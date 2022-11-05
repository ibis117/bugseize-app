<?php

use App\Actions\Log\CreateExceptionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/exceptions', CreateExceptionLog::class);

Route::post('/login', App\Actions\Auth\LoginUser::class);

Route::post('/logout', function () {
    return response([], 200);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response($request->user(), 200);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    //projects
    Route::post('/projects', App\Actions\Project\CreateProject::class);
    Route::get('/projects', App\Actions\Project\ListProject::class);
    Route::get('/projects/{id}', App\Actions\Project\ShowProject::class);
    Route::put('/projects/{id}', App\Actions\Project\UpdateProject::class);
    Route::delete('/projects/{id}', App\Actions\Project\DeleteProject::class);

    //issues
    Route::post('/issues', App\Actions\Issue\CreateIssue::class);
    Route::get('/issues', App\Actions\Issue\ListIssue::class);
    Route::get('/issues/{id}', App\Actions\Issue\ShowIssue::class);
    Route::put('/issues/{id}', App\Actions\Issue\UpdateIssue::class);
    Route::delete('/issues/{id}', App\Actions\Issue\DeleteIssue::class);

    //bug exceptions
    Route::post('/bug-exceptions', App\Actions\BugException\CreateBugexception::class);
    Route::get('/bug-exceptions', App\Actions\BugException\ListBugexception::class);
    Route::get('/bug-exceptions/{id}', App\Actions\BugException\ShowBugexception::class);
    Route::put('/bug-exceptions/{id}', App\Actions\BugException\UpdateBugexception::class);
    Route::delete('/bug-exceptions/{id}', App\Actions\BugException\DeleteBugexception::class);
    Route::get('/bug-exceptions/{id}/mark-as-read', App\Actions\BugException\MarkBugexceptionAsRead::class);
});



