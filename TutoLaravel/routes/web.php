<?php

use App\Http\Controllers\HomeController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/


/*
 *  |-------
 *  | Home Routes
 *  |-------
 */
Route::get('/', [HomeController::class, 'index'])->name('home');




/*
 *  |-------
 *  | Admin Routes
 *  |-------
 */
Route::prefix('/admin')->controller(\App\Http\Controllers\AdminController::class)->group(function () {
    Route::get('/',  'index')->name('admin/home');

});



/*
 *  |-------
 *  | User Routes
 *  |-------
 */
Route::prefix('/user')->controller(\App\Http\Controllers\UserController::class)->group(function () {
    Route::get('/',  'index')->name('user/home');

});




/*
 *  |-------
 *  | Chat Routes
 *  |-------
 */
Route::prefix('/chat')->controller(\App\Http\Controllers\ChatController::class)->group(function () {
    Route::get('/',  'index')->name('chat/home');

});
