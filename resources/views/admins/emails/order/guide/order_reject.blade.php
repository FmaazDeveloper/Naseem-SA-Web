@extends('components.mails.mail_order')

@section('message')
    We regret to inform you that you have expressed your inability to accept the order for the tour in Saudi Arabia, which
    was assigned to you. We understand that unforeseen circumstances have arisen that prevent you from fulfilling the tour
    request.
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
    We appreciate your prompt communication regarding this matter. We apologize for any inconvenience caused by this change
    and understand that it may impact your schedule as well.

    If you have any questions or concerns regarding this order rejection or require any further assistance, please do not
    hesitate to contact our support team. We appreciate your professionalism and hope to have the opportunity to work
    together on future assignments.
@endsection
