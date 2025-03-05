@props(['rows' => '1', 'placeholder' => '', 'required' => true, 'value' => '', 'lable' => false, 'name', 'id' => 'name', 'value' => ''])

@include('shared::layouts.forms.lables.lable',['lable'=>$lable])

<textarea rows="{{ $rows }}" id="{{ $id }}" name="{{ $name }}" {{ $attributes->class(['form-control', 'form-control-solid ', 'is-invalid' => $errors->has($name)]) }} placeholder="{{ $placeholder }}" {{ $attributes }}> {{ old($name, $value) }}</textarea>