@extends('admin.app')
@section('title')Announcement @endsection
@section('content')
    <div class="app-title">
        <div>
            {{-- <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1> --}}
            <h1><i class="fa fa-tags"></i> Add Announcement</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">
                Add New Announcement
                {{-- {{ $subTitle }} --}}
                    {{-- <span class="top-form-btn">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button>
                        <a class="btn btn-secondary" href=""><i class="fa fa-fw fa-lg fa-titles-circle"></i>Cancel</a>
                    </span> --}}
                </h3>
                <hr>
                <form action="{{ route('admin.announcement.store') }}" method="POST" role="form">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}"/>
                            @error('title') {{ $message ?? '' }} @enderror
                        </div>
                        
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label " for="description">Description <span class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description"  id="ckeditor" value="{{ old('description') }}"></textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message ?? '' }} </strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.announcement.index') }}"><i class="fa fa-fw fa-lg fa-titles-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection