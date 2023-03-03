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
        <div id="buttons" style="margin-right: 10px;"></div>
        @if (Auth::user()->roles == 'Administrator')
        <a name="" id="" class="show-modal btn btn-primary btn-flat btn-block" href="#" role="button"
            data-toggle="modal" data-target="#modal-create-user"><i class="fa fa-plus"
                style="font-weight: normal !imporant;"></i> Tambah Data
        </a>
        @endif
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Jabatan</th>
                        <th>Roles</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="data-row">
                        <td class="nama">{{ $user->nama }}</td>
                        <td class="email">{{ $user->email }}</td>
                        <td class="jabatan">{{ $user->jabatan }}</td>
                        <td class="roles">{{ $user->roles }}</td>
                        <td>
                            <a href="javascript:void(0)" id="edit-item-user" data-item-id="{{ $user->id }}"
                                data-url-edit="{{ url('user', $user->id)}}">
                                <i class="fa fa-edit" style="margin-right: 20px; color: #2196f3; font-size: 16px;"></i>
                            </a>
                            <a href="javascript:void(0)" id="delete-item-user" data-item-id="{{ $user->id }}"
                                data-nama="{{$user->nama}}" data-url-delete="{{ url('user',$user->id) }}">
                                <i class="fa fa-trash" style="color: #f44336; font-size: 16px;"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('user.create')
    @include('user.edit')
    @include('user.delete')
</div>
@endsection
