<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function exams()
    {
        $exam = Exam::select('*')->orderBy('id', 'ASC')->get();
        return response()->json($exam);
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
    public function newExam(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'name' => 'required',
            'type' => 'required',
        ]);

        $newExams = new Exam([
            'date' => $request->get('date'),
            'name' => $request->get('name'),
            'type' => $request->get('type'),
        ]);

        $newExams->save();
        return response()->json($newExams);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editExam(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);

        $request->validate([
            'date' => 'required',
            'name' => 'required',
            'type' => 'required',
        ]);

        $exam->date = $request->get('date');
        $exam->name = $request->get('name');
        $exam->type = $request->get('type');

        $exam->save();

        return response()->json($exam);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteExam($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();

        return response()->json($exam::all());
    }
}
