@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center py-4">
        <div class="col-md-8">
            <div class="fs-1 fw-bold text-center">
							Welcome {{ auth()->user()->name }}!
						</div>
        </div>
    </div>
</div>
@endsection