<?php

namespace Modules\Followers\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Followers\Entities\Follower;
use Modules\Shared\Http\Responses\ApiResponse;
use Modules\Store\Entities\Store;

class FollowersController extends Controller
{
    public function follow(Store $store)
    {
        $user = auth()->guard('user_api')->user();

        // Check if the user is not already following the store
        if (!$user->followers()->where('store_id', $store->id)->exists()) {
            $follower = new Follower([
                'user_id' => $user->id,
                'store_id' => $store->id
            ]);
            $follower->save();
            return ApiResponse::success(message: 'You are now following: ' . $store->name);
        }
        return ApiResponse::success(message: 'You are already following: ' . $store->name);

    }

    public function unfollow(Store $store)
    {
        $user = auth()->guard('user_api')->user();

        // Find the follower entry and delete it if it exists
        $follower = $user->followers()->where('store_id', $store->id)->first();

        if ($follower) {
            $follower->delete();
            return ApiResponse::success(message: 'You have unfollowed: ' . $store->name);
        }
        return ApiResponse::success(message: 'You were not following: ' . $store->name);
    }

    public function followersList()
    {
        if (auth()->guard() == 'seller_api') {
            $followers = auth()->guard('seller_api')->user()->store()->followers()->paginate();
        }
            $followers = auth()->guard('user_api')->user()->followers()->paginate();

        return ApiResponse::success($followers);
    }
}
