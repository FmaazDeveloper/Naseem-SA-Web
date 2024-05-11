@extends('components.mails.mail_order')

@section('message')
    We are excited to inform you that you have received a new order. A tourist has chosen you as their guide to explore the
    captivating regions of Saudi Arabia.
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
    Please review the order details and itinerary attached to this email. We trust in your expertise to provide an
    exceptional experience for the tourist. If you have any questions or require further information, please don't hesitate
    to contact us.

    Thank you for being a part of our team.
@endsection
