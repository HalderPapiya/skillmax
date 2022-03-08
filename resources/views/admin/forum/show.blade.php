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
                <form action="#">
                   <div class="tile-body"><img src="{{asset($forum->image)}}" width="100" /></div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="user_name"> User Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" name="user_name" id="user_name" value="{{  $forum->user ? $forum->user->fName.' '.$forum->user->lName : 'N/A' }}" readOnly/>
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title"> Forum Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" name="title" id="title" value="{{  $forum->title }}" readOnly/>
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="content"> Content <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" name="content" id="content" value="{{  $forum->content }}" readOnly/>
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="no_of_likes"> No of Likes <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" name="no_of_likes" id="no_of_likes" value="{{  $forum->no_of_likes }}" readOnly/>
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="no_of_comment"> No of Comments <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" name="no_of_comment" id="no_of_comment" value="{{  $forum->no_of_comment }}" readOnly/>
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="registration_link"> Registration Link <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" name="registration_link" id="registration_link" value="{{  $forum->registration_link }}" readOnly/>
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="content"> Content <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" name="content" id="content" value="{{  $forum->content }}" readOnly/>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <a class="btn btn-secondary" href="{{ route('admin.forum.index') }}"><i class="fa fa-fw fa-lg "></i>Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection