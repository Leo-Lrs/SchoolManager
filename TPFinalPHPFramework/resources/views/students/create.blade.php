@extends('layouts.app')
@section('title')
    Students Add
@endsection
@section('content')
    <form method="POST" action="{{ route('students.store') }}">
    @csrf
    @method('POST')
        <div class="form-row">
            <div class="form-group col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="name" value="" required='required'>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Firstname</label>
                    <input type="text" class="form-control" name="firstName" value="" required='required'>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" value="" required='required'>
                </div>
            </div>
        </div>
        <select class="custom-select col-md-4" name='promo' required='required'>
            <option selected>Choose a promotion</option>
            <option value="">None</option>
            @foreach ($promotions as $promotion)
                <option value="{{ $promotion["id"] }}">{{ $promotion["name"] }} - {{ $promotion["speciality"] }}</option>
            @endforeach
        </select>

        @foreach ( $modules as $module )
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $module->id }}" name="modules[]" id="defaultCheck1" >
                <label class="form-check-label" for="defaultCheck1">
                    {{ $module->name }} - {{ $module->description }}
                </label>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection