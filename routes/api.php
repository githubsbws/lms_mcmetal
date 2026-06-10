<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\OcrSearchController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/ocr-upload', [AdminController::class, 'uploadOCR']);
Route::get('/ocr/search', [OcrSearchController::class, 'search']);

Route::get('/get-sub-org/{parentId}', [RegisterController::class, 'getSubOrg']);

Route::middleware(['web', 'auth'])->group(function () {
    Route::post('/learn/progress', [CourseController::class, 'updateProgress']);
});
