<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Modules\Photo\Traits\FilesValidationRules;

class UserApiRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|max:255|email|unique:users,email|unique:sellers,email|unique:admins,email',
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                ,
                'confirmed'
            ],
            'phone_number' => 'required|regex:/^\+1 \d{3} \d{3} \d{4}$/|min:6|max:20|unique:users,phone_number',
            'avatar' => $this->ImageRules()
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
