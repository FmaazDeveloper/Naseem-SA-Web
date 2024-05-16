@extends('components.mails.mail_order')

@section('message')
    We hope this email finds you well. We are writing to provide you with an update on the status of your trip to
    {{ $data['region'] }}. Please note that this email is sent from the admin.

    We would like to inform both the tourist and the guide that the trip is currently pending confirmation. The admin has
    made some adjustments to the trip details, and it requires the guide's response.

    <b>{{ $data['guide_name'] }}</b>, we kindly ask for your prompt attention to review the updated trip details and provide your acceptance or
    rejection. Please consider the changes carefully and ensure they align with your availability and preferences.

    <b>{{ $data['tourist_name'] }}</b>, we kindly ask for your patience as we await the guide's response. We understand that this may cause some delay,
    and we appreciate your understanding and cooperation during this process.

    Once the guide has reviewed the updated details, they will have the option to accept or reject the trip. We will notify
    both parties promptly as soon as we receive a response from the guide.

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
