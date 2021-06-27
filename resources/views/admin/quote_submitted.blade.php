@extends('e_mail.layout.email_layout')

@section('email-body')

    <tr>
        <td class="body" width="100%" cellpadding="0" cellspacing="0">
            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                <!-- Body content -->
                <tr>
                    <td class="content-cell">

                        <h1 class="greet-ok">Dear {{$name}}</h1>
                        <p>Thank you for submitting your quote, we will forwarded it to the buyer. You will receive a notification if 
						the buyer accept your quote.</p>
						<br/>
                        <p>Quote Query No: {{$requestNo}}</p>
						<br/>
                        <p>This is an automated e-mail, Please do not reply to this e-mail.</p>

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
