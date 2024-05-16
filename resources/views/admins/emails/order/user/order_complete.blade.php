@extends('components.mails.mail_order')

@section('message')
    We hope this email finds you well. We are writing to provide you with an update on the status of your trip to
    {{ $data['region'] }}. Please note that this email is sent from the admin.

    We are delighted to inform you that your trip has been successfully completed. We trust that you had a wonderful time
    exploring the unique attractions and immersing yourself in the local culture. We would greatly appreciate it if you
    could share your experience and any feedback you may have.

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


    If you require further assistance or have any questions, please feel free to contact us. We are here to ensure you have
    a pleasant and memorable trip experience.
@endsection
