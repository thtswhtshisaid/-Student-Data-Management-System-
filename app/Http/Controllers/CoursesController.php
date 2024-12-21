<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;  // Import Achievement model
use Illuminate\Support\Facades\Storage;

class CoursesController extends Controller
{
    // Method to display the achievements page
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Fetch achievements based on the search query
        $courses = Course::query()
        ->where('user_id', auth()->id())
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })
        ->get();


        return view('courses', compact('courses')); // Make sure this view exists in resources/views
    }

    // Method to handle file uploads
    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'type' => 'required|string',
            'name' => 'required|string',
            'org_body' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'file' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048',
        ]);

        // Store the uploaded file in the 'achievements' folder under 'storage/app/public'
        $filePath = $request->file('file')->store('courses', 'public');
        Course::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'name' => $request->name,
            'org_body' => $request->org_body,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'file' => $filePath,
        ]);

        // Return success message
        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
    public function edit($id)
{
    $course = Course::where('user_id', auth()->id())->findOrFail($id);
    return view('edit', [
        'entity' => 'courses',
        'item' => $course,
    ]);
}

    public function update(Request $request, $id)
{
    $request->validate([
        'type' => 'required|string',
        'name' => 'required|string',
        'org_body' => 'required|string',
        'file' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $course = Course::where('user_id', auth()->id())->findOrFail($id);
    $filePath = $course->file; // Keep old file if no new file is uploaded

    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('courses', 'public');
    }

    $course->update([
        'type' => $request->type,
        'name' => $request->name,
        'org_body' => $request->org_body,
        'file' => $filePath,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
    ]);

    return redirect()->route('courses')->with('success', 'Course updated successfully!');
}
public function destroy($id)
{
    $course = Course::where('user_id', auth()->id())->findOrFail($id);
    Storage::delete('public/'.$course->file); // Delete the file from storage
    $course->delete();

    return redirect()->route('courses')->with('success', 'Course deleted successfully!');
}

}
