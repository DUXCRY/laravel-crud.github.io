<?php
if (isset($_POST['plaintext']))
{
    $key = $_POST['key'];

    $rc4 = new RC4($key);

    $plaintext  = $_POST['plaintext'];

    $ciphertext = $rc4->encrypt($plaintext);

    $biner_plaintext  = stringToBinary($plaintext);
    $biner_ciphertext = stringToBinary($ciphertext);

?>

<table class="table table-bordered table-striped">
    <tr style="text-align: left">
            <td colspan="2"><b>Key: </b> <?php echo $key;?></td>
    </tr>
</table>

<table class="table table-bordered table-striped">
   <thead>
   <tr style="text-align: center">
        <th></th>
        <th>Biner</th>
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
<?php } ?>
