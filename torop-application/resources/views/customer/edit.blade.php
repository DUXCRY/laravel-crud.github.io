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

<div class="modal fade" id="edit-modal-customer" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Ubah Data Customer</h4>

            </div>
            <div class="modal-body">
                <form id="edit-form-customer" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="">Nama Customer</label>
                        <input type="text" name="cs_nama" id="modal-input-nama" class="form-control" placeholder=""
                            {{--value="{{$data->decrypt($customer->cs_nama)}}"--}}>
                    </div>
                    <div class="form-group">
                        <label for="">alamat</label>
                        <textarea type="text" name="cs_alamat" id="modal-input-alamat" class="form-control"
                            placeholder="">{{--{{$data->decrypt($customer->cs_alamat)}}--}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">No.Telp</label>
                        <input type="text" name="cs_notelp" id="modal-input-notelp" class="form-control" placeholder=""
                            {{--value="{{$data->decrypt($customer->cs_notelp)}}"--}}>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="cs_email" id="modal-input-email" class="form-control" placeholder=""
                            {{--value="{{$data->decrypt($customer->cs_email)}}"--}}>
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

{{--@endsection--}}
