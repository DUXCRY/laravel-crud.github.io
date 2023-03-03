@extends('layouts.app')

@section('content')

@if (session('error'))
    <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ session('error') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ session('success') }}
    </div>
@endif

<div class="box box-primary">
    <div class="box-header">

    </div>
    <div class="box-body">
        <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
           @csrf
            <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                <label for="new-password" class="col-md-4 control-label">Current Password</label>

                <div class="col-md-6">
                    <input id="current-password" type="password" class="form-control" name="current-password" required>

                    @if ($errors->has('current-password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('current-password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                <label for="new-password" class="col-md-4 control-label">New Password</label>

                <div class="col-md-6">
                    <input id="new-password" type="password" class="form-control" name="new-password" required>

                    @if ($errors->has('new-password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('new-password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                <div class="col-md-6">
                    <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Change Password
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
