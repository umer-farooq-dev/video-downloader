<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ __('New message from') }} {{ $data['email'] }}</title>
    <style>#wrapper,table.body-wrap{width:100%}*{font-family:"Helvetica Neue",Helvetica,Helvetica,Arial,sans-serif}#wrapper{background-color:#f8f8f8;margin:0;padding:70px 0;-webkit-text-size-adjust:none!important}a{color:#2BA6CB}p{margin-bottom:10px;font-weight:400;font-size:14px;line-height:1.6}.container{display:block!important;max-width:600px!important;margin:0 auto!important;clear:both!important}.content{padding:15px}.table-data{box-shadow:0 1px 4px rgba(0,0,0,.1)!important;background-color:#fff;border:1px solid #dedede;border-radius:3px!important}.border-solid{border-top:1px solid #ddd}.details{border:1px dashed #ddd;padding:10px;background:repeat-x rgba(240,247,252,.2)}</style>
</head>
 
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    <div id="wrapper" dir="ltr">
        <table class="body-wrap" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
            <tbody>
                <tr>
                    <td align="center" valign="top">
                        <table bgcolor="#ffffff" class="table-data">
                            <tbody>
                                <tr>
                                    <td class="container content">
                                        <p>{{ __('You have received a message from') }}:</p>

                                        <div class="details">
                                            <p>{{ __('Name') }}: {{ $data['name'] }}</p>
                                            <p>{{ __('Email') }}: {{ $data['email'] }}</p>
                                            <p>{{ __('Message') }}: {{ $data['message'] }}</p>
                                        </div>

                                        <p>{{ __('This Email was sent from a contact form on') }} {{ route('home') }}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>