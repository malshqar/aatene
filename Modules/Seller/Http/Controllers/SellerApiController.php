<?php

namespace Modules\Seller\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Seller\Entities\Seller;
use Modules\Seller\Events\SellerBlocked;
use Modules\Seller\Events\SellerCancelBlocked;
use Modules\Seller\Http\Requests\SellerApiRequest;
use Modules\Seller\Http\Requests\SellerRequest;

class SellerApiController extends Controller
{

    public function store(SellerApiRequest $request)
    {
        try {
            \DB::beginTransaction();
            $seller = Seller::create($request->validated());
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $path = $seller->uploadOnDisk($file, str_replace(' ', '_', $seller->name));
                $seller->storeImage($path, \Str::slug($file->getClientOriginalName()));
            }
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollBack();
        }

        return $seller;
    }

}
