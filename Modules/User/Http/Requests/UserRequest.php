<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Modules\Photo\Traits\FilesValidationRules;

class UserRequest extends FormRequest
{
    use FilesValidationRules;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        if (request()->method() == 'PUT') {
            return [
                'name' => 'required|string|min:2|max:100',
                'email' => 'required|string|max:255|email|unique:users,email,' . $this->user->id,
                'password' => [
                    'nullable',
                    'string',
                    Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()

                    ,
                    'confirmed'
                ],
                'phone_number' => 'required|regex:/^\+1 \d{3} \d{3} \d{4}$/|min:6|max:20|unique:users,phone_number,' . $this->user->id,
                'status' => 'required|string|in:active,inactive',
                'avatar' => $this->ImageRules(true)
            ];
        }
        return [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|max:255|email|unique:users,email',
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
            'status' => 'required|string|in:active,inactive',
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

    public function attributes()
    {
        return [
            'name' => 'الإسم',
            'email' => 'بريد إلكتروني',
            'password' => 'كلمة السر',
            'phone_number' => 'رقم الهاتف',
            'avatar' => 'صورة المستخدم'
        ];
    }
}
