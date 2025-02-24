<?php

namespace Modules\Store\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Modules\Photo\Traits\FilesValidationRules;
class StoreApiRequest extends FormRequest
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
                'email' => 'required|string|max:255|email|unique:sellers,email,' . $this->seller->id,
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
                'phone_number' => 'required|regex:/^\+1 \d{3} \d{3} \d{4}$/|min:6|max:20|unique:sellers,phone_number,' . $this->seller->id,
                'status' => 'required|string|in:active,inactive',
                'avatar' => $this->ImageRules(nullable: true),
                'gold_coins' => 'required|numeric|min:0'
            ];
        }
        return [
            'name' => 'required|string|min:2|max:100',
            'description' => 'required|string|max:255',
            'avatar' => $this->ImageRules(),
            'cover' => $this->ImageRules(),
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
            'description' => 'الوصف',
            'avatar' => 'صورة الرئيسية',
            'cover' => 'صورة الغلاف',
        ];
    }
}
