<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title') @show</title>
    <style type="text/css">
        body, table {
            font-family: HelveticaNeue;
        }
        p {
            font-size: 14px;
        }
        .text-center {
            text-align: center;
        }
        .note-1, .note-2 {
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .note-2{
            font-size: 11px;
        }
        .border-t-b {
            border-top: 1px dashed #ddd;
        }
        .fz-16, .fz-16 p {
            font-size: 16px;
        }
        .fz-14, .fz-14 p {
            font-size: 14px;
        }
        .fz-12, .fz-12 p {
            font-size: 12px;
        }
    </style>
    @yield('style')
</head>

<body >
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <!-- Email Body -->
                    <tr class="email-body">
                        <td width="100%">
                            <table align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <h1 class="text-center link-homepage" ><a href="{{ $site_url }}">VICODERS</a></h1>
                                        <p class="text-center title-mail fz-16">Thông báo về một example mà bạn đang thử nghiệm</p>
                                        <p class="fz-16">Xin chào <strong>YOU</strong>,</p>
                                        <p class="fz-16"><strong>Vicoders Team</strong> vừa chia sẻ một thông tin cập nhật của thông tin <strong>"Chia sẻ"</strong>, với nội dung:</p>
                                        <p class="content fz-16">
                                            "Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi"
                                        </p>
                                        <p class="fz-14"><span style="text-decoration: underline;">Bạn có thể xem chi tiết link ở đây</span>: <a href="http://vicoders.com">xem chi tiết</a></p>
                                        <p class="note-2 border-t-b">
                                            <i class="fz-12">Để từ chối nhận tin cập nhật về kiến nghị này xin vui lòng email đến <a href="mailto:info@vicoders.com">info@vicoders.com</a> hoặc <a href="mailto:vicoders@gmail.com">vicoders@gmail.com</a></i>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr class="email-footer">
                        <td width="100%">
                            <table align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <div class="note-2 border-t-b fz-12">
                                            <p>Vicoders Team</p>
                                            <p>Tầng 2, số nhà 42, ngõ 178 Thái Hà, Đống Đa, Hà Nội</p>
                                            <p>Điện thoại: 0985 136 895</p>
                                            <p>Email: <a href="mailto:info@vicoders.com">info@vicoders.com</a></p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
