@if (Session::has('error'))
<div class="row">
    <div class="col-8 col-push-2">
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    </div>
</div>
@endif

@if (Session::has('notice'))
<div class="row">
    <div class="col-8 col-push-2">
        <div class="alert alert-info">
            {{ Session::get('notice') }}
        </div>
    </div>
</div>
@endif

@if (Session::has('success'))
<div class="row">
    <div class="col-8 col-push-2">
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    </div>
</div>
@endif