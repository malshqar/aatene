"use strict";
var KTAuthResetPassword = (function () {
    var t, e, i;
    return {
        init: function () {
            (t = document.querySelector("#kt_password_reset_form")),
                (e = document.querySelector("#kt_password_reset_submit")),
                (i = FormValidation.formValidation(t, {
                    fields: {
                        email: {
                            validators: {
                                regexp: {
                                    regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                    message: "القيمة المدخلة ليست بريد صالح",
                                },
                                notEmpty: {
                                    message: "البريد الإلكنرووني مطلوب",
                                },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: "",
                        }),
                    },
                })),
                e.addEventListener("click", function (r) {
                    r.preventDefault(),
                        i.validate().then(function (i) {
                            "Valid" == i
                                ? (e.setAttribute("data-kt-indicator", "on"),
                                  (e.disabled = !0),
                                  setTimeout(function () {
                                      e.removeAttribute("data-kt-indicator"),
                                          (e.disabled = !1),
                                          Swal.fire({
                                              text: " لقد قمنا بإرسال رابط استعادة كلمة المرور الى بريدك.",
                                              icon: "success",
                                              buttonsStyling: !1,
                                              confirmButtonText: "Ok, got it!",
                                              customClass: {
                                                  confirmButton:
                                                      "btn btn-primary",
                                              },
                                          }).then(function (e) {
                                              if (e.isConfirmed) {
                                                  t.querySelector(
                                                      '[name="email"]'
                                                  ).value = "";
                                                  var i = t.getAttribute(
                                                      "data-kt-redirect-url"
                                                  );
                                                  i && (location.href = i);
                                              }
                                          });
                                  }, 1500))
                                : Swal.fire({
                                      text: "عذراً يبدو أنه هناك بعض الأخطاء. حاول مرة أخرى",
                                      icon: "error",
                                      buttonsStyling: !1,
                                      confirmButtonText: "حسناً",
                                      customClass: {
                                          confirmButton: "btn btn-primary",
                                      },
                                  });
                        });
                });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTAuthResetPassword.init();
});
