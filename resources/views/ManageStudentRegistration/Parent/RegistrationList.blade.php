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
								<tr>
									<th scope="row">1</th>
									<td>William Lau</td>
									<td>Verified</td>
									<td>
										<button class="btn btn-info">View</button>
										<button class="btn btn-danger">Cancel</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			@endif
		</div>
	</div>
@endsection
