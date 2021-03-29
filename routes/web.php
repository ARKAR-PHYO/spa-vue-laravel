<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('app/get_tags', [AdminController::class, 'getTags']);
Route::post('app/create_tag', [AdminController::class, 'addTag']);
Route::post('app/edit_tag', [AdminController::class, 'editTag']);
Route::post('app/delete_tag', [AdminController::class, 'deleteTag']);
Route::post('app/upload', [AdminController::class, 'upload']);
Route::post('app/delete_image', [AdminController::class, 'deleteImage']);
Route::post('app/create_category', [AdminController::class, 'createCategory']);
Route::get('app/get_categories', [AdminController::class, 'getCategories']);
Route::post('app/edit_category', [AdminController::class, 'editCategory']);
Route::post('app/delete_category', [AdminController::class, 'deleteCategory']);

Route::get('app/get_adminUsers', [AdminController::class, 'getAdminUsers']);
Route::post('app/create_adminUser', [AdminController::class, 'createAdminUser']);
Route::post('app/edit_adminUser', [AdminController::class, 'editAdminUser']);
Route::post('app/edit_adminUser', [AdminController::class, 'editAdminUser']);

Route::post('app/adminUserLogin', [AdminController::class, 'adminUserLogin']);


Route::get('logout', [AdminController::class, 'logout']);
Route::get('/', [AdminController::class, 'index']);
Route::any('{slug}', [AdminController::class, 'index']);

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/dis', function () {
//     return view('dis');
// });

// Route::any('{slug}', function() {
//     return view('welcome');
// });
