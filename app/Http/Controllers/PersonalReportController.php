<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\SubDepartment;
use Illuminate\Http\Request;

class PersonalReportController extends Controller
{

    // personal Report
//  public function personalReport()
//  {
     
//  }

 public function addPersonalReport(){

    
 }

//  public function storePersonalReport(Request $request){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('manage employee'))
     {
             $employees = Employee::where('created_by', \Auth::user()->creatorId())->get();

         return view('employee.personal_report.index', compact('employees'));
     }
     else
     {
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
        //
        $employees = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');;
    $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
    $branch->prepend('Select Branch','');
    $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
    $department->prepend('Select Department','');
    $designation = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
    $designation->prepend('Select Designation','');
    $sub_department = SubDepartment::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

    return view('employee.personal_report.create',compact('employees','branch','department','designation','sub_department'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
