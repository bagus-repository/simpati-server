@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card-group">
            <div class="card p-4">
                <div class="card-body">
                    <div class="text-right"><img src="{{ asset('img/simpati-logo.png') }}" alt="" height="75px"></div>
                    <h1>Login</h1>
                    <p class="text-muted">Login ke akun anda</p>
                    @include('layouts.partials.alert')
                    <form class="spinner-form" action="{{ route('auth.do_login') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-envelope"></i>
                                </span>
                            </div>
                            <input class="form-control" type="email" placeholder="Email" name="email" required>
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-lock"></i>
                                </span>
                            </div>
                            <input class="form-control" type="password" placeholder="Password" name="password" minlength="6" required>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary px-4" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
