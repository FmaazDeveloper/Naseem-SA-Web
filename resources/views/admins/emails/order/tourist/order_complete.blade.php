@extends('components.mails.mail_order')

@section('message')
    We are delighted to inform you that your tour in Saudi Arabia has come to a successful conclusion. On behalf of our<b>
    team, we would like to express our gratitude for choosing our services and for allowing us to be a part of your travel<b>
    experience.
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
    We hope that the tour has been enjoyable, informative, and memorable for you and your fellow participants. Our team<b>
    strives to provide exceptional service, and we sincerely hope that we have met your expectations.<b>
        <b>
    We would also like to extend our sincere appreciation to your guide, <b>{{ $data['guide_name'] }}</b>. Their expertise,<b>
    professionalism,<b>
    and dedication have greatly contributed to the success of your trip. They have been instrumental in ensuring that you<b>
    had a fulfilling and enriching experience throughout the tour.<b>
        <b>
    We value your feedback and would be grateful if you could take a few moments to share your thoughts and rate your<b>
    overall experience with us. Your feedback will enable us to continually improve our services and ensure that we meet the<b>
    expectations of our future customers.<b>
        <b>
    Once again, we thank you for choosing us as your travel partner. Should you have any further inquiries or require<b>
    assistance with future travel plans, please do not hesitate to reach out to our support team. We would be more than<b>
    happy to assist you.<b>
    <b>
    We hope that your journey home is safe and comfortable. We look forward to serving you again in the future.<b>
@endsection
