<?php

namespace App\Http\Controllers;

use App\Models\GroupClass;
use App\Models\Level;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage class')) {
            $classes = GroupClass::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('class.index', compact('classes'));
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
        if (\Auth::user()->can('create class')) {
            $level = Level::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('class.create', compact('level'));
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
        if (\Auth::user()->can('create department')) {

            $validator = \Validator::make(
                $request->all(),
                [
                    'level_id' => 'required',
                    'name' => 'required|max:20',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $class             = new GroupClass();
            $class->level_id  = $request->level_id;
            $class->name       = $request->name;
            $class->created_by = \Auth::user()->creatorId();
            $class->save();

            return redirect()->route('class.index')->with('success', __('Class successfully created.'));
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
    public function edit(GroupClass $class)
    {
        if (\Auth::user()->can('edit class')) {
            if ($class->created_by == \Auth::user()->creatorId()) {
                $level = Level::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

                return view('class.edit', compact('class', 'level'));
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
    public function update(Request $request, GroupClass $class)
    {
        if (\Auth::user()->can('edit class')) {
            if ($class->created_by == \Auth::user()->creatorId()) {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'level_id' => 'required',
                        'name' => 'required|max:20',
                    ]
                );
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $class->level_id = $request->level_id;
                $class->name      = $request->name;
                $class->save();

                return redirect()->route('class.index')->with('success', __('Class successfully updated.'));
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
    public function destroy(GroupClass $class)
    {
        if (\Auth::user()->can('delete class')) {
            if ($class->created_by == \Auth::user()->creatorId()) {
                $class->delete();

                return redirect()->route('class.index')->with('success', __('Class successfully deleted.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
