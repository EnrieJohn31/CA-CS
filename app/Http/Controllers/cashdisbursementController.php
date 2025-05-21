<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class cashdisbursementController extends Controller
{
    public function index()
    {
        $students = student_data::all();
        return view('tables.studentdata', compact('students'));
    }
}
