@extends('dashboard::index', ['title' => __('تعديل سؤال')])
@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.faqs.index', 'previews' => __("الأسئلة الشائعة"), 'current' => __("تعديل الأسئلة الشائعة")])
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <form class="form d-flex flex-column flex-lg-row" action="{{ route('dashboard.faqs.update',$faq->id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')

                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="card card-flush py-4 ">
                                <!--begin::Header-->
                                <div class="card-header border-0 ">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1">
                                            {{__($faq->question)}}</span>
                                    </h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body py-3">
                                    <div class="mb-5">
                                        @include('shared::layouts.forms.inputs.input-with-lable', ['name' => 'question','value'=>$faq->question, 'lable' => __('السؤال'), 'placeholder' => __('أدخل السؤال')])
                                    </div>
                                    <div class="mb-5">
                                        @include('shared::layouts.forms.inputs.textarea-input-with-lable', ['name' => 'answer','value'=>$faq->answer, 'rows' => '3', 'lable' => __('الإجابة'), 'placeholder' => __('أدخل الإجابة')])
                                    </div>
                                    <div class="mb-5">
                                        <select name="category_id" class="form-select form-select-solid "
                                            data-control="select2" data-placeholder="{{__("إختر القسم")}}">
                                            <option></option>
                                            @foreach ($categories as $id => $name)
                                                <option value="{{$id}}" @selected($id == $faq->category_id)> {{__($name)}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--begin::Body-->
                                <!--begin::Footer-->
                                <div class="card-footer py-3">
                                    <button class="btn btn-primary  btn-sm w-150px">{{__("حفظ")}}</button>
                                    <a href="{{ route('dashboard.faqs.index') }}"
                                        class="btn btn-danger  btn-sm  w-150px">{{__("عودة")}}</a>
                                </div>
                                <!--begin::Footer-->
                            </div>
                        </div>
                        <!--end::Main column-->
                    </form>
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->

    </div>
    <!--end:::Main-->
@endsection