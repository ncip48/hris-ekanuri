<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\ExtendedContract;
use App\Models\SubDepartment;
use Illuminate\Http\Request;

class ExtendedContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage extended contract')) {

            $extends = ExtendedContract::where('created_by', '=', \Auth::user()->creatorId())->get();
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $branch->prepend('Select Branch', '');
            $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $department->prepend('Select Department', '');
            $designation = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $designation->prepend('Select Designation', '');
            $sub_department = SubDepartment::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $employees = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        //    dd($contracts);
            return view('extendedContract.index', compact('extends','employees','branch', 'department', 'designation', 'sub_department'));
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
        if (\Auth::user()->can('create extended contract')) {
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $branch->prepend('Select Branch', '');
            $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $department->prepend('Select Department', '');
            $designation = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $designation->prepend('Select Designation', '');
            $sub_department = SubDepartment::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $employees = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            return view('extendedContract.create', compact('employees','branch', 'department', 'designation', 'sub_department'));
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
        if (\Auth::user()->can('create extended contract')) {
            $validator = \Validator::make(
                $request->all(), [
                                   'employee_id' => 'required',
                                   'branch_id' => 'required',
                                    'department_id' => 'required',
                                    'designation_id' => 'required',
                                    'sub_department_id' => 'required',
                                //    'contract_type' => 'required',
                                   'start_date' => 'required',
                                   'end_date' => 'required',
                                   'contract_file' => 'required|mimes:pdf|max:2048',
                               ]
            );

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->route('extend-contract.index')->with('error', $messages->first());
            }

            $file = $request->file('contract_file');
            $random = rand(1, 999999);
            $contract_file = 'contract_' . $random . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads/extendedContract/', $contract_file);

            ExtendedContract::create([
                'employee_id' => $request->employee_id,
                'branch_id' => $request->branch_id,
                'department_id' => $request->department_id,
                'sub_department_id' => $request->sub_department_id,
                'designation_id' => $request->designation_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'contract_file' => $contract_file,
                'created_by' => \Auth::user()->creatorId(),
            ]);

            return redirect()->route('extend-contract.index')->with('success', __('Contract successfully created.'));
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
    public function edit(ExtendedContract $extendContract)
    {
        if(\Auth::user()->can('edit extended contract'))
        {
            if($extendContract->created_by == \Auth::user()->creatorId())
            {
                $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $branch->prepend('Select Branch', '');
                $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $department->prepend('Select Department', '');
                $designation = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $designation->prepend('Select Designation', '');
                $sub_department = SubDepartment::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $employees = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                return view('extendedContract.edit', compact('extendContract','employees','branch', 'department', 'designation', 'sub_department'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
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
    public function update(Request $request, $id)
    {
        if(\Auth::user()->can('edit extended contract'))
        {
            $contract = ExtendedContract::find($id);
            if($contract->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'employee_id' => 'required',
                                       'branch_id' => 'required',
                                        'department_id' => 'required',
                                        'designation_id' => 'required',
                                        'sub_department_id' => 'required',
                                    //    'contract_type' => 'required',
                                       'start_date' => 'required',
                                       'end_date' => 'required',
                                       'contract_file' => 'nullable|mimes:pdf|max:2048',
                                   ]
                );

                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();
                    return redirect()->route('extend-contract.index')->with('error', $messages->first());
                }

               $contract->employee_id = $request->employee_id;
                $contract->branch_id = $request->branch_id;
                $contract->department_id = $request->department_id;
                $contract->sub_department_id = $request->sub_department_id;
                $contract->designation_id = $request->designation_id;
                $contract->start_date = $request->start_date;
                $contract->end_date = $request->end_date;
                if($request->hasFile('contract_file'))
                {
                    $file = $request->file('contract_file');
                    $random = rand(1, 999999);
                    $contract_file = 'extend_contract_' . $random . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . '/uploads/extendedContract/', $contract_file);
                    $contract->contract_file = $contract_file;
                }
                $contract->save();

                return redirect()->route('extend-contract.index')->with('success', __('Contract successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
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
        if (\Auth::user()->can('delete extended contract')) {
            $contract = ExtendedContract::find($id);
            if ($contract->created_by == \Auth::user()->creatorId()) {
                $contract->delete();
                return redirect()->route('extend-contract.index')->with('success', __('Contract successfully deleted.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
