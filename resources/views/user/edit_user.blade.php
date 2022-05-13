@extends('layouts.app')

@section('content')
<div class="animated fadeIn">
    <a href="{{ route('users.index') }}" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Kembali ke list</a>
    <h3 class="mb-2">Edit User</h3>
    <div class="row">
        <div class="col-6">
            @include('layouts.partials.alert')
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" required value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password">
                            <small class="form-text text-muted">Password must be 6 or more characters</small>
                        </div>
                        <div class="form-group">
                            <label for="">Role</label>
                            <select name="role" id="" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success btn-md" type="submit"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
