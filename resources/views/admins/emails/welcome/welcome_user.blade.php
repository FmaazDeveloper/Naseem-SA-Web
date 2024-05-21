@extends('components.mails.mail_welcome')

@section('message')
    We are delighted to welcome you to <a href="{{ url('/') }}">Naseem-SA</a> ! Our platform connects tourists<br>
    with experienced guides to create incredible travel experiences. Whether you're a tourist seeking unique<br>
    adventures or a guide looking to share your expertise, we're here to help.<br>
    <br>
    As an added <b>{{ $data['role'] }}</b>, you now have access to our platform's features. Take advantage of the<br>
    opportunities available to you.<br>
    We encourage you to maximize your experience on our platform and make the most of the resources and tools we provide.<br>
    <br>
    Please use the following login credentials to access your account:
    <br><br>
    <b>Email: {{ $data['email'] }}</b>
    <br>
    <b>Temporary Password: {{ $data['password'] }}</b>
    <br><br>
    To ensure the security of your account, we kindly request that you change your password upon your first login.<br>
    You can do this by visiting our <a href="{{ route('login') }}">login page</a> and using the "Forgot Password" option.<br>
    Follow the instructions provided to set a new password of your choice.<br>
    <br>
    If you have any questions, need support, or require assistance, our dedicated team is always available to help.<br>
    We're excited to have you join our community and look forward to the incredible experiences you'll create!<br>
@endsection
