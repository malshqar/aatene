<?php

namespace Modules\HubConnect\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\HubConnect\Entities\JobAds;
use Modules\HubConnect\Http\Requests\JobAdsRequest;
use Modules\Shared\Helpers\DeleteAjaxRespose;
use Modules\Shared\Helpers\Slug;

class JobAdsController extends Controller
{
  
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $filters = request()->query();
        $count = (int) request()->query('count');
        $job_ads = JobAds::filters($filters)->latest()->paginate(($count == 0 && $count >= 100) ? 7 : $count);
        return view('hubconnect::job-ads.index', compact('job_ads'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('hubconnect::job-ads.create');
    }

    public function store(JobAdsRequest $request)
    {
        \DB::transaction(function () use ($request) {
            $job_ads = JobAds::create($request->validated());
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $job_ads->uploadOnDisk($file, 'job_ads');
                $job_ads->storeImage($path, Slug::ar(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)));
            }
            $job_ads->attachTags(explode(',',$request->tags));
        });
        return back()->with(['notification' => __("تمت الإضافة بنجاح")]);
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(JobAds $job_ad)
    {
        return view('hubconnect::job-ads.edit', compact('job_ad'));
    }

    public function update(JobAdsRequest $request, $id)
    {
        $job_ads = JobAds::findOrFail($id);
        \DB::transaction(function () use ($request, $job_ads) {
            $job_ads->update($request->validated());
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $job_ads->uploadOnDisk($file, 'job_ads');
                $job_ads->storeImage($path, Slug::ar(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)));
            }
            $job_ads->syncTags(explode(',',$request->tags));
        });
        return to_route('dashboard.job-ads.index')->with(['notification'=>__("تمت عملية التعديل بنجاح")]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $job_ads  = JobAds::findOrFail($id);
        $isDeleted = $job_ads->delete();
        if ($isDeleted) {
            $job_ads->deleteImage();
        }
        return DeleteAjaxRespose::deleteAjaxResponse($isDeleted??false);
    }
}
