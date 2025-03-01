<?php

namespace Modules\Seller\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Modules\Photo\Traits\FilesValidationRules;
class SellerRequest extends FormRequest
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
                'email' => 'required|string|max:255|email|unique:admins,email|unique:users,email|unique:sellers,email,'.$this->seller->id,
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
                'phone_number' => 'required|regex:/^\+1 \d{3} \d{3} \d{4}$/|min:6|max:20|unique:sellers,phone_number,'.$this->seller->id,
                'status' => 'required|string|in:active,inactive',
                'avatar' => $this->ImageRules(nullable: true),
                'gold_coins'=>'required|numeric|min:0'
            ];
        }
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
            'phone_number' => 'required|regex:/^\+1 \d{3} \d{3} \d{4}$/|min:6|max:20|unique:sellers,phone_number',
            'status' => 'required|string|in:active,inactive',
            'avatar' => $this->ImageRules(),
            'gold_coins'=>'required|numeric|min:0'

        ];

    }

    /**
     * Determine if the seller is authorized to make this request.
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
            'gold_coins'=>'العملات الذهبية'
        ];
    }
}
