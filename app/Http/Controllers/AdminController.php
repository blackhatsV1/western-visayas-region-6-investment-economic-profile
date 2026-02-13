<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectContent;
use App\Models\Inquiry;
use App\Exports\ProjectContentExport;
use Maatwebsite\Excel\Facades\Excel;

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

        $inquiries = Inquiry::latest()->get();

        return view('admin.dashboard', compact('contents', 'selectedYear', 'years', 'inquiries'));
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

    public function export(Request $request)
    {
        $year = $request->query('year', '2024-2025');
        return Excel::download(new ProjectContentExport($year), "economic-profile-{$year}.xlsx");
    }

    public function gridView(Request $request)
    {
        $selectedYear = $request->query('year', '2024-2025');
        $contents = ProjectContent::where('year_range', $selectedYear)->orderBy('page_number')->get();
        
        $years = ProjectContent::distinct()->pluck('year_range')->toArray();
        if (empty($years)) {
            $years = ['2024-2025'];
        }
        sort($years);

        return view('admin.grid', compact('contents', 'selectedYear', 'years'));
    }

    public function destroy(ProjectContent $content)
    {
        $content->delete();
        return response()->json(['success' => true]);
    }

    public function destroyYear($year)
    {
        ProjectContent::where('year_range', $year)->delete();
        return response()->json(['success' => true]);
    }

    public function destroyInquiry(Inquiry $inquiry)
    {
        $inquiry->delete();
        return response()->json(['success' => true]);
    }
}
