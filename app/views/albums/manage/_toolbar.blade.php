<ul class="nav nav-pills  nav-justified">
    <li class="{{$active_page == 'browse' ? 'active' : ''}}">
        <a href="{{URL::action('AlbumsController@browse', array('id' => $album->id))}}"><i class="icon-picture"></i> Browse</a>
    </li>
    <li class="{{$active_page == 'upload' ? 'active' : ''}}">
        <a href="{{URL::action('PhotosController@create', array('id' => $album->id))}}"><i class="icon-cloud-upload"></i> Upload</a>
    </li>
    <li class="{{$active_page == 'settings' ? 'active' : ''}}">
        <a href="#"><i class="icon-gear"></i> Settings</a>
    </li>
</ul>
<hr>