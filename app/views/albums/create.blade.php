@extends('layouts.master')

@section('content')
{{Form::open(array('action' => 'AlbumsController@create', 'role' => 'form', 'class' => 'create-album clearfix'))}}
<div class="caption">Create album</div>
<div class="form-group">
    <label for="name">Name</label>
    {{Form::text('name', '', array('class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name', 'autofocus' => ''))}}
    @include('shared._field_error', array('field' => 'name'))
</div>
<div class="form-group">
    <label for="description">Description</label>
    {{Form::textarea('description', '', array('class' => 'form-control', 'id' => 'description',
        'placeholder' => 'Description', 'rows' => 5))}}
    @include('shared._field_error', array('field' => 'description'))
</div>
<button type="submit" class="btn btn-default btn-primary pull-right">Create</button>
{{Form::close()}}
@stop