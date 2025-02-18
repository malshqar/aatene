<?php

namespace Modules\Seller\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Seller\Entities\Seller;
use Modules\Seller\Events\SellerBlocked;
use Modules\Seller\Events\SellerCancelBlocked;
use Modules\Seller\Http\Requests\SellerRequest;

class SellerController extends Controller
{
    public function __construct()
    {
        // $this->middleware('can:sellers.index')->only('index');
        // $this->middleware('can:sellers.create')->only('create');
        // $this->middleware('can:sellers.edit')->only('edit');
        // $this->middleware('can:sellers.delete')->only('destroy');
        // $this->middleware('can:sellers.ban')->only('blocked','ban');
        // $this->middleware('can:sellers.ban-cancel')->only('cancelBan');
    }

    public function index()
    {

        $filters = request()->query();
        $count = (int) request()->query('count');
        $sellers = Seller::filters($filters)->latest()->paginate($count == 0 ? 7 : $count);
        return view('seller::index', compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('seller::create');
    }


    public function ban(Seller $seller)
    {
        return view('seller::ban', compact('seller'));
    }


    public function blocked(Request $request, Seller $seller)
    {
        $data = $request->validate([
            'ban_reason' => 'required|string|max:255',
            'ban_at' => 'required|date'

        ], attributes: [
            'ban_reason' => 'سبب الحظر',
            'ban_at' => 'مدة الحظر'
        ]);
        $seller->update($data);
        SellerBlocked::dispatch($seller);
        return to_route('dashboard.sellers.index')->with(['notification' => " تم حظر   $seller->name بنجاح"]);
    }

    public function cancelBan(Seller $seller)
    {
        $seller->update([
            'ban_reason' => null,
            'ban_at' => null
        ]);
        SellerCancelBlocked::dispatch($seller);
        return to_route('dashboard.sellers.index')->with(['notification' => " تم إلغاء حظر   $seller->name بنجاح"]);

    }



    public function store(SellerRequest $request): RedirectResponse
    {
        \DB::transaction(function () use ($request) {
            $seller = Seller::create($request->validated());
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $path = $seller->uploadOnDisk($file, str_replace(' ', '_', $seller->name));
                $seller->storeImage($path, \Str::slug($file->getClientOriginalName()));
            }

        });
        return back()->with(['notification' => 'تمت اضافة بائع جديد بنجاح']);
    }


    public function show(Seller $seller)
    {
        return view('seller::show', compact('seller'));
    }


    public function edit(Seller $seller)
    {
        return view('seller::edit', compact('seller'));
    }


    public function update(SellerRequest $request, seller $seller): RedirectResponse
    {
        $data = $request->validated('password');
        if (empty($data['password'])) {
            $data = $request->except('password');
        }
        \DB::transaction(function () use ($request, $seller, $data) {
            $seller->update($data);
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $path = $seller->uploadOnDisk($file, str_replace(' ', '_', $seller->name));
                $seller->updateImage($path, \Str::slug($file->getClientOriginalName()));
            }
        });
        return to_route('dashboard.sellers.index')->with(['notification' => " تم تعديل بيانات $seller->name بنجاح"]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Seller $seller)
    {
        $isDeleted = $seller->delete();
        if ($isDeleted) {
            $seller->deleteImage();
        }
        return \Modules\Shared\Helpers\DeleteAjaxRespose::deleteAjaxResponse($isDeleted);
    }
}
