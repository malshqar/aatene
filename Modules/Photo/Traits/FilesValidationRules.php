<?php

namespace Modules\Photo\Traits;


trait FilesValidationRules
{
    /**
     * Get the validation rules used to validate image.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array<mixed>|string>
     */
    protected function ImageRules($nullable = false): array
    {
        return [$nullable ? 'nullable' : 'required', 'image'];
    }
}
