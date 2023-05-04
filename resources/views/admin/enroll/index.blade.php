@extends('layouts.admin')

@section('content')
    <div class="container">
    @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header  bg-primary text-white">Enrolled Courses</div>

                    <div class="card-body">
                        <table class="table table-striped  table-bordered table-striped table-bordered bg-light">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Course</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>User</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enrollments as $enrollment)
                                    <tr>
                                        <td><img src="{{ $enrollment->course->getCoverPicture() }}" width="50" height="50"/></td>
                                        <td><a href="{{ route('courses.show', $enrollment->course->id) }}" target="_blank">{{ $enrollment->course->name }}</a></td>
                                        <td>{{ $enrollment->course->start_date }}</td>
                                        <td>{{ $enrollment->course->end_date }}</td>
                                        <td>{{ $enrollment->status }}</td>
                                        <td>{{ $enrollment->user->name }}</td>
                                        <td>
                                            @if($enrollment->status=='applied')
                                                <a href="{{ route('admin.enrollments.suspended',$enrollment->id) }}" class="btn btn-primary mr-2">suspended</a>
                                                <a href="{{ route('admin.enrollments.cancelled',$enrollment->id) }}" class="btn btn-danger mr-2">cancelled</a>
                                            @elseif($enrollment->status=='suspended')
                                                <a href="{{ route('admin.enrollments.revoke',$enrollment->id) }}" class="btn btn-dark mr-2">Revoke</a>
                                              @else
                                                <a href="#" class="btn btn-warning mr-2">Cancelled</a>
                                              @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>                       
                    </div>
                    <div class="d-flex justify-content-end">
                          {!! $enrollments->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
