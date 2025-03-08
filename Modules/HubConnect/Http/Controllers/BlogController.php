<?php

namespace Modules\HubConnect\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\HubConnect\Entities\Blog;
use Modules\Photo\Traits\FilesValidationRules;
use Modules\Shared\Helpers\DeleteAjaxRespose;
use Modules\Shared\Helpers\Slug;
use function PHPUnit\Framework\returnArgument;

class BlogController extends Controller
{
    use FilesValidationRules;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $filters = request()->query();
        $count = (int) request()->query('count');
        $blogs = Blog::filters($filters)->latest()->paginate(($count == 0 && $count >= 100) ? 7 : $count);

        return view('hubconnect::blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('hubconnect::blogs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => $this->ImageRules(),
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'writer' => ['required', 'string', 'min:2', 'max:150'],
            'content' => ['required', 'string'],
            'is_published' => ['sometimes', 'boolean'],
            'tags'=>['required'],
            'tags.*'=>['required','string','max:255'],
        ]);
        $data['admin_id'] = auth()->user()->id;
        \DB::transaction(function () use ($data, $request) {
            $blog = Blog::create($data);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $blog->uploadOnDisk($file, 'blogs');
                $blog->storeImage($path, Slug::ar(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)));
            }
            $blog->attachTags(explode(',',$request->tags));
        });
        return back()->with(['notification' => __("تمت الإضافة بنجاح")]);
    }

    public function publish(Blog $blog)
    {
        $blog->update(['is_published'=>!$blog->is_published]);
        return back()->with(['notification'=>'تم تحديث الحالة']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Blog $blog)
    {
        return view('hubconnect::blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Blog $blog)
    {
        return view('hubconnect::blogs.edit', compact('blog'));
    }


    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'image' => $this->ImageRules(true),
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'writer' => ['required', 'string', 'min:2', 'max:150'],
            'content' => ['required', 'string'],
            'is_published' => ['sometimes', 'boolean'],
            'tags'=>['required'],
            'tags.*'=>['required','string','max:255'],
        ]);
        $data['admin_id'] = auth()->user()->id;
        \DB::transaction(function () use ($data, $request, $blog) {
            $blog->update($data);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $blog->uploadOnDisk($file, 'blogs');
                $blog->updateImage($path, Slug::ar(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)));
            }
            $blog->syncTags(explode(',',$request->tags));

        });
        return to_route('dashboard.blogs.index')->with(['notification' => __("تمت الإضافة بنجاح")]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Blog $blog)
    {
        $isDeleted = $blog->delete();
        if ($isDeleted) {
            $blog->deleteImage();
        }
        return DeleteAjaxRespose::deleteAjaxResponse($isDeleted??false);
    }
}
