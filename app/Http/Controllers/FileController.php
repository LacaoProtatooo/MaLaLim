<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use PDF;

class FileController extends Controller
{
    // Excel Import
    // SAMPLE ONLY
    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
 
        // Get the uploaded file
        $file = $request->file('file');
 
        // Process the Excel file
        //Excel::import(new YourImportClass, $file);
 
        return redirect()->back()->with('success', 'Excel file imported successfully!');
    }

    // PDF Export
    // SAMPLE ONLY
    public function generatePDF()
    {
        $data = ['title' => 'domPDF in Laravel 10'];
        $pdf = PDF::loadView('pdf.document', $data);
        return $pdf->download('document.pdf');
    }
}
