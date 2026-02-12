<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectContent;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $selectedYear = $request->query('year', '2024-2025');
        $contents = ProjectContent::where('year_range', $selectedYear)->orderBy('page_number')->get();
        
        $years = ProjectContent::distinct()->pluck('year_range')->toArray();
        if (empty($years)) {
            $years = ['2024-2025'];
        }
        sort($years);

        return view('admin.dashboard', compact('contents', 'selectedYear', 'years'));
    }

    public function update(Request $request, ProjectContent $content)
    {
        $validated = $request->validate([
            'section_title' => 'required|string',
            'content' => 'required|array',
            'source' => 'nullable|string',
        ]);

        $content->update($validated);

        return response()->json(['success' => true, 'content' => $content]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year_range' => 'required|string',
            'type' => 'required|string',
            'section_title' => 'required|string',
            'content' => 'required|array',
            'page_number' => 'required|integer',
        ]);

        $content = ProjectContent::create($validated);

        return response()->json(['success' => true, 'content' => $content]);
    }
}
