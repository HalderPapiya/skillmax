@extends('admin.app')
@section('title'){{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Edit Reward Report</h3>
                <form role="form" enctype="multipart/form-data">
                    @csrf
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name </label>
                            <input class="form-control @error('name') is-invalid @enderror" type="name" name="userId" id="name" value="{{$targetRewardReport->user->name}}" readOnly/>
                            @error('time') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="time">Reword Time </label>
                            <input class="form-control @error('time') is-invalid @enderror" type="text" name="time" id="time" value="{{ old('time', $targetRewardReport->time) }}" readOnly/>
                            @error('time') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div clapvss="form-group">
                            <label class="control-label" for="amount">Reword Amount </label>
                            <input class="form-control @error('amount') is-invalid @enderror" type="text" name="amount" id="amount" value="{{ old('amount', $targetRewardReport->amount) }}" readOnly/>
                            @error('amount') {{ $message }} @enderror
                        </div>
                    </div>
                    
                    <div class="tile-footer">
                       
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.reward-report.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection