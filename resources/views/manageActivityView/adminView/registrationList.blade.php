@extends('layouts.app')

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
             {{session('status')}}
        </div>
    @elseif (session('destroy'))
        <div class="alert alert-danger">
            {{session('destroy')}}
        </div>
    @endif

    <div id="main">
        <h1 id="title">Application List</h1>
        <div id="search">
            <form action="{{ route('searchRegistration') }}" method="GET">
                <input id="box-search" type="text" name="search" class="form-control" placeholder="Enter Student Name" value="{{ request('search') }}">
                <button id="btn-search" type="submit" class="btn btn-dark">Search</button>
            </form>
        </div>
        <br><br>
        <div style="float: right;">
            <a href="{{route('displayRegistration')}}">
                <button class="btn btn-secondary">Pending</button>
            </a>
            {{-- {{route('displayParticipant')}} --}}
            <a href="{{route('displayParticipant')}}">
                <button class="btn btn-outline-secondary">Registered</button>
            </a>
        </div>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Activity Name</th>
                        <th scope="col">Activity Date</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Students IC</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activityParticipants as $participant)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $participant->activity->activityName }}</td>
                            <td>{{ $participant->activity->activityDate }}</td>
                            <td>{{ $participant->student->student_name }}</td>
                            <td>{{ $participant->student->student_ic }}</td>
                            <td>
                                <form action="{{ url('registration/' .$participant->participantId. '/approval' ) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success" style="float: left;">Approve</button>
                                </form>
                                
                                <a href="{{url('registration/' .$participant->participantId. '/reject')}}">
                                    <button class="btn btn-danger">Reject</button>
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
            width: 1200px;
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
        #btn-search{

        }

    </style>

@endsection
