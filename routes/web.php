<?php

use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\JobController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'home'])->name('/');
Route::get('/chi-tiet/{id}', [IndexController::class, 'getJobDetail'])->name('job.details');
Route::get('/sua/{id}', [IndexController::class, 'jobEdit']);
Route::get('/bao-cao/{id}', [IndexController::class, 'getReport'])->name('job.report');
Route::get('/nhan-vien', [IndexController::class, 'staff'])->name('staff');
Route::get('/nhom', [IndexController::class, 'team'])->name('team');
Route::get('/loc/{value}', [IndexController::class, 'filter'])->name('filter');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::resource('/job', JobController::class);