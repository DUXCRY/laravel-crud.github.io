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

<div class="modal fade" id="modal-create-progress" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Tambah Data Progress</h4>

            </div>
            <div class="modal-body">
                <form action="{{route('progress.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Kode Project</label>
                        <input type="text" name="kd_project" id="kd_project" class="form-control" value="{{ $kd_project = request('kd_project') }}" readonly required>
                    </div>
                    <div class="form-group">
                        <label>Periode</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" type="text" name="pg_periode" id="pg_periode"
                                class="form-control pull-right col-lg-6 datepicker_bot" value="<?php //echo date('d/M/Y'); ?>" required>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label for="">Progress (%)</label>
                        <input type="text" name="pg_progres" id="pg_progres" class="form-control" maxlength="3" required>
                    </div>
                    <div class="form-group">
                        <label for="">Act Cost</label>
                        <input type="text" name="pg_act_cost" id="money" class="form-control" required>
                        <small id="helpId" class="text-muted">Sisa Nilai Kontrak : Rp.
                                @foreach ($data_pj as $pgs)
                                    @php
                                    $total = 0;
                                    @endphp
                                    @foreach ($data as $item)
                                        @php
                                        $total += $item->pg_act_cost;
                                        @endphp
                                    @endforeach
                                    @if ($total == 0)
                                    {{ number_format($pgs->pj_nilai_kontrak, 2 , ',', '.' )}}
                                    @elseif($total > 0)
                                    {{ number_format($pgs->pj_nilai_kontrak - $total, 2 , ',', '.')}}
                                    @endif
                                @endforeach
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Outstanding Issues</label>
                        <input type="text" name="pg_outstanding_issues" id="pg_outstanding_issues" class="form-control"
                            placeholder="" value="-" required>
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
