@extends('admin.app')
@section('title') Team @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Team</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Edit Team</h3>
                <form action="{{ route('admin.team.update',$team->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $team->id }}">
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name_in_bengali">User Name <span class="m-l-5 text-danger"> *</span><span class="m-l-5"> : {{ $team->user->fName . ' ' . $team->user->lName }}</span></label>
                            <select class="form-control @error('userId') is-invalid @enderror"
                                name="userId" id="userId" value="{{ old('userId') }}">
                                <option selected disabled>Select one</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->fName . ' ' . $user->lName }}</option>
                                @endforeach
                            </select>
                            @error('userId')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message ?? '' }} </strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name',$team->name) }}"/>
                            @error('name') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="email">Email <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" id="email" value="{{ old('email',$team->email) }}"/>
                            @error('email') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                   
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="phone">Mobile <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" id="phone" value="{{ old('phone',$team->phone) }}"/>
                            @error('phone') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Team</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.team.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection