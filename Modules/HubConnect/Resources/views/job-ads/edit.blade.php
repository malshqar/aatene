@extends('dashboard::index', ['title' => __("تدوين")])
@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.index', 'previews' => __("الرئيسية"), 'current' => __("تعديل الاعلان  عن وظيفة")])
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Tables Widget 11-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 py-4">
                            <div class="card-body">
                                <!--begin::Form-->
                                <form class="form" action="{{ route('dashboard.job-ads.update', $job_ad->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="fv-row mb-6 d-flex flex-center">
                                        <div class=" w-25">
                                            @include("shared::layouts.forms.inputs.image-with-lable", ['name' => 'image', 'value' => $job_ad->assets['url']])
                                        </div>
                                        <div class="w-75">
                                            @include('shared::layouts.forms.inputs.input-with-lable', ['name' => 'title', 'value' => $job_ad->title, 'lable' => __("العنوان"), 'placeholder' => __("عنوان الزظيفة")])
                                            <div class="mt-5">
                                                @include('shared::layouts.forms.inputs.input-with-lable', ['name' => 'location', 'value' => $job_ad->location, 'lable' => __("الموقع"), 'placeholder' => __("موقع الشركة")])
                                            </div>
                                            <div class="mt-5">
                                                @include('shared::layouts.forms.inputs.input-with-lable', ['name' => 'salary', 'value' => $job_ad->salary, 'lable' => __("المبلغ/الراتب"), 'placeholder' => __("المبلغ/الراتب للموظف")])
                                            </div>
                                            <div class="mt-5">
                                                @include('shared::layouts.forms.inputs.input-with-lable', ['name' => 'company', 'value' => $job_ad->company, 'lable' => __("اسم الشركة"), 'placeholder' => __("اسم الشركة")])
                                            </div>
                                            <div class="mt-5">
                                                <label class="form-label required">التاغات</label>
                                                <input @class(['form-control', 'form-control-lg', 'form-control-solid ', 'is-invalid' => $errors->has('tags')]) id="kt_tagify_1"
                                                    value="{{ old('tags', implode(',', $job_ad->tags()->pluck('name', 'name')->toArray()))}}"
                                                    name="tags" />
                                            </div>
                                            <div class="mt-5">
                                                @include('shared::layouts.forms.lables.lable', ['lable' => 'اوقات العمل'])
                                                <select name="type" class="form-select form-select-solid "
                                                    data-control="select2"
                                                    data-placeholder="{{__("إختر شكل دوام الوظيفة  ")}}">
                                                    <option></option>
                                                    <option value="full-time" @selected($job_ad->type == 'full-time')>
                                                        {{__('داوم كامل')}}
                                                    </option>
                                                    <option value="part-time" @selected($job_ad->type == 'part-time')>
                                                        {{__('داوم جزئي')}}
                                                    </option>
                                                    <option value="freelance" @selected($job_ad->type == 'freelance')>
                                                        {{__('عمل حر')}}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-5">
                                                @include('shared::layouts.forms.lables.lable', ['lable' => 'مكان العمل'])
                                                <select name="place" class="form-select form-select-solid "
                                                    data-control="select2" data-placeholder="{{__("إختر مكان الوظيفة ")}}">
                                                    <option></option>
                                                    <option value="office" @selected($job_ad->place == 'office')>
                                                        {{__("عمل في المكان")}}
                                                    </option>
                                                    <option value="remotly" @selected($job_ad->place == 'remotly')>
                                                        {{__('عمل عن بعد')}}
                                                    </option>
                                                </select>
                                            </div>
                                            <!--begin::Row-->
                                            <div class="mb-5">
                                                @include('shared::layouts.forms.lables.lable', ['lable' => __("صالح حتى الإعلان")])
                                                <input class="form-control form-control-solid "
                                                    placeholder="{{__("صالح حتى الإعلان")}}" id="kt_datepicker_1"
                                                    name="deadline" />
                                            </div>
                                            <div class="py-5" data-bs-theme="light">
                                                @include('shared::layouts.forms.lables.lable', ['lable' => __("الوصف")])
                                                <textarea name="description"
                                                    id="kt_docs_ckeditor_classic">{{old('description', $job_ad->description)}}</textarea>
                                            </div>

                                        </div>
                                        <!--end::Input-->
                                    </div>


                                    <!--begin::Actions-->
                                    <div class="text-end">
                                        <button class="btn btn-primary  btn-sm w-150px">حفظ</button>
                                        <a href="{{ route('dashboard.job-ads.index') }}"
                                            class="btn btn-danger  btn-sm  w-150px">عودة</a>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->

                            </div>

                        </div>
                        <!--end::Header-->
                    </div>
                    <!--end::Tables Widget 11-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->

    </div>
    <!--end:::Main-->

@endsection
@push('scripts')
    <!--CKEditor Build Bundles:: Only include the relevant bundles accordingly-->
    <script src="{{asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/44.3.0/translations/ar.umd.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5-premium-features/44.3.0/translations/ar.umd.js"></script>

    <script>
        var input1 = document.querySelector("#kt_tagify_1");
        new Tagify(input1);
        ClassicEditor
            .create(document.querySelector('#kt_docs_ckeditor_classic'), {
                toolbar: {
                    items: [
                        'paragraph', 'heading', '|',
                        'undo', 'redo', '|',
                        'bold', 'italic', 'underline', 'strikethrough', '|',
                        'link', '|',
                        'numberedList', 'bulletedList', '|',
                        'blockQuote', 'insertTable', '|',
                        'alignment:left', 'alignment:center', 'alignment:right', 'alignment:justify', '|',
                        'removeFormat', 'mediaEmbed'
                    ]
                },
                language: {
                    ui: 'ar',
                    content: 'ar'
                }
                , fontFamily: {
                    options: [
                        'Almarai',
                        'Almarai, Arial, sans-serif',
                    ]
                }
                // , ckfinder: {
                //     uploadUrl: '{{route('image.upload') . '?_token=' . csrf_token()}}',
                // }
            })
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    console.log("Data changed:", editor.getData());
                }); console.log(editor);

            })
            .catch(error => {
                console.error(error);
            });
            $("#kt_datepicker_1").flatpickr({
            defaultDate:`{{$job_ad->deadline->format("d-m-Y")}}`,
            dateFormat: "d-m-Y",
          

        });

    </script>

@endpush