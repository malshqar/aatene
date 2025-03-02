<?php

namespace Modules\Store\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Photo\Traits\FilesValidationRules;
use Modules\Shared\Helpers\DeleteAjaxRespose;
use Modules\Shared\Helpers\Slug;
use Modules\Shared\Http\Responses\ApiResponse;
use Modules\Store\Entities\Group;
use Modules\Store\Entities\Store;

class GroupController extends Controller
{
    use FilesValidationRules;
    public function index()
    {
        $groups = Group::latest('id')->paginate();
        return view('store::groups.index', compact('groups'));
    }
    public function create()
    {
        return view('store::groups.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255', 'unique:groups,name'],
            'image' => $this->ImageRules(),
            'tags.*' => ['sometimes', 'string']
        ]);
        \DB::transaction(function () use ($request, $data) {
            $group = Group::create($data);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $group->uploadOnDisk($file, 'groups');
                $group->storeImage($path, Slug::ar(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)));
            }
            if ($request->has('tags')) {
                $group->attachTags(explode(',',$request->tags));
            }
        });
        return back()->with(['notification' => 'تم إضافة المجموعة بنجاح']);
    }
    public function edit(Group $group)
    {
        return view('store::groups.edit', compact('group'));
    }

    public function update(Request $request, Group $group)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255', 'unique:groups,name,' . $group->id],
            'image' => $this->ImageRules(true),
            'tags.*' => ['sometimes', 'string']
        ]);
        \DB::transaction(function () use ($request, $data, $group) {
            $group->update($data);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $group->uploadOnDisk($file, 'groups');
                $group->updateImage($path, Slug::ar(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)));
            }
            if ($request->has('tags') ) {
                $group->syncTags(explode(',',$request->tags));
            }
        });
        return to_route('dashboard.groups.index')->with(['notification' => 'تم تعديل بيانات المجموعة بنجاح']);
    }


    public function destroy(Group $group)
    {

        \DB::transaction(function () use ($group) {
            $isDeleted = $group->delete();
            if ($isDeleted) {
                $group->deleteImage();
            }
        });
        return DeleteAjaxRespose::deleteAjaxResponse(true);
    }
}
