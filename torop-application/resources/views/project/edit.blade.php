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

<div class="modal fade" id="edit-modal-project" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Ubah Data Project</h4>

            </div>
            <div class="modal-body">
                <form id="edit-form-project" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="">Customer</label>
                        <select class="form-control select2" name="cs_id" id="modal-input-cs">
                            @foreach ($data_cs as $key => $vendor)
                            <option value="{{ $vendor->cs_id }}">{{ $vendor->cs_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Pekerjaan</label>
                        <textarea type="text" name="pj_nama" id="modal-input-nama" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">PM/PIC</label>
                        <input type="text" name="pj_pic" id="modal-input-pic" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nilai Kontrak</label>
                        <input type="text" name="pj_nilai_kontrak" id="modal-input-nilai_kontrak"
                            class="form-control">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Tanggal Mulai</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" type="text" name="pj_tgl_mulai" id="modal-input-tgl_mulai"
                                class=" form-control datepicker">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Tanggal Selesai</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" type="text" name="pj_tgl_selesai" id="modal-input-tgl_selesai"
                                class=" form-control datepicker">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select class="form-control" name="pj_status" id="modal-input-status" required>
                            <option value="Open">Open</option>
                            <option value="Close">Close</option>
                        </select>
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
{{-- @endsection --}}
