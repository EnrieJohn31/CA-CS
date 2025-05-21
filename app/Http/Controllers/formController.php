<?php

namespace App\Http\Controllers;

use App\Models\student_data;
use App\Models\User;
use Illuminate\Http\Request;

class formController extends Controller
{
    public function index()
    {
        $users = User::all();
        $students = student_data::all();
        return view('forms.index', compact('students', 'users'));
    }

    public function reportindex(Request $request)
    {

        $start_date = null;
        $end_date = null;
        $or_start = null;
        $or_end = null;
        $tui_sum = null;
        $reg_sum = null;
        $uni_sum = null;
        $oth_sum = null;
        $total_sum = null;

        $Medical= null;
        $Insurance= null;
        $Death= null;
        $Library= null;
        $School_Pub= null;
        $Athlet= null;
        $BACS= null;
        $Book= null;
        $Laboratory= null;
        $StudentID= null;
        $Passbook= null;
        $Handbook= null;
        $Dental= null;
        $Completers_Fee= null;
        $graduation= null;

        $users = User::all();
        $students = student_data::all();

        // $tui_sum = student_data::sum('tui_fee');
        // $reg_sum = student_data::sum('reg_fee');
        // $uni_sum = student_data::sum('uni_fee');
        // $oth_sum = student_data::sum('oth_fee');

        // $total_sum = $tui_sum + $reg_sum + $uni_sum + $oth_sum;

        return view('reports.index', compact('students', 'users', 'Medical',
        'Insurance',
        'Death',
        'Library',
        'School_Pub',
        'Athlet',
        'BACS',
        'Book',
        'Laboratory',
        'StudentID',
        'Passbook',
        'Handbook',
        'Dental',
        'Completers_Fee',
        'graduation', 'tui_sum', 'reg_sum', 'uni_sum', 'oth_sum', 'total_sum', 'start_date', 'end_date', 'or_start', 'or_end'));
    }

    public function total(Request $request)
    {
        $start_date = $request->startdate;
        $end_date = $request->enddate;

        $or_start = student_data::where('datepaid', $start_date)->value('or_no');
        $or_end = student_data::where('datepaid', $end_date)->value('or_no');

        // Filter student_data based on the date range
        $studentDetails = student_data::whereBetween('datepaid', [$start_date, $end_date])->get();

        // Calculate sums for the filtered data
        $tui_sum = $studentDetails->sum('tui_fee');
        $reg_sum = $studentDetails->sum('reg_fee');
        $uni_sum = $studentDetails->sum('uni_fee');

        $Medical        = $studentDetails->sum('Medical');
        $Insurance      = $studentDetails->sum('Insurance');
        $Death          = $studentDetails->sum('Death');
        $Library        = $studentDetails->sum('Library');
        $School_Pub     = $studentDetails->sum('School_Pub');
        $Athlet         = $studentDetails->sum('Athlet');
        $BACS           = $studentDetails->sum('BACS');
        $Book           = $studentDetails->sum('Book');
        $Laboratory     = $studentDetails->sum('Laboratory');
        $StudentID      = $studentDetails->sum('StudentID');
        $Passbook       = $studentDetails->sum('Passbook');
        $Handbook       = $studentDetails->sum('Handbook');
        $Dental         = $studentDetails->sum('Dental');
        $Completers_Fee = $studentDetails->sum('Completers_Fee');
        $graduation     = $studentDetails->sum('Graduation_Fee');


        $oth_sum = $studentDetails->sum('oth_fee');

        $total_sum = $tui_sum + $reg_sum + $uni_sum + $oth_sum + $Medical + $Insurance + $Death + $Library + $School_Pub + $Athlet + $BACS + $Book + $Laboratory + $StudentID + $Passbook
                    + $Handbook + $Dental + $Completers_Fee + $graduation;

        return view('reports.index',
        compact(
        'studentDetails',
        'tui_sum',
        'reg_sum',
        'Medical',
        'Insurance',
        'Death',
        'Library',
        'School_Pub',
        'Athlet',
        'BACS',
        'Book',
        'Laboratory',
        'StudentID',
        'Passbook',
        'Handbook',
        'Dental',
        'Completers_Fee',
        'graduation',
        'uni_sum',
        'oth_sum',
        'total_sum',
        'end_date',
        'start_date',
        'or_start',
        'or_end')
    );
}

    public function cashless_total(Request $request)
    {
        $start_date = null;
        $end_date = null;
        $start_date = $request->startdate;
        $end_date = $request->enddate;

        $expense_fee = null;
        $total_cashdisbursement = null;
        $sal_fee = $request->input('sal_fee');
        $pagibig_fee = $request->input('pagibig_fee');
        $sss_fee = $request->input('sss_fee');
        $ew_fee = $request->input('ew_fee');
        $seminar_fee = $request->input('seminar_fee');
        $payable_fee = $request->input('payable_fee');

        $or_start = student_data::where('datepaid', $start_date)->value('or_no');
        $or_end = student_data::where('datepaid', $end_date)->value('or_no');

        // Filter student_data based on the date range
        $studentDetails = student_data::whereBetween('datepaid', [$start_date, $end_date])->get();

        // Calculate sums for the filtered data
        $tui_sum = $studentDetails->sum('tui_fee');
        $reg_sum = $studentDetails->sum('reg_fee');
        $uni_sum = $studentDetails->sum('uni_fee');
        $oth_sum = $studentDetails->sum('oth_fee');

        $total_sum = $tui_sum + $reg_sum + $uni_sum + $oth_sum;

        $expense_fee = $sal_fee + $sss_fee + $pagibig_fee  + $ew_fee + $seminar_fee + $payable_fee;

        $total_cashdisbursement = $total_sum - $expense_fee;

        return view('tables.cashdisbursement', compact('total_cashdisbursement','pagibig_fee','payable_fee','expense_fee','sal_fee','sss_fee','ew_fee','seminar_fee','total_cashdisbursement', 'studentDetails', 'tui_sum', 'reg_sum', 'uni_sum', 'oth_sum', 'total_sum', 'end_date', 'start_date', 'or_start', 'or_end'));
    }
}
