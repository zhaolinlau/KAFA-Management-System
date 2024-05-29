@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col mt-3">
				<h1 class="text-center">Registration List</h1>
			</div>
			@if (auth()->user()->role == 'parent')
				<div class="col-12 text-end mt-3">
					<a class="btn btn-primary" href="{{ route('students.create') }}">Add</a>
				</div>
				<div class="col-12 mt-3">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">Name</th>
									<th scope="col">Status</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($students as $student)
									<tr>
										<th scope="row">{{ $loop->iteration }}</th>
										<td>{{ $student->student_name }}</td>
										<td>{{ $student->status }}</td>
										<td>
											<a class="btn btn-info" href="">View</a>
											<form action="{{ route('students.destroy', $student) }}" method="post" class="d-inline-block">
												@csrf
												@method('delete')
												<button type="submit" class="btn btn-danger">Cancel</button>
											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			@endif
		</div>
	</div>
@endsection
