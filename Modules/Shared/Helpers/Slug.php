<?php

namespace Modules\Shared\Helpers;

class Slug
{
    public static function ar(string $string, string $separator = '-')
    {
        // إزالة الرموز الخاصة التي يمكن أن تسبب مشاكل
        $string = preg_replace('/[^\p{L}\p{N}\s]/u', '', $string);

        // استبدال المسافات والمحددات المتتالية بمحدد واحد
        $string = preg_replace('/\s+/', $separator, $string);
        $string = preg_replace('/' . preg_quote($separator) . '+/', $separator, $string);

        // إزالة المحددات الزائدة في البداية والنهاية
        $string = trim($string, $separator);

        return $string;
    }
}