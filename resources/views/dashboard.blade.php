<x-app-layout>
    <x-slot name="header">
    <body>
        <div class="flex justify-between items-center">
            <!-- Heading -->
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="
    color: #ff7200; font-size: 35px;">
                Home Page
            </h2>

        </div>
    </x-slot>
    @section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="bg-white p-6 rounded-lg shadow">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Instructions for Students</h1>
            <p class="text-gray-600">
                Please follow the guidelines below to ensure proper usage of the platform and successful file uploads.
            </p>
        </div>
            </div>
             <!-- Instructions Section -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow">
            <ol class="list-decimal list-inside space-y-4 text-gray-700">
                <!-- Instruction 1 -->
                <li>
                    <strong>Upload Relevant Activities Only:</strong>
                    <ul class="list-disc ml-6 mt-2">
                        <li>Only activities relevant to college which will reflect the student's professional work and achievements.</li>
                        <li>Examples: Competition certificates, sports awards, hackathon recognitions, internships, publications, etc.</li>
                    </ul>
                </li>

                <!-- Instruction 2 -->
                <li>
                    <strong>File Upload Guidelines:</strong>
                    <ul class="list-disc ml-6 mt-2">
                        <li>Allowed file formats: <em>PDF, JPG, PNG, JPEG</em>.</li>
                        <li>Maximum file size: <em>2MB</em>.</li>
                        <li>Use clear and descriptive file names (e.g., <em>“Math_Competition_2023.pdf”</em>).</li>
                    </ul>
                </li>

                <!-- Instruction 3 -->
                <li>
                    <strong>Provide Accurate Information:</strong>
                    <ul class="list-disc ml-6 mt-2">
                        <li>Correctly fill in details, for example:
                            <ul class="ml-4">
                                <li><strong>Type of Achievement:</strong> Select Extra-curricular or Co-curricular.</li>
                                <li><strong>Name of Achievement:</strong> Provide a clear and specific title.</li>
                            </ul>
                        </li>
                        <li>Misleading or incomplete information may result in removal.</li>
                    </ul>
                </li>

                <!-- Instruction 4 -->
                <li>
                    <strong>Avoid Duplicate Entries:</strong>
                    <p class="mt-2">Check if the achievement has already been uploaded to prevent duplicates.</p>
                </li>

                <!-- Instruction 5 -->
                <li>
                    <strong>Maintain Professionalism:</strong>
                    <p class="mt-2">Only upload <em>authentic and verifiable achievements</em>. Avoid inappropriate or fake uploads.</p>
                </li>

                <!-- Instruction 6 -->
                <li>
                    <strong>Private Information:</strong>
                    <p class="mt-2">Do not upload files containing sensitive personal information (e.g., phone numbers, addresses).</p>
                </li>

                <!-- Instruction 7 -->
                <li>
                    <strong>Review Before Submission:</strong>
                    <p class="mt-2">Double-check the file and details before clicking the <em>Upload</em> button.</p>
                </li>

                <!-- Instruction 8 -->
                <li>
                    <strong>Contact us:</strong>
                    <ul class="list-disc ml-6 mt-2">
                        <li>Use the <strong>Contact us</strong> section in the user dropdown if you need help.</li>
                    </ul>
                </li>
            </ol>
        </div>
        </div>
    </div>
</body>
    @endsection
</x-app-layout>

