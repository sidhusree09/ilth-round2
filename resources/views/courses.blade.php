@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
@if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if(count($courses)==0)
            <div class="alert alert-danger">
                {{ __('No Courses Found') }}
            </div>
        @else
            <div class="card-deck">
            <div class="row">
                @foreach($courses as $course)
                <div class="col-md-4">
                  <div class="card">
                    <img class="card-img-top" src="{{ asset($course->getCoverPicture() ) }}" alt="">
                    <div class="card-body">
                      <h3 class="card-title">{{ $course->name}}</h3>
                      <p class="card-text">{{ substr($course->short_description,0,100) }}</p>
                      <p class="card-text"><small class="text-muted">Start date: {{ $course->start_date }}</small></p>
                      <p class="card-text"><small class="text-muted">End date: {{ $course->end_date }}</small></p>
                      @if(auth()->user()->isEnrolled($course->id))
                        <a href="{{ route('enrollments.unroll',$course->id) }}" class="btn btn-primary mr-2">Unenroll</a>
                      @else
                        <a href="{{ route('enrollments.enroll',$course->id) }}" class="btn btn-primary mr-2">Enroll Now</a>
                      @endif
                        <a href="{{ route('courses.show',$course->id) }}" target="_blank" class="btn btn-warning">Read More</a>
                      
                    </div>
                  </div>
              </div>
              @endforeach
              </div>
            </div>
@endif
 </div>
</div>
@endsection
