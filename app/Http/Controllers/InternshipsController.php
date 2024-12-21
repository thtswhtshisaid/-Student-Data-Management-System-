<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internship;  // Import Achievement model
use Illuminate\Support\Facades\Storage;

class InternshipsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Fetch achievements based on the search query
        $internships = Internship::query()
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })
        ->get();


        return view('internships', compact('internships')); // Make sure this view exists in resources/views
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
        $filePath = $request->file('file')->store('internships', 'public');
        Internship::create([
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
        $internship = Internship::where('user_id', auth()->id())->findOrFail($id);
        return view('edit', [
            'entity' => 'internships',
            'item' => $internship,
        ]);
    }
    
public function update(Request $request, $id)
{
    $request->validate([
        'type' => 'required|string',
        'name' => 'required|string',
        'instructor' => 'required|string',
        'file' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $internship = Internship::where('user_id', auth()->id())->findOrFail($id);
    $filePath = $internship->file; // Keep old file if no new file is uploaded

    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('internships', 'public');
    }

    $internship->update([
        'type' => $request->type,
        'name' => $request->name,
        'instructor' => $request->instructor,
        'file' => $filePath,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
    ]);

    return redirect()->route('internships')->with('success', 'Internship updated successfully!');
}
public function destroy($id)
{
    $internship = Internship::where('user_id', auth()->id())->findOrFail($id);
    Storage::delete('public/'.$internship->file); // Delete the file from storage
    $internship->delete();

    return redirect()->route('internships')->with('success', 'Internship deleted successfully!');
}
}
