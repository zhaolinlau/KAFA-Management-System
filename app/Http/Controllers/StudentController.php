<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StudentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(): View
	{
		if (auth()->user()->role == 'parent') {
			return view('ManageStudentRegistration.Parent.RegistrationList', ['students' => Student::with('user')->where('user_id', auth()->user()->id)->get()]);
		} elseif (auth()->user()->role == 'admin') {
			return view('ManageStudentRegistration.Admin.RegistrationList', ['students' => Student::with('user')->get()]);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): View
	{
		return view('ManageStudentRegistration.Parent.StudentRegistrationForm');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request): RedirectResponse
	{
		$request->validate([
			'parent_ic_no' => 'required|numeric|max_digits:12|min_digits:12',
			'parent_ic' => 'required|file|mimes:png,jpg,pdf',
			'parent_contact' => 'required|string',
			'relationship' => 'required|string',
			'student_name' => 'required|string',
			'birthday' => 'required|date|string',
			'birthplace' => 'required|string',
			'permanent_address' => 'required|string',
			'student_ic_no' => 'required|numeric|max_digits:12|min_digits:12',
			'student_ic' => 'required|file|mimes:png,jpg,pdf',
			'student_birthcert' => 'required|file|mimes:png,jpg,pdf',
		]);


		$request->user()->students()->create(array_merge($request->all(), [
			'parent_ic' => $request->file('parent_ic')->store($request->parent_ic_no, 'public'),
			'student_ic' => $request->file('student_ic')->store($request->student_ic_no, 'public'),
			'student_birthcert' => $request->file('student_birthcert')->store($request->student_ic_no, 'public'),
		]));

		return redirect(route('students.index'));
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Student $student): View
	{
		if (auth()->user()->role == 'parent') {
			return view('ManageStudentRegistration.Parent.StudentRegistrationForm', ['student' => $student]);
		} elseif (auth()->user()->role == 'admin') {
			return view('ManageStudentRegistration.Admin.StudentRegistrationForm', ['student' => $student]);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Student $student): View
	{
		return view('ManageStudentRegistration.Admin.StudentRegistrationForm', ['student' => $student]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Student $student): RedirectResponse
	{
		$request->validate([
			'status' => 'required|string',
			'matric_no' => 'required|string|min:7|max:7'
		]);


		$student->update($request->all());

		return redirect(route('students.index'));
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Student $student): RedirectResponse
	{
		$student->delete();
		Storage::disk('public')->deleteDirectory($student->parent_ic_no);
		Storage::disk('public')->deleteDirectory($student->student_ic_no);
		return redirect(route('students.index'));
	}
}
