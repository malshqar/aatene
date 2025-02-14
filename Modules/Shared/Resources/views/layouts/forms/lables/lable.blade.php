@props(['lable' => false,  'required' => true , 'id' => ''])

@if ($lable)
    <label for="{{ $id }}" @class(['form-lable', 'required' => $required])>{{ $lable }}</label>
@endif
