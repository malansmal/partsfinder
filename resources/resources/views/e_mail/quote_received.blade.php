@extends('e_mail.layout.email_layout')

@section('email-body')

    <tr>
        <td class="body" width="100%" cellpadding="0" cellspacing="0">
            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                <!-- Body content -->
                <tr>
                    <td class="content-cell">

                        <h1 class="greet-ok">Dear {{$name}}</h1>
                        <p>A supplier quoted on your parts wanted request. Click on the link below to view the quote. 
						Please allow for other suppliers to also quote, before accepting the quote.</p>
						<p> Please note that the price quoted does not include VAT and Courier/Delivery cost where applicable. 
						(If out of you area). Please take note of suppliers area.<p>
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
