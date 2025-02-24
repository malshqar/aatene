<?php

namespace Modules\Auth\Actions\Fortify;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Modules\Photo\Traits\FilesValidationRules;
use Modules\Seller\Entities\Seller;
use Modules\Shared\Traits\VaildationRules\PhoneNumber;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, PhoneNumber, FilesValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): Seller
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(Seller::class),
            ],
            'phone_number' => $this->PhoneRules('sellers', 'phone_number'),
            'password' => $this->passwordRules(),
        ], attributes: [
            'email' => 'البريد الإلكتروني',
            'name' => 'الاسم',
            'phone_number' => 'رقم الهاتف'
        ])->validate();
        return Seller::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone_number' => $input['phone_number'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
