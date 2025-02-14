@props(['type' => 'text','value' => '', 'placeholder' => '','autocomplete'=>'on', 'lable' => false, 'name' ,'required'=>true,'id' => 'name','value'=>''])

@include('shared::layouts.forms.lables.lable',['lable'=>$lable])

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}"
        {{ $attributes->class(['form-control', 'form-control-solid ', 'is-invalid' => $errors->has($name)]) }}
        placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}" autocomplete="{{ $autocomplete }}" {{ $attributes }} />
