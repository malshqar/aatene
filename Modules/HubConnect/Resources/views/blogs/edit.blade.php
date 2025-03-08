@extends('dashboard::index', ['title' => __("تدوين")])
@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.index', 'previews' => __("الرئيسية"), 'current' => __("تعديل التدوينة ")])
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
                                <form class="form" action="{{ route('dashboard.blogs.update',$blog->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-6 d-flex flex-center">
                                        <div class=" w-25">
                                            @include("shared::layouts.forms.inputs.image-with-lable", ['name' => 'image','value'=>$blog->assets['url']])
                                        </div>
                                        <div class="w-75">
                                            @include('shared::layouts.forms.inputs.input-with-lable', ['name' => 'title','value'=>$blog->title, 'lable' => __("العنوان"), 'placeholder' => __("عنوان التدوينة")])
                                            <div class="mt-5">
                                                @include('shared::layouts.forms.inputs.input-with-lable', ['name' => 'writer','value'=>$blog->writer, 'lable' => __("الكاتب"), 'placeholder' => __("كاتب التدوينة")])
                                            </div>
                                            <div class="mt-5">
                                                <label class="form-label required">التاغات</label>
                                                <input @class(['form-control', 'form-control-lg', 'form-control-solid ', 'is-invalid' => $errors->has('tags')]) id="kt_tagify_1"
                                                value="{{ old('tags',implode(',',$blog->tags()->pluck('name','name')->toArray()))}}"
                                                name="tags" />
                                            </div>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <div class="py-5" data-bs-theme="light">
                                        <textarea name="content" id="kt_docs_ckeditor_classic">
                                                {{old('content',$blog->content)}}
                                            </textarea>
                                    </div>

                                    <!--begin::Actions-->
                                    <div class="text-end">
                                        <button class="btn btn-primary  btn-sm w-150px">حفظ</button>
                                        <a href="{{ route('dashboard.blogs.index') }}"
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


    </script>

@endpush