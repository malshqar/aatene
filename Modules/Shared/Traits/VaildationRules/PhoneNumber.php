<?php

namespace Modules\Shared\Traits\VaildationRules;

use Illuminate\Validation\Rule;

trait PhoneNumber
{
    public function PhoneRules($table = null, $column = null, $id = null)
    {
        $rules = ['required', 'regex:/^\+1 \d{3} \d{3} \d{4}$/','min:6','max:20'];
        if ($table) {
            array_push($rules, Rule::unique($table, $column)->ignore($id));
        }
        return $rules;
    }
}