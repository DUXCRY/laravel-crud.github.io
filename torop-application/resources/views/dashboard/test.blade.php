@extends('layouts.app')

@section('content')

@php
    use App\Helpers\RC4_fix;
    use App\Helpers\help;

    $help = new help();
    $key = '2369';

    $rc4 = new RC4_fix($key);

    $plaintext  = 'DADAN';

    $ciphertext = $rc4->encrypt($plaintext);

    $biner_plaintext  = $help->stringToBinary($plaintext);
    $biner_ciphertext = $help->stringToBinary($ciphertext);
@endphp

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Striped Full Width Table</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <table class="table table-striped">
            <thead>
                <tr >
                     <th></th>
                     <th style="text-align: center">Biner</th>
                 </tr>
                </thead>
                 <tbody>
                 <tr style="text-align: center">
                     <td><b>Plaintext: </b><?php echo $plaintext;?></td>
                     <td>
                         <?PHP echo $biner_plaintext?>
                     </td>
                 </tr>
                 <tr style="text-align: center" >
                     <td ><b>XOR: </b><?php $rc4->key_xor(); ?></td>
                     <td>
                         <?PHP $rc4->biner_xor();?>
                     </td>
                 </tr>
                 <tr style="text-align: center">
                     <td><b>Ciphertext: </b><?php echo $ciphertext;?></td>
                     <td>
                         <?PHP echo $biner_ciphertext?>
                     </td>
                 </tr>
                 </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
@endsection
