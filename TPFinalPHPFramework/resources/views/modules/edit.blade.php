@extends('layouts.app')
@section('title')
    Edit Modules
@endsection
@section('content')
    <form method="POST" action="{{ route('modules.update', ['module'=>$module]) }}">
    @csrf
    @method('PUT')
    <h2>Name</h2>
    <div class="form-group col-md-4">
        <div class="form-group">
            <input type="text" class="form-control" name="name" value="{{ $module->name }}" required='required'>
        </div>
    </div>
    <h2>Description</h2>
    <div class="form-group col-md-4">
        <div class="form-group">
            <input type="text" class="form-control" name="description" value="{{ $module->description }}" required='required'>
        </div>
    </div>
    <h2>Promotions</h2>
       
        @foreach ( $promotions as $promotion )
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $promotion->id }}" name="promotions[]" id="defaultCheck1" 
                    @foreach($module->promotions as $checked)
                        @if($checked->id == $promotion->id) checked @endif
                    @endforeach>
                <label class="form-check-label" for="defaultCheck1">
                    {{ $promotion->name }} - {{ $promotion->speciality }}
                </label>
            </div>
        @endforeach

    <h2>Students</h2>
       
        @foreach ( $students as $student )
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $student->id }}" name="students[]" id="defaultCheck1" 
                    @foreach($module->students as $checked)
                        @if($checked->id == $student->id) checked @endif
                    @endforeach>
                <label class="form-check-label" for="defaultCheck1">
                    {{ $student->name }} - {{ $student->firstName }}
                </label>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
    <br>
    <form method="POST" action="{{route('modules.destroy', $module) }}">
    @method("DELETE")
    @csrf
        <button type="submit" class="btn btn-danger">
            Delete
        </button>
    </form>


@endsection