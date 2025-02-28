"use strict";

var KTAccountSettingsDeleteStore = (function () {
    var t, n, e;
    return {
        init: function () {
            (t = document.querySelector("#kt_store_delete_form")) &&
                ((e = document.querySelector("#kt_store_delete_store_submit")),
                (n = FormValidation.formValidation(t, {
                    fields: {
                        deleteStore: {
                            validators: {
                                notEmpty: {
                                    message: "الرجاء تحديد المربع لحذف حسابك",
                                },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: "",
                        }),
                    },
                })),
                e.addEventListener("click", function (t) {
                    t.preventDefault(),
                        n.validate().then(function (t) {
                            "Valid" == t
                                ? swal
                                      .fire({
                                          text: "هل انت متأكد انك تريد حذف هذا المتجر؟",
                                          icon: "warning",
                                          buttonsStyling: !1,
                                          showDenyButton: !0,
                                          confirmButtonText: "نعم",
                                          denyButtonText: "لا",
                                          customClass: {
                                              confirmButton:
                                                  "btn btn-light-primary",
                                              denyButton: "btn btn-danger",
                                          },
                                      })
                                      .then((t) => {
                                          t.isConfirmed
                                              ? Swal.fire({
                                                    text: "لقد قمت بحذف هذا المتجر بنجاح",
                                                    icon: "success",
                                                    confirmButtonText: "حسناً",
                                                    buttonsStyling: !1,
                                                    customClass: {
                                                        confirmButton:
                                                            "btn btn-light-primary",
                                                    },
                                                }) &&
                                                document
                                                    .getElementById(
                                                        "kt_store_delete_form"
                                                    )
                                                    .submit()
                                              : t.isDenied &&
                                                Swal.fire({
                                                    text: "المتجر لم يتم حذفه.",
                                                    icon: "info",
                                                    confirmButtonText: "حسناً",
                                                    buttonsStyling: !1,
                                                    customClass: {
                                                        confirmButton:
                                                            "btn btn-light-primary",
                                                    },
                                                });
                                      })
                                : swal.fire({
                                      text: "عذراً يبدو انه حدثت بعض الأخطاء، رجاءاَ حاول مرة اخرى.",
                                      icon: "error",
                                      buttonsStyling: !1,
                                      confirmButtonText: "حسنا لقد فهمت!",
                                      customClass: {
                                          confirmButton:
                                              "btn btn-light-primary",
                                      },
                                  });
                        });
                }));
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTAccountSettingsDeleteStore.init();
});
