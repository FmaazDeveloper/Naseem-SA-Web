@extends('components.mails.mail_welcome')

@section('message')
    We are delighted to welcome you to <a href="{{ url('/') }}">Naseem-SA</a> ! Our platform connects tourists
    with
    experienced guides to create
    incredible travel experiences. Whether you're a tourist seeking unique adventures or a guide looking to share your
    expertise, we're here to help.

    As an added <b>{{ $data['role'] }}</b>, you now have access to our platform's features. Take advantage of the
    opportunities available to you.
    We encourage you to maximize your experience on our platform and make the most of the resources and tools we provide.

    Please use the following login credentials to access your account:
    <br><br>
    <b>Email: {{ $data['email'] }}</b>
    <br>
    <b>Temporary Password: {{ $data['password'] }}</b>
    <br><br>
    To ensure the security of your account, we kindly request that you change your password upon your first login. You can
    do this by visiting our <a href="{{ route('login') }}">login page</a> and using the "Forgot Password" option.
    Follow
    the
    instructions provided to set a new password of your choice.

    If you have any questions, need support, or require assistance, our dedicated team is always available to help. We're
    excited to have you join our community and look forward to the incredible experiences you'll create!
@endsection
