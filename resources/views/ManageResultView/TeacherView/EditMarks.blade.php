@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2>Edit Marks</h2>
    <p>Name: {{ $result->student->student_name }}</p>
    <p>Matric Id: {{ $result->student->matric_no }}</p>
    <p>Year: {{ $result->student->year }}</p>
    <p>Subject: {{ $result->Subject_name }}</p>
    <form action="{{ route('results.updateResult', $result->Result_id) }}" method="POST">
        @csrf
        @method('PUT')
        <table class="table mt-3" id="marksTable">
            <thead>
                <tr>
                    <th>Assessments</th>
                    <th>Marks</th>
                    <th>Weightage</th>
                    <th>Grade</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($result->assessments ?? [] as $assessment)
                <tr>
                    <td><input type="text" name="assessments[]" value="{{ $assessment['name'] }}"></td>
                    <td><input type="text" name="marks[]" value="{{ $assessment['marks'] }}" class="marks"></td>
                    <td><input type="text" name="weightage[]" value="{{ $assessment['weightage'] }}" class="weightage"></td>
                    <td><input type="text" name="grades[]" value="{{ $assessment['grade'] }}" readonly class="grade"></td>
                    <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
                </tr>
                @empty
                <tr>
                    <td><input type="text" name="assessments[]" value=""></td>
                    <td><input type="text" name="marks[]" value="" class="marks"></td>
                    <td><input type="text" name="weightage[]" value="" class="weightage"></td>
                    <td><input type="text" name="grades[]" value="" readonly class="grade"></td>
                    <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <button type="button" class="btn btn-success" id="addRow">Add</button>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('results.showResult', $result->Result_id) }}" class="btn btn-secondary">Back</a>
    </form>
</div>

<script>
document.getElementById('addRow').addEventListener('click', function() {
    let table = document.getElementById('marksTable').getElementsByTagName('tbody')[0];
    let newRow = table.insertRow();
    newRow.innerHTML = `
        <td><input type="text" name="assessments[]"></td>
        <td><input type="text" name="marks[]" class="marks"></td>
        <td><input type="text" name="weightage[]" class="weightage"></td>
        <td><input type="text" name="grades[]" readonly class="grade"></td>
        <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
    `;
});

document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('remove-row')) {
        let row = e.target.closest('tr');
        row.remove();
        calculateGrades();
    }
});

document.addEventListener('input', function(e) {
    if (e.target && (e.target.classList.contains('marks') || e.target.classList.contains('weightage'))) {
        calculateGrades();
    }
});

function calculateGrades() {
    let rows = document.querySelectorAll('#marksTable tbody tr');
    rows.forEach(function(row) {
        let marks = parseFloat(row.querySelector('.marks').value) || 0;
        let weightage = parseFloat(row.querySelector('.weightage').value) || 0;
        let grade = (marks * weightage) / 100;
        row.querySelector('.grade').value = grade.toFixed(2);
    });
}
</script>
@endsection
