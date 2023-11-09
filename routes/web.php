<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;

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


Route::group(['middleware'=>'guest'],function(){
    Route::get('/',[TaskController::class,'index'])->name('task.index');
    Route::get('/filter',[TaskController::class,'filter'])->name('filter');
    Route::get('/taskshow',[TaskController::class,'showComplated'])->name('taskshow');
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('/tasks/create',[TaskController::class,'create'])->name('tasks.create');
    Route::post('/tasks',[TaskController::class,'store'])->name('tasks.store');
    Route::get('/tasks/edit/{task}',[TaskController::class,'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}',[TaskController::class,'update'])->name('tasks.update');
    Route::delete('/tasks/{task}',[TaskController::class,'destroy'])->name('tasks.destroy');
    Route::post('/tasks/{task}/complate',[TaskController::class,'complate'])->name('tasks.complate');
});




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
