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
        $years = ProjectContent::distinct()->pluck('year_range')->toArray();
        if (empty($years)) {
            $years = ['2024-2025'];
        }
        sort($years);
        $noContent = $contents->isEmpty();

        return view('welcome', compact('contents', 'selectedYear', 'years', 'noContent'));
    }
}
