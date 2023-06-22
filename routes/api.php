<?php

use App\Http\Controllers\Api\ProjectController;
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

// here we are using middleware to authenticate the user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// test route
Route::get('test', function () {
    return response()->json([
        'name' => 'test',
    ]);
});

// projects API route
Route::get('projects', [ProjectController::class, 'index']);

// we need to add slug to the route to get the project API route
Route::get('/projects/{slug}', [ProjectController::class, 'show']);
