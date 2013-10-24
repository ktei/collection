@extends('layouts.master')

@section('content')
<h1>{{$album->name}} <small>upload</small></h1>
@include('albums.manage._toolbar', array('active_page' => 'upload'))
{{Form::open(array('action' => array('PhotosController@upload', $album->id), 'role' => 'form', 'files' => true, 'class' => 'clearfix'))}}
<div class="form-group">
    <label for="photo">Upload photo</label>
    {{Form::file('photo', array('class' => 'form-control', 'id' => 'photo'))}}
</div>
<button type="submit" class="btn btn-default btn-primary pull-right">Submit</button>
{{Form::close()}}
@stop