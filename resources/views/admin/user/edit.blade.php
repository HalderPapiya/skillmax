@extends('admin.app')
@section('title') User @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> User</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Edit User</h3>
                <form action="{{ route('admin.user.update',$user->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="fName">First Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('fName') is-invalid @enderror" type="text" name="fName" id="fName" value="{{ old('fName',$user->fName) }}"/>
                            @error('fName') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="lName">Last Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('lName') is-invalid @enderror" type="text" name="lName" id="lName" value="{{ old('lName',$user->lName) }}"/>
                            @error('lName') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="email">Email <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" id="email" value="{{ old('email',$user->email) }}"/>
                            @error('email') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     {{-- <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="password">Password <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('password') is-invalid @enderror" type="text" name="password" id="password" value="{{ old('password',decrypt($user->password)) }}"/>
                            @error('password') {{ $message ?? '' }} @enderror
                        </div>
                    </div> --}}
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="phone">Mobile <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" id="phone" value="{{ old('phone',$user->phone) }}"/>
                            @error('phone') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="college">College <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('college') is-invalid @enderror" type="text" name="college" id="college" value="{{ old('college',$user->college) }}"/>
                            @error('college') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="subject">Subject <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('subject') is-invalid @enderror" type="text" name="subject" id="subject" value="{{ old('subject',$user->subject) }}"/>
                            @error('subject') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Interest</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.interest.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection