@extends('layouts.app')
@section('title')
Promotions Create
@endsection
@section('content')
    <form method="POST" action="{{ route('promotions.store') }}">
    @csrf
    @method('POST')
        <h2>Name</h2>
        <div class="form-group col-md-4">
            <div class="form-group">
                <input type="text" class="form-control" name="name" value="" required='required'>
            </div>
        </div>
        <h2>Speciality</h2>
        <div class="form-group col-md-4">
            <div class="form-group">
                <input type="text" class="form-control" name="speciality" value="" required='required'>
            </div>
        </div>
        <h2>Modules List</h2>

        @foreach ( $modules as $module )
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $module->id }}" name="modules[]" id="defaultCheck1" >
                    <label class="form-check-label" for="defaultCheck1">
                        {{ $module->name }} - {{ $module->description }}
                    </label>
                </div>
        @endforeach

        <h2>Students List</h2>

        @foreach ( $students as $student )
            @if ($student->promotion_id == NULL)

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $student->id }}" name="students[]" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    {{ $student->name }} - {{ $student->firstName }}
                </label>
            </div>
                
            @endif
        @endforeach
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection