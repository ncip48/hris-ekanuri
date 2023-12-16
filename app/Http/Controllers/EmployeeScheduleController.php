<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeSchedule;
use App\Models\Reimbursement;
use App\Models\Shift;
use Illuminate\Http\Request;

class EmployeeScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage employee schedule')) {
            $schedules = EmployeeSchedule::where('created_by', '=', \Auth::user()->creatorId())->get();
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $employees = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $shifts = Shift::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('employeeSchedule.index', compact('schedules', 'branch', 'department', 'employees'));
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
        if (\Auth::user()->can('create employee schedule')) {
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $employees = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $shift = Shift::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('employeeSchedule.create', compact('branch', 'department', 'employees', 'shift'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
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
        if (\Auth::user()->can('create employee schedule')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'employee_id' => 'required',
                    'date' => 'required',
                    'branch_id' => 'required',
                    'department_id' => 'required',
                    'shift_id' => 'required',
                ]
            );

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->route('employeeSchedule.index')->with('error', $messages->first());
            }

            $schedule = new EmployeeSchedule();
            $schedule->employee_id = $request->employee_id;
            $schedule->date = $request->date;
            $schedule->branch_id = $request->branch_id;
            $schedule->department_id = $request->department_id;
            $schedule->shift_id = $request->shift_id;
            $schedule->created_by = \Auth::user()->creatorId();
            $schedule->save();

            return redirect()->route('employee-schedule.index')->with('success', __('Employee schedule successfully created.'));
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
    public function edit(EmployeeSchedule $employeeSchedule)
    {
        if (\Auth::user()->can('edit employee schedule')) {
            if ($employeeSchedule->created_by == \Auth::user()->creatorId()) {
                $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $employees = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $shift = Shift::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

                return view('employeeSchedule.edit', compact('employeeSchedule', 'branch', 'department', 'employees', 'shift'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeSchedule $employeeSchedule, Request $request)
    {
        if (\Auth::user()->can('edit employee schedule')) {
            if ($employeeSchedule->created_by == \Auth::user()->creatorId()) {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'employee_id' => 'required',
                        'date' => 'required',
                        'branch_id' => 'required',
                        'department_id' => 'required',
                        'shift_id' => 'required',
                    ]
                );

                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();
                    return redirect()->route('employeeSchedule.index')->with('error', $messages->first());
                }

                $employeeSchedule->employee_id = $request->employee_id;
                $employeeSchedule->date = $request->date;
                $employeeSchedule->branch_id = $request->branch_id;
                $employeeSchedule->department_id = $request->department_id;
                $employeeSchedule->shift_id = $request->shift_id;
                $employeeSchedule->save();

                return redirect()->route('employee-schedule.index')->with('success', __('Employee schedule successfully updated.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
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
        if (\Auth::user()->can('delete employee schedule')) {
            $schedule = EmployeeSchedule::find($id);
            if ($schedule) {
                $schedule->delete();
                return redirect()->route('employee-schedule.index')->with('success', __('Employee schedule successfully deleted.'));
            } else {
                return redirect()->route('employee-schedule.index')->with('error', __('Something is wrong.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
