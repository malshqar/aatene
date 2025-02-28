<?php

namespace Modules\Store\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Seller\Entities\Seller;
use Modules\Shared\Helpers\DeleteAjaxRespose;
use Modules\Store\Entities\Store;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $filters = request()->query();
        $count = (int) request()->query('count');
        $stores = Store::with('seller')->latest()->filters($filters)->paginate(($count == 0 && $count >= 100) ? 7 : $count);
        $open = Store::active()->accepted()->count();
        $close = Store::inactive()->accepted()->count();
        $sellers = Seller::latest()->take(10)->get();
        $sellers_count = Seller::count();
        $pending = Store::pending()->count();
        return view('store::index', compact('stores', 'open', 'close', 'sellers', 'sellers_count', 'pending'));
    }

    public function acceptStore(Store $store)
    {
        $store->update(['is_accepted' => true]);
        return back()->with(['notification' => 'تم قبول هذا المتجر بنجاح']);
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('store::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Store $store)
    {
        return view('store::show', compact('store'));
    }

    public function actions(Store $store)
    {
        return view('store::pages.actions', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('store::edit');
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


    public function destroy(Store $store)
    {
        $isDeleted = $store->delete();
        return to_route('dashboard.stores.index');
    }
}
