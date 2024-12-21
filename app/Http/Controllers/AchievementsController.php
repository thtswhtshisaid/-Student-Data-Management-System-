<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achievement;  // Import Achievement model
use Illuminate\Support\Facades\Storage;

class AchievementsController extends Controller
{
    // Method to display the achievements page
    public function index(Request $request)
{
    $search = $request->input('search');

    // Modify the query to only get achievements for the logged-in user
    $achievements = Achievement::query()
        ->where('user_id', auth()->id())  // Add this line to filter by user
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })
        ->get();

    return view('achievements', compact('achievements'));
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
        $filePath = $request->file('file')->store('achievements', 'public');
        Achievement::create([
            'user_id' => auth()->id(),//this
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
        $achievement = Achievement::where('user_id', auth()->id())->findOrFail($id);//This
        return view('edit', [
            'entity' => 'achievements',
            'item' => $achievement,
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

    $achievement = Achievement::where('user_id', auth()->id())->findOrFail($id);
    $filePath = $achievement->file; // Keep old file if no new file is uploaded

    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('achievements', 'public');
    }

    $achievement->update([
        'type' => $request->type,
        'name' => $request->name,
        'org_body' => $request->org_body,
        'file' => $filePath,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
    ]);

    return redirect()->route('achievements')->with('success', 'Achievement updated successfully!');
}
public function destroy($id)
{
    $achievement = Achievement::where('user_id', auth()->id())->findOrFail($id);
    Storage::delete('public/'.$achievement->file); // Delete the file from storage
    $achievement->delete();

    return redirect()->route('achievements')->with('success', 'Achievement deleted successfully!');
}

}
