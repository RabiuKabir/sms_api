<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
class SubjectController extends Controller
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

    
    public function subjects()
    {
        $subject = Subject::select('*')->orderBy('id', 'ASC')->get();;
        return response()->json($subject);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newSubject(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'grade' => 'required',
            'status' => 'required'
        ]);

        $newSubject = new Subject([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'grade' => $request->get('grade'),
            'status' => $request->get('status')
        ]);

        $newSubject->save();
        return response()->json($newSubject);
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
    public function editSubject(Request $request, $id)
    {

        $subject = Subject::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'grade' => 'required',
            'status' => 'required'
        ]);

        $subject->name = $request->get('name');
        $subject->description = $request->get('description');
        $subject->grade = $request->get('grade');
        $subject->status = $request->get('status');

        $subject->save();

        return response()->json($subject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteSubject($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return response()->json($subject::all());
    }
}
