@extends('layouts.app')
@section('title')
Promotions Edit
@endsection
@section('content')
    <form method="POST" action="{{ route('promotions.update', ['promotion'=>$promotion]) }}">
    @csrf
    @method('PUT')
    <h2>Name</h2>
    <div class="form-group col-md-4">
        <div class="form-group">
            <input type="text" class="form-control" name="name" value="{{ $promotion->name }}" required='required'>
        </div>
    </div>
    <h2>Speciality</h2>
    <div class="form-group col-md-4">
        <div class="form-group">
            <input type="text" class="form-control" name="speciality" value="{{ $promotion->speciality }}" required='required'>
        </div>
    </div>
    <h2>Modules</h2>
        @foreach ( $modules as $module )
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $module->id }}" name="modules[]" id="defaultCheck1" 
                    @foreach($promotion->modules as $checked)
                        @if($checked->id == $module->id) checked @endif
                    @endforeach>
                <label class="form-check-label" for="defaultCheck1">
                    {{ $module->name }} - {{ $module->description }}
                </label>
            </div>
        @endforeach

    <h2>Students</h2>
       
        @foreach ( $students as $student )
            @if ($student->promotion_id == NULL || $student->promotion_id == $promotion->id)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $student->id }}" name="students[]" id="defaultCheck1" 
                        @foreach($promotion->students as $checked)
                            @if($checked->id == $student->id) checked @endif
                        @endforeach>
                    <label class="form-check-label" for="defaultCheck1">
                        {{ $student->name }} - {{ $student->firstName }}
                    </label>
                </div>
            @endif
        @endforeach
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
    <br>
    <form method="POST" action="{{route('promotions.destroy', $module) }}">
    @method("DELETE")
    @csrf
        <button type="submit" class="btn btn-danger">
            Delete
        </button>
    </form>
@endsection