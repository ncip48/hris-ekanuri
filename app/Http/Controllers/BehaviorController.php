<?php

namespace App\Http\Controllers;

use App\Models\Behavior;
use App\Models\Branch;
use Illuminate\Http\Request;

class BehaviorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage behavior')) {
            $behaviors = Behavior::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('behavior.index', compact('behaviors'));
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
        if (\Auth::user()->can('create behavior')) {
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('behavior.create', compact('branch'));
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
        if (\Auth::user()->can('create behavior')) {

            $validator = \Validator::make(
                $request->all(),
                [
                    // 'branch_id' => 'required',
                    'name' => 'required|max:20',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $behavior             = new Behavior();
            // $behavior->branch_id  = $request->branch_id;
            $behavior->name       = $request->name;
            $behavior->created_by = \Auth::user()->creatorId();
            $behavior->save();

            return redirect()->route('behavior.index')->with('success', __('Behavior successfully created.'));
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
    public function edit(Behavior $behavior)
    {
        if (\Auth::user()->can('edit behavior')) {
            if ($behavior->created_by == \Auth::user()->creatorId()) {
                $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

                return view('behavior.edit', compact('behavior', 'branch'));
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
    public function update(Request $request, Behavior $behavior)
    {
        if (\Auth::user()->can('edit behavior')) {
            if ($behavior->created_by == \Auth::user()->creatorId()) {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        //    'branch_id' => 'required',
                        'name' => 'required|max:20',
                    ]
                );
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                // $behavior->branch_id = $request->branch_id;
                $behavior->name      = $request->name;
                $behavior->save();

                return redirect()->route('behavior.index')->with('success', __('Behavior successfully updated.'));
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
    public function destroy(Behavior $behavior)
    {
        if (\Auth::user()->can('delete behavior')) {
            if ($behavior->created_by == \Auth::user()->creatorId()) {
                $behavior->delete();

                return redirect()->route('behavior.index')->with('success', __('Behavior successfully deleted.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
