<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\SubjectController;
/*
|--------------------------------------------------------------------------
| API Route.
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// 'throttle:60,1' to add rate limiter which is very important...

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);

    Route::post('/new-attendance', [AttendanceController::class, 'newAttendance']);
    Route::get('/attendance', [AttendanceController::class, 'allAttendance']);
    Route::get('/attendance/{id}', [AttendanceController::class, 'userAttendance']);

    Route::get('/issues', [IssueController::class, 'allIssues']);
    Route::get('/resolved-issues', [IssueController::class, 'allResolvedIssues']);
    Route::post('/new-issue', [IssueController::class, 'newIssue']);
    Route::get('/issue-details/{id}', [IssueController::class, 'issueDetails']);
    Route::get('/student-issues/{id}', [IssueController::class, 'studentIssues']);
    Route::patch('/resolve-issue/{id}', [IssueController::class, 'resolveIssue']);
    Route::put('/edit-issue/{id}', [IssueController::class, 'editIssue']);
    Route::delete('/delete-issue/{id}', [IssueController::class, 'deleteIssue']);

    Route::post('/new-subject', [SubjectController::class, 'newSubject']);
    Route::get('/subjects', [SubjectController::class, 'subjects']);
    Route::put('/edit-subject/{id}', [SubjectController::class, 'editSubject']);
    Route::delete('/delete-subject/{id}', [SubjectController::class, 'deleteSubject']);
});
