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
@if (session('progress'))
@section('progress_script')
<script type="text/javascript">
    $(function () {
        $('#modal-progress').modal('show');
    });

</script>
@endsection
@endif
<div class="box">
    <div class="box-header" style="display: flex">
        <div id="export_project" style="margin-right: 10px;"></div>
        <a name="" id="" class="show-modal btn btn-primary btn-flat btn-block" href="javascript:void(0)" role="button"
            data-toggle="modal" data-target="#modal-create"><i class="fa fa-plus"
                style="font-weight: normal !imporant;"></i> Tambah Data
        </a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Pekerjaan</th>
                        <th hidden></th>
                        <th>Customer</th>
                        <th>PM/PIC</th>
                        <th>Nilai Kontrak (Rp)</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>Progress</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $project)

                        <tr class="data-row">
                            <td class="kd_project">{{$project->kd_project}}</td>
                            <td class="pj_nama">{{$project->pj_nama}}</td>
                            <td class="pj_cs" hidden>{{ $project->cs_id }}</td>
                            <td class="">{{$project->cs_nama}}</td>
                            <td class="pj_pic">{{$project->pj_pic}}</td>
                            <td class="pj_nilai_kontrak">{{number_format($project->pj_nilai_kontrak, 0 , ',', '.')}}</td>
                            <td class="pj_tgl_mulai">{{$project->pj_tgl_mulai}}</td>
                            <td class="pj_tgl_selesai">{{$project->pj_tgl_selesai}}</td>
                            <td>
                                <a role="button" class="btn btn-default btn-sm btn-flat"
                                    href='progress?kd_project={{$project->kd_project }}'
                                    onclick="Progress('{{ $project->kd_project }}')">Progress</a>
                            </td>
                            <td>
                                <form action="{{ route('order.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="kd_project" value="{{ $project->kd_project }}" class="form-control">
                                    <button class="btn btn-default btn-flat btn-sm">Order</button>
                                </form>
                            </td>
                           {{--  <td>
                                <a role="button" class="btn btn-default btn-sm btn-flat"
                                href='order?kd_project={{ $project->kd_project }}'
                                onclick="Order('{{ $project->kd_project }}')">Order</a>
                            </td> --}}

                            @if ($project->pj_status == "Open")
                            <td class="pj_status"><span class="label label-warning" style="font-weight: normal !important;">Open</span></td>
                            <td>
                                <a href="javascript:void(0)" id="edit-item-project"
                                data-item-id="{{ $project->kd_project }}"
                                data-url-edit="{{ url('project', $project->kd_project) }}">
                                <i class="fa fa-edit" style="margin-right: 20px; color: #2196f3; font-size: 16px;"></i>
                                </a>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#cant-delete-project"
                                data-backdrop="false">
                                <i class="fa fa-trash" style="color: #f44336; font-size: 16px;"></i>
                                </a>
                            </td>
                            @elseif($project->pj_status == "Close")
                            <td class="pj_status"><span class="label label-success" style="font-weight: normal !important;" id="pj_status">Close</span></td>
                            <td>
                                <a href="javascript:void(0)" id="edit-item-project"
                                data-item-id="{{ $project->kd_project }}"
                                data-url-edit="{{ url('project', $project->kd_project) }}">
                                <i class="fa fa-edit" style="margin-right: 20px; color: #2196f3; font-size: 16px;"></i>
                                </a>
                                <a href="javascript:void(0)" id="delete-item-project"
                                data-item-id="{{ $project->kd_project }}"
                                data-nama="{{ $project->pj_nama }}"
                                data-url-delete="{{ url('project', $project->kd_project) }}">
                                <i class="fa fa-trash" style="color: #f44336; font-size: 16px;"></i>
                            </a>
                            </td>
                            @endif
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
    @include('project.create')
    @include('project.edit')
    @include('project.delete')

</div>
<script type="text/javascript">
    function Progress(kd_project) {
        $.ajax({
            type: "GET",
            url: "progress",
            data: "kd_project=" + kd_project
        });
    }

</script>

@endsection
