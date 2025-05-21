<?php

namespace App\Http\Controllers;

use App\Models\student_data;
use App\Models\payments_summary;
use App\Models\monthly_payment;
use App\Models\User;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class studentController extends Controller
{
    public function index(Request $request)
    {

        $student_id = $request->student_id;

        // Use eloquent to fetch payment summaries only if the provided student ID matches
        $studentDetails = payments_summary::where('stud_id', $student_id)->get();

        $students = student_data::all();
        return view('tables.studentdata', compact('students','studentDetails'));

        // $students = $request->student_id;
        // $StudentDetails = student_data::find($student_id);
        // return response()->json(['details'=>$StudentDetails]);
    }

    public function archive()
    {
        $students = student_data::all();
        return view('tables.archived', compact('students'));
    }

    public function cashdisbursement()
    {
        $start_date = null;
        $end_date = null;
        $or_start = null;
        $or_end = null;
        $expense_fee = null;
        $sal_fee = null;
        $sss_fee = null;
        $pagibig_fee = null;
        $ew_fee = null;
        $seminar_fee = null;
        $payable_fee = null;
        $total_cashdisbursement = null;
        $total_sum = null;

        $users = User::all();
        $students = student_data::all();

        $tui_sum = student_data::sum('tui_fee');
        $reg_sum = student_data::sum('reg_fee');
        $uni_sum = student_data::sum('uni_fee');
        $oth_sum = student_data::sum('oth_fee');

        // $total_sum = $tui_sum + $reg_sum + $uni_sum + $oth_sum;

        // $total_sum = $total_sum - $expense_fee;

        return view('tables.cashdisbursement', compact('total_cashdisbursement', 'pagibig_fee', 'sal_fee', 'sss_fee', 'payable_fee', 'ew_fee', 'seminar_fee', 'students', 'expense_fee', 'users', 'tui_sum', 'reg_sum', 'uni_sum', 'oth_sum', 'total_sum', 'start_date', 'end_date', 'or_start', 'or_end'));
    }

    public function Saveform(Request $request)
    {

        // student_data::create($request->all());

        // return redirect()->route('form.student')->with('success', 'Student added successfully');

        // $validator = \Validator::make($request->all(), [
        //     'Id_num' => 'required|unique:student_data',
        //     'name' => 'required',
        //     'lvl' => 'required',
        // ], [
        //     'Id_num' => 'LRN Number already exist',
        //     'name' => 'Please Enter Student Name',
        //     'lvl' => 'Choose Grade Level',
        // ]);

        // if (!$validator->passes()) {
        //     return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        // } else {

        //     $student_data = new student_data();
        //     $student_data->Id_num = $request->Id_num;
        //     $student_data->name = $request->name;
        //     $student_data->section = $request->section;
        //     $student_data->lvl = $request->lvl;
        //     $student_data->strand = $request->strand;
        //     $student_data->phonenumber = $request->phonenumber;
        //     $student_data->ay = $request->ay;
        //     $student_data->reg_fee = $request->reg_fee;
        //     $student_data->tui_fee = $request->tui_fee;
        //     $student_data->uni_fee = $request->uni_fee;
        //     $query = $student_data->save();

        //     if (!$query) {
        //         return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        //     } else {
        //         return response()->json(['code' => 1, 'msg' => 'Student has been successfully saved']);
        //         //return redirect()->route('form.student')->with('success', 'Student added successfully');
        //     }
        // }

        $validator = \Validator::make($request->all(), [
            'Id_num' => 'required|unique:student_data',
            'fname' => 'required',
            'lname' => 'required',
            'mname' => 'nullable',
            'lvl' => 'required',
            'middle_initial' => 'nullable|unique:student_data,middle_initial',
        ], [
            'Id_num.required' => 'LRN Number is required',
            'Id_num.unique' => 'LRN Number already exists',
            'fname.required' => 'Please enter First Name',
            'lname.required' => 'Please enter Last Name',
            'lvl.required' => 'Choose Grade Level',
            'middle_initial.unique' => 'Middle initial must be unique',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $fullName = $request->fname;
        if ($request->filled('mname')) {
            $fullName .= ' ' . $request->mname;
        }
        if ($request->filled('middle_initial')) {
            $fullName .= ' ' . $request->middle_initial;
        }
        $fullName .= ' ' . $request->lname;

        $existingStudent = student_data::where('name', $fullName)->exists();
        if ($existingStudent) {
            return response()->json(['code' => 0, 'error' => ['mname' => ['Student with the same Name already exists']]]);
        }

        $student_data = new student_data();
        $student_data->Id_num = $request->Id_num;
        $student_data->name = $fullName;
        $student_data->section = $request->section;
        $student_data->lvl = $request->lvl;
        $student_data->strand = $request->strand;
        $student_data->phonenumber = $request->phonenumber;
        $student_data->ay = $request->ay;
        $student_data->reg_fee = $request->reg_fee;
        $student_data->tui_fee = $request->tui_fee;
        $student_data->uni_fee = $request->uni_fee;

        $query = $student_data->save();

        if (!$query) {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        } else {
            return response()->json(['code' => 1, 'msg' => 'Student has been successfully saved']);
        }

    }

    // GET ALL Students
    public function getStudentList(Request $request)
    {
        $students = student_data::all();
        return DataTables::of($students)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                                              <button class="btn btn-sm btn-primary" data-id="' . $row['id'] . '" id="editbtn">Update</button>
                                              <button class="btn btn-sm btn-warning" data-id="' . $row['id'] . '" id="archivebtn">Archive</button>
                                              <button  class="btn btn-sm btn-info" data-id="' . $row['id'] . '" id="historybtn">View</button>
                                        </div>';
            })
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" name="student_checkbox" data-id="' . $row['id'] . '"><label></label>';
            })

            ->rawColumns(['actions', 'checkbox'])
            ->make(true);
    }

    // GET ALL Students
    public function archivedStudentList()
    {
        $students = student_data::onlyTrashed()->get();
        return DataTables::of($students)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                                          <button class="btn btn-sm btn-success" data-id="' . $row['id'] . '" id="restorebtn">Restore</button>
                                          <button class="btn btn-sm btn-danger" data-id="' . $row['id'] . '" id="deletebtn">Delete</button>
                                    </div>';
            })
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" name="student_checkbox" data-id="' . $row['id'] . '"><label></label>';
            })

            ->rawColumns(['actions', 'checkbox'])
            ->make(true);
    }

    // public function edit(Request $request, $id)
    // {
    //     DB::table('student_data')
    //         ->where('id', $id)
    //         ->update(['or_no' => trim($request->or_num),
    //                 'datepaid' => trim($request->datep),
    //                 'totalf' => trim($request->total_fee),
    //                 'amount_paid' => trim($request->amountp),
    //                 'balance' => trim($request->balance)
    //         ]);

    //         return redirect()->route('form.student')->with('success', 'Student Updated Successfully');
    // }

    public function view(Request $request) {
        // $student_id = $request->student_id;
        // $studentDetails = student_data::find($student_id);
        // return response()->json(['details' => $studentDetails]);

        $student_id = $request->student_id;

        // $studentDetails = student_data::leftJoin('student_payables', 'student_payables.grade_lvl', '=', 'student_data.lvl')
        //     ->where('student_data.id' ,'=', $student_id)
        //     ->select('student_data.id' ,
        //     'student_data.or_no',
        //     'student_data.datepaid',
        //     'student_data.lvl',
        //     'student_data.name',
        //     'student_data.amount_paid',
        //     'student_data.balance',
        //     'student_data.total_fee',
        //     'student_data.oth_fee',
        //     'student_payables.registration_fee',
        //     'student_payables.tuition_fee',
        //     'student_payables.uniform_fee',
        //     // Testing
        //         'student_data.reg_fee',
        //         'student_data.tui_fee',
        //         'student_data.uni_fee',
        //         'student_data.Medical',
        //         'student_data.Insurance',
        //         'student_data.Death',
        //         'student_data.Library',
        //         'student_data.School_Pub',
        //         'student_data.Athlet',
        //         'student_data.BACS',
        //         'student_data.Book',
        //         'student_data.Laboratory',
        //         'student_data.StudentID',
        //         'student_data.Passbook',
        //         'student_data.Handbook',
        //         'student_data.Dental',
        //         'student_data.Completers_Fee',
        //         'student_data.Graduation_Fee'
        //     )
        //     ->first();

        $studentDetails = student_data::leftJoin('student_payables', 'student_payables.grade_lvl', '=', 'student_data.lvl')
    ->leftJoin('monthly_payments', 'monthly_payments.stud_id', '=', 'student_data.id')
    ->where('student_data.id', '=', $student_id)
    ->select('student_data.id',
        'student_data.or_no',
        'student_data.datepaid',
        'student_data.lvl',
        'student_data.name',
        'student_data.amount_paid',
        'student_data.balance',
        'student_data.total_fee',
        'student_data.oth_fee',
        'student_payables.registration_fee',
        'student_payables.tuition_fee',
        'student_payables.uniform_fee',
        'student_data.reg_fee',
        'student_data.tui_fee',
        'student_data.uni_fee',
        'student_data.Medical',
        'student_data.Insurance',
        'student_data.Death',
        'student_data.Library',
        'student_data.School_Pub',
        'student_data.Athlet',
        'student_data.BACS',
        'student_data.Book',
        'student_data.Laboratory',
        'student_data.StudentID',
        'student_data.Passbook',
        'student_data.Handbook',
        'student_data.Dental',
        'student_data.Completers_Fee',
        'student_data.Graduation_Fee',
        'monthly_payments.january',
        'monthly_payments.february',
        'monthly_payments.march',
        'monthly_payments.april',
        'monthly_payments.may',
        'monthly_payments.june',
        'monthly_payments.july',
        'monthly_payments.august',
        'monthly_payments.september',
        'monthly_payments.october',
        'monthly_payments.november',
        'monthly_payments.december'
    )
    ->first();
        return response()->json(['details' => $studentDetails]);
    }

    public function payments_history(Request $request) {
        // $student_id = $request->student_id;

        // // Use the where condition to filter by stud_id if student_id is provided
        // $query = payments_summary::query();

        // if ($student_id) {
        //     $query->where('stud_id', $student_id);
        // }

        // $studentDetails = $query->get();

        // return response()->json(['details' => $studentDetails]);

        //edit
        $student_id = $request->student_id;

        $studentDetails = payments_summary::when($student_id, function ($query) use ($student_id) {
            return $query->where('stud_id', $student_id);
        })->get();

        return response()->json(['details' => $studentDetails]);

        // $student_id = $request->student_id;

        // $studentDetails = payments_summary::where('stud_id', $student_id)->get();

        // return response()->json(['details' => $studentDetails]);


    }

    public function update(Request $request)
    {
        try {
            $student_id = $request->sid;

            // Check for duplicate or_no in payments_summary table
            $existingPayment = payments_summary::where('or_num', $request->or_num)->first();
            if ($existingPayment) {
                return response()->json(['code' => 0, 'msg' => 'Error: Duplicate Official Number found.']);
            }

            // Insert into payments_summary table
            $payment_data = new payments_summary();
            $payment_data->stud_id = $request->sid;
            $payment_data->or_num = $request->or_num;
            $payment_data->datepaid = Carbon::now();
            $payment_data->total_fee = $request->totalf;
            $payment_data->amount_paid = $request->amountp;
            $payment_data->balance = $request->balance;
            $payment_data->save();

            $monthly_payments = new monthly_payment();
            $monthly_payments->stud_id = $request->sid;

            $monthly_payments->january = $request->january;
            $monthly_payments->february = $request->february;
            $monthly_payments->march = $request->march;
            $monthly_payments->april = $request->april;
            $monthly_payments->may = $request->may;
            $monthly_payments->june = $request->june;
            $monthly_payments->july = $request->july;
            $monthly_payments->august = $request->august;
            $monthly_payments->september = $request->september;
            $monthly_payments->october = $request->october;
            $monthly_payments->november = $request->november;
            $monthly_payments->december = $request->december;
            $monthly_payments->save();

            $request->validate([
                'or_num' => 'required|digits_between:1,6',
            ], [
                'or_num' => 'OR NO must be 6 digits only',
            ]);

            // Update student_data table
            $student = student_data::find($student_id);
            $student->or_no = $request->or_num;
            $student->datepaid = $request->datep;
            $student->tui_fee = $request->tui_fee;
            // $student->uni_fee = $request->uni_fee;

            $student->Medical = $request->Medical;
            $student->Insurance = $request->Insurance;
            $student->Death = $request->Death;
            $student->Library = $request->Library;
            $student->School_Pub = $request->School_Pub;
            $student->Athlet = $request->Athlet;
            $student->BACS = $request->BACS;
            $student->Book = $request->Book;
            $student->Laboratory = $request->Laboratory;
            $student->StudentID = $request->StudentID;
            $student->Passbook = $request->Passbook;
            $student->Handbook = $request->Handbook;
            $student->Dental = $request->Dental;
            $student->Completers_Fee = $request->Completers_Fee;
            $student->Graduation_Fee = $request->graduation;

            $student->oth_fee = $request->oth_fee;
            $student->total_fee = $request->fulltotalf;
            $student->amount_paid = $request->amountp;
            $student->balance = $request->balance;
            $student->save();

            return response()->json(['code' => 1, 'msg' => 'Student Payment Successfully Saved']);
        } catch (\Exception $e) {
            return response()->json(['code' => 0, 'msg' => 'Error: ' . $e->getMessage()]);
        }

    }

    public function restoreStudent(Request $request)
    {
        $id = $request->input('sid'); // Access the 'sid' parameter from the request

        $restoredStudent = student_data::withTrashed()->find($id);

        if ($restoredStudent) {
            $restoredStudent->restore();
            return response()->json(['success' => true, 'message' => 'Student restored successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Student not found']);
        }
    }

    public function archiveStudent(Request $request)
    {
        $student_id = $request->student_id;
        $query = student_data::find($student_id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Student has been archive from database']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    public function archiveSelectedStudents(Request $request)
    {
        $Student_ids = $request->Student_ids;
        student_data::whereIn('id', $Student_ids)->delete();
        return response()->json(['code' => 1, 'msg' => 'Students have been archive from database']);
    }

    public function deleteStudent(Request $request)
    {
        $student_id = $request->student_id;
        $query = student_data::withTrashed()->where('id', $student_id)->forceDelete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Student has been deleted from database']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    public function deleteSelectedStudents(Request $request)
    {
        $Student_ids = $request->Student_ids;
        student_data::withTrashed()->whereIn('id', $Student_ids)->forceDelete();
        return response()->json(['code' => 1, 'msg' => 'Students have been deleted from database']);
    }


}
