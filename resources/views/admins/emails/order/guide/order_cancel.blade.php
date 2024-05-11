@extends('components.mails.mail_order')

@section('message')
    We regret to inform you that the tourist who previously booked your services has requested to cancel the order for their
    upcoming tour in Saudi Arabia. They have expressed their decision due to unforeseen circumstances.
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
    We understand that this cancellation may affect your schedule and apologize for any inconvenience caused. We appreciate
    your understanding and flexibility in accommodating this request.

    If there are any questions or concerns regarding the cancellation or any related matters, please feel free to reach out
    to our support team. We value your professionalism and look forward to the possibility of working together in the
    future.
@endsection
