



@extends('admin.app')
@section('title') User @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Industry</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Edit Industry</h3>
                <form action="{{ route('admin.industry.update',$data->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                   
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="industry">Industry <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('industry') is-invalid @enderror" type="text" name="industry" id="industry" value="{{ old('industry',$data->industry) }}"/>
                            @error('industry') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    
                     
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Industry</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.industry.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection