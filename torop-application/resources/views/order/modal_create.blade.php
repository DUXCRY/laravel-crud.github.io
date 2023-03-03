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

<div class="modal fade" id="modal-create" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Tambah Data Order</h4>

            </div>
            <div class="modal-body">
                <form action="{{route('order.store')}}" method="post">
                    @csrf
                   <div class="form-group">
                     <label for="">Project</label>
                     <select class="form-control select2-sorter" name="kd_project" id="">
                       <option selected disabled>Pilih Project</option>
                       @foreach ($data_pj as $pj)
                           <option value="{{ $pj->kd_project }}">{{ $pj->pj_nama }}</option>
                       @endforeach
                     </select>
                   </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="submit">Buat Order</button>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- @endsection --}}
