<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
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

/** PRODUCT ROUTES */
Route::get('product', [ProductController::class, 'all']);
Route::post('product', [ProductController::class, 'store']);
Route::get('product/{id}', [ProductController::class, 'show']);
Route::put('product/{id}', [ProductController::class, 'update']);
Route::delete('product/{id}', [ProductController::class, 'destroy']);
Route::put('product/{product}/update-category', [ProductController::class, 'updateCategory']);
Route::put('product/{product}/remove-category', [ProductController::class, 'removeCategory']);
Route::put('product/{product}/update-image', [ProductController::class, 'updateImage']);
Route::put('product/{product}/remove-image', [ProductController::class, 'removeImage']);

/** CATEGORY ROUTES */
Route::get('category', [CategoryController::class, 'index']);
Route::post('category', [CategoryController::class, 'store']);
Route::get('category/{id}', [CategoryController::class, 'show']);
Route::put('category/{id}', [CategoryController::class, 'update']);
Route::delete('category/{id}', [CategoryController::class, 'destroy']);

/** IMAGE ROUTES */
Route::get('image', [ImageController::class, 'index']);
Route::post('image', [ImageController::class, 'store']);
Route::get('image/{id}', [ImageController::class, 'show']);
Route::put('image/{id}', [ImageController::class, 'update']);
Route::delete('image/{id}', [ImageController::class, 'destroy']);
