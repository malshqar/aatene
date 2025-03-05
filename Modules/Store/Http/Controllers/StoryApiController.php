<?php

namespace Modules\Store\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Event;
use Modules\Shared\Helpers\Slug;
use Modules\Shared\Http\Responses\ApiResponse;
use Modules\Store\Entities\Story;
use Modules\Store\Events\StoryCreated;
use Modules\Store\Http\Requests\StoryApiRequest;

class StoryApiController extends Controller
{

    public function index()
    {
        $stories = auth()->user()->store->stories;
        return ApiResponse::success($stories);
    }

    public function store(StoryApiRequest $request)
    {
        $data = $request->validated();
        $data['store_id']=$request->user()->store->id;
        try {
            \DB::beginTransaction();
            $story = Story::create($data);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $story->uploadOnDisk($file, $story->slug);
                $story->storeImage($path, Slug::ar(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)));
            }
            \DB::commit();
            StoryCreated::dispatch($story);
            return ApiResponse::success($story);
        } catch (\Throwable $th) {
            \DB::rollBack();
        return ApiResponse::error($th->getMessage());
        }
    }

    public function show(Story $story)
    {
        return ApiResponse::success($story);
    }

    public function update(StoryApiRequest $request, Story $story)
    {
        
        try {
            \DB::beginTransaction();
            $story->update($request->validated());
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $story->uploadOnDisk($file, $story->slug);
                $story->updateImage($path, Slug::ar(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)));
            }
            \DB::commit();
            return ApiResponse::success($story);
        } catch (\Throwable $th) {
            \DB::rollBack();
            return ApiResponse::error();
        }
    }

    public function destroy(Story $story)
    {
        $isDeleted = $story->delete();
        if ($isDeleted) {
            $story->deleteImage();
        }
        return ApiResponse::success();
    }
}
