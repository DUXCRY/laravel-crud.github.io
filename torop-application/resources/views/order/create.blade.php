@extends('layouts.app')

@section('content')
@if ($errors->all())
<div class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
</div>
@endif
@php
$KG = new KeyGenerator();
@endphp
<div class="box box-default">
    <div class="box-header">

    </div>
    <div class="box-body">
        <div class="col-md-12 col-sm-12">
            <form action="{{ route('order.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Project</label>
                    <select class="form-control select2" name="kd_project" id="kd_project">
                        <option disabled selected>Pilih Project</option>
                        @foreach ($projects as $project)
                        @php
                        $prepare = $KG->DekripUUID($project->uuid);
                        $data = $KG->prepare_data($prepare);
                        @endphp
                        <option value="{{ $project->kd_project }}">
                            {{ $data->decrypt($project->pj_nama) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="250">Product</th>
                                <th width="70">Qty</th>
                                <th>Unit</th>
                                <th>Harga Unit (Rp)</th>
                                <th>Keterangan (Optional)</th>
                                <th hidden></th>
                                <th>Jumlah (Rp)</th>
                                <th><a href="#" class="addRow"><i class="glyphicon glyphicon-plus"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control select2" name="pd_id[]" id="pd_id">
                                            <option disabled selected>Pilih Product</option>
                                            @foreach ($products as $item)
                                            @php
                                            $prepare = $KG->DekripUUID($item->uuid);
                                            $data = $KG->prepare_data($prepare);
                                            @endphp
                                            <option value="{{ $item->pd_id }}" data-price="{{ $data->decrypt($item->pd_harga) }}">{{ $data->decrypt($item->pd_nama) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td><input type="text" name="qty[]" class="form-control qty"></td>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control" name="unit[]">
                                            <option value="EA" selected>EA</option>
                                            <option value="PC">PC</option>
                                        </select>
                                    </div>
                                </td>
                                <td><input type="text" name="harga_unit[]" id="harga_unit" class="form-control harga_unit" readonly></td>
                                <td><input type="text" name="keterangan[]" id="" class="form-control"></td>
                                <td hidden><input type="text" class="form-control total_harga_ed"></td>
                                <td><input type="text" name="total_harga[]" id="total_harga" class="form-control total_harga" readonly></td>
                                <td><a href="#" class="btn btn-danger remove"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td style="border: none"></td>
                                <td style="border: none"></td>
                                <td style="border: none"></td>
                                <td style="border: none"></td>
                                <td style="text-align: right;">Total Harga : </td>
                                <td><b class="total" id="money"></b> </td>
                                <td><input type="submit" name="" value="Simpan" class="btn btn-success btn-flat"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

@section('script')
    <script text="text/javascript">

    function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
    }

    $('#pd_id').on('change',function(){
        var price = $(this).children('option:selected').data('price');
        $('#harga_unit').val(formatNumber(price));
    });

    $('tbody').delegate('.qty,.harga_unit','keyup',function(){
        var tr=$(this).parent().parent();
        var qty=tr.find('.qty').val();
        var harga_unit=tr.find('.harga_unit').val();
        var harga_unit_ed = harga_unit.replace(/[.,\s]/g, '');
        var total_harga=(qty*harga_unit.replace(/[.,\s]/g, ''));
        var total_harga_ed = (qty*harga_unit_ed);
        tr.find('.total_harga_ed').val(total_harga_ed);
        tr.find('.total_harga').val(formatNumber(total_harga));
       // $('#total_harga') = total_harga_ed;
        total();
    });

    function total(){
        var total=0;
        $('.total_harga_ed').each(function(i,e){
            var total_harga_ed= $(this).val()-0;
        total +=total_harga_ed;
    });
        $('.total').html("Rp "+formatNumber(total));
    }
    $('.addRow').on('click',function(){
        addRow();
    });

    function addRow()
    {
        var tr='<tr>'+
        '<td><div class="form-group">'+
           ' <select class="form-control select2" name="pd_id[]" id="pd_ids">'+
                '<option selected disabled>Pilih Product</option>'+
                '<?php foreach($products as $index => $product) { ?>'+
                    '<?php $KG = new KeyGenerator();?>'+
                    '<?php $prepare = $KG->DekripUUID($product->uuid);?>'+
                    '<?php $data = $KG->prepare_data($prepare); ?>'+
                    '<option value="<?php echo($product->pd_id); ?>"'+
                        'data-price="<?php echo($data->decrypt($product->pd_harga)); ?>">'+
                        '<?php echo ($data->decrypt($product->pd_nama)); ?></option>'+
                    '<?php } ?>'+
            '</select>'+
        '</div></td>'+
        '<td><input type="text" name="qty[]" class="form-control qty"></td>'+
        '<td><div class="form-group">'+
           '<select class="form-control" name="unit[]">'+
                '<option value="EA">EA</option>'+
               ' <option value="PC">PC</option>'+
            '</select>'+
        '</div></td>'+
        '<td><input type="text" name="harga_unit[]" id="hag" class="form-control harga_unit" readonly></td>'+
        '<td><input type="text" name="keterangan[]" id="" class="form-control"></td>'+
        '<td hidden><input type="text" class="form-control total_harga_ed"></td>' +
        ' <td><input type="text" name="total_harga[]" class="form-control total_harga" readonly></td>'+
        '<td><a href="#" class="btn btn-danger remove"><i class="fa fa-times"></i></a></td>'+
        '</tr>';
        $('tbody').append(tr);


    $('#pd_ids').on('change',function(){
            var price = $(this).children('option:selected').data('price');
            $('#hag').val(price);
        });

    $('.remove').on('click',function() {
        var last=$('tbody tr').length;
        if(last==1){
           alert("Tidak Dapat Dihapus!");
        }
        else {
             $(this).parent().parent().remove();
        }
    });
    };



    </script>
@endsection

@endsection
