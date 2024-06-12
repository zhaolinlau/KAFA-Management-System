@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Create Timetable</h2>
    <form action="{{ route('timetables.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="class_name">Class</label>
            <select name="class_name" class="form-control" required>
                <option selected disabled>Select the class</option>
                <option value="Kelas1Kafa">Kafa 1</option>
                <option value="Kelas2Kafa">Kafa 2</option>
                <option value="Kelas3Kafa">Kafa 3</option>
                <option value="Kelas4Kafa">Kafa 4</option>
                <option value="Kelas5Kafa">Kafa 5</option>
                <option value="Kelas6Kafa">Kafa 6</option>
            </select>
        </div>
        <div id="entries-container">
            <!-- This is where the dynamically added entries will be inserted -->
        </div>
        <button type="button" class="btn btn-success mt-4" id="addEntry">Add Entry</button>
        <button type="submit" class="btn btn-primary mt-4">Create</button>
    </form>
</div>

<script>
const teachersBySubject = {
    'UlumSyariahAkidahIbadah': ['Ustazah Aisyah', 'Ustaz Amin'],
    'Sirah': ['Ustaz Aiman', 'Ustaz Amir'],
    'JawiKhat': ['Ustazah Aminah', 'Ustazah Kamilah'],
    'AdabAkhlakIslamiah': ['Ustaz Amzar', 'Ustaz Zakaria'],
    'LughatulQuran': ['Ustazah Nurul', 'Ustaz Zuhair'],
    'AmaliSolat': ['Ustaz Rayyan', 'Ustazah Solehah']
};

document.addEventListener('DOMContentLoaded', function () {
    const addEntryBtn = document.getElementById('addEntry');

    addEntryBtn.addEventListener('click', function () {
        const entriesContainer = document.getElementById('entries-container');
        const entryGroup = document.createElement('div');
        entryGroup.classList.add('entry-group', 'mt-3', 'p-3', 'border', 'rounded');

        const dayLabel = document.createElement('label');
        dayLabel.textContent = 'Day';
        entryGroup.appendChild(dayLabel);

        const daySelect = document.createElement('select');
        daySelect.name = 'days[]';
        daySelect.classList.add('form-control');
        const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        days.forEach(function (day) {
            const option = document.createElement('option');
            option.value = day;
            option.textContent = day;
            daySelect.appendChild(option);
        });
        entryGroup.appendChild(daySelect);

        const subjectLabel = document.createElement('label');
        subjectLabel.textContent = 'Subject';
        entryGroup.appendChild(subjectLabel);

        const subjectSelect = document.createElement('select');
        subjectSelect.name = 'subject_name[][]';
        subjectSelect.classList.add('form-control');
        const subjects = ['UlumSyariahAkidahIbadah', 'Sirah', 'JawiKhat', 'AdabAkhlakIslamiah', 'LughatulQuran', 'AmaliSolat'];
        subjects.forEach(function (subject) {
            const option = document.createElement('option');
            option.value = subject;
            option.textContent = subject;
            subjectSelect.appendChild(option);
        });
        entryGroup.appendChild(subjectSelect);

        const teacherLabel = document.createElement('label');
        teacherLabel.textContent = 'Teacher';
        entryGroup.appendChild(teacherLabel);

        const teacherSelect = document.createElement('select');
        teacherSelect.name = 'teacher_name[][]';
        teacherSelect.classList.add('form-control');
        teacherSelect.innerHTML = '<option value="" selected>Select the teacher</option>';
        entryGroup.appendChild(teacherSelect);

        const startTimeLabel = document.createElement('label');
        startTimeLabel.textContent = 'Start Time';
        entryGroup.appendChild(startTimeLabel);

        const startTimeInput = document.createElement('input');
        startTimeInput.type = 'time';
        startTimeInput.name = 'start_time[][]';
        startTimeInput.classList.add('form-control');
        entryGroup.appendChild(startTimeInput);

        const endTimeLabel = document.createElement('label');
        endTimeLabel.textContent = 'End Time';
        entryGroup.appendChild(endTimeLabel);

        const endTimeInput = document.createElement('input');
        endTimeInput.type = 'time';
        endTimeInput.name = 'end_time[][]';
        endTimeInput.classList.add('form-control');
        entryGroup.appendChild(endTimeInput);

        entriesContainer.appendChild(entryGroup);

        subjectSelect.addEventListener('change', function () {
            const selectedSubject = this.value;
            const teachers = teachersBySubject[selectedSubject] || [];
            teacherSelect.innerHTML = '<option value="" selected>Select the teacher</option>';
            teachers.forEach(function (teacher) {
                const option = document.createElement('option');
                option.value = teacher;
                option.textContent = teacher;
                teacherSelect.appendChild(option);
            });
        });
    });
});
</script>
@endsection
