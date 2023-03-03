@extends('layouts.app')

@section('content')

@if ($errors->all())
<div class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
</div>
@endif

@if (session('status'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i>{{ session('status') }}</h4>
</div>
@endif
<div class="box">
    <div class="box-header" style="display: flex">
        <div id="export_progress" style="margin-right: 10px;"></div>
        <a name="" id="" class="show-modal btn btn-primary btn-flat btn-block" href="#" role="button"
            data-toggle="modal" data-target="#modal-create-progress"><i class="fa fa-plus"
                style="font-weight: normal !imporant;"></i> Tambah Data
        </a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">Kode Project</th>
                        <th scope="col">Periode</th>
                        <th scope="col">Progress (%)</th>
                        <th scope="col">Act Cost</th>
                        <th scope="col">Outstanding Issues</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $pg)

                    <tr class="data-row">
                        <td class="pg_kd_project">{{$pg->kd_project}}</td>
                        <td class="pg_periode">{{$pg->pg_periode}}</td>
                        <td class="pg_progres">{{$pg->pg_progres}}</td>
                        <td class="pg_act_cost">{{number_format($pg->pg_act_cost, 0 , ',', '.') }}</td>
                        <td class="pg_ots">{{$pg->pg_outstanding_issues}}</td>
                        <td>
                            <a href="javascript:void(0)" id="edit-item-progress" data-item-id="{{ $pg->pg_id }}"
                                data-url-edit="{{ url('progress', $pg->pg_id)}}">
                                <i class="fa fa-edit" style="margin-right: 20px; color: #2196f3; font-size: 16px;"></i>
                            </a>
                            <a  href="javascript:void(0)" id="delete-item-progress"
                                data-item-id="{{ $pg->pg_id }}"
                                data-nama="{{ $pg->pg_periode }}"
                                data-url-delete="{{ url('progress', $pg->pg_id) }}">
                                <i class="fa fa-trash" style="color: #f44336; font-size: 16px;"></i>
                            </a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
    @include('progress.create')
    @include('progress.edit')
    @include('progress.delete')
</div>
<!-- /.box -->
@endsection
