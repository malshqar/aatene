<?php

namespace Modules\HubConnect\Http\Controllers\Api;


use Illuminate\Routing\Controller;
use Modules\HubConnect\Entities\Blog;
use Modules\Shared\Http\Responses\ApiResponse;

class BlogController extends Controller
{

    public function index()
    {
        $filters = request()->query();
        $count = (int) request()->query('count');
        $blogs = Blog::filters($filters)->paginate(($count == 0 && $count >= 100) ? 7 : $count);
        return ApiResponse::success($blogs);
    }
}
