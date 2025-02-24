<?php

namespace Modules\Shared\Http\Responses;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse
{

    /**
     * إنشاء استجابة نجاح.
     *
     * @param  mixed  $data
     * @param  string  $message
     * @param  int  $status
     * @return JsonResponse
     */
    public static function success($data = null, $message = 'Operation successful', $status = Response::HTTP_OK)
    {
        $count = is_array($data) || $data instanceof \Countable ? count($data) : null;

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'count' => $count,
            'data' => $data,
        ], $status);
    }

    /**
     * إنشاء استجابة خطأ.
     *
     * @param  string  $message
     * @param  int  $status
     * @param  mixed  $errors
     * @return JsonResponse
     */
    public static function error($message = 'Operation failed', $status = Response::HTTP_BAD_REQUEST, $errors = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}
