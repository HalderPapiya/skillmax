@extends('admin.app')
@section('title')Forum @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Forum Details</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title"> Forum Details</h3>
                <form action="{{ route('admin.forum.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                   {{-- <div class="tile-body"><img src="{{asset($forum->image)}}" width="100" /></div> --}}
                    {{-- <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="user_name"> User Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" name="user_name" id="user_name" >
                        </div>
                    </div> --}}
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name_in_bengali">User Name <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('user_name') is-invalid @enderror"
                                name="user_name" id="user_name" value="{{ old('user_name') }}">
                                <option selected disabled>Select one</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->fName }}</option>
                                @endforeach
                            </select>
                            @error('user_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message ?? '' }} </strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title"> Forum Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" name="title" id="title">
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="content"> Content <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" name="content" id="content" >
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="no_of_likes"> No of Likes <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" name="no_of_likes" id="no_of_likes" >
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="no_of_comment"> No of Comments <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" name="no_of_comment" id="no_of_comment" >
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="registration_link"> Registration Link <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" name="registration_link" id="registration_link" >
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="content"> Content <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" name="content" id="content">
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="image">Image <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" value="{{ old('image') }}"/>
                            @error('image') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Forum</button>
                        <a class="btn btn-secondary" href="{{ route('admin.forum.index') }}"><i class="fa fa-fw fa-lg "></i>cancle</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection