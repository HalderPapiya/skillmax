@extends('admin.app')
@section('title') Banner @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Banner</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Edit Banner</h3>
                <form action="{{ route('admin.banner.update',$banner->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body"><img src="{{asset($banner->image)}}" width="100" /></div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="image">Image <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" />
                            <input type="hidden" name="id" value="{{ $banner->id }}">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message ?? '' }} </strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $banner->title) }}"/>
                            @error('title') {{ $message }} @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="link">Link <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('link') is-invalid @enderror" type="text" name="link" id="link" value="{{ old('link', $banner->link) }}"/>
                            @error('link') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Banner</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.banner.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection