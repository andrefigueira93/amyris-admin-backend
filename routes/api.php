<?php

use App\Http\Controllers\Admin\LandingPageCrudController;
use App\Http\Controllers\Api\LandingPageController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TopBannerController;
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


Route::get('/pages/{project}/', [LandingPageController::class, 'index']);
Route::get('/pages/{project}/{slug}', [LandingPageController::class, 'show']);
Route::get('/project/{project}', [ProjectController::class, 'show']);
