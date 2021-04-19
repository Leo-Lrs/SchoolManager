@extends('layouts.app')
@section('title')
Modules Details
@endsection
@section('content')
    <div class="container">
    <h5>
        {{ $module["name"] }} <br>
    </h5>
    <h6>
        {{ $module["description"] }} <br>
    </h6>

    @if (isset($module->promotions[0])) 
        <h6>Promotion affiliated :</h6>
        @foreach ( $module->promotions as $promotion )
           C - {{ $promotion->speciality }} <br>
        @endforeach
        @else
        <h6>No Promotion affiliated</h6>
    @endif
    @if (isset($module->students[0]))
        <h6>Students affiliated :</h6>
        @foreach ( $module->students as $student)
            {{ $student->name }} - {{ $student->firstName }} <br>
        @endforeach
        @else  
        <h6>No Students affiliated</h6>
    @endif
    <br>
    <form method="POST" action="{{route('modules.destroy', $module) }}">
    @method("DELETE")
    @csrf
        <button type="submit" class="btn btn-danger">
            Delete
        </button>
    </form>
    </div>

@endsection