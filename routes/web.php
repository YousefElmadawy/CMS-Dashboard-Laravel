<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

 

Route::get('/', function () {
    return view('auth/login');
});

use App\Http\Controllers\backendController;
Route::get('/logout', [backendController::class, 'logout'])->name('logout');

use App\Http\Controllers\CategoryController;
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');

Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');

Route::get('/categories/softDelete/{id}', [CategoryController::class, 'softDelete'])->name('categories.softDelete');
Route::get('/categories/trashedcategories', [CategoryController::class, 'deletedcategories'])->name('categories.deletedcategories');
Route::get('/categories/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
Route::get('/categories/hardDelete/{id}', [CategoryController::class, 'hardDelete'])->name('categories.hardDelete');
// use App\Models\User;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function (){
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');

    Route::get('/users', function () {
        // $users=User::all();
        $users=DB::table('users')->get();
        return view('admin.users', compact('users')) ;
    })->name('users');
});
