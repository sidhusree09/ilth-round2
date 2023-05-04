@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">Courses</div>

                    <div class="card-body">
                        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary mb-3">Add Course</a>
                        <table class="table  table-bordered table-striped table-bordered bg-light">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Cover</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Short Description</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Start date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Enrollments</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                <tr>
                                    <th scope="row">{{ $course->id }}</th>
                                    <td><img src="{{ $course->getCoverPicture() }}" width="50" height="50"/></td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ substr($course->short_description,0,100) }}</td>
                                    <td>{{ substr($course->description,0,100) }}</td>
                                    <td>{{ $course->start_date }}</td>
                                    <td>{{ $course->end_date }}</td>
                                    <td>{{ $course->totalEnrollments() }}</td>
                                    <td>{{ $course->status }}</td>
                                    <td>{{ $course->creator->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-sm btn-warning" target="_blank">view</a>
                                        <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this course?')">Delete</button>
                                        </form>                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        {!! $courses->render() !!}
                        </div>
                       </div>
                      </div>
                     </div>
                    </div>
                  </div>
@endsection