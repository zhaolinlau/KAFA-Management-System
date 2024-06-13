<?php

use App\Http\Controllers\TimetableController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ResultController;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
	return redirect(route('login'));
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

// Module 1 - Manage Student Registration (LAU ZHAO LIN CB22039)
Route::middleware(['auth', 'verified'])->group(function () {
	Route::get('/students', [StudentController::class, 'index'])->name('students.index');
	Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
	Route::post('/students', [StudentController::class, 'store'])->name('students.store');
	Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
	Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit')->middleware('role:admin');
	Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update')->middleware('role:admin');
	Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
});


// Module 2 - Manage Activity (MUHAMMAD AZIQUDDIN CB21057)
Route::get('createActivity', function () {return view('manageActivityView.adminView.createActivity');})->name('createActivity'); // Define named route here
Route::get('createActivity', function () {
	return view('manageActivityView.adminView.createActivity');
})->name('createActivity'); // Define named route here

Route::post('submit', [activityController::class, 'create']);
Route::get('createdActivity/List', [activityController::class, 'index'])->name('createdActivityList');
Route::get('createdActivity/{activityId}/edit', [activityController::class, 'edit'])->name('editActivity');
Route::post('createdActivity/{activityId}/update', [activityController::class, 'update'])->name('updateActivity');
Route::get('createdActivity/{activityId}/delete', [activityController::class, 'destroy'])->name('deleteActivity');
Route::get('registerActivity', [ActivityController::class, 'displayActivity'])->name('displayActivity');
Route::post('registerParticipant/{participantId}/register', [ActivityController::class, 'registerActivity'])->name('registerActivity');
Route::get('registration/List', [ActivityController::class, 'displayRegistration'])->name('displayRegistration');
Route::get('search/Registration', [ActivityController::class, 'searchRegistration'])->name('searchRegistration');
Route::post('registration/{participantId}/approval', [ActivityController::class, 'updateStatus'])->name('updateStatus');
Route::get('registration/{participantId}/reject',[ActivityController::class, 'destroyRegistration'])->name('destroyRegistration');

Route::get('registration/{participantId}/reject', [ActivityController::class, 'destroyRegistration'])->name('destroyRegistration');

Route::get('display/participant', [ActivityController::class, 'displayParticipant'])->name('displayParticipant');
Route::get('search/Participant', [ActivityController::class, 'searchParticipant'])->name('searchParticipant');
Route::get('delete/{participantId}/participant', [ActivityController::class, 'deleteParticipant'])->name('deleteParticipant');


// Module 4 - Manage Timetable (EMYLIA AQILA CB21090)
Route::resource('timetables', TimetableController::class);
Route::get('/timetables', [TimetableController::class, 'index'])->name('timetables.index')->middleware(['verified']);
Route::get('/timetables/create', [TimetableController::class, 'create'])->name('timetables.create')->middleware(['verified']);
Route::post('/timetables', [TimetableController::class, 'store'])->name('timetables.store')->middleware(['verified']);
Route::get('/timetables/{timetable}', [TimetableController::class, 'show'])->name('timetables.show')->middleware(['verified']);
Route::get('/timetables/{timetable}/edit', [TimetableController::class, 'edit'])->name('timetables.edit')->middleware(['verified']);
Route::put('/timetables/{timetable}', [TimetableController::class, 'update'])->name('timetables.update')->middleware(['verified']);
Route::delete('/timetables/{timetable}', [TimetableController::class, 'destroy'])->name('timetables.destroy')->middleware(['verified']);
Route::get('partipate/activity', [ActivityController::class, 'displayRegisteredActivity'])->name('displayRegisteredActivity');
// Module 3 - Manage Result (KELVIN HO RUI SHENG CB21058)
Route::middleware(['auth', 'verified'])->group(function () {
	Route::get('/results', [ResultController::class, 'index'])->name('results.index');
	Route::get('/results/create', [ResultController::class, 'createResult'])->name('results.createResult');
	Route::post('/results', [ResultController::class, 'storeResult'])->name('results.storeResult');
	Route::get('/results/{id}', [ResultController::class, 'showResult'])->name('results.showResult');
	Route::get('/results/{id}/edit', [ResultController::class, 'editResult'])->name('results.editResult');
	Route::put('/results/{id}', [ResultController::class, 'updateResult'])->name('results.updateResult');
	Route::delete('/results/{id}', [ResultController::class, 'destroyResult'])->name('results.destroyResult');
});
