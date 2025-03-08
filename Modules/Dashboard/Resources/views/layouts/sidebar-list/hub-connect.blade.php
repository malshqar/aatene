@can('user.index')
    <!--begin:Menu item-->
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
        <!--begin:Menu link-->
        <span class="menu-link">
            <span class="menu-icon">
                <i class="ki-duotone ki-happy-emoji   fs-2">
                    <i class="path1"></i>
                    <i class="path2"></i>
                    <i class="path3"></i>
                    <i class="path4"></i>
                    <i class="path5"></i>
                    <i class="path6"></i>
                    <i class="path7"></i>
                    <i class="path8"></i>
                </i>
            </span>
            <span class="menu-title fs-4 fw-bold"> {{__("مركز الإتصال")}} </span>
            <span class="menu-arrow"></span>
        </span>
        <!--end:Menu link-->
        <!--begin:Menu sub-->
        <div @class([
            'menu-sub',
            ' menu-sub-accordion',
            ' here show menu-accordion' => Route::is('dashboard.faqs.index') || Route::is('dashboard.blogs.index') || Route::is('dashboard.faqs_categories.index'),
        ])>
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a @class(['menu-link', 'active fw-bold' => Route::is('dashboard.faqs.index')])
                    href="{{ route('dashboard.faqs.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title fs-5"> {{__("الأسئلة الشائعة")}} </span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
            @can('user.create')
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a @class(['menu-link', 'active' => Route::is('dashboard.faqs_categories.index')])
                        href="{{ route('dashboard.faqs_categories.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title fs-5"> {{__("أقسام الأسئلة الشائعة")}} </span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
            @endcan
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a @class(['menu-link', 'active' => Route::is('dashboard.blogs.index')])
                    href="{{ route('dashboard.blogs.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title fs-5"> {{__("المدونة")}} </span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
                  <!--begin:Menu item-->
                  <div class="menu-item">
                    <!--begin:Menu link-->
                    <a @class(['menu-link', 'active' => Route::is('dashboard.job-ads.index')])
                        href="{{ route('dashboard.job-ads.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title fs-5"> {{__("إعلانات الوظائف")}} </span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
        </div>
        <!--end:Menu item-->
    </div>

    <!--end:Menu item-->
@endcan