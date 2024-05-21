@extends('components.mails.mail_order')

@section('message')
    We hope this email finds you well. We are writing to provide you with an update on the status of your trip to<br>
    {{ $data['region'] }}. Please note that this email is sent from the admin.<br>

    We regret to inform you that your trip has been rejected. We understand that this news may be disappointing, and we<br>
    apologize for any inconvenience caused. Our team is available to discuss alternative options or address any concerns you<br>
    may have.<br>

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


    If you require further assistance or have any questions, please feel free to contact us. We are here to ensure you have<br>
    a pleasant and memorable trip experience.<br>
@endsection
