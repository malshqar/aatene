<form action="{{ route('dashboard.ads.index') }}">
    <div class="d-flex align-items-end">
        <!--begin::Input group-->
        <div class="position-relative w-lg-300px w-md-150px me-md-2 my-0">
            <i class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
            <input type="text" class="form-control form-control-solid ps-10" name="search"
                value="{{ request()->query('search') }}" placeholder="ابحث هنا... ">
        </div>
        <!--end::Input group-->
        <!--begin::Actions-->
        <div class="d-flex my-0 mx-3">
       
            <!--begin::Select-->
            <select name="count" data-control="select2" data-hide-search="true" data-placeholder="العدد"
                class="form-select form-select-sm border-body bg-body  me-5">
                <option value="7" @selected(request()->query('count') == 7)>7</option>
                <option value="15" @selected(request()->query('count') == 15)> 15</option>
                <option value="25" @selected(request()->query('count') == 25)> 25</option>
                <option value="50" @selected(request()->query('count') == 50)> 50</option>
                <option value="100" @selected(request()->query('count') == 100)> 100</option>
            </select>
            <!--end::Select-->
        </div>
        <!--end::Actions-->
        <!--begin:Action-->
        <div class="d-flex my-0">
            <button type="submit" class="btn btn-sm btn-light-primary fs-3 me-5">
                <i class="ki-duotone ki-filter-search fs-1">
                    <i class="path1"></i>
                    <i class="path2"></i>
                    <i class="path3"></i>
                </i>
                فلترة
            </button>
            <a href="{{ route('dashboard.ads.index') }}" class="btn btn-sm btn-light-primary btn-icon fs-3 me-5">
                <i class="ki-duotone ki-cross-circle fs-2">
                    <i class="path1"></i>
                    <i class="path2"></i>
                </i>
            </a>
        </div>
        <!--end:Action-->
    </div>
</form>