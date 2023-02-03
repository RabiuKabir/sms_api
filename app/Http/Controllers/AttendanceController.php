<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function allAttendance()
    {
        $attendance = Attendance::all();
        return response()->json($attendance);
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
    public function newAttendance(Request $request)
    {
        $request->validate([
            'userId' => 'required',
            'date' => 'required',
            'status' => 'required'
        ]);

        $newAttendance = new Attendance([
            'userId' => $request->get('userId'),
            'date' => $request->get('date'),
            'status' => $request->get('status')
        ]);

        $newAttendance->save();

        return response()->json($newAttendance);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userAttendance($id)
    {
        $user = User::findOrFail($id);
        $userAttendance = $user->attendances()->get();
        return response()->json($userAttendance);
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
        $attendance = Attendance::findOrFail($id);

        $request->validate([
            'userId' => 'required',
            'date' => 'required',
            'status' => 'required'
        ]);

        $attendance->userId = $request->get('userId');
        $attendance->date = $request->get('date');
        $attendance->status = $request->get('status');

        $attendance->save();

        return response()->json($attendance);
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
