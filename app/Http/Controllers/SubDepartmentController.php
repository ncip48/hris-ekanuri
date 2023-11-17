<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\SubDepartment;
use Illuminate\Http\Request;

class SubDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage sub department')) {
            $subDepartments = SubDepartment::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('sub_department.index', compact('subDepartments'));
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
        if (\Auth::user()->can('create sub department')) {
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('sub_department.create', compact('branch', 'department'));
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
        if (\Auth::user()->can('create sub department')) {

            $validator = \Validator::make(
                $request->all(),
                [
                    'department_id' => 'required',
                    'branch_id' => 'required',
                    'name' => 'required|max:20',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $department             = new SubDepartment();
            $department->department_id  = $request->department_id;
            $department->branch_id  = $request->branch_id;
            $department->name       = $request->name;
            $department->created_by = \Auth::user()->creatorId();
            $department->save();

            return redirect()->route('sub-department.index')->with('success', __('Sub Department successfully created.'));
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
    public function edit(SubDepartment $subDepartment)
    {
        if (\Auth::user()->can('edit sub department')) {
            if ($subDepartment->created_by == \Auth::user()->creatorId()) {
                $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

                return view('sub_department.edit', compact('department', 'branch', 'subDepartment'));
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
    public function update(Request $request, SubDepartment $subDepartment)
    {
        if (\Auth::user()->can('edit department')) {
            if ($subDepartment->created_by == \Auth::user()->creatorId()) {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'branch_id' => 'required',
                        'department_id' => 'required',
                        'name' => 'required|max:20',
                    ]
                );
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $subDepartment->branch_id = $request->branch_id;
                $subDepartment->department_id = $request->department_id;
                $subDepartment->name      = $request->name;
                $subDepartment->save();

                return redirect()->route('sub-department.index')->with('success', __('Sub Department successfully updated.'));
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
    public function destroy(SubDepartment $subDepartment)
    {
        if (\Auth::user()->can('delete sub department')) {
            if ($subDepartment->created_by == \Auth::user()->creatorId()) {
                $subDepartment->delete();

                return redirect()->route('sub-department.index')->with('success', __('Sub Department successfully deleted.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
