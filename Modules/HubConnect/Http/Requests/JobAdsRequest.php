<?php

namespace Modules\HubConnect\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Photo\Traits\FilesValidationRules;

class JobAdsRequest extends FormRequest
{
    use FilesValidationRules;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image'=>$this->ImageRules((bool) ($this->method() == 'PUT')),
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'required|string|min:0',
            'company' => 'required|string|max:255',
            'type' => 'required|string|in:full-time,part-time,freelance',
            'place' => 'required|string|max:255|in:office,remotly',
            'deadline' => 'required|date|after:today',
            'tags'=>'required',
            'tags.*'=>'required|string'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    
}
