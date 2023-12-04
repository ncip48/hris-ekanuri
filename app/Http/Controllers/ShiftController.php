<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage shifting')) {
            $shifts = Shift::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('shift.index', compact('shifts'));
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
        if (\Auth::user()->can('create shifting')) {
            return view('shift.create');
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
        if (\Auth::user()->can('create shifting')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:120',
                    'start_time' => 'required',
                    'end_time' => 'required',
                ]
            );

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->route('shifting.index')->with('error', $messages->first());
            }

            $shift = new Shift();
            $shift->name = $request->name;
            $shift->start_time = $request->start_time;
            $shift->end_time = $request->end_time;
            $shift->created_by = \Auth::user()->creatorId();
            $shift->save();

            return redirect()->route('shifting.index')->with('success', __('Shift created successfully.'));
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
    public function edit(Shift $shifting)
    {
        // dd($shifting);

        if (\Auth::user()->can('edit shifting')) {
            if ($shifting->created_by == \Auth::user()->creatorId()) {
                return view('shift.edit', compact('shifting'));
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
    public function update(Request $request, Shift $shifting)
    {
        if (\Auth::user()->can('edit shifting')) {

            if ($shifting->created_by == \Auth::user()->creatorId()) {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'name' => 'required|max:120',
                        'start_time' => 'required',
                        'end_time' => 'required',
                    ]
                );

                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();
                    return redirect()->route('shifting.index')->with('error', $messages->first());
                }

                $shifting->name = $request->name;
                $shifting->start_time = $request->start_time;
                $shifting->end_time = $request->end_time;
                $shifting->save();

                return redirect()->route('shifting.index')->with('success', __('Shifting successfully updated.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

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
        if (\Auth::user()->can('delete shifting')) {
            $shift = Shift::find($id);
            if ($shift->created_by == \Auth::user()->creatorId()) {
                $shift->delete();
                return redirect()->route('shif.index')->with('success', __('Shift successfully deleted.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
