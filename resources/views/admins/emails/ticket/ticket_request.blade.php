@extends('components.mails.mail_ticket')

@section('message')
    Thank you for reaching out to us regarding your ticket request. We have received your inquiry and our team is working
    diligently to assist you.

    Please note that our response time is typically within 24 hours. We appreciate your patience and assure you that we are
    committed to providing you with the best possible service.
    <b>
        <br><br>
        <b>Contact Reason: {{ $data['contact_reason'] }}</b>
        <br>
        <b>Title: {{ $data['title'] }}</b>
        <br>
        <b>Message: {{ $data['message'] }}</b>
        <br><br>
    </b>
    If you have any additional information or files to share related to your ticket request, please feel free to attach them
    to this email.

    Thank you for choosing our services.
@endsection
