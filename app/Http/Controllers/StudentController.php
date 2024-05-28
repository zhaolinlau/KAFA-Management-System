<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class StudentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		if (auth()->user()->role == 'parent') {
			return view('ManageStudentRegistration.Parent.RegistrationList');
		} elseif (auth()->user()->role == 'admin') {
			return view('ManageStudentRegistration.Admin.RegistrationList');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('ManageStudentRegistration.Parent.StudentRegistrationForm');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$request->validate([
			'parent_ic_no' => 'required|string',
			'parent_ic' => ['required', File::types(['pdf', 'png', 'jpeg', 'jpg'])],
			'parent_contact' => 'required|string',
			'relationship' => 'required|string',
			'student_name' => 'required|string',
			'birthday' => 'required|date',
			'birthplace' => 'required|string',
			'permanent_address' => 'required|string',
			'student_ic_no' => 'required|string',
			'student_ic' => ['required', File::types(['pdf', 'png', 'jpeg', 'jpg'])],
			'student_birthcert' => ['required', File::types(['pdf', 'png', 'jpeg', 'jpg'])],
		]);

		$request->user()->students()->create($request->all());

		return redirect(route('students.index'));
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Student $student)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Student $student)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Student $student)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Student $student)
	{
		//
	}
}
