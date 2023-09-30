@extends('layouts.admin.main')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Your jobs
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Created on</th>
                            <th>Total applicants</th>
                            <th>View job</th>
                            <th>View applicants</th>
                        </tr>
                    </thead>
  
                    <tbody>
                        @foreach($listings as $listing)
                        <tr>
                            <td>{{$listing->title}}</td>
                            <td>{{$listing->created_at->format('Y-m-d')}}</td>
                            <td>{{$listing->users_count}}</td>
                            <td>View</td>
                            <td><a href="{{route('applicants.show',$listing->slug)}}">view</a></td>
                        </tr>
        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection