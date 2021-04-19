@extends('layouts.app')
@section('title')
Students
@endsection
@section('content')
    <div class="container">
    <br>
    <a href="{{ route("students.create") }}"><h3>Add Student</h3></a>
    
    <br><h5>Student List :</h5><br>

    {{-- <h6>Search Student by Name :</h6>
    <button class="btn" type="submit">Search</button> --}}
    <div class="row">
            @foreach ( $students as $student)
                <div class="col-4 mb-3">
                    <div class="text-center">
                    <h6>{{ $student["name"] }} {{ $student["firstName"] }}</h6>
                    <img src="https://img.freepik.com/icones-gratuites/chapeau-graduation_318-374.jpg?size=338&ext=jpg" class="img-thumbnail">
                    <form method="POST" action="{{route('students.destroy', $student) }}">
                    <a href="{{ route("students.show", ['student'=>$student]) }}" class="btn btn-primary">Show</a>
                    
                    <a href="{{ route('students.edit', ['student'=>$student]) }}" class="btn btn-warning">Update</a>
                    @method("DELETE")
                    @csrf
                        <button type="submit" class="btn btn-danger">
                            Delete
                        </button>
                    </form>
                    </div>
                </div>
            @endforeach
    </div>
    </div>
@endsection