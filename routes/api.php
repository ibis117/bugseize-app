<?php

use App\Models\Exception as ExceptionAlias;
use App\Models\Project;
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

//    $token = $request->header('X-BugSeize-Key');
//
//    $project = Project::where('token', $token)->first();
     ExceptionAlias::create([
         'log' => $request->all(),
     ]);
});
