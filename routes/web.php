<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpensCOntroller ;
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
    Route::get('/expenses/create',[ExpensCOntroller::class,'create'])->name('expenses.create') ;
    Route::post('/expenses' ,[ExpensCOntroller::class ,'store'])->name('expenses.store');
}) ;
require __DIR__.'/auth.php';
