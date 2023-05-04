@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header bg-primary text-white">{{ __('Create Course') }}</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="card-body">
          <form method="POST" action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
              <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

           <div class="form-group row">
              <label for="short_description" class="col-md-4 col-form-label text-md-right">{{ __('Short Description') }}</label>

              <div class="col-md-6">
                <textarea id="short_description" class="form-control @error('short_description') is-invalid @enderror" name="short_description" required autocomplete="short_description">{{ old('short_description') }}</textarea>

                @error('short_description')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

              <div class="col-md-6">
                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description">{{ old('description') }}</textarea>

                @error('description')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="video-url" class="col-md-4 col-form-label text-md-right">{{ __('Video Url') }}</label>

              <div class="col-md-6">
                <input id="video-url" type="text" class="form-control @error('vieo_url') is-invalid @enderror" name="video_url" value="{{ old('video_url') }}" required autocomplete="title" autofocus>

                @error('video_url')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="duration" class="col-md-4 col-form-label text-md-right">{{ __('Duration (in days)') }}</label>

              <div class="col-md-6">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" required>
                
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" required>
                                

                @error('duration')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
                <label for="image" class="col-md-4 col-form-label text-md-right">{{ _('Cover Image:') }}</label>
                <div class="col-md-6">
                <input type="file" name="image" class="form-control-file">                                            

                @error('image')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

              <div class="col-md-6">
                <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" required autocomplete="status">
                  <option value="active" @if(old('status') == 'active') selected @endif>{{ __('Active') }}</option>
                  <option value="inactive" @if(old('status') == 'inactive') selected @endif>{{ __('Inactive') }}</option>
                </select>

                @error('status')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Save') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
