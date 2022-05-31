@extends('admin.app')
@section('title')Forum Comment @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Forum Comment Details</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title"> Forum Comment Details</h3>
                <form action="#">
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="user_name"> User Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" name="user_name" id="user_name" value="{{  $forumComment->user ? $forumComment->user->fName.' '.$forumComment->user->lName : 'N/A' }}" readOnly/>
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title"> Forum Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" name="title" id="title" value="{{  $forumComment->forum ? $forumComment->forum->title : 'N/A'}}" readOnly/>
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="content"> Content <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" name="content" id="content" value="{{  $forumComment->content }}" readOnly/>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <a class="btn btn-secondary" href="{{ route('admin.forum-comment.index') }}"><i class="fa fa-fw fa-lg "></i>Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection