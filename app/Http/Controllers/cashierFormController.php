<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

use App\Models\student_data;
use App\Models\payments_summary;
use App\Models\student_payables;
use App\Models\student_mfees;

use Illuminate\Http\Request;

class cashierFormController extends Controller
{
    public function index(){
        return view('cashier_form.index');
    }

    public function searchStudentForm(){

        $str='';

        $str .='<div class="row">';

            $str .='<div class="col-md-12">';
                $str .='<div class="mb-3">';

                    $str .='<input type="text" class="form-control" name="search_student" id="search_student" value="" onkeyup="searchStudent()">';
                $str .='</div>';
            $str .='</div>';

        $str .='</div>';

        $str .='<div class="row">';
            $str .='<table class="table table-hover">';
                $str .='<thead>';
                    $str .='<tr>';
                        $str .='<th scope="col">ID</th>';
                        $str .='<th scope="col">Student ID</th>';
                        $str .='<th scope="col">Student Name</th>';
                        $str .='<th scope="col">Grade Level</th>';
                    $str .='</tr>';
                $str .='</thead>';
                $str .='<tbody id="empdata_body">';
                $str .='</tbody>';
            $str .='</table>';
        $str .='</div>';

        return $str;

    }

    public function searchStudent(Request $request){

        $keyword    = $request->keyword;

        $requests = DB::table('student_data')
        ->select('id','Id_num','name','lvl')
        ->where('Id_num', 'like', '%' . $keyword . '%')
        ->orWhere('name', 'like', '%' . $keyword . '%')
        ->orWhere('lvl', 'like', '%' . $keyword . '%')
        ->get();

        $str='';

        if(count($requests) > 0){
            foreach ($requests as $request) {
                $str .='<tr OnClick="clickStudent('.$request->id.')">';
                $str .='<td>'.$request->id.'</td>';
                $str .='<td>'.$request->Id_num.'</td>';
                $str .='<td>'.$request->name.'</td>';
                $str .='<td>'.$request->lvl.'</td>';
                $str .='</tr>';
            }
        }else{

                $str .='<tr><td style="text-align:center;" colspan="3">NO RESULTS FOUND</td></tr>';
          }
          return $str;
    }

    public function GetStudent(Request $request){

        $requests = DB::table('student_data')
            ->leftJoin('student_payables', 'student_payables.grade_lvl', '=', 'student_data.lvl')
            ->crossJoin('student_mfees')
            ->where('student_data.id', '=', $request->id)
            ->select(
                'student_data.Id_num',
                'student_data.lvl',
                'student_data.name',
                'student_data.section',
                'student_data.strand',
                'student_data.phonenumber',
                'student_data.ay',
                'student_payables.registration_fee',
                'student_payables.tuition_fee',
                'student_payables.uniform_fee',
                'student_mfees.Medical',
                'student_mfees.Insurance',
                'student_mfees.Death',
                'student_mfees.Library',
                'student_mfees.School_Pub',
                'student_mfees.Athlet',
                'student_mfees.BACS',
                'student_mfees.Book',
                'student_mfees.Laboratory',
                'student_mfees.StudentID',
                'student_mfees.Passbook',
                'student_mfees.Handbook',
                'student_mfees.Dental',
                'student_mfees.Completers_Fee',
                'student_mfees.Graduation_Fee',

            )
            ->get();

        echo json_encode($requests);

    }

    public function GetStudentPayment(Request $request){

        $requests = student_payables::where('id', $id);

        if ($lvl) {
            $requests->where('grade_lvl', $lvl);
        }

        $result = $requests->get();

        echo json_encode($result);

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
        //     'Id_num' => 'Please Enter a Correct Student ID',
        //     'name' => 'Please Enter Student Name',
        //     'lvl' => 'Choose Grade Level',
        // ]);

        // if (!$validator->passes()) {
        //     return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        // } else {

            // $student_data = new student_data();
            // $student_data->Id_num = $request->Id_num;
            // $student_data->name = $request->name;
            // $student_data->section = $request->section;
            // $student_data->lvl = $request->lvl;
            // $student_data->strand = $request->strand;
            // $student_data->phonenumber = $request->phonenumber;
            // $student_data->ay = $request->ay;
            // $student_data->reg_fee = $request->reg_fee;
            // $student_data->tui_fee = $request->tui_fee;
            // $student_data->uni_fee = $request->uni_fee;
            // $query = $student_data->save();

            // $student_data = [
            //     'name' => $request->name,
            //     'section' => $request->section,
            //     'lvl' => $request->lvl,
            //     'strand' => $request->strand,
            //     'or_no' => $request->or_no,
            //     'ay' => $request->ay,
            //     'reg_fee' => $request->reg_fees,
            //     'tui_fee' => $request->tui_fees,
            //     'uni_fee' => $request->uni_fees,
            //     'total_fee' => $request->total_amount,
            // ];

            $student_data = [
                'name' => $request->name,
                'section' => $request->section,
                'lvl' => $request->lvl,
                'strand' => $request->strand,
                'or_no' => $request->or_no,
                'ay' => $request->ay,
                'reg_fee' => $request->reg_fee,
                'tui_fee' => $request->tui_fee,
                'uni_fee' => $request->uni_fee,
                'Medical' => $request->Medical,
                'Insurance' => $request->Insurance,
                'Death' => $request->Death,
                'Library' => $request->Library,
                'School_Pub' => $request->School_Pub,
                'Athlet' => $request->Athlet,
                'BACS' => $request->BACS,
                'Book' => $request->Book,
                'Laboratory' => $request->Laboratory,
                'StudentID' => $request->StudentID,
                'Passbook' => $request->Passbook,
                'Handbook' => $request->Handbook,
                'Dental' => $request->Dental,
                'Completers_Fee' => $request->Completers_Fee,
                'Graduation_Fee' => $request->graduation,
                'total_fee' => $request->total_amount,
            ];


            // Assuming you have a unique identifier, like 'Id_num'
            $uniqueIdentifier = ['Id_num' => $request->Id_num];

            // Update or insert based on the existence of a record with the given unique identifier
            $query = student_data::updateOrCreate($uniqueIdentifier, $student_data);


            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Payment Has been Successfully Set']);
                //return redirect()->route('form.student')->with('success', 'Student added successfully');
            }
        // }

    }

}
