<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Collection</title>
    <meta name="description" content="Rui's family photo storage site" />
    <meta name="keywords" content="photo storage" />
    <meta name="robots" content="collection" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{HTML::style('css/app.css')}}
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <!-- TODO put favicon here -->
    <body>
        <header>
            @if (Auth::check())
                @include('layouts.header._user')
            @else
                @include('layouts.header._guest')
            @endif
        </header>
        <div class="container">
            @include('layouts._flash_message')
            @section('content')
            <div>
                <h1>Opps! There is something wrong here!</h1>
            </div>
            @show
        </div>
    </body>

    {{HTML::script('packages/requirejs/require.js', array('data-main' => 'js/main'))}}
</head>