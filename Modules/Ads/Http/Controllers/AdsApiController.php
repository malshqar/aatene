<?php

namespace Modules\Ads\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ads\Entities\Ad;
use Modules\Photo\Traits\FilesValidationRules;
use Modules\Shared\Helpers\Slug;
use Modules\Shared\Http\Responses\ApiResponse;

class AdsApiController extends Controller
{

    use FilesValidationRules;
   
    public function index()
    {
        return ApiResponse::success(Ad::paginate());
    }

    
}
