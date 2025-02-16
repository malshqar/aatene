<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Transformers\UserResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserApiController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        $filters = request()->query();
        $count = (int) request()->query('count');
        $users = User::activeUseres()->filters($filters)->paginate($count == 0 ? 7 : $count);
        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        return (new UserResource($user));
    }


}
