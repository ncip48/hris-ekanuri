<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Reimbursement;
use App\Models\SubDepartment;
use Illuminate\Http\Request;

class ReimbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage reimbursement')) {
            $reimbursements = Reimbursement::where('created_by', '=', \Auth::user()->creatorId())->get();

            // dd($ratings);

            return view('reimbursement.index', compact('reimbursements'));
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
        if (\Auth::user()->can('create reimbursement')) {
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $subDepartment = SubDepartment::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $employee = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('reimbursement.create', compact('branch', 'department', 'subDepartment', 'employee'));
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
        if (\Auth::user()->can('create reimbursement')) {

            $rules = [
                'date' => 'required|date',
                'description' => 'required',
                'file' => 'required',
            ];

            if (\Auth::user()->isStaff() == false) {
                $rules['employee_id'] = 'required';
            }

            $validator = \Validator::make(
                $request->all(),
                $rules,
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $file = $request->file('file');
            $random = rand(1, 999999);
            $fileName = $random . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/reimbursement/'), $fileName);

            $reimbursement             = new Reimbursement();
            // $reimbursement->department_id  = $request->department_id;
            // $reimbursement->branch_id  = $request->branch_id;
            $reimbursement->employee_id  = \Auth::user()->type == 'staf' ? Employee::where('user_id', \Auth::user()->id)->first()->id : $request->employee_id;
            $reimbursement->date  = $request->date;
            $reimbursement->description  = $request->description;
            $reimbursement->file  = $fileName;
            $reimbursement->created_by = \Auth::user()->creatorId();
            $reimbursement->save();

            return redirect()->route('reimbursement.index')->with('success', __('Reimbursement successfully created.'));
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
    public function edit(Reimbursement $reimbursement)
    {
        if (\Auth::user()->can('edit reimbursement')) {
            if ($reimbursement->created_by == \Auth::user()->creatorId()) {
                $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $subDepartment = SubDepartment::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $employee = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

                return view('reimbursement.edit', compact('branch', 'department', 'subDepartment', 'employee', 'reimbursement'));
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
    public function update(Request $request, Reimbursement $reimbursement)
    {
        if (\Auth::user()->can('edit reimbursement')) {
            if ($reimbursement->created_by == \Auth::user()->creatorId()) {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        // 'branch_id' => 'required',
                        // 'department_id' => 'required',
                        'employee_id' => 'required',
                        'date' => 'required|date',
                        'description' => 'required',
                        'file' => 'nullable',
                    ]
                );
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                // $reimbursement->branch_id = $request->branch_id;
                // $reimbursement->department_id = $request->department_id;
                $reimbursement->employee_id = $request->employee_id;
                $reimbursement->date = $request->date;
                $reimbursement->description = $request->description;
                if ($request->file('file')) {
                    if ($reimbursement->file) {
                        $file_path = public_path('uploads/reimbursement/' . $reimbursement->file);
                        if (file_exists($file_path)) {
                            unlink($file_path);
                        }
                    }
                    $file = $request->file('file');
                    $random = rand(1, 999999);
                    $fileName = $random . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/reimbursement/'), $fileName);
                    $reimbursement->file = $fileName;
                } else {
                    $reimbursement->file = $reimbursement->file;
                }
                $reimbursement->save();

                return redirect()->route('reimbursement.index')->with('success', __('Reimbursement successfully updated.'));
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
    public function destroy(Reimbursement $reimbursement)
    {
        if (\Auth::user()->can('delete reimbursement')) {
            if ($reimbursement->created_by == \Auth::user()->creatorId()) {
                //unlink if file exist
                if ($reimbursement->file) {
                    $file_path = public_path('uploads/reimbursement/' . $reimbursement->file);
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
                $reimbursement->delete();

                return redirect()->route('reimbursement.index')->with('success', __('Reimbursement successfully deleted.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
