<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\User;
use Illuminate\Http\Request;

class IssueController extends Controller
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


    public function allIssues()
    {
        $issues = Issue::all();
        return response()->json($issues);
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
    public function newIssue(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'type' => 'required',
            'details' => 'required',
            'is_resolved' => 'required'
        ]);

        $newIssues = new Issue([
            'user_id' => $request->get('user_id'),
            'type' => $request->get('type'),
            'details' => $request->get('details'),
            'is_resolved' => $request->get('is_resolved')
        ]);

        $newIssues->save();
        return response()->json($newIssues);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function issueDetails($id)
    {
        $issue = Issue::findOrFail($id);
        return response()->json($issue);
    }


    public function studentIssues($id)
    {
        $student = User::findOrFail($id);
        $sIssues = $student->issues()->get();
        return response()->json($sIssues);
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
    public function editIssue(Request $request, $id)
    {
        
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
