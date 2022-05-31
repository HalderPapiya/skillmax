<div class="tile">
    <form action="{{ route('admin.changepassword.save') }}" method="POST" role="form" id="formpassword">
        @csrf
        <h3 class="tile-title">Change Password</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="site_name">Current Password</label>
                <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" autofocus="" placeholder="Old password" value="{{old('old_password')}}">
                            @error('old_password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
            @error('current_password') <p class="small text-danger">{{$message}}</p> @enderror
            <div class="form-group">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="New password" value="{{ old('password') }}">
                            @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
            <div class="form-group">
                <label class="control-label" for="site_title">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm password" value="{{ old('password_confirmation') }}">
                     @error('password_confirmation')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>
        <!-- <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Password</button>
                </div>
            </div>
        </div> -->
    </form>
</div>