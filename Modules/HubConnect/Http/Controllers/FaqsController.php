<?php
namespace Modules\HubConnect\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\HubConnect\Entities\Faqs;
use Illuminate\Support\Facades\DB;
use Modules\Shared\Helpers\DeleteAjaxRespose;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $filters = request()->query();
        $count = (int) request()->query('count');
        $faqs = Faqs::filters($filters)->with('category')->latest()->paginate(($count == 0 && $count >= 100) ? 7 : $count);
        return view('hubconnect::faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = DB::table('faq_categories')->pluck('name', 'id'); // جلب أسماء الفئات
        return view('hubconnect::faqs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => ['required', 'string', 'min:10'],
            'answer' => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:faq_categories,id'], // التحقق من الفئة
        ]);

        Faqs::create($data);
        return back()->with(['notification' => 'تم الاضافة بنجاح']);
    }
    public function edit(Faqs $faq)
    {
        $categories = DB::table('faq_categories')->pluck('name', 'id'); // جلب الفئات المتاحة
        return view('hubconnect::faqs.edit', compact('faq', 'categories'));
    }
    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'question' => ['required', 'string', 'min:10'], // التحقق من السؤال
            'answer' => ['required', 'string'], // التحقق من الإجابة
            'category_id' => ['required', 'integer', 'exists:faq_categories,id'], // التحقق من الفئة
        ]);
        Faqs::where('id', $id)->update($data); // تحديث بيانات السؤال الشائع
        return redirect()->route('dashboard.faqs.index')->with(['notification' => 'تم تحديث السؤال بنجاح.']);
    }

    public function destroy($id)
    {
        $isDeleted = Faqs::destroy($id);
        return DeleteAjaxRespose::deleteAjaxResponse($isDeleted ?? false);
    }

}
