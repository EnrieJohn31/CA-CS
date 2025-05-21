<?php

namespace App\Http\Controllers;

use App\Models\student_data;

use App\Models\payments_summary;

use Illuminate\Http\Request;

class moreinfoController extends Controller
{
    public function registered_students () {
        $students = student_data::paginate(5);

        return view('moreinfo.registered', compact('students'));
    }
    public function paid_students () {

        $no_balance = student_data::where('balance', '=', 0)
                    ->orWhereNull('balance')
                    ->paginate(5);

        return view('moreinfo.paid', compact('no_balance'));
    }
    public function withbalance_students () {
        $has_balance = student_data::where('balance', '>', 0)->paginate(5);

        return view('moreinfo.withbalance', compact('has_balance'));
    }

    public function payment_summary(Request $request)
    {

        $student_id = $request->input('student_id');

        // Use eloquent to fetch payment summaries only if the provided student ID matches
        // $studentDetails = payments_summary::leftJoin('student_data', 'payments_summary.stud_id', '=', 'student_data.id')
        //     ->where('payments_summary.stud_id', $student_id)
        //     ->select('payments_summary.*', 'student_data.*')
        //     ->get();

        $student_id = $request->student_id;

        $studentDetails = payments_summary::where('stud_id', $student_id)->get();

        // return response()->json(['details' => $studentDetails]);

        $student = student_data::where('id', $student_id)->first();

        // Get the name from the student record
        $name = $student->name;
        $section = $student->lvl . ' - ' . $student->section;
        $stud_id = $student->Id_num;
                $Medical        = $student->Medical;
                $Insurance      = $student->Insurance;
                $Death          = $student->Death;
                $Library        = $student->Library;
                $School_Pub     = $student->School_Pub;
                $Athlet         = $student->Athlet;
                $BACS           = $student->BACS;
                $Book           = $student->Book;
                $Laboratory     = $student->Laboratory;
                $StudentID      = $student->StudentID;
                $Passbook       = $student->Passbook;
                $Handbook       = $student->Handbook;
                $Dental         = $student->Dental;
                $Completers_Fee = $student->Completers_Fee;
                $graduation     = $student->Graduation_Fee;
                $fulltotalf     = $student->total_fee;
                $amountp        = $student->amount_paid;

        // Assuming you need to return details as an array
        $details = $studentDetails->toArray();

        return response()->json([
        'details' => $details,
        'name' => $name,
        'section' => $section,
        'stud_id'=> $stud_id,
        'Medical'=>$Medical,
        'Insurance'=>$Insurance,
        'Death'=>$Death,
        'Library'=>$Library,
        'School_Pub'=>$School_Pub,
        'Athlet'=>$Athlet,
        'BACS'=>$BACS,
        'Book'=>$Book,
        'Laboratory'=>$Laboratory,
        'StudentID'=>$StudentID,
        'Passbook'=>$Passbook,
        'Handbook'=>$Handbook,
        'Dental'=>$Dental,
        'Completers_Fee'=>$Completers_Fee,
        'graduation'=>$graduation,
        'fulltotalf'=>$fulltotalf,
        'amountp'=>$amountp
        ]);

        // $students = $request->student_id;
        // $StudentDetails = student_data::find($student_id);
        // return response()->json(['details'=>$StudentDetails]);
    }
}
