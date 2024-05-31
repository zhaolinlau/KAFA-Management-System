<?php

use App\Http\Controllers\StudentController;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return redirect(route('login'));
});

Auth::routes();

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['verified']);

// Module 1 - Manage Student Registration (LAU ZHAO LIN CB22039)
Route::resource('students', StudentController::class)->middleware(['verified']);
