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

<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Tambah Data Customer</h4>

            </div>
            <div class="modal-body">
                <form action="{{route('customer.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Customer</label>
                        <input type="text" name="cs_nama" id="cs_nama" class="form-control" placeholder="" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea type="text" name="cs_alamat" id="cs_alamat" class="form-control"
                            placeholder="" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">No.Telp</label>
                        <input type="text" name="cs_notelp" id="cs_notelp" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="cs_email" id="cs_email" class="form-control" placeholder=""
                            required>
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

{{-- @endsection --}}
