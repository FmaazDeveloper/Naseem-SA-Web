@extends('components.mails.mail_order')

@section('message')
    We have received your request to cancel the order for your upcoming tour in Saudi Arabia. We understand that
    circumstances may change, and we want to support you in making the best decision for your travel plans.
    <b>
        <br><br>
        Order Details:
        <br><br>
        Order ID: {{ $data['id'] }}
        <br>
        Destination: {{ $data['region'] }}
        <br>
        Order Start Date: {{ $data['start_date'] }}
        <br>
        Order End Date: {{ $data['end_date'] }}
        <br>
        Number of Participants: {{ $data['number_of_people'] }}
        <br><br>
    </b>
    We will proceed with the cancellation process and initiate any applicable refunds, as per our cancellation policy.
    Please note that there may be certain cancellation fees or conditions outlined in our terms and conditions, which we
    encourage you to review.

    We apologize for any inconvenience caused and hope to have the opportunity to serve you in the future. If you have any
    further questions or require assistance, please don't hesitate to contact our support team.
@endsection
