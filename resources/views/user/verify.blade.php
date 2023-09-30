@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="card">
            <div class="card-header">Verify Account</div>
            <div class="card-body">
            <p>Your account is not verified. Please verify your account. You may resend 
                the verification email.

                <a href="{{route('resend.email')}}">Resend veification email</a>

            </p>
            </div>
        </div>
        @if(Session::has('success'))
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success">{{Session::get('success')}}</div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection