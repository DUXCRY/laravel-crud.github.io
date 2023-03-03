<div class="modal fade" id="modal-create" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Tambah Data Item</h4>

            </div>
            <div class="modal-body">
                <form action="{{route('item.store')}}" method="post">
                    @csrf
                    <input type="text" name="order_id" class="form-control" value="{{ Request('order_id') }}" style="display: none">
                    <div class="form-group">
                      <label for="">Product</label>
                      <select class="form-control select2" name="pd_id" id="pd_id" required>
                        <option selected disabled>Pilih Product</option>
                        @foreach ($data_pd as $item)
                        <option value="{{ $item->pd_id }}" data-price="{{ $item->pd_harga }}">{{ $item->pd_nama }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="">Qty</label>
                        <input type="text" name="qty" class="form-control qty" required>
                    </div>
                   <div class="form-group">
                     <label for="">Unit</label>
                     <select class="form-control" name="unit">
                       <option value="EA">EA</option>
                       <option value="PCS">PCS</option>
                     </select>
                   </div>
                    <div class="form-group">
                        <label for="">Harga Unit (Rp)</label>
                        <input type="text" name="" id="harga_unit" class="form-control harga_unit" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Total Harga (Rp)</label>
                        <input type="texet" name="total_harga" id="total_harga" class="form-control total_harga" readonly>
                    </div>
                    <div class="form-group">
                      <label for="">Keterangan (Optional)</label>
                      <textarea class="form-control" name="keterangan" id="" rows="3"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="submit">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
@section('item.create.script')
<script text="text/javascript">

$('#pd_id').on('change',function(){
    var price = $(this).children('option:selected').data('price');
    $('.qty').val('');
    $('.total_harga').val('');
    $('#harga_unit').val(price);
});

$('form').delegate('.qty,.harga_unit','keyup',function(){
    var tr=$(this).parent().parent();
    var qty=tr.find('.qty').val();
    var harga_unit=tr.find('.harga_unit').val();
    var total_harga=(qty*harga_unit);
    tr.find('.total_harga').val(total_harga);
});
</script>
@endsection
{{-- @endsection --}}
