@extends('components.mails.mail_order')

@section('message')
    We are pleased to inform you that the tour you have been guiding in Saudi Arabia has successfully concluded. On behalf<b>
    of our team, we would like to express our gratitude for your professionalism, expertise, and dedication throughout the trip.<b>
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
    Your commitment to providing an exceptional experience for the tourists is greatly appreciated. Your knowledge,<b>
    communication skills, and ability to engage with the participants have made a significant impact on the success of the<b>
    tour.<b>
        <b>
    We would like to take this opportunity to thank you for your hard work and for representing our company with excellence.<b>
    Your outstanding service and passion for creating memorable experiences for our customers have not gone unnoticed.<b>
        <b>
    If you have any feedback or suggestions based on your experience, we would be grateful to hear them. Your insights will<b>
    help us enhance our services and ensure that future tours are even more fulfilling for both guides and tourists.<b>
        <b>
    Once again, we extend our appreciation for your contributions. Should you have any further inquiries or require<b>
    assistance with future assignments, please do not hesitate to contact our support team. We value your expertise and look<b>
    forward to the opportunity to work together again.<b>
@endsection
