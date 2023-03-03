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

<div class="box box-primary">
    <div class="box-header">

    </div>
    <div class="box-body">
        <form  method="post" method="POST" action="{{route('user.updateAsOperator', $user)}}">
            @csrf
            @method('patch')
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Lengkap') }}</label>

                <div class="col-md-6">
                    <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                        name="nama" required autocomplete="off" autofocus value="{{ Auth::user()->nama }}">

                    @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email"
                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" autocomplete="off" value="{{ Auth::user()->email }}" required>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Jabatan') }}</label>
                <div class="col-md-6">
                    <input id="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror"
                        name="jabatan" autocomplete="off" value="{{ Auth::user()->jabatan }}" required>

                    @error('jabatan')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <br>
            <div class="form-group row">
                <div class="col-md-4"></div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-flat btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
