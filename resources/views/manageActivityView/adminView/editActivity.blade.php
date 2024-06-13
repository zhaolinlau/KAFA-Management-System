@extends('layouts.app')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Edit Form --}}
    <div id="main">
        <h1 id="title">Edit Activity Form</h1>
        <!-- Edit activity form -->
        <form action="{{ url('createdActivity/' . $activity->activityId . '/update') }}" method="post">
            @csrf
            <input type="hidden" name="activityId" value="{{ $activity->activityId }}">
            <div>Activity : <input type="text" name="name" class="form-control" value="{{ $activity->activityName }}" style="color: grey"></div><br>
            <div>Location : <input type="text" name="location" class="form-control" value="{{ $activity->activityLocation }}" style="color: grey"></div><br>
            <div>Capacity : <input type="number" name="capacity" class="form-control" value="{{ $activity->activityCapacity }}" style="color: grey"></div><br>
            <div>Date : <input type="datetime-local" name="date" class="form-control" value="{{ $activity->activityDate }}" style="color: grey"></div><br>
            <button id="btn-update" type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>


    <style>
        #title{
            margin-bottom: 50px;
            margin-top: 20px;
            text-align: center;
        }

        #main{
            margin: auto;
            width: 600px;
        }

        #btn-update{
            float: right;
        }
    </style>

@endsection
