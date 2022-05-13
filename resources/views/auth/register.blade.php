@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card mx-4">
            <div class="card-body p-4">
                <h1>Register</h1>
                <p class="text-muted">Create your account</p>
                @include('layouts.partials.alert')
                <form action="{{ route('register.submit') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-user"></i>
                            </span>
                        </div>
                        <input class="form-control" type="text" placeholder="Fullname" name="name" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input class="form-control" type="email" placeholder="Email" name="email" required>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-lock"></i>
                            </span>
                        </div>
                        <input class="form-control" type="password" placeholder="Password" name="password" required
                            minlength="8">
                    </div>
                    <small class="form-text text-muted mb-3">Password must be 8 alphanumeric</small>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-lock"></i>
                            </span>
                        </div>
                        <input class="form-control" type="password" placeholder="Repeat password" name="repassword" required>
                    </div>
                    <button class="btn btn-block btn-success" type="submit"><i class="fa fa-pencil"></i> Create Account</button>
                    <a class="btn btn-link pull-right" href="{{ route('login') }}">Login</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
