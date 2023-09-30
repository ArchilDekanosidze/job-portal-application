@extends('layouts.app')

@section('content')

<div class="container mt-5">
<div class="row mt-5">
    <div class="col-md-8">
      <h3>Applied jobs</h3>
      @foreach($users as $user)
      @foreach($user->listings as $listing)
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">{{$listing->title}}</h5>
          <p class="card-text">Applied:{{$listing->pivot->created_at}} </p>
          <a href="{{route('job.show',[$listing->slug])}}" class="btn btn-dark">View</a>
        </div>
      </div>   
    @endforeach
    @endforeach
    </div>
  </div>
</div>

@endsection