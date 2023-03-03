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


<div class="modal fade" id="modal-create" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"
    data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Tambah Data Project</h4>

            </div>
            <div class="modal-body">
                <form action="{{route('project.store')}}" method="post">
                    @csrf {{ method_field('POST') }}
                    <div class="form-group">
                        <label for="">Customer</label>
                        <select class="form-control select2" name="cs_id" id="cs_id" required>
                            <option value="" hidden>-Pilih Customer-</option>
                            @foreach ($data_cs as $key => $vendor)
                            <option value="{{ $vendor->cs_id }}">{{ $vendor->cs_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Pekerjaan</label>
                        <textarea type="text" name="pj_nama" id="pj_nama" class="form-control" placeholder=""
                            required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Nilai Kontrak</label>
                        <input type="text" name="pj_nilai_kontrak" id="money" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">PM/PIC</label>
                        <input type="text" name="pj_pic" id="pj_pic" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Tanggal Mulai</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" type="text" name="pj_tgl_mulai" id="pj_tgl_mulai"
                                class="form-control pull-right col-lg-6 datepicker"
                                value="<?php //echo date('d/M/Y'); ?>" required>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Tanggal Selesai</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" type="text" name="pj_tgl_selesai" id="pj_tgl_selesai"
                                class="form-control pull-right col-lg-6 datepicker" required>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select class="form-control" name="pj_status" id="pj_status" required>
                            <option value="" hidden>Pilih Status</option>
                            <option value="Open">Open</option>
                            <option value="Close">Close</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}
