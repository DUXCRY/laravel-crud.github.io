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
@php $KG = new KeyGenerator(); @endphp
<div class="box">
    <div class="box-header" style="display: flex">
        <div id="export_product" style="margin-right: 10px;"></div>
        <a name="" id="" class="show-modal btn btn-primary btn-flat btn-block" href="#" role="button"
            data-toggle="modal" data-target="#modal-create-product"><i class="fa fa-plus"
                style="font-weight: normal !imporant;"></i> Tambah Data
        </a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th>Nama</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">Design</th>
                        <th scope="col">Material</th>
                        <th scope="col">Harga (Rp)</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item)
                        <tr class="data-row">
                            <td>{{ $index+1 }}.</td>
                            <td class="pd_nama">{{ $item->pd_nama }}</td>
                            <td class="pd_kategori">{{ $item->pd_kategori }}</td>
                            <td class="pd_brand">{{ $item->pd_brand }}</td>
                            <td class="pd_tipe">{{ $item->pd_tipe }}</td>
                            <td class="pd_design">{{ $item->pd_design }}</td>
                            <td class="pd_material">{{ $item->pd_material }}</td>
                            <td class="pd_harga">{{number_format($item->pd_harga, 0 , ',', '.' ) }}</td>
                            <td>
                                <a href="javascript:void(0)" id="edit-item-product" data-item-id="{{ $item->pd_id }}"
                                    data-url-edit="{{ url('product', $item->pd_id)}}">
                                    <i class="fa fa-edit" style="margin-right: 20px; color: #2196f3; font-size: 16px;"></i>
                                </a>
                                <a  href="javascript:void(0)" id="delete-item-product"
                                    data-item-id="{{ $item->pd_id }}"
                                    data-nama="{{ $item->pd_nama}}"
                                    data-url-delete="{{ url('product', $item->pd_id) }}">
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
@include('product.create')
@include('product.edit')
@include('product.delete')
<!-- /.box -->
@endsection
