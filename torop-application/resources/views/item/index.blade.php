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
    <div class="box box-default">
        <div class="box-header" style="display: flex">
            <div id="export_order" style="margin-right: 10px;"></div>
            <a name="" id="" class="show-modal btn btn-primary btn-flat btn-block" href="javascript:void(0)" role="button"
            data-toggle="modal" data-target="#modal-create"><i class="fa fa-plus"
                style="font-weight: normal !imporant;"></i> Tambah Data
        </a>
        </div>
        <div class="box-body">
           <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped">
                <thead>
                    <th>No.</th>
                    <th hidden></th>
                    <th hidden></th>
                    <th>Nama Product</th>
                    <th>Qty</th>
                    <th>Unit</th>
                    <th>Harga Unit (Rp)</th>
                    <th>Total Harga (Rp)</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                 @foreach ($data as $index => $item)
                 <tr class="data-row">
                        <td>{{ $index+1 }}.</td>
                        <td class="order_id" hidden>{{ $item->order_id }}</td>
                        <td class="pd_id" hidden>{{ $item->pd_id }}</td>
                        <td>{{ $item->pd_nama }}</td>
                        <td class="qty">{{ $item->qty }}</td>
                        <td class="unit">{{ $item->unit }}</td>
                        <td class="harga_unit">{{number_format($item->pd_harga ,0 , ',', '.') }}</td>
                        <td class="total_harga">{{ number_format($item->total_harga ,0 , ',', '.') }}</td>
                        <td class="keterangan">{{ $item->keterangan }}</td>
                        <td>
                            <a href="javascript:void(0)" id="edit-item-item" data-item-id="{{ $item->id }}"
                                data-url-edit="{{ url('item', $item->id)}}">
                                <i class="fa fa-edit" style="margin-right: 20px; color: #2196f3; font-size: 16px;"></i>
                            </a>
                            <a  href="javascript:void(0)" id="delete-item-item"
                                data-item-id="{{ $item->id }}"
                                data-nama="{{ $item->pd_nama }}"
                                data-url-delete="{{ url('item', $item->id) }}">
                                <i class="fa fa-trash" style="color: #f44336; font-size: 16px;"></i>
                            </a>
                        </td>
                 </tr>
                 @endforeach
                </tbody>
            </table>
           </div>
        </div>
        @include('item.create')
        @include('item.edit')
        @include('item.delete')

    </div>
@endsection
