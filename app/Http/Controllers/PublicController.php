<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProjectContent;
use App\Models\Inquiry;

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

    public function submitContactForm(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'contact' => 'required|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        try {
            $inquiry = Inquiry::create($validated);
            
            $subject = "Inquiry: " . $validated['name'];
            $body = "Name: " . $validated['name'] . "\r\n" .
                    "Email: " . $validated['email'] . "\r\n" .
                    "Contact: " . $validated['contact'] . "\r\n\r\n" .
                    "Inquiry:\r\n" . $validated['message'];
            
            $mailto = "mailto:r06@dti.gov.ph?subject=" . rawurlencode($subject) . "&body=" . rawurlencode($body);

            return response()->json(['success' => true, 'mailto' => $mailto]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to save inquiry.'], 500);
        }
    }
}
