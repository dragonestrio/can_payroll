@php
// need data : type, name, value, placeholder (if exists), class_add (if exists), option (for form select), label (for input group text & floating)
// optional data : optional (if exists)
//
$data = json_decode(json_encode($data));
@endphp

<div class="form-check">
    <input type="checkbox" id="form{{ ucwords($data->name) }}"
    name="{{ $data->name }}" class="form-check-input {{ !isset($data->class_add) ? '' : $data->class_add }} @error($data->name)
    is-invalid
    @enderror" value="{{ $data->value }}" placeholder="{{ (!isset($data->placeholder)) ? '' : $data->placeholder }}" {{ !isset($data->optional) ? '' : $data->optional }}>
    <label for="form{{ ucwords($data->name) }}" class="form-check-label">{{ ucwords($data->label) }}</label>
</div>

@error($data->name)
<p class="p-0 m-0 text-danger text-input-failed">{{ $message }}</p>
@enderror
