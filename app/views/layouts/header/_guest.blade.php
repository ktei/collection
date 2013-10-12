<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{URL::action('PagesController@home')}}">Collection</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{URL::action('SessionsController@create')}}">Log in</a>
                </li>
                <li>
                    <a href="{{URL::action('UsersController@create')}}">Sign up</a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>