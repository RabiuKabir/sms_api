<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function results()
    {
        $result = Result::all();
        return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newResult(Request $request)
    {
        $request->validate([
            'exam_id' => 'required',
            'user_id' => 'required',
            'subject_id' => 'required',
            'marks' => 'required'
        ]);

        $newResult = new Result([
            'exam_id' => $request->get('exam_id'),
            'user_id' => $request->get('user_id'),
            'subject_id' => $request->get('subject_id'),
            'marks' => $request->get('marks')
        ]);

        $newResult->save();
        return response()->json($newResult);
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
    public function editResult(Request $request, $id)
    {
        $result = Result::findOrFail($id);

        $request->validate([
            'exam_id' => 'required',
            'user_id' => 'required',
            'subject_id' => 'required',
            'marks' => 'required'
        ]);

        $result->exam_id = $request->get('exam_id');
        $result->user_id = $request->get('user_id');
        $result->subject_id = $request->get('subject_id');
        $result->marks = $request->get('marks');
        $result->created_by = Auth::id();

        $result->save();

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteResult($id)
    {
        $result = Result::findOrFail($id);
        $result->delete();

        return response()->json($result::all());
    }
}
