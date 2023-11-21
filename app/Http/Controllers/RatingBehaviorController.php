<?php

namespace App\Http\Controllers;

use App\Models\Behavior;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\RatingBehavior;
use App\Models\SubDepartment;
use Illuminate\Http\Request;

class RatingBehaviorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage rating behavior')) {
            $ratings = RatingBehavior::where('created_by', '=', \Auth::user()->creatorId())->get();

            // dd($ratings);

            return view('rating_behavior.index', compact('ratings'));
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
        if (\Auth::user()->can('create rating behavior')) {
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $subDepartment = SubDepartment::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $behavior = Behavior::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $employee = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('rating_behavior.create', compact('branch', 'department', 'subDepartment', 'behavior', 'employee'));
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
        if (\Auth::user()->can('create rating behavior')) {

            $validator = \Validator::make(
                $request->all(),
                [
                    // 'department_id' => 'required',
                    // 'branch_id' => 'required',
                    'employee_id' => 'required',
                    'behavior_id' => 'required',
                    'score' => 'required|max:20',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $ratingBehavior             = new RatingBehavior();
            // $ratingBehavior->department_id  = $request->department_id;
            // $ratingBehavior->branch_id  = $request->branch_id;
            $ratingBehavior->employee_id  = $request->employee_id;
            $ratingBehavior->behavior_id  = $request->behavior_id;
            $ratingBehavior->score       = $request->score;
            $ratingBehavior->created_by = \Auth::user()->creatorId();
            $ratingBehavior->save();

            return redirect()->route('rating-behavior.index')->with('success', __('Rating behavior successfully created.'));
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
    public function edit(RatingBehavior $ratingBehavior)
    {
        if (\Auth::user()->can('edit rating behavior')) {
            if ($ratingBehavior->created_by == \Auth::user()->creatorId()) {
                $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $subDepartment = SubDepartment::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $behavior = Behavior::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $employee = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

                return view('rating_behavior.edit', compact('branch', 'department', 'subDepartment', 'behavior', 'employee', 'ratingBehavior'));
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
    public function update(Request $request, RatingBehavior $ratingBehavior)
    {
        if (\Auth::user()->can('edit rating behavior')) {
            if ($ratingBehavior->created_by == \Auth::user()->creatorId()) {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        // 'branch_id' => 'required',
                        // 'department_id' => 'required',
                        'employee_id' => 'required',
                        'behavior_id' => 'required',
                        'score' => 'required|max:20',
                    ]
                );
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                // $ratingBehavior->branch_id = $request->branch_id;
                // $ratingBehavior->department_id = $request->department_id;
                $ratingBehavior->employee_id = $request->employee_id;
                $ratingBehavior->behavior_id = $request->behavior_id;
                $ratingBehavior->score      = $request->score;
                $ratingBehavior->save();

                return redirect()->route('rating-behavior.index')->with('success', __('Rating behavior successfully updated.'));
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
    public function destroy(RatingBehavior $ratingBehavior)
    {
        if (\Auth::user()->can('delete rating behavior')) {
            if ($ratingBehavior->created_by == \Auth::user()->creatorId()) {
                $ratingBehavior->delete();

                return redirect()->route('rating-behavior.index')->with('success', __('Rating behavior successfully deleted.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
