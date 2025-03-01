<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Shared\Http\Responses\ApiResponse;
use Modules\User\Entities\User;
use Modules\User\Transformers\UserResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserApiController extends Controller
{

    public function index(): JsonResponse
    {
        $filters = request()->query();
        $count = (int) request()->query('count');
        $users = User::activeUseres()->filters($filters)->paginate((($count == 0 && $count >= 100) && $count > 100) ? 7 : $count);
        return ApiResponse::success(UserResource::collection($users));
    }

    public function show(User $user): JsonResponse
    {
        return ApiResponse::success((new UserResource($user)));
    }

    public function profile()
    {
        return  ApiResponse::success(User::find(auth()->user()->id));
    }

    public function destroy()
    {
        $user = auth()->user();
        if($user){
            $user->tokens()->delete();
            return ApiResponse::success($user->delete(),'Remove Your Account Has Done Successfully');
        }
        return ApiResponse::error('There Is Something Wrong, PleaseTry Again!');
    }


}
