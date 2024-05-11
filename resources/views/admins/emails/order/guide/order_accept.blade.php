@extends('components.mails.mail_order')

@section('message')

Congratulations! Your acceptance of the order has been confirmed. The tourist is looking forward to exploring the enchanting regions of Saudi Arabia under your expert guidance.

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

Please refer to the attached itinerary for the details of the tour. If you have any questions or require any assistance, please don't hesitate to contact us.

Thank you for your dedication and commitment to providing an exceptional experience.

@endsection
