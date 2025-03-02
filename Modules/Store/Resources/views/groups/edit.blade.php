@extends('dashboard::index', ['title' => "تعديل بيانات $group->name"])
@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.groups.index', 'previews' => 'قائمة المجموعات', 'current' =>"تعديل بيانات $group->name"])
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
                                <form  class="form" action="{{ route('dashboard.groups.update',$group->id) }}"
                                    method="POST" enctype="multipart/form-data"> 
                                    @csrf
                                    @method('PUT')
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-6 d-flex flex-center">
                                        <div class=" w-25">
                                            @include("shared::layouts.forms.inputs.image-with-lable",['name'=>'image','value'=>$group->assets['url']])
                                            
                                        </div>
                                            <div class="w-75">
                                                @include('shared::layouts.forms.inputs.input-with-lable', ['name' => 'name','value'=>old('name',$group->name), 'lable' => 'اسم المجموعة', 'placeholder' => 'أدخل اسم المجموعة'])
                                                <div class="mt-5">
                                                    <label class="form-label required">التاغات</label>
                                                    <input 
                                                    @class(['form-control', 'form-control-lg','form-control-solid ', 'is-invalid' => $errors->has('tags')])
                                                        id="kt_tagify_1"
                                                        value="{{ old('tags',implode(',',$group->tags()->pluck('name','name')->toArray()))}}"
                                                        name="tags" />
                                                </div>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="text-end">
                                        <button class="btn btn-primary  btn-sm w-150px">حفظ</button>
                                        <a href="{{ route('dashboard.groups.index') }}"
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
    <script>
        var input1 = document.querySelector("#kt_tagify_1");

        new Tagify(input1);
    </script>
@endpush