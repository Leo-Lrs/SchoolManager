@extends('layouts.app')
@section('title')
Students Details
@endsection
@section('content')
    <div class="text-center">
    <br>
        <img src="https://img.freepik.com/icones-gratuites/chapeau-graduation_318-374.jpg?size=338&ext=jpg" class="img-thumbnail">
        <br>
        <p>
            Full Name : {{ $student["name"] }} 
            {{ $student["firstName"] }} <br>
            Email : {{ $student["email"] }} <br>
            @if (isset($student["promotion_id"]))
                Promotion : {{ $student->promotion->name }} - {{ $student->promotion->speciality }}
            @else
            No Promotion

            @endif
            @if (isset($student->modules))
                <br>
                Modules List : 
                <ul>
                @foreach ( $student->modules as $module )
                    <h5>{{ $module->name }} </h5>
                    {{ $module->description }}
                @endforeach
                </ul>
            @else
            <br>
            No Modules
            @endif
        </p>
        <form method="POST" action="{{route('students.destroy', $student) }}">
            @method("DELETE")
            @csrf
            <button type="submit" class="btn btn-danger">
                Delete
            </button>
        </form>
    </div>

@endsection