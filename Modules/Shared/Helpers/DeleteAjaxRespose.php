<?php

namespace Modules\Shared\Helpers;

use Symfony\Component\HttpFoundation\Response;

class DeleteAjaxRespose
{
    public static function deleteAjaxResponse(bool $isDeleted)
    {
        
        if ($isDeleted) {
            return response()->json([
                'title' => 'نجحت',
                'text' => 'تم حذف العنصر بنجاح',
                'icon' => 'success'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'title' => 'فشلت',
                'text' => 'حدث خلل ما في عملية الحذف',
                'icon' => 'error'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}