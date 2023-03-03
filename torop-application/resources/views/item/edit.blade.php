{{--
@extends('layouts.app')

@section('content')
@if ($errors->all())
<div class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
    <li>{{$error}}</li>
@endforeach
</div>
@endif
--}}
<!-- Modal -->

<div class="modal fade" id="edit-modal-item" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Ubah Data Item</h4>

            </div>
            <div class="modal-body">
                <form id="edit-form-item" method="POST">
                    @csrf
                    @method('put')
                    <input type="text" name="order_id" id="order_id" class="form-control" value="{{ $order_id = request('order_id') }}" style="display: none" readonly>
                    <div class="form-group">
                      <label for="">Product</label>
                      <select class="form-control select2" name="pd_id" id="modal-input-pd_id" data-price-awal="modal-input-price-awal">
                        @foreach ($data_pd as $item)
                        <option value="{{ $item->pd_id }}" data-price="{{ $item->pd_harga }}">{{ $item->pd_nama }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                      <label for="">Quantity</label>
                      <input type="text" name="qty" id="modal-input-qty" class="form-control qty">
                    </div>
                    <div class="form-group">
                        <label for="">Unit</label>
                        <select class="form-control" name="unit" id="modal-input-unit">
                            <option value="EA">EA</option>
                            <option value="PCS">PCS</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Harga Unit (Rp)</label>
                        <input type="text" name="" id="modal-input-harga_unit" class="form-control harga_unit" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Total Harga (Rp)</label>
                        <input type="text" name="total_harga" id="modal-input-total_harga" class="form-control total_harga">
                        <small id="helpId" class="text-muted">Unit <span style="color: red !important">*</span> Harga Unit</small>
                    </div>
                    <div class="form-group">
                      <label for="">Keterangan</label>
                      <textarea class="form-control" name="keterangan" id="modal-input-keterangan" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('item.edit.script')
<script text="text/javascript">
    function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
    $('#modal-input-pd_id').on('change',function(){
        var price = $(this).children('option:selected').data('price');
        $('.qty').val('');
        $('.total_harga').val('');
        $('#modal-input-harga_unit').val(price);
    });

    $('form').delegate('.qty,.harga_unit','keyup',function(){
        var tr=$(this).parent().parent();
        var qty=tr.find('.qty').val();
        var harga_unit=tr.find('.harga_unit').val();
        var total_harga=(qty*harga_unit);
        tr.find('.total_harga').val(formatNumber(total_harga));
    });
    </script>
@endsection

{{--@endsection--}}
