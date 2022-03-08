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