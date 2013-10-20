@extends('layouts.master')

@section('content')
<div class="row">
    @foreach ($albums as $album)
        <div class="album">
            <div class="thumbnail">
                <img src="http://placehold.it/250x200">
                <div class="caption">
                    <span>{{$album->name}}</span>
                </div>
            </div>
        </div>
    @endforeach
</div>
@stop