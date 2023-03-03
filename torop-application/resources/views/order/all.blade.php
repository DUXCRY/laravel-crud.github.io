@extends('layouts.app')

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
   {{--  <div class="box-header" style="display: flex">
        <a name="" id="" class="btn btn-primary btn-flat btn-block" href="{{ route('order.create') }}" role="button">
            <i class="fa fa-plus"style="font-weight: normal !imporant;"></i> Tambah Data
        </a>
    </div> --}}
    <div class="box-header" style="display: flex">
        <a name="" id="" class="show-modal btn btn-primary btn-flat btn-block" href="#" role="button" data-toggle="modal"
            data-target="#modal-create"><i class="fa fa-plus" style="font-weight: normal !imporant;"></i> Tambah Data
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $order)
                    <tr class="data-row">
                        <td>{{ $index+1 }}</td>
                        <td class="kd_project">{{ $order->kd_project }}</td>
                        <td>{{ $order->pj_nama }}</td>
                        {{-- <td><a href="{{ route('item.index','order_id='.$order->order_id) }}" role="button" class="btn btn-default btn-sm btn-flat"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</a>
                        </td> --}}

                        <td style="display: flex">
                            {{-- <a href="javascript:void(0)" id="edit-item-order" data-order-id="{{ $order->order_id }}"
                                data-url-edit="{{ url('order', $order->order_id)}}" role="button" class="btn btn-warning btn-flat btn-sm">
                                <i class="fa fa-edit"></i>
                            </a> --}}
                            <a href="{{ route('order.print', $order->order_id) }}" target="_blank" class="btn btn-default btn-sm btn-flat" style="margin-right: 5px"><i class="fa fa-print" aria-hidden="true"></i></a>
                            <a href="{{ route('order.edit', $order->order_id) }}" class="btn btn-warning btn-sm btn-flat" style="margin-right: 5px"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a  href="javascript:void(0)" id="delete-item-order" data-item-id="{{ $order->order_id }}"
                                data-nama="{{ $order->pj_nama }}"
                                data-url-delete="{{ url('order', $order->order_id) }}" role="button" class="btn btn-danger btn-flat btn-sm" >
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
</div>
{{-- @include('order.edit')
 --}}
@include('order.modal_create')
@include('order.delete')
<!-- /.box -->
@endsection
