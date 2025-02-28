<!--begin::Notifications-->
<div class="app-navbar-item ms-1 ms-md-4">
    <!--begin::Menu- wrapper-->
    <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px position-relative"
        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
        data-kt-menu-placement="bottom-start" id="kt_menu_item_wow">
        <i class="ki-duotone ki-notification-on fs-2">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
            <span class="path5"></span>
        </i>

        @if (auth()->user()->unreadNotifications()->count() > 0)
            <span class="bullet bullet-dot bg-success h-6px w-6px position-absolute top-0 start-0 animation-blink">
            </span>
        @endif
    </div>
    <!--begin::Menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px " data-kt-menu="true"
        id="kt_menu_notifications">
        <!--begin::Heading-->
        <div class="d-flex flex-column bgi-no-repeat rounded-top"
            style="background-image:url('{{asset('/assets/media/misc/menu-header-bg.jpg')}}')">
            <!--begin::Title-->
            <h3 class="text-white fw-semibold px-9 mt-10 mb-6">
                {{__('الإشعارات')}} <span class="fs-8 opacity-75 ps-3">24 {{__('إشعار')}} </span>
            </h3>
            <!--end::Title-->

            <!--begin::Tabs-->
            <ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-semibold px-9">
                <li class="nav-item">
                    <a class="nav-link text-white opacity-75 opacity-state-100 pb-4 active" data-bs-toggle="tab"
                        href="#kt_topbar_notifications_1">{{__('أحدث الإشعارات')}}</a>
                </li>
            </ul>
            <!--end::Tabs-->
        </div>
        <!--end::Heading-->

        <!--begin::Tab content-->
        <div class="tab-content ">
            <!--begin::Tab panel-->
            <div class="tab-pane fade show active" id="kt_topbar_notifications_1" role="tabpanel">
                <!--begin::Items-->
                <div class="scroll-y mh-325px my-5 px-8" id="notification-list">

                    @foreach (auth()->user()?->unreadNotifications as $notification)
                        <!--begin::Item-->
                        <div class="d-flex flex-stack py-4">
                            <!--begin::Section-->
                            <div class="d-flex align-items-center">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-35px me-4">
                                    <span class="symbol-label bg-light-primary">
                                        <i class="{{ $notification->data['icon'] }} fs-2 text-primary">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                            <span class="path7"></span>
                                        </i>
                                    </span>
                                </div>
                                <!--end::Symbol-->

                                <!--begin::Title-->
                                <div class="mb-0 me-2">
                                    <a href="{{$notification->data['url']}}?notification_id={{$notification->id}}"
                                        class="fs-6 text-gray-800 text-hover-primary fw-bold">{{$notification->data['name']}}</a>
                                    <div class="text-gray-500 fs-7">{{$notification->data['message']}}</div>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Section-->

                            <!--begin::Label-->
                            <span class="badge badge-light fs-8">{{$notification->created_at->diffForHumans()}}</span>
                            <!--end::Label-->
                        </div>
                        <!--end::Item-->

                    @endforeach
                </div>
                <!--end::Items-->

                <!--begin::View more-->
                <div class="py-3 text-center border-top">
                    <a href="{{route('dashboard.notifications.index')}}"
                        class="btn btn-color-gray-600 btn-active-color-primary">
                        {{__('عرض الجميع')}}
                        <i class="ki-duotone ki-arrow-left fs-5"><span class="path1"></span><span
                                class="path2"></span></i> </a>
                </div>
                <!--end::View more-->
            </div>
            <!--end::Tab panel-->


        </div>
        <!--end::Tab content-->
    </div>
    <!--end::Menu--> <!--end::Menu wrapper-->
</div>
<!--end::Notifications-->

@push('scripts')
    <script>
        let channelId = "{{auth()->user()->id}}";
    </script>
    @vite('resources/js/app.js')
@endpush