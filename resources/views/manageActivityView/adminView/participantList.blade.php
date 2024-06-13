@extends('layouts.app')

@section('content')
    <div id="main">

        @if (session('status'))
            <div class="alert alert-danger">
                {{session('status')}}
            </div>  
        @endif

        <h1 id="title">Participant List</h1>
        <div id="search">
            <form action="{{ route('searchParticipant') }}" method="GET">
                <input id="box-search" type="text" name="search" class="form-control" placeholder="Enter Student Name" value="{{ request('search') }}">
                <button id="btn-search" type="submit" class="btn btn-dark">Search</button>
            </form>
        </div>
        <br><br>
        <div style="float: right;">
            <a href="{{route('displayRegistration')}}">
                <button class="btn btn-outline-secondary">Pending</button>
            </a>
            <a href="{{route('displayParticipant')}}">
                <button class="btn btn-secondary">Registered</button>
            </a>
        </div>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Activity</th>
                        <th scope="col">Date</th>
                        <th scope="col">Student's Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activityParticipants as $participant)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $participant->activity->activityName }}</td>
                            <td>{{ $participant->activity->activityDate }}</td>
                            <td>{{ $participant->student->student_name }}</td>
                            
                            <td>
                                <a href="{{ route('deleteParticipant', ['participantId' => $participant->participantId]) }}">
                                    <button class="btn btn-danger">Delete</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        #main{
            margin: auto;
            width: 1000px;
        }
        #title{
            margin-bottom: 50px;
            margin-top: 20px;
            text-align: center;
        }

        #search{
            width: 680px;
            /* max-width: fit-content; */
            margin-left: auto;
            margin-right: auto;
        }
        #box-search{
            width: 600px;
            float: left;
        }

    </style>

@endsection
