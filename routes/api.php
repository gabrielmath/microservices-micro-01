<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    CategoryController,
    CompanyController
};

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

Route::get('/', function () {
    return response()->json(['message' => 'success']);
});

Route::apiResource('categories', CategoryController::class);
Route::apiResource('companies', CompanyController::class);
