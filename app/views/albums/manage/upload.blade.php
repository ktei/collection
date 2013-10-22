@extends('layouts.master')

@section('content')
<h1>{{$album->name}} <small>upload</small></h1>
@include('albums.manage._toolbar', array('active_page' => 'upload'))
@stop