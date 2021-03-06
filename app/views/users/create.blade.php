@extends('layouts.master')

@section('content')

{{Form::open(array('action' => 'UsersController@create', 'role' => 'form', 'class' => 'signup clearfix'))}}
<div class="caption">Sign up</div>
<p>Already have an account? <a href="{{URL::action('SessionsController@create')}}">Log in</a></p>
<div class="form-group">
    <label for="email">Email</label>
    {{Form::email('email', '', array('class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email', 'autofocus' => ''))}}
    @include('shared._field_error', array('field' => 'email'))
</div>
<div class="form-group">
    <label for="full-name">Full name</label>
    {{Form::text('full_name', '', array('class' => 'form-control', 'id' => 'full-name', 'placeholder' => 'Full name'))}}
    @include('shared._field_error', array('field' => 'full_name'))
</div>
<div class="form-group">
    <label for="password">Password</label>
    {{Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password'))}}
    @include('shared._field_error', array('field' => 'password'))
</div>
<button type="submit" class="btn btn-default btn-primary pull-right">Sign up</button>
{{Form::close()}}
@stop