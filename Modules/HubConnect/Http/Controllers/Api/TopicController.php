<?php

namespace Modules\HubConnect\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\HubConnect\Entities\Topic;
use Modules\HubConnect\Transformers\TopicResource;
use Modules\Shared\Helpers\DeleteAjaxRespose;
use Modules\Shared\Http\Responses\ApiResponse;

class TopicController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:seller_api,user_api')->except('index');
    }
    public function index()
    {
        $filters = request()->query();
        $count = (int) request()->query('count');

        $topics = Topic::filters($filters)->with([
            'userable' => function ($query) {
                $query->select('id', 'name', 'email'); // عرض فقط الحقول المطلوبة
            }
        ])->paginate(($count == 0 && $count >= 100) ? 7 : $count);
        return ApiResponse::success(TopicResource::collection($topics));
    }

    public function me()
    {

        $filters = request()->query();
        $count = (int) request()->query('count');
        $topics = request()->user()->topics()?->filters($filters)->paginate(($count == 0 && $count >= 100) ? 7 : $count);
        return ApiResponse::success(TopicResource::collection($topics));
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);
        $request->user()->topics()->create($data);
        return ApiResponse::success(message: 'Topic Created Successfully');
    }




    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);
        $topic = $request->user()->topics()->findOrFail($id);
        $topic->update($data);
        return ApiResponse::success(message: 'Topic Updated Successfully');
    }

    public function destroy($id)
    {
        $user = auth()->user();
        return ApiResponse::success($user->topics()->findOrFail($id)->delete());
    }
}
