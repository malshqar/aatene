<?php

namespace Modules\AccessControl\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends FormRequest
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
                'name' => 'required|string|max:100|unique:roles,name,'.$this->role->id,
                'permission_ids' => 'required|array',
                'permission_ids.*' => 'required|exists:permissions,id',
            ];
        }
        return  [
            'name' => 'required|string|max:100|unique:roles,name',
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'required|exists:permissions,id',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'name' => 'اسم الدور',
            'permission_ids' => 'صلاحية'
        ];
    }
}
