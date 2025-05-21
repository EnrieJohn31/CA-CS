<?php

namespace App\Http\Controllers;

use DataTables;

use App\Models\student_data;
use App\Models\payments_summary;
use App\Models\student_payables;
use App\Models\student_mfees;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('cashier_settings.index');
    }
    public function display()
    {
        $students = student_payables::all();
        return DataTables::of($students)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                                              <button class="btn btn-sm btn-primary" data-id="' . $row['id'] . '" id="editbtn">Update</button>
                                              <button  class="btn btn-sm btn-danger" data-id="' . $row['id'] . '" id="deletebtn">Delete</button>
                                        </div>';
            })
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" name="student_checkbox" data-id="' . $row['id'] . '"><label></label>';
            })

            ->rawColumns(['actions', 'checkbox'])
            ->make(true);
    }
    public function setting_stored(Request $request) {

        $validator = \Validator::make($request->all(), [
            'grade_lvl' => 'required|unique:student_payables',
            'registration_fee' => 'required',
            'tuition_fee' => 'required',
            'uniform_fee' => 'required',
        ], [
            'grade_lvl' => 'Already have that Grade Level',
            'registration_fee' => 'Please Enter Registration Fee',
            'tuition_fee' => 'Please Enter Tuition Fee',
            'uniform_fee' => 'Please Enter Uniform Fee',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

                $student_payables = new student_payables();
                $student_payables->grade_lvl = $request->grade_lvl;
                $student_payables->registration_fee = $request->registration_fee;
                $student_payables->tuition_fee = $request->tuition_fee;
                $student_payables->uniform_fee = $request->uniform_fee;
                $query = $student_payables->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Student Setting has been successfully saved']);
                //return redirect()->route('cashier_settings.index')->with('success', 'Student added successfully');
            }
        }
         return view('cashier_settings.index');
    }

    public function setting_delete(Request $request)
    {
        $student_id = $request->student_id;
        $query = student_payables::find($student_id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Student Payable has been Deleted']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    public function view(Request $request) {
        $student_id = $request->student_id;
        $studentDetails = student_payables::find($student_id);
        return response()->json(['details' => $studentDetails]);
    }

    public function setting_update(Request $request)
    {
        try {
            $student_id = $request->sid;

            $request->validate([
                'grade_lvl' => 'required',
                'registration_fee' => 'required',
                'tuition_fee' => 'required',
                'uniform_fee' => 'required',
            ], [
                'grade_lvl' => 'Please Enter Grade Level',
                'registration_fee' => 'Please Enter Registration Fee',
                'tuition_fee' => 'Please Enter Tuition Fee',
                'uniform_fee' => 'Please Enter Uniform Fee',
            ]);

            // Update student_data table
                $student_payables = student_payables::find($student_id);
                $student_payables->grade_lvl = $request->grade_lvl;
                $student_payables->registration_fee = $request->registration_fee;
                $student_payables->tuition_fee = $request->tuition_fee;
                $student_payables->uniform_fee = $request->uniform_fee;
                $student_payables->save();

            return response()->json(['code' => 1, 'msg' => 'Student Grade Setting have Been updated']);
        } catch (\Exception $e) {
            return response()->json(['code' => 0, 'msg' => 'Error: ' . $e->getMessage()]);
        }

    }

    public function delete_selected_setting(Request $request)
    {
        // $Student_ids = $request->Student_ids;
        // student_data::withTrashed()->whereIn('id', $Student_ids)->forceDelete();
        // return response()->json(['code' => 1, 'msg' => 'Students have been deleted from database']);
        $studentIds = $request->Student_ids;

        $deletedCount = student_payables::whereIn('id', $studentIds)->delete();

        if ($deletedCount > 0) {
            return response()->json(['code' => 1, 'msg' => 'Students Setting deleted from the database']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'No Setting found to delete']);
        }
    }

    public function annual_index()
    {
        $studentFees = student_mfees::all();

        return view('cashier_settings.annual', compact('studentFees'));

    }

    public function annual_fee_display()
    {
        return view('cashier_settings.annual');
    }

}
