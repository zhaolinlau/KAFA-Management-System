@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row mt-3">
			<h1 class="text-center">Registration Form</h1>
			@if (Route::is('students.create'))
				<div class="col mt-3">
					<form class="row rounded-3 shadow-sm bg-white p-md-5 p-3" action="{{ route('students.store') }}" method="post"
						enctype="multipart/form-data">
						@csrf
						<div class="col-md-6 mb-3">
							<label class="form-label" for="parent_ic_no">Parent IC Number</label>
							<input class="form-control @error('parent_ic_no') is-invalid @enderror" type="text" name="parent_ic_no"
								id="parent_ic_no">
							@error('parent_ic_no')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="parent_ic">Parent IC</label>
							<input class="form-control @error('parent_ic') is-invalid @enderror" type="file" name="parent_ic"
								id="parent_ic">
							@error('parent_ic')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="parent_contact">Parent Contact</label>
							<input class="form-control @error('parent_contact') is-invalid @enderror" type="tel" name="parent_contact"
								id="parent_contact">
							@error('parent_contact')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="relationship">Relationship</label>
							<select class="form-control @error('relationship') is-invalid @enderror" name="relationship" id="relationship">
								<option value="" selected></option>
								<option value="Father">Father</option>
								<option value="Mother">Mother</option>
								<option value="Guardian">Guardian</option>
							</select>
							@error('relationship')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="student_name">Student Name</label>
							<input class="form-control @error('student_name') is-invalid @enderror" type="text" name="student_name"
								id="student_name">
							@error('student_name')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="birthday">Student Birthday</label>
							<input class="form-control @error('birthday') is-invalid @enderror" type="date" name="birthday" id="birthday">
							@error('birthday')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="birthplace">Student Birthplace</label>
							<input class="form-control @error('birthplace') is-invalid @enderror" type="text" name="birthplace"
								id="birthplace">
							@error('birthplace')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="permanent_address">Permanent Address</label>
							<textarea class="form-control @error('permanent_address') is-invalid @enderror" name="permanent_address"
							 id="permanent_address"></textarea>
							@error('permanent_address')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="student_ic_no">Student IC Number</label>
							<input class="form-control @error('student_ic_no') is-invalid @enderror" type="text" name="student_ic_no"
								id="student_ic_no"></input>
							@error('student_ic_no')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="student_ic">Student IC</label>
							<input class="form-control @error('student_ic') is-invalid @enderror" type="file" name="student_ic"
								id="student_ic">
							@error('student_ic')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="student_birthcert">Student Birth Certificate</label>
							<input class="form-control @error('student_birthcert') is-invalid @enderror" type="file"
								name="student_birthcert" id="student_birthcert">
							@error('student_birthcert')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="col-12 mt-3">
							<button class="btn btn-primary" type="submit">Submit</button>
							<a class="btn btn-outline-primary" href="{{ route('students.index') }}">Cancel</a>
						</div>
					</form>
				</div>
			@elseif (Route::is('students.show'))
				<form class="row rounded-3 shadow-sm bg-white p-md-5 p-3">
					<div class="col-md-6 mb-3">
						<label class="form-label" for="parent_ic_no">Parent IC Number</label>
						<div>
							{{ $student->parent_ic_no }}
						</div>
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label" for="parent_ic">Parent IC</label>
						<div>
							<a href="/storage/{{ $student->parent_ic }}" target="blank">{{ $student->parent_ic }}</a>
						</div>
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label" for="parent_contact">Parent Contact</label>
						{{ $student->parent_contact }}
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label" for="relationship">Relationship</label>
						{{ $student->relationship }}
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label" for="student_name">Student Name</label>
						<div>
							{{ $student->student_name }}
						</div>
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label" for="birthday">Student Birthday</label>
						<div>
							{{ $student->birthday }}
						</div>
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label" for="birthplace">Student Birthplace</label>
						<div>
							{{ $student->birthplace }}
						</div>
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label" for="permanent_address">Permanent Address</label>
						<div>
							{{ $student->permanent_address }}
						</div>
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label" for="student_ic_no">Student IC Number</label>
						<div>
							{{ $student->student_ic_no }}
						</div>
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label" for="student_ic">Student IC</label>
						<div>
							<a href="/storage/{{ $student->student_ic }}" target="blank">{{ $student->student_ic }}</a>
						</div>
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label" for="student_birthcert">Student Birth Certificate</label>
						<div>
							<a href="/storage/{{ $student->student_birthcert }}" target="blank">{{ $student->student_birthcert }}</a>
						</div>
					</div>
					<div class="col-12 mt-3">
						<a class="btn btn-danger" href="{{ route('students.index', $student) }}">Back</a>
					</div>
				</form>
			@endif
		</div>
	</div>
@endsection
