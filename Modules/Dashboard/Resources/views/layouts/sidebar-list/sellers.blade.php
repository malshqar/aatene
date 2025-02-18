@can('seller.index')
<!--begin:Menu item-->
<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
    <!--begin:Menu link-->
    <span class="menu-link">
        <span class="menu-icon">
            <i class="ki-duotone ki-people fs-2">
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
        <span class="menu-title fs-4 fw-bold">البائعين</span>
        <span class="menu-arrow"></span>
    </span>
    <!--end:Menu link-->
    <!--begin:Menu sub-->
    <div @class([
        'menu-sub',
        ' menu-sub-accordion',
        ' here show menu-accordion' => Route::is('dashboard.sellers.index') || Route::is('dashboard.sellers.create'),
    ])>
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a @class(['menu-link', 'active fw-bold' => Route::is('dashboard.sellers.index')]) href="{{ route('dashboard.sellers.index') }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title fs-5">قائمة البائعين</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
        @can('seller.create')
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a @class(['menu-link', 'active' => Route::is('dashboard.sellers.create')]) href="{{ route('dashboard.sellers.create') }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title fs-5">إضافة بائع </span>
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