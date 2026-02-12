<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProjectContent;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $selectedYear = $request->query('year', '2024-2025');
        $contents = ProjectContent::where('year_range', $selectedYear)->orderBy('page_number')->get();
        $years = ['2024-2025', '2026-2027', '2028-2029']; // Updated to ranges

        // If no content found for the selected year (and it's not the default), we pass a flag
        $noContent = $contents->isEmpty();

        return view('welcome', compact('contents', 'selectedYear', 'years', 'noContent'));
    }
}
