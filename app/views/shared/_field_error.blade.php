@if (isset($errors) && $errors->has($field))
<span class="help-block error">
    <div>{{$errors->first($field)}}</div>
</span>
@endif