@can('store.index')
    <!--begin:Menu item-->
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
        <!--begin:Menu link-->
        <span class="menu-link">
            <span class="menu-icon">
                <i class="ki-duotone ki-shop fs-2">
                    <i class="path1"></i>
                    <i class="path2"></i>
                    <i class="path3"></i>
                    <i class="path4"></i>
                    <i class="path5"></i>
                </i>
            </span>
            <span class="menu-title fs-4 fw-bold">{{__('المتاجر')}}</span>
            <span class="menu-arrow"></span>
        </span>
        <!--end:Menu link-->
        <!--begin:Menu sub-->
        <div @class([
            'menu-sub',
            ' menu-sub-accordion',
            ' here show menu-accordion' => Route::is('dashboard.stores.index') || Route::is('dashboard.gruops.index'),
        ])>
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a @class(['menu-link', 'active fw-bold' => Route::is('dashboard.stores.index')])
                    href="{{ route('dashboard.stores.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title fs-5">{{__("قائمة المتاجر")}}</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a @class(['menu-link', 'active fw-bold' => Route::is('dashboard.groups.index')])
                    href="{{ route('dashboard.groups.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title fs-5">{{__("المجموعات")}}</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
        </div>
        <!--end:Menu sub-->
    </div>
    <!--end:Menu item-->
@endcan