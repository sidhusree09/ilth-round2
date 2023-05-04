@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset($course->getCoverPicture() ) }}" class="img-fluid mb-3" alt="Course Cover Image">
                </div>
                <div class="col-md-8">
                    <h2>{{ $course->title }}</h2>
                    <h5 class="text-muted mb-3">{{ $course->short_description }}</h5>
                    <p class="mb-4">{{ $course->description }}</p>
                    <p class="mb-2"><strong>Start Date:</strong> {{ $course->start_date }}</p>
                    <p class="mb-2"><strong>End Date:</strong> {{ $course->end_date }}</p>
                    <p class="mb-4"><strong>Video URL:</strong> {{ $course->video_url }}</p>
                    <p class="mb-4">                        
                        <iframe width="560" height="315" src="{{ $course->video_url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </p>
                    <hr>
                    <h4>Created By:</h4>
                    <p><strong>Name:</strong> {{ $course->creator->name }}</p>
                    <p><strong>Email:</strong> {{ $course->creator->email }}</p>
                    <p><strong>Role:</strong> {{ $course->creator->getRoleNames()->first() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
