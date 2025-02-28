import "./bootstrap";

// var channel = Echo.private("Modules.Admin.Entities.Admin." + channelId);
// channel.notification(function (data) {
//     console.log(JSON.stringify(data));
//     document.getElementById("notification-list").innerHTML += renderNotifications(JSON.stringify(data));

// });// استمع إلى القناة الخاصة
var channel = Echo.private("Modules.Admin.Entities.Admin." + channelId);
channel.notification(function (data) {
    console.log("Notification received:", data);

    // تمرير البيانات مباشرة إلى renderNotifications
    if (data && typeof data === 'object') {
        document.getElementById("notification-list").innerHTML += renderNotifications(data);
        document.getElementById("kt_menu_item_wow").innerHTML += `
         <span class="bullet bullet-dot bg-success h-6px w-6px position-absolute top-0 start-0 animation-blink">
            </span>
        `;
    } else {
        console.error("Invalid notification data:", data);
    }
});

// دالة توليد HTML للإشعارات
function renderNotifications({ icon, name, url, id, message }) {
    return `
        <!--begin::Item-->
        <div class="d-flex flex-stack py-4">
            <!--begin::Section-->
            <div class="d-flex align-items-center">
                <!--begin::Symbol-->
                <div class="symbol symbol-35px me-4">
                    <span class="symbol-label bg-light-primary">
                        <i class="${icon} fs-2 text-primary">
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
                    <a href="${url}?notification_id=${id}"
                        class="fs-6 text-gray-800 text-hover-primary fw-bold">${name}</a>
                    <div class="text-gray-500 fs-7">${message}</div>
                </div>
                <!--end::Title-->
            </div>
            <!--end::Section-->

            <!--begin::Label-->
            <span class="badge badge-light fs-8">
            الآن
            </span>
            <!--end::Label-->
        </div>
        <!--end::Item-->
    `;
}
