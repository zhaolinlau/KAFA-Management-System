<?php

use App\Http\Controllers\TimetableController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['verified']);


// Route::resource('timetables', TimetableController::class);
Route::get('/timetables', [TimetableController::class, 'index'])->name('timetables.index')->middleware(['verified']);
Route::get('/timetables/create', [TimetableController::class, 'create'])->name('timetables.create')->middleware(['verified']);
Route::post('/timetables', [TimetableController::class, 'store'])->name('timetables.store')->middleware(['verified']);
Route::get('/timetables/{timetable}', [TimetableController::class, 'show'])->name('timetables.show')->middleware(['verified']);
Route::get('/timetables/{timetable}/edit', [TimetableController::class, 'edit'])->name('timetables.edit')->middleware(['verified']);
Route::put('/timetables/{timetable}', [TimetableController::class, 'update'])->name('timetables.update')->middleware(['verified']);
Route::delete('/timetables/{timetable}', [TimetableController::class, 'destroy'])->name('timetables.destroy')->middleware(['verified']);