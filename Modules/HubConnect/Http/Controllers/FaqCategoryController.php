<?php

namespace Modules\HubConnect\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Shared\Helpers\DeleteAjaxRespose;

class FaqCategoryController extends Controller
{
    // عرض قائمة الفئات
    public function index()
    {
        $categories = DB::table('faq_categories')->paginate();
        return view('hubconnect::faqs.categories.index', compact('categories'));
    }

    // عرض صفحة إضافة فئة جديدة
    public function create()
    {
        return view('hubconnect::faqs.categories.create');
    }

    // تخزين فئة جديدة
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:faq_categories,name',
        ]);

        DB::table('faq_categories')->insert([
            'name' => $data['name'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return to_route('dashboard.faqs_categories.index')->with('success', 'تم إضافة الفئة بنجاح.');
    }

    // عرض صفحة تعديل فئة
    public function edit($id)
    {
        $category = DB::table('faq_categories')->where('id', $id)->first();
        return view('hubconnect::faqs.categories.edit', compact('category'));
    }

    // تحديث فئة موجودة
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:faq_categories,name,' . $id,
        ]);

        DB::table('faq_categories')->where('id', $id)->update([
            'name' => $data['name'],
            'updated_at' => now(),
        ]);

        return to_route('dashboard.faqs_categories.index')->with('success', 'تم تحديث الفئة بنجاح.');
    }

    // حذف فئة
    public function destroy($id)
    {
        DB::table('faq_categories')->where('id', $id)->delete();

        return DeleteAjaxRespose::deleteAjaxResponse(true);
    }
}
