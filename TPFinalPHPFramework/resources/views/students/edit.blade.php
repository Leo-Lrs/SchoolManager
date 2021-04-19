@extends('layouts.app')
@section('title')
    Students Edit
@endsection
@section('content')
    <form method="POST" action="{{ route('students.update', $student) }}">
    @csrf
    @method('PUT')
    <h2>Personal Data</h2>
        <div class="form-row">
            <div class="form-group col-md-4">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $student["name"] }}" required='required'>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="form-group">
                    <label>Firstname</label>
                    <input type="text" class="form-control" name="firstName" value="{{ $student["firstName"] }}" required='required'>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control" name="email" value="{{ $student["email"] }}" required='required'>
                </div>
            </div>
        </div>
        <p>Promotion</p>
        <select class="custom-select col-md-4" name='promo' required='required'>
            @if ((isset($student["promotion_id"])))
                <option selected value="{{ $student["promotion_id"] }}"> {{ $student->promotion->name }} - {{ $student->promotion->speciality }}</option>
                <option value="">None</option>
                @foreach ($promotions as $promotion)
                    <option value="{{ $promotion["id"] }}">{{ $promotion["name"] }} - {{ $promotion["speciality"] }}</option>
                @endforeach

            @else
                <option selected value="">Select a promotion</option>
                <option value="">None</option>
                @foreach ($promotions as $promotion)
                    <option value="{{ $promotion["id"] }}">{{ $promotion["name"] }} - {{ $promotion["speciality"] }}</option>
                @endforeach
            
            @endif
        </select>
        <h2>Modules</h2>
        @foreach ( $modules as $module )
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $module->id }}" name="modules[]" id="defaultCheck1" 
                    @foreach($student->modules as $checked)
                        @if($checked->id == $module->id) checked @endif
                    @endforeach>
                <label class="form-check-label" for="defaultCheck1">
                    {{ $module->name }} - {{ $module->description }}
                </label>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
@endsection
