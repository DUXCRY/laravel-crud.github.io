@extends('layouts.app')

@section('h1.order')
<h1>
    <a role="button" class="btn btn-default btn-flat" href="{{ url()->previous() }}">
        <i class="fa fa-arrow-circle-left"></i> Kembali</a> Daftar Order
</h1>
@endsection

@section('content')

@if ($errors->all())
<div class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
</div>
@endif

@if (session('status'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i>{{ session('status') }}</h4>
</div>
@endif
<div class="box">
    <div class="box-header" style="display: flex">
        <a name="" id="" class="btn btn-primary btn-flat btn-block" href="{{ route('order.create') }}" role="button">
            <i class="fa fa-plus"style="font-weight: normal !imporant;"></i> Tambah Data
        </a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Kode Project</th>
                        <th scope="col">Nama Project</th>
                        <th scope="col">Items</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $order)
                    <tr class="data-row">
                        <td>{{ $index+1 }}.</td>
                        <td class="kd_project">{{ $order->kd_project }}</td>
                        <td>{{ $order->pj_nama }}</td>
                        <td><a href="item?order_id={{ $order->order_id }}" role="button" class="btn btn-default btn-sm btn-flat"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</a>
                        </td>
                        <td>
                            <a href="javascript:void(0)" id="edit-item-order" data-order-id="{{ $order->order_id }}"
                                data-url-edit="{{ url('order', $order->order_id)}}" role="button" class="btn btn-warning btn-flat btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a  href="javascript:void(0)" id="delete-item-order"
                                data-nama=""
                                data-url-delete="{{ url('order', $order->order_id) }}" role="button" class="btn btn-danger btn-flat btn-sm">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->

    @include('order.delete')
</div>
<!-- /.box -->
@endsection
