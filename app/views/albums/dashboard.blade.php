@extends('layouts.master')

@section('content')

@if (count($albums) > 0)
    <div class="list-group">
        @foreach ($albums as $album)
        <a href="#" class="album-entry">
            <div class="head">
                <img class="cover" src="http://placehold.it/100x100">
                <h4>{{$album->name}}</h4>
            </div>
            <span class="badge">{{$album->photos_count}}</span>
            <p class="description">{{$album->description}}</p>
        </a>
        @endforeach
    </div>
@else
    <div class="alert alert-info">
        <h3>No albums found</h3>
        <p>To create an album, click the button below.</p>
        <br>
        <button class="btn btn-primary btn-large">Create album</button>
    </div>
@endif
@stop