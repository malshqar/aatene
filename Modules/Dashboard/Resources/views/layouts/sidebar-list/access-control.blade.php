<!--begin:Menu item-->
<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
    <!--begin:Menu link-->
    <span class="menu-link">
        <span class="menu-icon">
            <i class="ki-duotone ki-security-user fs-1">
                <i class="path1"></i>
                <i class="path2"></i>


            </i>
        </span>
        <span class="menu-title fs-4 fw-bold">الأدوار</span>
        <span class="menu-arrow"></span>
    </span>
    <!--end:Menu link-->
    <!--begin:Menu sub-->
    <div @class([
        'menu-sub',
        ' menu-sub-accordion',
        ' here show menu-accordion' => Route::is('dashboard.roles.index') || Route::is('dashboard.roles.create'),
    ])>
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a @class(['menu-link', 'active fw-bold' => Route::is('dashboard.roles.index')])
                href="{{ route('dashboard.roles.index') }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title fs-5">قائمة الأدوار</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a @class(['menu-link', 'active' => Route::is('dashboard.roles.create')])
                href="{{ route('dashboard.roles.create') }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title fs-5">إضافة دور </span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
    </div>
    <!--end:Menu sub-->
</div>
<!--end:Menu item-->