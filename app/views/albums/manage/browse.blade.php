@extends('layouts.master')

@section('content')
<h1>{{$album->name}} <small>browse</small></h1>
@include('albums.manage._toolbar', array('active_page' => 'browse'))
<div class="row">
    @foreach ($photos as $photo)
    <div class="photo">
        <div class="thumbnail">
            <img src="http://placehold.it/200x150">
        </div>
    </div>
    @endforeach
</div>
@stop