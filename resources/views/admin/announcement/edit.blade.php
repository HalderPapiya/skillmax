@extends('admin.app')
@section('title')@endsection
@section('content')
    <div class="app-title">
        <div>
            {{-- <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1> --}}
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Edit Announcement</h3>
                <form action="{{ route('admin.announcement.update',$targetAnnouncement->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title"> Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $targetAnnouncement->title) }}"/>
                            <input type="hidden" name="id" value="{{ $targetAnnouncement->id }}">
                            @error('title') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="description"> Description <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('description') is-invalid @enderror" type="text" name="description" id="description" value="{{ old('description', $targetAnnouncement->description) }}"/>
                            <input type="hidden" name="id" value="{{ $targetAnnouncement->id }}">
                            @error('description') {{ $message }} @enderror
                        </div>
                    </div>
                    
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Announcement</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.announcement.index') }}"><i class="fa fa-fw fa-lg fa-titles-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection