@can('user.index')
<!--begin:Menu item-->
<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
    <!--begin:Menu link-->
    <span class="menu-link">
        <span class="menu-icon">
            <i class="ki-duotone ki-picture  fs-2">
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
        <span class="menu-title fs-4 fw-bold">الإعلانات</span>
        <span class="menu-arrow"></span>
    </span>
    <!--end:Menu link-->
    <!--begin:Menu sub-->
    <div @class([
        'menu-sub',
        ' menu-sub-accordion',
        ' here show menu-accordion' => Route::is('dashboard.ads.index') || Route::is('dashboard.ads.create'),
    ])>
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a @class(['menu-link', 'active fw-bold' => Route::is('dashboard.ads.index')]) href="{{ route('dashboard.ads.index') }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title fs-5">قائمة الإعلانات</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
        @can('user.create')
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a @class(['menu-link', 'active' => Route::is('dashboard.ads.create')]) href="{{ route('dashboard.ads.create') }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title fs-5">إضافة إعلان </span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
        @endcan
    </div>
    <!--end:Menu sub-->
</div>
<!--end:Menu item-->
@endcan