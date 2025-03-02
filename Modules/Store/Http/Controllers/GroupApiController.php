<?php

namespace Modules\Store\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Shared\Http\Responses\ApiResponse;
use Modules\Store\Entities\Group;

class GroupApiController extends Controller
{
  
    public function index()
    {
        return ApiResponse::success(Group::paginate());
    }

    public function show(Group $group)
    {
        return $group->stores()->paginate();
    }
   
}
