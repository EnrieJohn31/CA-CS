<?php

namespace App\Http\Controllers;

use App\Models\student_data;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {
        $count = student_data::count();

        $no_balance = student_data::where('balance', '=', 0)
                    ->orWhereNull('balance')
                    ->count();

        $has_balance = student_data::where('balance', '>', 0)->count();

        return view('dashboard.main', compact('count', 'no_balance', 'has_balance'));

    }
    public function aboutus()
    {

        return view('about.developers');

    }
    public function sysinfo()
    {

        return view('about.system');

    }
}
