<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (auth()->user()->role == 'teacher') {
            return $this->indexStudent($request);
        } elseif (auth()->user()->role == 'parent') {
            $studentId = auth()->user()->id;
            $result = Result::where('student_id', $studentId)->first();
            if ($result) {
                return redirect()->route('results.showResult', $result->id);
            } else {
                abort(404, 'Result not found.');
            }
        }

        abort(403);
    }

    /**
     * Display a listing of the resource for teachers.
     */
    protected function indexStudent(Request $request): View
    {
        $query = Student::with('results');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('student_name', 'like', "%{$search}%")
                  ->orWhere('matric_no', 'like', "%{$search}%");
        }

        $students = $query->get();

        return view('ManageResultView.TeacherView.StudentList', ['students' => $students]);
    }

     /**
     * Display the specified result.
     */
    public function showResult($id): View
{
    $result = Result::with('student')->findOrFail($id);
    
    // Ensure the assessments field is an array
    if (is_null($result->assessments)) {
        $result->assessments = [];
    }

    if (auth()->user()->role == 'teacher') {
        return view('ManageResultView.TeacherView.MarksViewTeacher', ['result' => $result]);
    } elseif (auth()->user()->role == 'parent') {
        return view('ManageResultView.ParentView.MarksViewParent', ['result' => $result]);
    }

    abort(403);
}


    /**
     * Show the form for creating a new result.
     */
    public function createResult(): View
    {
        $students = Student::all();
        return view('ManageResultView.TeacherView.CreateResult', ['students' => $students]);
    }

    /**
     * Store a newly created result in storage.
     */
    public function storeResult(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer|exists:students,id',
            'Subject_name' => 'required|string|max:255',
            'Marks' => 'required|string|max:255',
            'Categories' => 'required|string|max:255',
            'Grade' => 'required|string|max:255',
        ]);

        Result::create($request->all());

        return redirect()->route('results.index');
    }

    /**
     * Show the form for editing the specified result.
     */
    public function editResult($id): View
    {
        $result = Result::with('student')->findOrFail($id);
        return view('ManageResultView.TeacherView.EditMarks', ['result' => $result]);
    }

    /**
     * Update the specified result in storage.
     */
    public function updateResult(Request $request, $id): RedirectResponse
{
    $request->validate([
        'assessments' => 'required|array',
        'assessments.*' => 'required|string|max:255',
        'marks' => 'required|array',
        'marks.*' => 'required|string|max:255',
        'weightage' => 'required|array',
        'weightage.*' => 'required|string|max:255',
        'grades' => 'required|array',
        'grades.*' => 'required|string|max:255',
    ]);

    $result = Result::findOrFail($id);
    $assessments = [];

    foreach ($request->assessments as $index => $assessment) {
        $assessments[] = [
            'name' => $assessment,
            'marks' => $request->marks[$index],
            'weightage' => $request->weightage[$index],
            'grade' => $request->grades[$index],
        ];
    }

    $result->update([
        'assessments' => json_encode($assessments),
    ]);

    return redirect()->route('results.index');
}

    

    /**
     * Remove the specified result from storage.
     */
    public function destroyResult($id): RedirectResponse
    {
        $result = Result::findOrFail($id);
        $result->delete();

        return redirect()->route('results.index');
    }
}