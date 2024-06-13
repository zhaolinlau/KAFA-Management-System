@extends('layouts.app')

@section('content')

    <div id="main">
        <h1 id="title">Create Activity Form</h1>
        <!-- Create activity form -->
        <form action="submit" method="post">
            @csrf
            <div>Activity : <input type="text" name="name" class="form-control"></div><br>
            <div>Location : <input type="text" name="location" class="form-control"></div><br>
            <div>Capacity : <input type="number" name="capacity" class="form-control"></div><br>
            <div>Date : <input type="datetime-local" name="date" class="form-control"></div><br>
            <input id="btn-submit" type="submit" class="btn btn-primary">
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

        #btn-submit{
            float: right;
        }

    </style>

@endsection
