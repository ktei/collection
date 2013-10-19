@extends('layouts.master')

@section('content')
{{Form::open(array('action' => 'SessionsController@create', 'role' => 'form', 'class' => 'login clearfix'))}}
<div class="caption">Log in</div>
<p>No account yet? <a href="{{URL::action('UsersController@create')}}">Sign up</a></p>
<div class="form-group">
    <label for="email">Email</label>
    {{Form::email('email', '', array('class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email', 'autofocus' => ''))}}
</div>
<div class="form-group">
    <label for="password">Password</label>
    {{Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password'))}}
</div>
<button type="submit" class="btn btn-default btn-primary pull-right">Log in</button>
{{Form::close()}}
@stop