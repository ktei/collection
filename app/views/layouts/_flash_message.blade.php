@if (Session::has('error'))
<div class="alert alert-danger">
    {{ Session::get('error') }}
</div>
@endif

@if (Session::has('notice'))
<div class="alert alert-info">
    {{ Session::get('notice') }}
</div>
@endif

@if (Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
</div>
@endif