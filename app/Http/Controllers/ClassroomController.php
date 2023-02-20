<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
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


    public function allClassrooms()
    {
        $classrooms = Classroom::all();
        return response()->json($classrooms);
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
    public function newClassroom(Request $request)
    {
        $request->validate([
            'section' => 'required',
            'grade' => 'required',
            'user_id' => 'required'
        ]);

            $newClassroom = new Classroom([
            'section' => $request->get('section'),
            'grade' => $request->get('grade'),
            'user_id' => $request->get('user_id')
        ]);

        $newClassroom->save();
        return response()->json($newClassroom);
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
    public function editClassroom(Request $request, $id)
    {
        $result = Classroom::findOrFail($id);

        $request->validate([
            'section' => 'required',
            'grade' => 'required',
            'user_id' => 'required'
        ]);

        $result->section = $request->get('section');
        $result->grade = $request->get('grade');
        $result->user_id = $request->get('user_id');

        $result->save();

        return response()->json($result);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteClassroom($id)
    {
    $result = Classroom::findOrFail($id);
    $result->delete();

    return response()->json($result::all());
    }
}
