        <!--begin::Image input placeholder-->
        <style>
            .image-input-placeholder {
                background-image: url('/assets/media/svg/files/blank-image.svg');
            }

            [data-bs-theme="dark"] .image-input-placeholder {
                background-image: url('/assets/media/svg/files/blank-image-dark.svg');
            }
        </style>
        <!--begin::Image input-->
        <div class="image-input image-input-empty" data-kt-image-input="true">
            <!--begin::Image preview wrapper-->
            <div class="image-input-wrapper image-input-placeholder w-70px h-70px"></div>
            <!--end::Image preview wrapper-->

            <!--begin::Edit button-->
            <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                title="Change {{ $name }}">
                <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                <!--begin::Inputs-->
                <input type="file"  name="{{ $name }}" accept=".png, .jpg, .jpeg" />
                <input type="hidden" name="{{ $name }}_remove" />
                <!--end::Inputs-->
            </label>
            <!--end::Edit button-->

            <!--begin::Cancel button-->
            <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                title="Cancel {{ $name }}">
                <i class="ki-outline ki-cross fs-3"></i>
            </span>
            <!--end::Cancel button-->

            <!--begin::Remove button-->
            <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click"
                title="Remove {{ $name }}">
                <i class="ki-outline ki-cross fs-3"></i>
            </span>
            <!--end::Remove button-->
        </div>
        <!--end::Image input-->

        <script>
            setInterval(() => {
                document.querySelectorAll('[data-kt-image-input="true"]').forEach((el) => {
                    var imageInput = new KTImageInput(el);
                })
            }, 1000);
        </script>
