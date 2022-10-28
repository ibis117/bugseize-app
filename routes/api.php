<?php

use App\Models\ExceptionLog;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/exceptions', function (Request $request) {
    ExceptionLog::create([
        'log' => $request->all(),
    ]);
});

//Projects
Route::post('/projects', App\Actions\Project\CreateProject::class);
Route::get('/projects', App\Actions\Project\ListProject::class);
Route::get('/projects/{project}', App\Actions\Project\ShowProject::class);
Route::put('/projects/{project}', App\Actions\Project\UpdateProject::class);
Route::delete('/projects/{project}', App\Actions\Project\DeleteProject::class);
