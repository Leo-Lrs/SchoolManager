@extends('layouts.app')
@section('title')
Create Module
@endsection
@section('content')
    <form method="POST" action="{{ route('modules.store') }}">
    @csrf
    @method('POST')
    <h2>Name</h2>
    <div class="form-group col-md-4">
        <div class="form-group">
            <input type="text" class="form-control" name="name" value="" required='required'>
        </div>
    </div>
    <h2>Description</h2>
    <div class="form-group col-md-4">
        <div class="form-group">
            <input type="text" class="form-control" name="description" value="" required='required'>
        </div>
    </div>

    <h2>Promotions</h2>
       
        @foreach ( $promotions as $promotion )
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $promotion->id }}" name="promotions[]" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    {{ $promotion->name }} - {{ $promotion->speciality }}
                </label>
            </div>
        @endforeach

    <h2>Students</h2>
       
        @foreach ( $students as $student )
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $student->id }}" name="students[]" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    {{ $student->name }} - {{ $student->firstName }}
                </label>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection