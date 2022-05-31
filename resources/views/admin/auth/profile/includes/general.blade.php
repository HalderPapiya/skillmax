<div class="tile">
    <form action="{{ route('admin.profile.save') }}" method="POST" role="form" id="formgeneral">
        @csrf
        <h3 class="tile-title">General Settings</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="site_name">First Name</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Enter Name"
                    id="name"
                    name="name"
                    value="{{ $user->name }}"
                />
            </div>
            {{-- <div class="form-group">
                <label class="control-label" for="site_name">Last Name</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Enter Last Name"
                    id="lName"
                    name="lName"
                    value="{{ $user->lName }}"
                />
            </div> --}}
            <div class="form-group">
                <label class="control-label" for="site_title">Email</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Enter Email ID"
                    id="email"
                    name="email"
                    value="{{ $user->email }}"
                    readonly
                />
            </div>
        </div>
    </form>
</div>