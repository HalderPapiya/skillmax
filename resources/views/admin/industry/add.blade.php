@extends('admin.app')
@section('title')
Industry
 @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Industry</h1>
            {{-- <h1><i class="fa fa-tags"></i> Add Category</h1> --}}
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">
               Add Industry
                    {{-- <span class="top-form-btn">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button>
                        <a class="btn btn-secondary" href=""><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span> --}}
                </h3>
                <hr>
                <form action="{{ route('admin.industry.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    
                    
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="industry">Industry <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('industry') is-invalid @enderror" type="text" name="industry" id="industry" value="{{ old('industry') }}"/>
                            @error('industry') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    
                   
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Industry</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.industry.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection