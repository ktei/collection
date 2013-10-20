<h2>{{$album->name}}</h2>
<ul class="nav nav-pills  nav-justified">
    <li class="active">
        <a href="#"><i class="icon-picture"></i> Browse</a>
    </li>
    <li>
        <a href="#"><i class="icon-cloud-upload"></i> Upload</a>
    </li>
    <li>
        <a href="#"><i class="icon-gear"></i> Settings</a>
    </li>
</ul>
<div class="row">
    @foreach ($photos as $photo)
    <div class="photo">
        <div class="thumbnail">
            <img src="http://placehold.it/200x150">
        </div>
    </div>
    @endforeach
</div>