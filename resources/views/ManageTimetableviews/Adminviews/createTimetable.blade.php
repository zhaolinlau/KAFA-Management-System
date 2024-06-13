@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Create Timetable</h2>
    
    <!-- Form to create a new timetable -->
    <form action="{{ route('timetables.store') }}" method="POST">
        @csrf
        
        <!-- Class Selection Dropdown -->
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
        </div>
        
        <!-- Button to add a new timetable entry -->
        <button type="button" class="btn btn-success mt-4" id="addEntry">Add Entry</button>
        
        <!-- Button to save the created timetable -->
        <button type="submit" class="btn btn-primary mt-4">Save</button>
    </form>
</div>

<script>
    // Assign subjects to their respective teachers
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

        // Add event listener for the "Add Entry" button
        addEntryBtn.addEventListener('click', function () {
            const entriesContainer = document.getElementById('entries-container');
            const entryGroup = document.createElement('div');
            entryGroup.classList.add('entry-group', 'mt-3', 'p-3', 'border', 'rounded');

            // Day Selection
            const dayLabel = document.createElement('label');
            dayLabel.textContent = 'Day';
            entryGroup.appendChild(dayLabel);

            const daySelect = document.createElement('select');
            daySelect.name = 'days[]';
            daySelect.classList.add('form-control');
            daySelect.innerHTML = '<option value="" selected>Select the day</option>';
            const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
            days.forEach(function (day) {
                const option = document.createElement('option');
                option.value = day;
                option.textContent = day;
                daySelect.appendChild(option);
            });
            entryGroup.appendChild(daySelect);

            // Subject Selection
            const subjectLabel = document.createElement('label');
            subjectLabel.textContent = 'Subject';
            entryGroup.appendChild(subjectLabel);

            const subjectSelect = document.createElement('select');
            subjectSelect.name = 'subject_name[][]';
            subjectSelect.classList.add('form-control');
            subjectSelect.innerHTML = '<option value="" selected>Select the subject</option>';
            const subjects = ['UlumSyariahAkidahIbadah', 'Sirah', 'JawiKhat', 'AdabAkhlakIslamiah', 'LughatulQuran', 'AmaliSolat'];
            subjects.forEach(function (subject) {
                const option = document.createElement('option');
                option.value = subject;
                option.textContent = subject;
                subjectSelect.appendChild(option);
            });
            entryGroup.appendChild(subjectSelect);

            // Teacher Selection
            const teacherLabel = document.createElement('label');
            teacherLabel.textContent = 'Teacher';
            entryGroup.appendChild(teacherLabel);

            const teacherSelect = document.createElement('select');
            teacherSelect.name = 'teacher_name[][]';
            teacherSelect.classList.add('form-control');
            teacherSelect.innerHTML = '<option value="" selected>Select the teacher</option>';
            entryGroup.appendChild(teacherSelect);

            // Start Time Input
            const startTimeLabel = document.createElement('label');
            startTimeLabel.textContent = 'Start Time';
            entryGroup.appendChild(startTimeLabel);

            const startTimeInput = document.createElement('input');
            startTimeInput.type = 'time';
            startTimeInput.name = 'start_time[][]';
            startTimeInput.classList.add('form-control');
            entryGroup.appendChild(startTimeInput);

            // End Time Input
            const endTimeLabel = document.createElement('label');
            endTimeLabel.textContent = 'End Time';
            entryGroup.appendChild(endTimeLabel);

            const endTimeInput = document.createElement('input');
            endTimeInput.type = 'time';
            endTimeInput.name = 'end_time[][]';
            endTimeInput.classList.add('form-control');
            entryGroup.appendChild(endTimeInput);

            // Append the new entry group to the entries container
            entriesContainer.appendChild(entryGroup);

            // Add event listener for subject selection to update the corresponding teachers
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
