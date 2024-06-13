<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use App\Models\TimetableEntry;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function index(Request $request)
    {
        // Validate class name
        $class_name = $request->input('class_name');
        $timetables = Timetable::with('entries')->get();
        $timetable = null;

        if ($class_name) {
            $timetable = Timetable::with('entries')->where('class_name', $class_name)->first();
        }
        // route for display list of timetable for admin
		if (auth()->user()->role == 'admin') {
            return view('ManageTimetableviews.Adminviews.listTimetable', compact('timetables'));
        // route for display  timetable for parents
        }elseif (auth()->user()->role == 'parent') {
            return view('ManageTimetableviews.Parentviews.studentTimetable', compact('timetables', 'timetable', 'class_name'));
        // route for display  timetable for teacher
        }elseif (auth()->user()->role == 'teacher') {
            return view('ManageTimetableviews.Teacherviews.teacherTimetable', compact('timetables', 'timetable', 'class_name'));
        }
    }

    // function create timetable 
    public function create()
    {
        // route to return create form for timetable
        return view('ManageTimetableviews.Adminviews.createTimetable');
    }

    // function store data from create timetable page 
    public function store(Request $request)
    {
        // Validate data into timetable and timetablentry table
    $request->validate([
        'class_name' => 'required|string',
        'days' => 'required|array',
        'subject_name' => 'required|array',
        'teacher_name' => 'required|array',
        'start_time' => 'required|array',
        'end_time' => 'required|array',
        'subject_name.*.*' => 'required|string',
        'teacher_name.*.*' => 'required|string',
        'start_time.*.*' => 'required|date_format:H:i',
        'end_time.*.*' => 'required|date_format:H:i|after:start_time.*.*',
    ]);

    $timetable = Timetable::create([
        'class_name' => $request->class_name,
    ]);

    foreach ($request->days as $dayIndex => $day) {
        foreach ($request->subject_name[$dayIndex] as $subjectIndex => $subjectName) {
            TimetableEntry::create([
                'timetable_id' => $timetable->id,
                'day' => $day,
                'subject_name' => $subjectName,
                'teacher_name' => $request->teacher_name[$dayIndex][$subjectIndex],
                'start_time' => $request->start_time[$dayIndex][$subjectIndex],
                'end_time' => $request->end_time[$dayIndex][$subjectIndex],
            ]);
        }
    }
    // route for go to timetable home after creating timetable
    return redirect()->route('timetables.index')->with('success', 'Timetable created successfully.');
    }

// Function to show the timetable
    public function show($id)
{
    // Call timetable ID with the entries for the timetable
    $timetable = Timetable::with('entries')->findOrFail($id);
    return view('timetables.show', compact('timetable'));
}
    
// Function to edit the timetable
    public function edit($id)
    {
        // Check timetable id from db
        $timetable = Timetable::findOrFail($id);
        return view('ManageTimetableviews.Adminviews.editTimetable', compact('timetable'));
    }

// Function to update the timetable
    public function update(Request $request, $id)
    {
        // Check timetable ID from db
        $timetable = Timetable::find($id); 
        // Call class name from timetable table from db
        $timetable->class_name = $request->input('class_name');
        $timetable->save();

        // Update existing entries
        foreach ($request->input('entry_id', []) as $entryId) {
            // Check timetableentry ID from db
            $entry = TimetableEntry::find($entryId);
            $entry->subject_name = $request->input('subject_name')[$entryId];
            $entry->teacher_name = $request->input('teacher_name')[$entryId];
            $entry->day = $request->input('day')[$entryId];
            $entry->start_time = $request->input('start_time')[$entryId];
            $entry->end_time = $request->input('end_time')[$entryId];
            $entry->save();
        }

        // Add new entries for the timetable
        if ($request->has('new_days')) {
            foreach ($request->input('new_days') as $newDay) {
                $newSubjects = $request->input("new_subject_name.$newDay", []);
                $newTeachers = $request->input("new_teacher_name.$newDay", []);
                $newStartTimes = $request->input("new_start_time.$newDay", []);
                $newEndTimes = $request->input("new_end_time.$newDay", []);
                // store new subject if added 
                for ($i = 0; $i < count($newSubjects); $i++) {
                    $entry = new TimetableEntry();
                    $entry->timetable_id = $timetable->id;
                    $entry->subject_name = $newSubjects[$i];
                    $entry->teacher_name = $newTeachers[$i];
                    $entry->day = $newDay;
                    $entry->start_time = $newStartTimes[$i];
                    $entry->end_time = $newEndTimes[$i];
                    $entry->save();
                }
            }
        }
        // route to show timetable page
        return redirect()->route('timetables.show', $timetable->id)->with('success', 'Timetable updated successfully');
    }




    // function delete timetable 
    public function destroy($id)
    {
        // checktime timetable id from db
        $timetable = Timetable::findOrFail($id);
        $timetable->delete();
        // route to go home timetable page after delete timetable
        return redirect()->route('timetables.index')->with('success', 'Timetable deleted successfully.');
    }

}
