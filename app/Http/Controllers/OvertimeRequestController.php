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
use Illuminate\Support\Facades\DB;
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
            // $overtimes = OvertimeRequest::where('created_by', \Auth::user()->creatorId())->get();
            // $employees = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');;
            // $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $overtimes = OvertimeRequest::where('created_by', \Auth::user()->creatorId())
                ->orderBy('created_at')
                ->get();

            // Grouping by employee_id and created_at using Eloquent Collection methods
            $groupedOvertimes = $overtimes->groupBy(['employee_id', 'created_at']);

            //grouping note
            $notes = $overtimes
                ->groupBy(['employee_id', 'note'])
                // ->map(function ($item) {
                //     return $item->pluck('note');
                // })
                ;

            foreach ($groupedOvertimes as $key => $groupedOvertime) {
                // dd($groupedOvertime);
                $employee = Employee::where('id', $key)->first();
                $groupedOvertime->employee_name = $employee->name;
                $groupedOvertime->employee_id = $employee->id;
                $note = OvertimeRequest::where('employee_id', $key)->first();
                $groupedOvertime->status = $note->status;
                $groupedOvertime->created_at = $note->created_at;
                $groupedOvertime->updated_at = $note->updated_at;
                $groupedOvertime->branch_id = $note->branch_id;
                $groupedOvertime->start_date = $note->start_date;
                $groupedOvertime->end_date = $note->end_date;
                $groupedOvertime->duration = $note->duration;
                $groupedOvertime->branch_name = Branch::where('id', $note->branch_id)->first()->name;
                $groupedOvertime->note = $notes;
            }

            $employees = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
// dd($notes);
            // dd($groupedOvertimes);
            return view('overtimeRequest.index', compact('overtimes', 'employees', 'branch', 'notes', 'groupedOvertimes'));
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
        if (\Auth::user()->can('create overtime request')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'employee_id' => 'required',
                    'branch_id' => 'required',
                    'department_id' => 'required',
                    'designation_id' => 'required',
                    'sub_department_id' => 'required',
                    'date' => 'required',
                    'start_time' => 'required',
                    'end_time' => 'required',
                    'reason' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $overtimeRequest = new OvertimeRequest();
            $overtimeRequest->employee_id = $request->employee_id;
            $overtimeRequest->branch_id = $request->branch_id;
            $overtimeRequest->start_date = $request->start_date;
            $overtimeRequest->end_date = $request->end_date;
            $overtimeRequest->duration = $request->duration;
            $overtimeRequest->status = 'Pending';
            $overtimeRequest->note = $request->note;
            $overtimeRequest->created_by = \Auth::user()->creatorId();
            $overtimeRequest->save();

            return redirect()->route('overtime-request.index')->with('success', __('Overtime Request successfully created.'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
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
        if (\Auth::user()->can('manage overtime request')) {
            $overtimes = OvertimeRequest::findOrfail($id);
            $employee = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');;
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('overtimeRequest.detail', compact('overtimes', 'employee', 'branch'));
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
        if (\Auth::user()->can('delete overtime request')) {
            $overtimeRequest = OvertimeRequest::findOrfail($id);
            $overtimeRequest->delete();
            return redirect()->route('overtime-request.index')->with('success', __('Overtime Request successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
