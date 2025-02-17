<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AdminRequest extends FormRequest
{
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
                'email' => 'required|string|max:255|email|unique:admins,email,' .$this->admin->id,
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
                'phone_number' => 'required|regex:/^\+1 \d{3} \d{3} \d{4}$/|min:6|max:20|unique:admins,phone_number,' .$this->admin->id,
                'status' => 'required|string|in:active,inactive',
                'avatar' => 'nullable|image',
                'role_ids' => ['required'],
                'role_ids.*' => ['required', 'exists:roles,id'],

            ];
        }
        return [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|max:255|email|unique:admins,email',
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
            'phone_number' => 'required|regex:/^\+1 \d{3} \d{3} \d{4}$/|min:6|max:20|unique:admins,phone_number',
            'status' => 'required|string|in:active,inactive',
            'avatar' => 'required|image',
            'role_ids' => ['required'],
            'role_ids.*' => ['required', 'exists:roles,id'],
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
            'avatar' => 'صورة المستخدم',
            'role_ids' => 'الأدوار'
        ];
    }
}
