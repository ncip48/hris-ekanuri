<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage level')) {
            $levels = Level::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('level.index', compact('levels'));
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
        if (\Auth::user()->can('create level')) {
            // $branch = Level::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('level.create');
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
        if (\Auth::user()->can('create level')) {

            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:30',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $level             = new Level();
            $level->name       = $request->name;
            $level->created_by = \Auth::user()->creatorId();
            $level->save();

            return redirect()->route('level.index')->with('success', __('Level successfully created.'));
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
    public function edit(Level $level)
    {
        if (\Auth::user()->can('edit level')) {
            if ($level->created_by == \Auth::user()->creatorId()) {
                // $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

                return view('level.edit', compact('level'));
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
    public function update(Request $request, Level $level)
    {
        if (\Auth::user()->can('edit level')) {
            if ($level->created_by == \Auth::user()->creatorId()) {
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

                // $level->branch_id = $request->branch_id;
                $level->name      = $request->name;
                $level->save();

                return redirect()->route('level.index')->with('success', __('Level successfully updated.'));
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
    public function destroy(Level $level)
    {
        if (\Auth::user()->can('delete department')) {
            if ($level->created_by == \Auth::user()->creatorId()) {
                $level->delete();

                return redirect()->route('level.index')->with('success', __('Level successfully deleted.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
