@php
// need data : type, name, value, placeholder (if exists), class_add (if exists), option (for form select), label (for input group text & floating)
// optional data : optional (if exists)
//
$data = json_decode(json_encode($data));
@endphp

<div class="input-group form-control form-control-lg py-0 ps-0 rounded-5-important overflow-hidden @error($data->name)
    is-invalid
@enderror">
    <div class="bg-secondary py-2 px-2 border-2 border-end @error($data->name)
        border-danger
    @enderror">
    <span class="text-capitalize text-white">{{ $data->label }}</span>
    </div>
    <input type="{{ $data->type }}" name="{{ $data->name }}" class="form-control py-4 rounded-0 border-0 px-2 shadow-none {{ !isset($data->class_add) ? '' : $data->class_add }}" value="{{ $data->value }}" placeholder="{{ (!isset($data->placeholder)) ? '' : $data->placeholder }}" {{ !isset($data->optional) ? '' : $data->optional }}>
</div>

@error($data->name)
<p class="p-0 m-0 text-danger text-input-failed">{{ $message }}</p>
@enderror

