@extends('admin.app')
@section('title')
 {{ $pageTitle }} 
 @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            {{-- <h1><i class="fa fa-tags"></i> Add Category</h1> --}}
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">
                {{ $subTitle }}}}
                </h3>
                <hr>
                <form action="{{ route('admin.reword.store') }}" method="POST" role="form">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="time">Reward Time <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('time') is-invalid @enderror" type="text" name="time" id="time" value="{{ old('time') }}"/>
                            @error('time') {{ $message ?? '' }} @enderror
                        </div>
                        
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="amount">Reward Amount <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('amount') is-invalid @enderror" type="text" name="amount" id="amount" value="{{ old('amount') }}"/>
                            @error('amount') {{ $message ?? '' }} @enderror
                        </div>
                        
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.reword.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection