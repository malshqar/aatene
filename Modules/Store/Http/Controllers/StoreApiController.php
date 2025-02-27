<?php

namespace Modules\Store\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Shared\Helpers\Slug;
use Modules\Shared\Http\Responses\ApiResponse;
use Modules\Store\Events\StoreCreated;
use Modules\Store\Http\Requests\StoreApiRequest;
use Modules\Store\Transformers\StoreResource;

class StoreApiController extends Controller
{

    public function store(StoreApiRequest $request)
    {
        $seller = auth()->user();
        try {
            \DB::beginTransaction();
            if (is_null($seller->store)) {
                $store = $seller->store()->create($request->only(['name', 'description']));
                if ($request->hasFile('logo')) {
                    $file = $request->file('logo');
                    $path = $store->uploadOnDisk($file, $store->slug);
                    $store->storeImage($path, Slug::ar(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)), 'logo');
                }
                if ($request->hasFile('cover')) {
                    $file = $request->file('cover');
                    $path = $store->uploadOnDisk($file, $store->slug);
                    $store->storeImage($path, Slug::ar(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)), 'cover');
                }
                \DB::commit();
                StoreCreated::dispatch($store);
                return ApiResponse::success((new StoreResource($store)), 'Store Created Successfully');
            }
        } catch (\Throwable $th) {
            \DB::rollBack();
            return ApiResponse::error(errors: $th->getMessage());

        }
        return ApiResponse::success((new StoreResource($seller->store()->first())), 'Seller Already Has Store');
    }

}
