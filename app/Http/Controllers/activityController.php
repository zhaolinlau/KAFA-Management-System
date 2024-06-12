<?php

namespace App\Http\Controllers;

use App\Models\activity;
use Illuminate\Http\Request;



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Http\Controllers\Controller;
use App\Models\activityParticipant;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{


    // Create Activity
    public function create(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'date' => 'nullable|date',
        ]);

        // Create a new Activity instance
        $activity = new Activity();
        $activity->activityName = $validatedData['name'];
        $activity->activityLocation = $validatedData['location'];
        $activity->activityCapacity = $validatedData['capacity'];
        $activity->activityDate = $validatedData['date'];

        // Save the activity to the database
        $activity->save();

        // Redirect back to the form with a success message
        return redirect()->route('createdActivityList')->with('success', 'Activity created successfully!');
    }

    // Display all data in activity table
    public function index()
    {
        $activity_data = Activity::all();
        return view('manageActivityView.adminView.createdActivityList', ['activity_data' => $activity_data]);
    }

    // Edit Activity
    public function edit($activityId)
    {
        $activity = Activity::where('activityId', $activityId)->first();
        if (!$activity) {
            abort(404, 'Activity not found');
        }
        return view('manageActivityView.adminView.editActivity', ['activity' => $activity]);
    }

    // Update Activity
    public function update(Request $request, $activityId)
    {
        $activity = Activity::where('activityId', $activityId)->first();
        if (!$activity) {
            abort(404, 'Activity not found');
        }

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'date' => 'nullable|date',
        ]);

        $activity->activityName = $request->input('name');
        $activity->activityLocation = $request->input('location');
        $activity->activityCapacity = $request->input('capacity');
        $activity->activityDate = $request->input('date');
        $activity->save();

        return redirect()->route('createdActivityList')->with('success', 'Data Successfully Updated');
    }

    //Delete activity
    public function destroy($activityId){
        $activity = Activity::where('activityId', $activityId);
        
        if ($activity){
            $activity->delete();
        }

        return redirect()->route('createdActivityList')->with('destroy','Data Successfully Deleted');
    }

    //Display Registration List -> Only Pending status displayed
    public function displayRegistration()
    {
        //Select the activity_participants data with "Pending" status only
        $activityParticipants = ActivityParticipant::with(['activity', 'student'])->where('status', 'Pending')->get();
        return view('manageActivityView.adminView.registrationList', ['activityParticipants' => $activityParticipants]);
    }

    
    //Search Registration Name
    public function searchRegistration(Request $request) {
        $query = $request->input('search'); // Get the search query from the request
        
        // Fetch participants with "Pending" status whose student names match the search query
        $participants = ActivityParticipant::with(['activity', 'student'])
                        ->where('status', 'Pending') // Filter by status "Pending"
                        ->whereHas('student', function ($q) use ($query) {
                            $q->where('student_name', 'like', '%' . $query . '%');
                        })
                        ->get();
        
        // Pass the filtered participants to the view
        return view('manageActivityView.adminView.registrationList', [
            'activityParticipants' => $participants,
            'search' => $query // Include the search query for repopulating the form
        ]);
    }

    //Approval Registration
    public function updateStatus($participantId){
        $participant = ActivityParticipant::find($participantId);

        $participant->status = 'Registered';

        $participant->save();
        return redirect()->route('displayRegistration')->with('status', 'Participant registered successfully!');
    }

    //Reject Partidcipant
    public function destroyRegistration($participantId){
        $participant = activityParticipant::where('participantId', $participantId);

        if($participant){
            $participant->delete();
        }

        return redirect()->route('displayRegistration')->with('destroy', 'Rejected registration was deleted');
    }

    //Display registered participant
    public function displayParticipant(){
        $activityParticipants = ActivityParticipant::with(['activity', 'student'])->where('status', 'Registered')->get();
        // dd($activityParticipants);
        return view('manageActivityView.adminView.participantList', ['activityParticipants' => $activityParticipants]);
    }

    //Search participant Name
    public function searchParticipant(Request $request) {
        $query = $request->input('search'); // Get the search query from the request
        
        // Fetch participants with "Pending" status whose student names match the search query
        $participants = ActivityParticipant::with(['activity', 'student'])
                        ->where('status', 'Registered') // Filter by status "Pending"
                        ->whereHas('student', function ($q) use ($query) {
                            $q->where('student_name', 'like', '%' . $query . '%');
                        })
                        ->get();
        
        // Pass the filtered participants to the view
        return view('manageActivityView.adminView.participantList', [
            'activityParticipants' => $participants,
            'search' => $query // Include the search query for repopulating the form
        ]);
    }


    //Delete participant
    public function deleteParticipant($participantId){
        $activityParticipants = activityParticipant::where('participantId', $participantId);
        
        if($activityParticipants){
            $activityParticipants->delete();
        }

        return redirect()->route('displayParticipant')->with('status', 'Participant has been deleted');
    }






    //PARENTS

    //Display Activity to register
    public function displayActivity() 
    {
        $userId = Auth::id();

        // $activity_data = Activity::all();

        $activity_data = Activity::with(['activityParticipants' => function ($query) use ($userId) {
            $query->where('usersId', $userId)
                  ->where('status', '!=', 'Registered');
        }])->get();

        return view('manageActivityView.parentsView.registerActivity', ['activity_data' => $activity_data]);

        

    }


    // Register Activity
    public function registerActivity($activityId)
    {
        // Assuming you have authentication set up and the user is logged in
        $user = Auth::user();

        // Fetch the first student associated with the user
        $student = $user->students->first();

        if (!$student) {
            return redirect()->route('displayActivity')->with('error', 'No student associated with this user.');
        }

        // Create a new activity participant record
        $participant = new ActivityParticipant();
        $participant->activityId = $activityId;
        $participant->usersId = $user->id;
        $participant->studentsId = $student->id; // Assuming 'id' is the primary key for the student
        $participant->status = 'Pending';
        $participant->save();

        return redirect()->route('displayActivity')->with('status', 'Participant registered successfully!');
    }
    

}