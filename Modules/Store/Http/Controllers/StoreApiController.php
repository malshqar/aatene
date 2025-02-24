<?php

namespace Modules\Store\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Seller\Entities\Seller;
use Modules\Shared\Helpers\Slug;
use Modules\Shared\Http\Responses\ApiResponse;
use Modules\Store\Entities\Store;
use Modules\Store\Http\Requests\StoreApiRequest;
use Modules\Store\Transformers\StoreResource;

class StoreApiController extends Controller
{

    public function store(StoreApiRequest $request, Seller $seller)
    {

        try {
            \DB::beginTransaction();
            if (is_null($seller->store)) {
                $store = $seller->store()->create($request->only(['name', 'description']));
                if ($request->hasFile('avatar')) {
                    $file = $request->file('avatar');
                    $path = $store->uploadOnDisk($file, str_replace(' ', '_', $store->name));
                    $store->storeImage($path, Slug::ar( pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)), 'avatar');
                }
                if ($request->hasFile('cover')) {
                    $file = $request->file('cover');
                    $path = $store->uploadOnDisk($file, $store->slug);
                    $store->storeImage($path, Slug::ar(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)), 'cover');
                }
                \DB::commit();
                return ApiResponse::success((new StoreResource($store)), 'Store Created Successfully');
            }
        } catch (\Throwable $th) {
            \DB::rollBack();
            return ApiResponse::error(errors: $th->getMessage());

        }
        return ApiResponse::success((new StoreResource($seller->store()->first())), 'Seller Already Has Store');
    }

}
