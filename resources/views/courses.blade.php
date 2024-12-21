@extends('layouts.app') <!-- Extends the main layout where navigation links exist -->

@section('content') <!-- Page-specific content goes here -->
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">

      <!-- Search Form -->
      <div class="mt-8 bg-white p-6 shadow-sm rounded-lg">
            <form method="GET" action="{{ route('courses') }}">
                <div class="flex items-center">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by name"
                           class="w-full px-4 py-2 border border-gray-300 rounded-l-lg shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-r-lg">Search</button>
                </div>
            </form>
        </div>
        
    <!-- Upload Form -->
    <div class="bg-white p-6 shadow-sm rounded-lg">
        <h1 class="text-2xl font-semibold text-gray-800">Upload Courses/Workshops</h1>
        <form action="{{ route('courses.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Course/Workshop</label>
                <select name="type" id="type" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                    <option value="Course">Course</option>
                    <option value="Workshop">Workshop</option>
                </select>
            </div>
            <div class="mt-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name of COurse/Workshop</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm" required>
            </div>
            <div class="mt-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name of Organizing body</label>
                <input type="text" name="org_body" id="org_body" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm" required>
            </div>
            <div class="mt-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm" required>
            </div>
            <div class="mt-4">
                <label for="name" class="block text-sm font-medium text-gray-700">End Date</label>
                <input type="date" name="end_date" id="end_date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm" required>
            </div>
            <div class="mt-4">
                <label for="file" class="block text-sm font-medium text-gray-700">Upload Certificate</label>
                <input type="file" name="file" id="file" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm" required>
            </div>
            <button type="submit" class="mt-4 px-4 py-2 bg-orange-500 text-white rounded-lg">Upload</button>
        </form>
    </div>

    <!-- Table to display uploaded achievements -->
    <div class="bg-white p-6 shadow-sm rounded-lg mt-8">
        <h2 class="text-xl font-semibold text-gray-800">Uploaded Course & wokrshop</h2>
        <table class="min-w-full mt-4">
            <thead>
                <tr class="border-b">
                    <th class="px-4 py-2 text-left">Type</th>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Organizing Body</th>
                    <th class="px-4 py-2 text-left">File</th>
                    <th class="px-4 py-2 text-left">Start Date</th>
                    <th class="px-4 py-2 text-left">End Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td class="px-4 py-2">{{ $course->type }}</td>
                        <td class="px-4 py-2">{{ $course->name }}</td>
                        <td class="px-4 py-2">{{ $course->org_body }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ asset('storage/'.$course->file) }}" class="text-orange-500" target="_blank">View File</a>
                        </td>
                        <td class="px-4 py-2">{{ $course->start_date }}</td>
                        <td class="px-4 py-2">{{ $course->end_date }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('courses.edit', $course->id) }}" class="text-orange-500">Edit</a> |
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
