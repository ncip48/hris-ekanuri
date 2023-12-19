<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\PersonalReport;
use App\Models\SubDepartment;
use Illuminate\Http\Request;

class PersonalReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage employee')) {
            $reports = PersonalReport::where('created_by', '=', \Auth::user()->creatorId())->get();

            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $branch->prepend('Select Branch', '');
            $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $department->prepend('Select Department', '');
            $designation = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $designation->prepend('Select Designation', '');
            $sub_department = SubDepartment::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
$employees = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');


            return view('personalReport.index', compact('reports','employees','branch', 'department', 'designation', 'sub_department'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::user()->can('create personal report')) {
            $employees = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');;
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $designation = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $sub_department = SubDepartment::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('personalReport.create', compact('employees', 'branch', 'department', 'designation', 'sub_department'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
        // $employees = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');;
        // $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        // $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        // $designation = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        // $sub_department = SubDepartment::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

        // return view('personalReport.create', compact('employees', 'branch', 'department', 'designation', 'sub_department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\Auth::user()->can('create personal report')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'employee_id' => 'required',
                    'branch_id' => 'required',
                    'department_id' => 'required',
                    'designation_id' => 'required',
                    'sub_department_id' => 'required',
                    'report' => 'required',
                    'date_of_report' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $personalReport = new PersonalReport();
            $personalReport->employee_id = $request->employee_id;
            $personalReport->branch_id = $request->branch_id;
            $personalReport->department_id = $request->department_id;
            $personalReport->designation_id = $request->designation_id;
            $personalReport->sub_department_id = $request->sub_department_id;
            $personalReport->report = $request->report;
            $personalReport->date_of_report = $request->date_of_report;
            $personalReport->created_by = \Auth::user()->creatorId();
            $personalReport->save();
            // dd($personalReport);

            return redirect()->route('personal-report.index')->with('success', __('Personal Report successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonalReport $personalReport)
    {
        // dd($personalReport);
        if (\Auth::user()->can('edit personal report')) {
            // dd($report);
            if ($personalReport->created_by == \Auth::user()->creatorId()) {
            // $personalReport = PersonalReport::find($personalReport->id);
                $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $designation = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $sub_department = SubDepartment::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $employees = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');;

                return view('personalReport.edit', compact('personalReport', 'employees', 'branch', 'department', 'designation', 'sub_department'));
            } else {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(\Auth::user()->can('edit personal report')){
            $validator = \Validator::make(
                $request->all(),
                [
                    'employee_id' => 'required',
                    'branch_id' => 'required',
                    'department_id' => 'required',
                    'designation_id' => 'required',
                    'sub_department_id' => 'required',
                    'report' => 'required',
                    'date_of_report' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $personalReport = PersonalReport::find($id);
            $personalReport->employee_id = $request->employee_id;
            $personalReport->branch_id = $request->branch_id;
            $personalReport->department_id = $request->department_id;
            $personalReport->designation_id = $request->designation_id;
            $personalReport->sub_department_id = $request->sub_department_id;
            $personalReport->report = $request->report;
            $personalReport->date_of_report = $request->date_of_report;
            $personalReport->created_by = \Auth::user()->creatorId();
            $personalReport->save();

            return redirect()->route('personal-report.index')->with('success', __('Personal Report successfully updated.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Auth::user()->can('delete personal report')) {
            $personalReport = PersonalReport::find($id);
            if ($personalReport) {
                $personalReport->delete();
                return redirect()->route('personal-report.index')->with('success', __('Personal Report successfully deleted.'));
            } else {
                return redirect()->route('personal-report.index')->with('error', __('Something is wrong.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
