@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Edit Marks for {{ $result->student->student_name }}</h1>
    <form method="POST" action="{{ route('results.updateResult', $result->id) }}">
        @csrf
        @method('PUT')
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Assessment</th>
                    <th>Marks</th>
                    <th>Weightage</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $categories = is_string($result->Categories) ? json_decode($result->Categories, true) : $result->Categories;
                    $marks = is_string($result->Marks) ? json_decode($result->Marks, true) : $result->Marks;
                    $weightage = is_string($result->Weightage) ? json_decode($result->Weightage, true) : $result->Weightage;

                    $categories = $categories ?? [];
                    $marks = $marks ?? [];
                    $weightage = $weightage ?? [];
                @endphp
                @foreach($categories as $index => $category)
                    <tr>
                        <td><input type="text" name="Categories[]" class="form-control" value="{{ $category }}"></td>
                        <td><input type="number" name="Marks[]" class="form-control" value="{{ $marks[$index] ?? '' }}"></td>
                        <td><input type="number" name="Weightage[]" class="form-control" value="{{ $weightage[$index] ?? '' }}"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    <a href="{{ route('results.showSubject', $result->student->id) }}" class="btn btn-secondary">Back</a>
</div>
@endsection
