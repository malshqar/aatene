<?php

namespace Modules\Ads\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ads\Entities\Ad;
use Modules\Photo\Traits\FilesValidationRules;
use Modules\Shared\Helpers\Slug;
use Modules\Shared\Http\Responses\ApiResponse;

class AdsController extends Controller
{

    use FilesValidationRules;
   
    public function index()
    {
        return ApiResponse::success(Ad::paginate());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'url'=>['required','string','url'],
            'name'=>['required','string'],
            'start_at'=>['required','date'],
            'end_at'=>['required','date'],
            'image'=>$this->ImageRules(),
            'priority'=>['required','numeric','min:1','max:10']
        ]);

        $ads = Ad::create($data);
        if($request->hasFile('image')){
                $file = $request->file('image');
                $path = $ads->uploadOnDisk($file,'ads');
                $ads->storeImage($path, Slug::ar(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)), 'photo');
        }
        return back()->with(['notification'=>'تم اضافة الإعلان بنجاح']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('ads::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('ads::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
