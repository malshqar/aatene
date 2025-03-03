<?php

namespace Modules\Ads\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ads\Entities\Ad;
use Modules\Photo\Traits\FilesValidationRules;
use Modules\Shared\Helpers\DeleteAjaxRespose;
use Modules\Shared\Helpers\Slug;

class AdsController extends Controller
{

    use FilesValidationRules;

    public function index()
    {
        $filters = request()->query();
        $count = (int) request()->query('count');
        $ads = Ad::filters($filters)->latest()->paginate(($count == 0 && $count >= 100) ? 7 : $count);
        return view('ads::index', compact('ads'));
    }

    public function create()
    {
        return view('ads::create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'url' => ['required', 'string', 'url'],
            'name' => ['required', 'string'],
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date'],
            'image' => $this->ImageRules(),
            'priority' => ['required', 'numeric', 'min:1', 'max:10']
        ],attributes:[
            'url' => "الرابط",
            'name' => "الإسم",
            'start_at' => "تاريخ البداية",
            'end_at' =>"تاريخ النهاية",
            'image' => "صورة",
            'priority' => "الأولوية"
        ]);

        \DB::transaction(function () use ($data, $request) {
            $ads = Ad::create($data);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $ads->uploadOnDisk($file, 'ads');
                $ads->storeImage($path, Slug::ar(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)), 'main');
            }
        });
        return back()->with(['notification' => 'تم اضافة الإعلان بنجاح']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Ad $ad)
    {
        return view('ads::show', compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Ad $ad)
    {
        return view('ads::edit', compact('ad'));
    }


    public function update(Request $request, Ad $ad)
    {
        $data = $request->validate([
            'url' => ['required', 'string', 'url'],
            'name' => ['required', 'string'],
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date'],
            'image' => $this->ImageRules(true),
            'priority' => ['required', 'numeric', 'min:1', 'max:10']
        ]);

        \DB::transaction(function () use ($data, $request, $ad) {
            $ad->update($data);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $ad->uploadOnDisk($file, 'ads');
                $ad->updateImage($path, Slug::ar(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)), 'photo');
            }
        });
        return to_route('dashboard.ads.index')->with(['notification' => 'تم اضافة الإعلان بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Ad $ad)
    {
        \DB::transaction(function () use ($ad) {
            $isDeleted = $ad->delete();
            if ($isDeleted) {
                $ad->deleteImage();
            }
        });
        return DeleteAjaxRespose::deleteAjaxResponse(true);
    }
}
