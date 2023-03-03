@extends('layouts.login')

@section('content')
<div class="page">
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto"css>
                    <div class="text-center" center>
                        <img src="{{ asset('tabler/img/logo-torop.png') }}" alt="" style="text-align: center;" width="60px" height="55px">
                        <h2>Torop Sumber Makmur</h2>
                    </div>
                    <form class="card" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card-body p-6">
                            <div class="form-group">
                                <label for="form-control-1">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <span class="custom-control-label">Remember me</span>
                                </label>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-login btn-block">{{ __('Login') }}</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center text-muted">
                        <span class="text-muted">Copyright &copy; 2022 PT. Torop Sumber Makmur</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
