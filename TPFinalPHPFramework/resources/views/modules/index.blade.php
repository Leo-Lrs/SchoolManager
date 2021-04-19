@extends('layouts.app')
@section('title')
Modules
@endsection
@section('content')
    <div class="container">

    <br>
    <a href="{{ route("modules.create") }}"><h3>Add Module</h3></a>
     <br><h5>Modules List : </h5><br> <br>
    @foreach ($modules as $module)
    <div class="col-4 mb-3">
        {{ $module["name"] }} - {{ $module["description"] }}
        <form method="POST" action="{{route('modules.destroy', $module) }}">
        <a href="{{ route("modules.show", ['module'=>$module] ) }}" class="btn btn-primary">Show</a>
        
        <a href="{{ route('modules.edit', ['module'=>$module]) }}" class="btn btn-warning">Update</a>
        @method("DELETE")
        @csrf
            <button type="submit" class="btn btn-danger">
                Delete
            </button>
        </form>
    </div>
        
    @endforeach
    </div>
@endsection