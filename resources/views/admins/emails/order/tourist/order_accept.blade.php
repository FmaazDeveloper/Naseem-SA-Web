@extends('components.mails.mail_order')

@section('message')
    We are thrilled to inform you that your order has been accepted by the guide you selected. They are excited to show you
    the wonders of Saudi Arabia's cities and islands.

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

    Please review the attached itinerary for your upcoming journey. Should you have any questions or require any
    modifications, please reach out to our support team.

    We wish you an unforgettable experience filled with breathtaking sights and memorable moments.
@endsection
