@extends('e_mail.layout.email_layout')

@section('email-body')

    <tr>
        <td class="body" width="100%" cellpadding="0" cellspacing="0">
            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                <!-- Body content -->
                <tr>
                    <td class="content-cell">

                        <h1 class="greet-ok">
                            Dear {{$name}}</h1>

                        <p>Thank you for submitting your order. Your order is in progress and we will contact you soon.</p>
						<br/>                       
						<p>Request No: {{$requestNo}}</p>
                        <p>Your Order No: {{$orderNo}}</p>
						<br/>
                        <p>This is an automated e-mail, Please do not reply to this e-mail.</p>
						<br/>
                        <p>
                            Regards,<br>
                            {{ getApplicationName() }} Team
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

@endsection
