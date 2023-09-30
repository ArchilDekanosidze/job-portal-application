@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h1>Looking for a job?</h1>
            <h3>Please create an account</h3>
            <img src="/it-engineer-working-with-his-pc.jpeg" width="580"
            class="img-responsibe">
        </div>

        <div class="col-md-6 mt-5 mb-5">
            <div class="card" id="card" style="margin-top:50px;">
                <div class="card-header">Register</div>
                <form action="#" method="post" id="registrationForm">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Full name</label>
                            <input type="text" name="name" class="form-control" required>
                            @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" required>
                            @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" required>
                            @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password')}}</span>
                            @endif
                        </div>
                        <br>
                        <div class="form-group mb-5 mt-3">
                            <button class="btn btn-dark" id="btnRegister">Register</button>
                        </div>
                    </div>
                </form>
            </div>
            <div id="message" class="mt-2"></div>
        </div>
    </div>
</div>
<script>
    var url = "{{route('store.seeker')}}";
    document.getElementById("btnRegister").addEventListener("click", function(event) {
    var form = document.getElementById("registrationForm");
    var card = document.getElementById("card");
    var messageDiv = document.getElementById('message')
    messageDiv.innerHTML = ''
    var formData = new FormData(form)

    var button = event.target
    button.disabled = true;
    button.innerHTML = 'Sending email.... '

    fetch(url, {
        method: "POST",
        headers:{
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        },
        body: formData
    }).then(response => {
        if(response.ok) {
            return response.json();
        }else{
            throw new Errror('Error')
        }
    }).then(data=> {
        button.innerHTML = 'Register'
        button.disabled = false
        messageDiv.innerHTML = '<div class="alert alert-success">Registration was successful.Please check your email to verify it</div>'
        card.style.display = 'none'
    }).catch(error => {
        console.log(error)
        button.innerHTML = 'Register'
        button.disabled = false
        messageDiv.innerHTML = '<div class="alert alert-danger">Something went wrong. Please try again</div>'
       
    })


})
</script>

@endsection