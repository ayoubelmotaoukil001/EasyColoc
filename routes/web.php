<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController ;
use Termwind\Components\Raw;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth') ->group( function (){
    Route::get('/expenses/create',[ExpenseController::class,'create'])->name('expenses.create') ;
    Route::post('/expenses' ,[ExpenseController::class ,'store'])->name('expenses.store');
}) ;

Route::resource('categories',CategoryController::class) ;
require __DIR__.'/auth.php';
