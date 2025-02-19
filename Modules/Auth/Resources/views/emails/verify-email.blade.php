<div style="background-color:#D5D9E2; --kt-scrollbar-color: #d9d0cc; --kt-scrollbar-hover-color: #d9d0cc padding:20px">

    <!--begin::Email template-->
    <style>
        html,
        body {
            padding: 0;
            margin: 0;
            font-family: "Almarai", "serif";
            direction: rtl;
        }

        a:hover {
            color: #009ef7;
        }
    </style>

    <div id="#kt_app_body_content"
        style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
        <div
            style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:40px auto; max-width: 600px;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto"
                style="border-collapse:collapse">
                <tbody>
                    <tr>
                        <td align="center" valign="center" style="text-align:center; padding-bottom: 10px">

                            <!--begin:Email content-->
                            <div style="text-align:center; margin:0 60px 34px 60px">
                                <!--begin:Logo-->
                                <div style="margin-bottom: 10px">
                                    <a href="{{url('/')}}" rel="noopener" target="_blank">
                                        <img alt="Logo" src="{{ asset('assets/media/aatene-logo.png') }}"
                                            style="height: 35px" />
                                    </a>
                                </div>
                                <!--end:Logo-->

                                <!--begin:Media-->
                                <div style="margin-bottom: 15px">
                                    <img alt="Logo" src="{{asset('assets/media/email/icon-positive-vote-2.svg')}}" />
                                </div>
                                <!--end:Media-->

                                <!--begin:Text-->
                                <div
                                    style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
                                    @if (!empty($greeting))
                                        <p style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700">
                                            {{ $greeting }}
                                        </p>
                                    @else
                                        <p style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700">
                                            Whoops!</p>
                                    @endif
                                    @foreach ($introLines ?? [] as $line)
                                        <p style="margin-bottom:2px; color:#7E8299">
                                            {{ $line }}
                                        </p>
                                    @endforeach
                                </div>
                                <!--end:Text-->
                                @isset($actionText)
                                    <!--begin:Action-->
                                    <a href="{{$actionUrl}}" target="_blank"
                                        style="background-color:#50cd89; border-radius:6px;display:inline-block; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500; font-family:Arial,Helvetica,sans-serif;">
                                        {{ $actionText }}
                                    </a>
                                    <!--end:Action-->
                                @endisset

                            </div>
                            <!--end:Email content-->
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="center"
                            style="font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif">
                            <p
                                style="color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ">
                                تحياتي!</p>
                            <p style="margin-bottom:4px">يمكنك الوصول إلينا على<a href="{{url('/')}}" rel="noopener"
                                    target="_blank" style="font-weight: 600">{{request()->HttpHost()}}</a>.
                            </p>

                        </td>
                    </tr>

                    <tr>
                        <td align="center" valign="center" style="text-align:center; padding-bottom: 20px;">
                            <a href="#" style="margin-right:10px"><img alt="Logo"
                                    src="{{asset('assets/media/email/icon-linkedin.svg')}}" /></a>
                            <a href="#" style="margin-right:10px"><img alt="Logo"
                                    src="{{asset('assets/media/email/icon-dribbble.svg')}}" /></a>
                            <a href="#" style="margin-right:10px"><img alt="Logo"
                                    src="{{asset('assets/media/email/icon-facebook.svg')}}" /></a>
                            <a href=" #"><img alt="Logo" src="{{asset('assets/media/email/icon-twitter.svg')}}" /></a>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" valign="center"
                            style="font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif">
                            <p>
                                &copy جميع الحقوق محفوظة الى {{config('app.name')}}.
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!--end::Email template-->

</div>