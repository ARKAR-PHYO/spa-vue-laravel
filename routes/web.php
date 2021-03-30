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

Route::prefix('app')->middleware('adminCheck')->group(function(){
    Route::get('get_tags', [AdminController::class, 'getTags']);
    Route::post('create_tag', [AdminController::class, 'addTag']);
    Route::post('edit_tag', [AdminController::class, 'editTag']);
    Route::post('delete_tag', [AdminController::class, 'deleteTag']);
    Route::post('upload', [AdminController::class, 'upload']);
    Route::post('delete_image', [AdminController::class, 'deleteImage']);
    Route::post('create_category', [AdminController::class, 'createCategory']);
    Route::get('get_categories', [AdminController::class, 'getCategories']);
    Route::post('edit_category', [AdminController::class, 'editCategory']);
    Route::post('delete_category', [AdminController::class, 'deleteCategory']);

    Route::get('get_adminUsers', [AdminController::class, 'getAdminUsers']);
    Route::post('create_adminUser', [AdminController::class, 'createAdminUser']);
    Route::post('edit_adminUser', [AdminController::class, 'editAdminUser']);
    Route::post('edit_adminUser', [AdminController::class, 'editAdminUser']);

    Route::post('adminUserLogin', [AdminController::class, 'adminUserLogin']);

    Route::get('get_roles', [AdminController::class, 'getRoles']);
    Route::post('create_role', [AdminController::class, 'createRole']);
    Route::post('edit_role', [AdminController::class, 'editRole']);
    Route::post('delete_role', [AdminController::class, 'deleteRole']);

    Route::post('assignRoles', [AdminController::class, 'assignRoles']);

});


Route::get('logout', [AdminController::class, 'logout']);
Route::get('/', [AdminController::class, 'index']);
Route::any('{slug}', [AdminController::class, 'index']);
