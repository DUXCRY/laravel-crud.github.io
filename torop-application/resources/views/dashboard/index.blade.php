@extends('layouts.app')

@section('content')
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong style="font-weight: normal"><i class="icon fa fa-check"></i>Selamat datang <b>{{ Auth::user()->nama }}</b> anda
        login sebagai <b>{{ Auth::user()->roles }}</b></strong> </br>
    <span style="margin-left: 25px">Untuk mengelola data silahkan pilih menu yang ada di Sidebar.</span>
</div>
<div class="col-lg-3 col-xs-3">
    <div class="small-box bg-yellow">
        <div class="inner">
            <h3>{{ $t_cs }}</h3>

            <p>Total Customer</p>
        </div>
        <div class="icon">
            <i class="fa fa-users"></i>
        </div>
        <a href="{{ route('customer.index') }}" class="small-box-footer">More info <i
                class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-xs-3">
    <div class="small-box bg-aqua">
        <div class="inner">
            <h3>{{ $t_pd }}</h3>

            <p>Total Product</p>
        </div>
        <div class="icon">
            <i class="fa fa-cubes"></i>
        </div>
        <a href="{{ route('product.index') }}" class="small-box-footer">More info <i
                class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-xs-3">
    <div class="small-box bg-green">
        <div class="inner">
            <h3>{{ $t_pj->count() }}</h3>

            <p>Total Project</p>
        </div>
        <div class="icon">
            <i class="fa fa-pie-chart"></i>
        </div>
        <a href="{{ route('project.index') }}" class="small-box-footer">More info <i
                class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-xs-3">
    <div class="small-box bg-red">
        <div class="inner">
            <h3>{{ $t_od }}</h3>

            <p>Total Order</p>
        </div>
        <div class="icon">
            <i class="fa fa-shopping-bag"></i>
        </div>
        <a href="{{ route('order.index') }}" class="small-box-footer">More info <i
                class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
<div id="graph"></div>
@endsection
