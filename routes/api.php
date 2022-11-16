<?php

use App\Actions\Centrifuge\CreateCentrifugeUserToken;
use App\Actions\Log\CreateExceptionLog;
use App\Actions\User\UserRecentExceptions;
use App\Http\Middleware\CheckPermission;
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

Route::group(['middleware' => ['auth:sanctum', CheckPermission::class]], function () {
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
    Route::get('/recent-bug-exceptions', UserRecentExceptions::class);

    //broadcast
    Route::get('/centrifuge/token', CreateCentrifugeUserToken::class);

    //Users
    Route::post('/users', App\Actions\User\CreateUser::class);
    Route::get('/users', App\Actions\User\ListUser::class);
    Route::get('/users/{user}', App\Actions\User\ShowUser::class);
    Route::put('/users/{user}', App\Actions\User\UpdateUser::class);
    Route::delete('/users/{user}', App\Actions\User\DeleteUser::class);

//Roles
    Route::post('/roles', App\Actions\Role\CreateRole::class);
    Route::get('/roles', App\Actions\Role\ListRole::class);
    Route::get('/roles/{role}', App\Actions\Role\ShowRole::class);
    Route::put('/roles/{role}', App\Actions\Role\UpdateRole::class);
    Route::delete('/roles/{role}', App\Actions\Role\DeleteRole::class);

//Permissions
    Route::post('/permissions', App\Actions\Permission\CreatePermission::class);
    Route::get('/permissions', App\Actions\Permission\ListPermission::class);
    Route::get('/permissions/{permission}', App\Actions\Permission\ShowPermission::class);
    Route::put('/permissions/{permission}', App\Actions\Permission\UpdatePermission::class);
    Route::delete('/permissions/{permission}', App\Actions\Permission\DeletePermission::class);
    Route::post('/sync-permission', App\Actions\Permission\SyncPermission::class);

//Clients
    Route::post('/clients', App\Actions\Client\CreateClient::class);
    Route::get('/clients', App\Actions\Client\ListClient::class);
    Route::get('/clients/{client}', App\Actions\Client\ShowClient::class);
    Route::put('/clients/{client}', App\Actions\Client\UpdateClient::class);
    Route::delete('/clients/{client}', App\Actions\Client\DeleteClient::class);

});


