<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use App\Models\student_data;
use App\Models\income;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class incomeController extends Controller
{
    public function index()
    {
        $start_date = null;
        $end_date = null;

        $ca_paper_quantity = null;
        $yellow_book_quantity = null;
        $mass_card_quantity = null;
        $total_sales = null;

        return view('tables.other_income', compact('ca_paper_quantity', 'yellow_book_quantity', 'mass_card_quantity', 'total_sales', 'end_date', 'start_date'));
    }

    public function get_income_list(Request $request){

        $income = income::all();
        return DataTables::of($income)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                                              <button class="btn btn-sm btn-primary" data-id="' . $row['id'] . '" id="editbtn">Update</button>
                                              <button class="btn btn-sm btn-danger" data-id="' . $row['id'] . '" id="deletebtn">Delete</button>
                                        </div>';
            })
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" name="income_checkbox" data-id="' . $row['id'] . '"><label></label>';
            })

            ->rawColumns(['actions', 'checkbox'])
            ->make(true);
    }

    public function Saveincome(Request $request){

        $income_data = new Income();
        $income_data->ca_paper = $request->ca_paper ?? 0;
        $income_data->yellow_book = $request->green_book ?? 0;
        $income_data->mass_card = $request->mass_card ?? 0;

        $income_data->updated_at = Carbon::now();

        // Check if at least one text field is filled
        if ($income_data->ca_paper === 0 && $income_data->green_book === 0 && $income_data->mass_card === 0) {
            return response()->json(['code' => 0, 'msg' => 'At least one payment field must be filled']);
        }

        // Calculate total
        $income_data->total = ($income_data->ca_paper * 1) + ($income_data->yellow_book * 4) + ($income_data->mass_card * 3);

        $query = $income_data->save();

        if (!$query) {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        } else {
            return response()->json(['code' => 1, 'msg' => 'Payment has been successfully saved']);
        }
    }

    public function view(Request $request){
        $student_id = $request->student_id;
        $studentDetails = income::find($student_id);
        return response()->json(['details' => $studentDetails]);
    }

    public function update(Request $request) {
        try {
            $student_id = $request->sid;

            // Update student_data table
            $income_data = income::find($student_id);
            $income_data->ca_paper = $request->ca_paper;
            $income_data->yellow_book = $request->green_book;
            $income_data->mass_card = $request->mass_card;
            $income_data->total = $request->total;
            $income_data->save();

            return response()->json(['code' => 1, 'msg' => 'Income Details have Been updated']);
        } catch (\Exception $e) {
            return response()->json(['code' => 0, 'msg' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function deletePayment(Request $request) {
        $student_id = $request->student_id;
        $query = income::find($student_id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Student Payment has been deleted from database']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    public function deleteSelectedPayment(Request $request)
    {
        $Student_ids = $request->Student_ids;
        income::whereIn('id', $Student_ids)->delete();
        return response()->json(['code' => 1, 'msg' => 'Students Payment have been deleted from database']);
    }

    public function income_total(Request $request)
    {
        // // Validate the request data
        $validator = Validator::make($request->all(), [
            'startdate' => 'required|date',
            'enddate' => 'required|date',
        ], [
            'startdate' => 'Date Required',
            'enddate' => 'Date Required',
        ]);

        // Check if validation fails
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

        $start_date = $request->startdate;
        $end_date = $request->enddate;

        // $or_start = income::where('updated_at', $start_date)->value('or_no');
        // $or_end = income::where('updated_at', $end_date)->value('or_no');

        // Filter student_data based on the date range
        $studentDetails = income::whereBetween('updated_at', [$start_date, $end_date])->get();

        $ca_paper_quantity = $studentDetails->sum('ca_paper');
        $yellow_book_quantity = $studentDetails->sum('yellow_book');
        $mass_card_quantity = $studentDetails->sum('mass_card');

        $ca_paper_multiplier = 1;
        $yellow_book_multiplier = 4;
        $mass_card_multiplier = 3;

        $ca_paper_sales = $ca_paper_quantity * $ca_paper_multiplier;
        $yellow_book_sales = $yellow_book_quantity * $yellow_book_multiplier;
        $mass_card_sales = $mass_card_quantity * $mass_card_multiplier;

        $total_sales = $ca_paper_sales + $yellow_book_sales + $mass_card_sales;

        return view('tables.other_income', compact('studentDetails', 'ca_paper_quantity', 'yellow_book_quantity', 'mass_card_quantity', 'total_sales', 'end_date', 'start_date'));
    }
        // Validate the request data
    // $validator = Validator::make($request->all(), [
    //     'startdate' => 'required|date',
    //     'enddate' => 'required|date',
    // ]);

    // // Check if validation fails
    // if ($validator->fails()) {
    //     // Handle validation errors, e.g., return a response to the user
    //     return response()->json(['errors' => $validator->errors()]);
    // }

    // $start_date = $request->startdate;
    // $end_date = $request->enddate;

    // // Filter student_data based on the date range
    // $studentDetails = income::whereBetween('updated_at', [$start_date, $end_date])->get();

    // return response()->json(['studentDetails' => $studentDetails]);
    }

}
