@extends('layouts.master')

@section('content')
{{Form::open(['action' => 'UsersController@create', 'role' => 'form', 'class' => 'signup clearfix'])}}
<div class="caption">Sign up</div>
<p>Already have an account? <a href="{{URL::action('SessionsController@create')}}">Log in</a></p>
<div class="form-group">
    <label for="email">Email</label>
    {{Form::email('email', '', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email', 'autofocus' => ''])}}
</div>
<div class="form-group">
    <label for="full-name">Full name</label>
    {{Form::text('full_name', '', ['class' => 'form-control', 'id' => 'full-name', 'placeholder' => 'Full name'])}}
</div>
<div class="form-group">
    <label for="password">Password</label>
    {{Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password'])}}
</div>
<button type="submit" class="btn btn-default btn-primary pull-right">Sign up</button>
{{Form::close()}}
@stop