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
    <div class="box-header" style="display: flex">
        <div id="export_customer" style="margin-right: 10px;"></div>
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
                        <th scope="col">Customer</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No.Telp</th>
                        <th scope="col">Email</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @csrf
                    @foreach ($data as $index => $cus)
                   <tr class="data-row">
                        <td>{{ $index+1}}.</td>
                        <td class="cs_nama">{{ $cus->cs_nama }}</td>
                        <td class="cs_alamat">{{ $cus->cs_alamat }}</td>
                        <td class="cs_notelp">{{ $cus->cs_notelp }}</td>
                        <td class="cs_email">{{ $cus->cs_email }}</td>
                        <td class="aksi" style="display: flex">
                        <a href="#" id="edit-item-customer"
                        data-item-id="{{ $cus->cs_id }}"
                        data-url-edit="{{ url('customer', $cus->cs_id)}}">
                            <i class="fa fa-edit" style="margin-right: 20px; color: #2196f3; font-size: 16px;"></i>
                        </a>

                        <a  href="#" id="delete-item-customer" data-item-id="{{ $cus->cs_id }}"
                            data-nama="{{$cus->cs_nama}}"
                            data-url-delete="{{ url('customer', $cus->cs_id) }}">
                        <i class="fa fa-trash" style="color: #f44336; font-size: 16px;"></i>
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
<!-- /.box -->
@include('customer.create_caesar')
@include('customer.edit')
@include('customer.delete')

@stop
