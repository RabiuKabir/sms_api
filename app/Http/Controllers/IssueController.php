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


    public function allResolvedIssues()
    {
        $issues = Issue::select("*")->where("is_resolved", 1)->get();
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
        ]);
     
        $newIssues = new Issue([
            'user_id' => $request->get('user_id'),
            'type' => $request->get('type'),
            'details' => $request->get('details')
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
    public function resolveIssue(Request $request, $id)
    {
        $issue = Issue::findOrFail($id);
             $request->validate([
            'is_resolved' => 'required'
        ]);
        // $issue->is_resolved = $request->get('is_resolved');
        // $issue->update();
        
        $issue->update(['is_resolved' => $request->get('is_resolved')]);
        return response()->json($issue);
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
        $issue = Issue::findOrFail($id);

        $request->validate([
            'user_id' => 'required',
            'type' => 'required',
            'details' => 'required',
        ]);

        $issue->user_id = $request->get('user_id');
        $issue->type = $request->get('type');
        $issue->details = $request->get('details');

        $issue->update();

        return response()->json($issue);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteSubject($id)
    {
        $subject = Issue::findOrFail($id);
        $subject->delete();

        return response()->json($subject::all());
    }
}
