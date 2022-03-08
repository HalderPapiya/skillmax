{{-- test admin dashboaqrd. --}}



@extends('admin.app')
@section('title') Dashboard @endsection
@section('content')

<style type="text/css">
    .row-md-body.no-nav {
    margin-top: 70px;
}
</style>
<div class="fixed-row">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
    </div>
</div>
    <div class="row section-mg row-md-body no-nav">
        <div class="col-md-3 dash-card-col">
            <a href="{{route('admin.user.index')}}">
                <div class="card card-body mb-0">
                    <h5 class="mb-2">User ({{count($data->users)}})</h5>
                    <p class="small mb-0">
                        @foreach ($data->users as $key=> $user)
                            {{($loop->first ? '' : ', ').($user->fName) . ' ' .($user->lName)}}
                            @php if ($key == 2) {echo '...';break;} @endphp
                        @endforeach
                    </p>
                    {{-- <i class="fas fa-list-alt app-menu__icon fa fa-group"></i> --}}
                </div>
            </a>
        </div>
        <div class="col-md-3 dash-card-col">
            <a href="{{route('admin.user.index')}}">
                <div class="card card-body mb-0">
                    <h5 class="mb-2">Interest ({{count($data->interests)}})</h5>
                    <p class="small mb-0">
                        @foreach ($data->interests as $key=> $interest)
                            {{($loop->first ? '' : ', ').($interest->name) }}
                            @php if ($key == 2) {echo '...';break;} @endphp
                        @endforeach
                    </p>
                    {{-- <i class="fas fa-list-alt app-menu__icon fa fa-group"></i> --}}
                </div>
            </a>
        </div>
         <div class="col-md-3 dash-card-col">
            <a href="{{route('admin.user.index')}}">
                <div class="card card-body mb-0">
                    <h5 class="mb-2">Team ({{count($data->teams)}})</h5>
                    <p class="small mb-0">
                        @foreach ($data->teams as $key=> $team)
                            {{($loop->first ? '' : ', ').($team->name) }}
                            @php if ($key == 2) {echo '...';break;} @endphp
                        @endforeach
                    </p>
                    {{-- <i class="fas fa-list-alt app-menu__icon fa fa-group"></i> --}}
                </div>
            </a>
        </div>
        <div class="col-md-3 dash-card-col">
            <a href="{{route('admin.user.index')}}">
                <div class="card card-body mb-0">
                    <h5 class="mb-2">Event ({{count($data->events)}})</h5>
                    <p class="small mb-0">
                        @foreach ($data->events as $key=> $event)
                            {{($loop->first ? '' : ', ').($event->title) }}
                            @php if ($key == 2) {echo '...';break;} @endphp
                        @endforeach
                    </p>
                    {{-- <i class="fas fa-list-alt app-menu__icon fa fa-group"></i> --}}
                </div>
            </a>
        </div>
        <div class="col-md-3 dash-card-col">
            <a href="{{route('admin.user.index')}}">
                <div class="card card-body mb-0">
                    <h5 class="mb-2">Forum ({{count($data->forums)}})</h5>
                    <p class="small mb-0">
                        @foreach ($data->forums as $key=> $forum)
                            {{($loop->first ? '' : ', ').($forum->title) }}
                            @php if ($key == 2) {echo '...';break;} @endphp
                        @endforeach
                    </p>
                    {{-- <i class="fas fa-list-alt app-menu__icon fa fa-group"></i> --}}
                </div>
            </a>
        </div>
        {{-- <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon">
            <i class="icon fa fa-files-o fa-3x"></i>
                <div class="info">
                    <h4>Category Leve One</h4>
                    <p><b> {{count($categoryLvlOne)}} </b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon">
            <i class="icon fa fa-files-o fa-3x"></i>
                <div class="info">
                    <h4>Category Leve Two</h4>
                    <p><b>{{count($categoryLvlTwo)}} </b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon">
            <i class="icon fa fa-files-o fa-3x"></i>
                <div class="info">
                    <h4>Category Leve Three</h4>
                    <p><b>{{count($categoryLvlThree)}} </b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon">
            <i class="icon fa fa-files-o fa-3x"></i>
                <div class="info">
                    <h4>Category Leve Four</h4>
                    <p><b>{{count($categoryLvlFour)}} </b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon">
            <i class="icon fa fa-files-o fa-3x"></i>
                <div class="info">
                    <h4>Category Leve Five</h4>
                    <p><b>{{count($categoryLvlFive)}} </b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon">
            <i class="icon fa fa-files-o fa-3x"></i>
                <div class="info">
                    <h4>Brand</h4>
                    <p><b>{{count($brands)}} </b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon">
            <i class="icon fa fa-files-o fa-3x"></i>
                <div class="info">
                    <h4>product</h4>
                    <p><b>{{count($products)}} </b></p>
                </div>
            </div>
        </div> --}}
       
       
    </div>
@endsection