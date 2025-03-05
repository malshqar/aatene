<?php

namespace Modules\Store\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Photo\Traits\FilesValidationRules;

class StoryApiRequest extends FormRequest
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
            'image' => $this->ImageRules($this->method() == 'POST' ? false : true),
            'title' => ['required', 'string', 'max:255'],
            'caption' => ['sometimes', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'status' => ['required', 'string', 'in:draft,published'],
            'reactions' => ['sometimes', 'json'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->method() == 'POST') {
            return true;
        }
        $storyId = $this->story->id;
        return $this->user()->store->stories()->where('id', $storyId)->exists();

    }
}
