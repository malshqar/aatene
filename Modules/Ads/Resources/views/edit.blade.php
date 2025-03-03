@extends('dashboard::index', ['title' => 'اضافة إعلان'])
@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.ads.index', 'previews' => __("قائمة الإعلانات"), 'current' => __("$ad->name")])
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Tables Widget 11-->
                    <form class="form" action="{{ route('dashboard.ads.update', $ad->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 py-4">
                                <div class="card-body">
                                    <!--begin::Form-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-6 d-flex flex-center">
                                        <div class=" w-25">
                                            @include("shared::layouts.forms.inputs.image-with-lable", ['name' => __('image'),'value'=>$ad->assets['url']])
                                        </div>
                                        <div class="w-75">
                                            <div class="mb-5">
                                                @include('shared::layouts.forms.inputs.input-with-lable', ['name' => 'name', 'lable' => __('اسم المعلن'), 'value' => $ad->name, 'placeholder' => __('أدخل اسم المعلن')])
                                            </div>

                                            <div class="mb-5">
                                                @include('shared::layouts.forms.inputs.input-with-lable', ['name' => 'url', 'type' => 'url', 'value' => $ad->url, 'lable' => __('رابط الإعلان'), 'placeholder' => __('أدخل رابط الإعلان')])
                                            </div>
                                            <div class="mb-5">
                                                @include('shared::layouts.forms.lables.lable', ['lable' => __("الأولوية")])

                                                <select name="priority" class="form-select form-select-solid"
                                                    data-control="select2" data-placeholder="{{__("إختر أولوية الإعلان")}}">
                                                    <option></option>
                                                    <option value="1" @selected($ad->priority == 1)>أولوية 1</option>
                                                    <option value="2" @selected($ad->priority == 2)>أولوية 2</option>
                                                    <option value="3" @selected($ad->priority == 3)>أولوية 3</option>
                                                    <option value="4" @selected($ad->priority == 4)>أولوية 4</option>
                                                    <option value="5" @selected($ad->priority == 5)>أولوية 5</option>
                                                    <option value="6" @selected($ad->priority == 6)>أولوية 6</option>
                                                    <option value="7" @selected($ad->priority == 7)>أولوية 7</option>
                                                    <option value="8" @selected($ad->priority == 8)>أولوية 8</option>
                                                    <option value="9" @selected($ad->priority == 9)>أولوية 9</option>
                                                    <option value="10" @selected($ad->priority == 10)>أولوية 10</option>
                                                </select>
                                            </div>
                                            <!--begin::Row-->
                                            <div class="mb-5">
                                                <label for="" class="form-label required">{{__("بداية الإعلان")}}</label>
                                                <input class="form-control form-control-solid "
                                                    placeholder="{{__("بداية الإعلان")}}" id="kt_datepicker_1"
                                                    name="start_at" />
                                            </div>
                                            <!--end::Row-->
                                            <!--begin::Row-->
                                            <div class="mb-5">
                                                <label for="" class="form-label required">{{__("نهاية الإعلان")}}</label>
                                                <input class="form-control form-control-solid"
                                                    placeholder="{{__("نهاية الإعلان")}}" id="kt_datepicker_2" name="end_at"
                                                    />
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Actions-->
                                    <div class="text-end">
                                        <button class="btn btn-primary  btn-sm w-150px">حفظ</button>
                                        <a href="{{ route('dashboard.ads.index') }}"
                                            class="btn btn-danger  btn-sm  w-150px">عودة</a>
                                    </div>
                                    <!--end::Actions-->
                                    <!--end::Form-->

                                </div>

                            </div>
                            <!--end::Header-->
                        </div>
                        <!--end::Tables Widget 11-->
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
@push('scripts')
    <script>

        $("#kt_datepicker_1").flatpickr({
            defaultDate:`{{$ad->start_at->format("d-m-Y")}}`,
            dateFormat: "d-m-Y",
          

        });
        $("#kt_datepicker_2").flatpickr({
            defaultDate:`{{$ad->end_at->format("d-m-Y")}}`,
            dateFormat: "d-m-Y",

        });

    </script>
@endpush