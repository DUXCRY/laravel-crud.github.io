@extends('layouts.app')

@section('content')
@if (session('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{ session('error') }}
</div>
@endif
@if (session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {!! session('success') !!}
</div>
@endif
<section class="invoice">
      <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> PT. Torop Sumber Makmur
                <small class="pull-right">Date: {{ date('d/m/Y') }}</small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
                <strong>PT. Torop Sumber Makmur</strong><br>
                Jln. Pangeran Jayakarta 68 Blok B No. 23<br>
                Jakarta, Indonesia<br>
                Phone: 0216498323<br>
                Email: sales@tms.com
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            To
            <address>
                @foreach ($data_pj as $pj)
                <strong>{{ $pj->cs_nama }}</strong><br>
                {{ $pj->cs_alamat }}<br>
                Phone: {{ $pj->cs_notelp }}<br>
                Email: {{ $pj->cs_email }}
            </address>
            @endforeach
        </div>
        <div class="col-sm-4 invoice-col">
            Project
            <address>
                @foreach ($data_pj as $pj)
                <strong>{{ $pj->pj_nama }}</strong><br>
            </address>
            @endforeach
            <div class="col-xs-12">
                <a href="{{ route('order.print', $orders->order_id) }}" target="_blank" class="btn btn-default pull-right " style="width:120px"><i class="fa fa-print"></i>
                    Print</a>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
          @foreach ($data_od as $order)
            <form action="{{ route('order.update', ['order_id' => $order->order_id]) }}" method="post">
          @endforeach
                @csrf
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Unit</th>
                            <th>Harga Unit</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_it as $index => $item)
                        <tr>
                            <td>{{ $index+1 }}.</td>
                            <td>{{ $item->pd_nama }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>Rp. {{ number_format($item->pd_harga, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($item->qty * $item->pd_harga, 0, ',', '.') }} </td>
                            <td>
                                <a  href="javascript:void(0)" id="delete-item-item"
                                    data-nama="{{ $item->pd_nama }}"
                                    data-url-delete="{{ route('order.delete_product', ['id' => $item->id]) }}" role="button" class="btn btn-danger btn-flat btn-sm">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td>
                                <input type="hidden" name="_method" value="PUT" class="form-control">
                                <select name="pd_id" class="form-control select2-sorter">
                                    <option selected disabled>Pilih Produk</option>
                                    @foreach ($data_pd as $product)
                                    <option value="{{ $product->pd_id }}">{{ $product->pd_nama }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td style="width: 8%">
                                <input type="text" min="1" value="1" name="qty" class="form-control" required>
                            </td>
                            <td>
                                <select name="unit" class="form-control select2">
                                    <option selected disabled>Pilih Unit</option>
                                    <option value="EA">EA</option>
                                    <option value="PCS">PCS</option>
                                </select>
                            </td>
                            <td colspan="3">
                                <button class="btn btn-primary btn-sm btn-flat">Tambahkan</button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="width:25%">Subtotal</th>
                            <td style="width: 5%">:</td>
                            @foreach ($data_od as $item)
                            <td>Rp. {{number_format($item->total, 0, ',','.') }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Tax (10%)</th>
                            <td>:</td>
                           @foreach ($data_od as $item)
                           <td>Rp. {{ number_format($item->tax, 0, ',','.') }}</td>
                           @endforeach
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>:</td>
                            @foreach ($data_od as $item)
                           <td>Rp. {{ number_format($item->total_harga, 0, ',','.') }}</td>
                           @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- <div class="row no-print">
        <div class="col-xs-12">
            <a href="{/{ route('order.print', $orders->order_id) }}" target="_blank" class="btn btn-default pull-right "><i class="fa fa-print"></i>
                Print</a>
        </div>
    </div>-->

</section>
@include('item.delete')
@endsection
