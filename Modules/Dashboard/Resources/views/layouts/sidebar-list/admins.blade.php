<!--begin:Menu item-->
<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
    <!--begin:Menu link-->
    <span class="menu-link">
        <span class="menu-icon">
            <i class="ki-duotone ki-user-tick fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
            </i> </span>
        <span class="menu-title fs-4 fw-bold">المدراء</span>
        <span class="menu-arrow"></span>
    </span>
    <!--end:Menu link-->
    <!--begin:Menu sub-->
    <div @class([
        'menu-sub',
        ' menu-sub-accordion',
        ' here show menu-accordion' => Route::is('dashboard.admins.index') || Route::is('dashboard.admins.create'),
    ])>
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a @class(['menu-link', 'active fw-bold' => Route::is('dashboard.admins.index')])
                href="{{ route('dashboard.admins.index') }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title fs-5">قائمة المدراء</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a @class(['menu-link', 'active' => Route::is('dashboard.admins.create')])
                href="{{ route('dashboard.admins.create') }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title fs-5">إضافة مدير </span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
    </div>
    <!--end:Menu sub-->
</div>
<!--end:Menu item-->