@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('message')
            <div class="card shadow-lg">
                <div class="card-header">Login</div>
                <form action="{{route('login.post')}}" method="post">@csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control">
                            @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control">
                            @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password')}}</span>
                            @endif
                        </div>
                        <br>
                        <div class="form-group text-center">
                            <button class="btn btn-dark" type="submit">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            Employer test credentails:
            <p>Email: maxoh@mailinator.com<p> 
            <p>Password: password123</p>
            <hr>
            Job seeker test credentails:
            <p>Email: dekivik@mailinator.com</p>
            <p>Password: password123</p>
            <p>Note:Make sure you have downloaded  myjob.sql file from Udemy and imported into your database</p>
            <p>You can also run migration and create your own records</p>
            <hr>
            <p class="lead"> Please rate this course with 5 star and a nice comment. I will be motivated to
                create even better course then this. 
                Thanks
            </p>
        </div>
    </div>
</div>
<style> 
body{
    background-color: #f5f5f5;
}
</style>

@endsection