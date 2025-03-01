<?php

namespace Modules\Seller\Http\Controllers;


use Illuminate\Routing\Controller;
use Modules\Seller\Entities\Seller;
use Modules\Seller\Transformers\SellerResource;
use Modules\Shared\Http\Responses\ApiResponse;
use function PHPUnit\Framework\returnArgument;


class SellerApiController extends Controller
{
    public function index()
    {
        $filters = request()->query();
        $count = (int) request()->query('count');
        $users = Seller::activeSellers()->filters($filters)->paginate((($count == 0 && $count >= 100) && $count > 100) ? 7 : $count);
        return ApiResponse::success(SellerResource::collection($users));
    }

    public function profile()
    {
        $id = auth()->guard('seller_api')->user()->id;
        return Seller::findOrFail($id)->load('store');
    }

    public function destroy()
    {
        $user = auth()->user();
        if ($user) {
            $user->tokens()->delete();
            return ApiResponse::success($user->delete(), 'Remove Your Account Has Done Successfully');
        }
        return ApiResponse::error('There Is Something Wrong, PleaseTry Again!');
    }
}
