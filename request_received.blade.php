@extends('e_mail.layout.email_layout')

@section('email-body')

    <tr>
        <td class="body" width="100%" cellpadding="0" cellspacing="0">
            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                <!-- Body content -->
                <tr>
                    <td class="content-cell">

                        <h1 class="greet-ok">Dear {{$name}}</h1>

                        <p>Thank you for submitting a request for parts wanted. Your request will be send to all our suppliers 
						throughout South Africa. You will receive a notification to view your request online from suppliers if parts are available. 
						Please find the link to your quote below.</p>
						<p>Please allow for other suppliers to quote before accepting quote.</p>
						<br/>
                        <p>Request No: {{$requestNo}}</p>
                        <br/>
						<a href="{{$link}}" class='button button-blue'>View Quote</a>
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
