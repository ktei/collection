@extends('layouts.master')

@section('content')
<h1>{{$album->name}} <small>upload</small></h1>
@include('albums.manage._toolbar', array('active_page' => 'upload'))
<input id="fileupload" type="file" name="photo"
       data-url="{{URL::action('PhotosController@upload', array('id' => $album->id))}}" multiple>

<table class="table table-hover">
    <thead>
        <tr>
            <th width="200px">File</th>
            <th width="100px">Size</th>
            <th>Progress</th>
            <th width="150px">Action</th>
        </tr>
    </thead>
    <tbody data-bind="template: { name: 'entryTemplate', foreach: entries, as: 'entry' }">

    </tbody>
</table>

<script type="text/html" id="entryTemplate">
    <tr>
        <td data-bind="text: filename"></td>
        <td data-bind="text: size"></td>
        <td>
            <div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar"
                     aria-valuemin="0" aria-valuemax="100" class="bar-success"
                     data-bind="css: { 'bar-danger': status() == 'fail' }, style: { width: progressPercent },
                                    attr: { 'aria-valuenow': progress }">
                </div>
            </div>
        </td>
        <td>
            <a href="#" data-bind="visible: status() == 'working', click: $parent.cancel">Cancel</a>
            <span data-bind="visible: status() == 'success'">Success</span>
            <span data-bind="visible: status() == 'fail'">Failed</span>
        </td>
    </tr>
</script>
@stop

@section('scripts')
<script>
    require(['upload'], function(upload) {
        upload();
    });
</script>
@stop