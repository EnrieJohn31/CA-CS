<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentBatchImport;
use App\Models\student_data;
use App\Http\Controllers\Controller;


class batchUploadController extends Controller
{
    public function downloadStudentData()
{
    // Specify the relative path to the file
    $filePath = 'assets/downloads/student_data.xlsx';

    // Check if the file exists
    if (file_exists(public_path($filePath))) {
        // Define the headers for the response
        $headers = [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="student_data.xlsx"',
        ];

        // Create the response object
        return Response::download(public_path($filePath), 'student_data.xlsx', $headers);
    } else {
        // If the file does not exist, return a 404 response or handle it as needed
        abort(404, 'File not found');
    }
}
    public function index(){

        return view('forms.batch_upload');

    }

    public function importExcel(Request $request)
    {
        // Excel::import(new StudentBatchImport, request()->file('file'));

        // return redirect('/forms/batch_upload')->with('success', 'Import Complete');

        try {
            Excel::import(new StudentBatchImport, request()->file('file'));
            return redirect('/forms/batch_upload')->with('success', 'Import Complete');
        } catch (\Exception $e) {
            return redirect('/forms/batch_upload')->with('error', 'Error during import: ' . $e->getMessage());
        }
    }
}
