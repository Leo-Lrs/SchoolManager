@extends('layouts.app')
@section('title')
Promotions
@endsection
@section('content')
    <div class="container">
    <br>
    <a href="{{ route("promotions.create") }}"><h3>Add Promotion</h3></a>
     <br>Promotions List : <br> <br>
    @foreach ($promotions as $promotion)
    <div class="col-4 mb-3">
        {{ $promotion["name"] }} - {{ $promotion["speciality"] }}
        <form method="POST" action="{{route('promotions.destroy', $promotion) }}">
        <a href="{{ route("promotions.show", ['promotion'=>$promotion] ) }}" class="btn btn-primary">Show</a>
        
        <a href="{{ route('promotions.edit', ['promotion'=>$promotion]) }}" class="btn btn-warning">Update</a>
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