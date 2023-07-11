@php
// need data : type, name, value, placeholder (if exists), class_add (if exists), option (for form select), label (for input group text & floating)
// optional data : optional (if exists)
//
$data = json_decode(json_encode($data));
@endphp

<input type="file" name="{{ $data->name }}" class="form-control form-control-lg fs-6 rounded-5-important shadow-none {{ !isset($data->class_add) ? '' : $data->class_add }} @error($data->name)
    is-invalid
@enderror" value="{{ $data->value }}" placeholder="{{ (!isset($data->placeholder)) ? '' : $data->placeholder }}" {{ !isset($data->optional) ? '' : $data->optional }}>

@error($data->name)
<p class="p-0 m-0 text-danger text-input-failed">{{ $message }}</p>
@enderror
