@extends('components.mails.mail_ticket')

@section('message')
    We have reviewed your ticket regarding {{ $data['title'] }} and would like to provide you with the following response:
    <b>
        <br><br>
        Answer: {{ $data['answer'] }}
        <br><br>
    </b>
    If you have any further questions or require additional assistance, please don't hesitate to reach out to us.<br>
    We are here to help you.<br>
    <br>
    Thank you for choosing our services.<br>
@endsection
