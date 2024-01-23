<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\OvertimeRequest;
use App\Models\PersonalReport;
use App\Models\Shift;
use App\Models\SubDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Empty_;

class OvertimeRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Auth::user()->can('manage overtime request'));
        if (\Auth::user()->can('manage overtime request')) {
            $overtimeRequests = OvertimeRequest::where('created_by', \Auth::user()->creatorId())->get();
            $employees = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');;
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            dd($overtimeRequests);
            return view('overtimeRequest.index', compact('overtimeRequests','employees','branch'));
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
        if (\Auth::user()->can('create overtime request')) {
            $employees = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');;
        $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $designation = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $sub_department = SubDepartment::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

        return view('overtimeRequest.create', compact('employees', 'branch', 'department', 'designation', 'sub_department'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'employee_id' => 'required
            // 'branch_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'duration' => 'required',
            // 'note' => 'required',
        ]);
    
        // $employee_id = Auth::user()->employee_id;
    
        foreach ($request->start_date as $key => $value) {
            OvertimeRequest::create([
                // 'employee_id' => $employee_id,
                'employee_id' => $request->employee_id,
                'branch_id' => $request->branch_id,
                'start_date' => $value,
                'end_date' => $request->end_date[$key],
                'duration' => $request->duration[$key],
                'note' => $request->note[$key],
            ]);
        }

        return redirect()->route('overtime-request.index')->with('success', __('Overtime Request successfully created.'));
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (\Auth::user()->can('manage overtime request')) {
            $overtimeRequest = OvertimeRequest::findOrfail($id);
            $employee = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');;
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $designation = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $sub_department = SubDepartment::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('overtimeRequest.detail', compact('overtimeRequest', 'employee', 'branch', 'department', 'designation', 'sub_department'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
