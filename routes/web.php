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
Route::middleware(['verified'])->group(function () {
	Route::get('/students', [StudentController::class, 'index'])->name('students.index');
	Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
	Route::post('/students', [StudentController::class, 'store'])->name('students.store');
	Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
	Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
	Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
	Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
});
