@extends('components.mails.mail_order')

@section('message')
    Thank you for choosing our services to guide you through the captivating regions of Saudi Arabia. We have received your
    order request and we are thrilled to be a part of your journey.
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
    Please note that our team is currently processing your request, ensuring that everything is in place for a seamless
    experience. We will keep you updated on the progress of your order.

    If you have any questions or need any further information, please feel free to contact our support team.
@endsection
