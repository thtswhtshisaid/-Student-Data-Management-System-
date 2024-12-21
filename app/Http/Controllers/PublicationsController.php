<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;  // Import publication model
use Illuminate\Support\Facades\Storage;

class PublicationsController extends Controller
{
    // Method to display the publications page
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Fetch publications based on the search query
        $publications = Publication::query()
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })
        ->get();


        return view('publications', compact('publications')); // Make sure this view exists in resources/views
    }

    // Method to handle file uploads
    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'type' => 'required|string',
            'name' => 'required|string',
            'org_body' => 'required|string',
            'upload_date' => 'required|date',
            'file' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Store the uploaded file in the 'publications' folder under 'storage/app/public'
        $filePath = $request->file('file')->store('publications', 'public');
        Publication::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'name' => $request->name,
            'org_body' => $request->org_body,
            'upload_date' => $request->upload_date,
            'file' => $filePath,
        ]);

        // Return success message
        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
    public function edit($id)
{
    $publication = Publication::where('user_id', auth()->id())->findOrFail($id);
    return view('edit', [
        'entity' => 'publications',
        'item' => $publication,
    ]);
}

public function update(Request $request, $id)
{
    $request->validate([
        'type' => 'required|string',
        'name' => 'required|string',
        'org_body' => 'required|string',
        'file' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048',
        'upload_date' => 'required|date',
    ]);

    $publication = Publication::where('user_id', auth()->id())->findOrFail($id);
    $filePath = $publication->file; // Keep old file if no new file is uploaded

    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('publications', 'public');
    }

    $publication->update([
        'type' => $request->type,
        'name' => $request->name,
        'org_body' => $request->org_body,
        'file' => $filePath,
        'upload_date' => $request->upload_date,
    ]);

    return redirect()->route('publications')->with('success', 'Publication updated successfully!');
}
public function destroy($id)
{
    $publication = Publication::where('user_id', auth()->id())->findOrFail($id);
    Storage::delete('public/'.$publication->file); // Delete the file from storage
    $publication->delete();

    return redirect()->route('publications')->with('success', 'Publication deleted successfully!');
}
}
