@extends('layouts.app')
@section('title')
Promotions Details
@endsection
@section('content')
    <div class="container">
    <h5>
        {{ $promotion["name"] }} 
    </h5>
    <h6>
        {{ $promotion["speciality"] }} <br>
    </h6>
    @if (isset($promotion->modules))
            <br>
            Modules List : 
            <ul>
            @foreach ( $promotion->modules as $module )
                <li>{{ $module->name }} </li>
                {{ $module->description }}
            @endforeach
            </ul>
        @else
        <br>
        No Modules affiliated
        @endif
    @if (isset($promotion->students[0]))
        <h6>Students affiliated :</h6>
        @foreach ( $promotion->students as $student)
            {{ $student->name }} - {{ $student->firstName }} <br>
        @endforeach
        @else  
        <h6>No Students affiliated</h6>
    @endif
    <br>
    <form method="POST" action="{{route('promotions.destroy', $promotion) }}">
    @method("DELETE")
    @csrf
        <button type="submit" class="btn btn-danger">
            Delete
        </button>
    </form>
    </div>
@endsection