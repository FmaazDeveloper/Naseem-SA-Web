@extends('components.mails.mail_order')

@section('message')
    We regret to inform you that the guide you selected has informed us that they are unable to accept your order for the
    tour in Saudi Arabia. Unforeseen circumstances have arisen that prevent them
    from
    fulfilling the tour request.
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
    We understand that this news may be disappointing. However, we encourage you to explore other available options for your
    travel plans. If you wish to proceed with booking another guide or tour, please visit our website <a
        href="http://127.0.0.1:8000/">Home page</a> or
    contact our support team for further assistance.

    Thank you for your understanding, and we apologize for any inconvenience caused. We appreciate your continued interest
    in our services, and we hope to have the opportunity to assist you in the future.
@endsection
