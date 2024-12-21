
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit {{ ucfirst($entity) }}
        </h2>
    </x-slot>
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <form action="{{ route($entity . '.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Type Field -->
                    <div class="mt-4">
                        <label for="type" class="block font-medium text-sm text-gray-700">Type</label>
                        <select name="type" id="type" class="block w-full mt-1" required>
                            @if ($entity == 'achievements')
                                <option value="extra" {{ $item->type == 'extra' ? 'selected' : '' }}>Extra</option>
                                <option value="co-ciricular" {{ $item->type == 'co-ciricular' ? 'selected' : '' }}>Co-ciricular</option>
                            @elseif ($entity == 'courses')
                                <option value="course" {{ $item->type == 'course' ? 'selected' : '' }}>Course</option>
                                <option value="workshop" {{ $item->type == 'workshop' ? 'selected' : '' }}>Workshop</option>
                            @elseif ($entity == 'internships')
                                <option value="external" {{ $item->type == 'external' ? 'selected' : '' }}>External</option>
                                <option value="inhouse" {{ $item->type == 'inhouse' ? 'selected' : '' }}>Inhouse</option>
                            @elseif ($entity == 'publications')
                                <option value="national" {{ $item->type == 'national' ? 'selected' : '' }}>National</option>
                                <option value="international" {{ $item->type == 'international' ? 'selected' : '' }}>International</option>
                            @endif
                        </select>
                    </div>

                    <!-- Name Field -->
                    <div class="mt-4">
                        <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ $item->name }}" class="block w-full mt-1" required>
                    </div>

                    <!-- Organisation/Body Field -->
                    <div class="mt-4">
                        <label for="org_body" class="block font-medium text-sm text-gray-700">Organisation Body</label>
                        <input type="text" name="org_body" id="org_body" value="{{ $item->org_body }}" class="block w-full mt-1" required>
                    </div>

                    <!-- Start Date Field -->
                    @if ($entity != 'publications')
                        <div class="mt-4">
                            <label for="start_date" class="block font-medium text-sm text-gray-700">Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ $item->start_date }}" class="block w-full mt-1" required>
                        </div>
                    @endif

                    <!-- End Date Field -->
                    @if ($entity != 'publications')
                        <div class="mt-4">
                            <label for="end_date" class="block font-medium text-sm text-gray-700">End Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ $item->end_date }}" class="block w-full mt-1" required>
                        </div>
                    @endif

                    <!-- Upload Date Field (For Publications Only) -->
                    @if ($entity == 'publications')
                        <div class="mt-4">
                            <label for="upload_date" class="block font-medium text-sm text-gray-700">Upload Date</label>
                            <input type="date" name="upload_date" id="upload_date" value="{{ $item->upload_date }}" class="block w-full mt-1" required>
                        </div>
                    @endif

                    <!-- File Field -->
                    <div class="mt-4">
                        <label for="file" class="block font-medium text-sm text-gray-700">File (leave blank to keep current)</label>
                        <input type="file" name="file" id="file" class="block w-full mt-1">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
</x-app-layout>
