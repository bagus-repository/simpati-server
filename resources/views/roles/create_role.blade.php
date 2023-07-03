@extends('layouts.app')

@section('content')
<div class="animated fadeIn">
    <a href="{{ route('users.index') }}" class="btn btn-primary btn-xs"><i class="fa fa-chevron-left"></i> Kembali ke list</a>
    <h3 class="mb-2">Create User</h3>
    <div class="row">
        <div class="col-md-6">
            @include('layouts.partials.alert')
            <div class="card">
                <div class="card-body">
                    <div class="text-right">
                        <span class="required-label">*</span> wajib
                    </div>
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Name <span class="required-label">*</span></label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Email <span class="required-label">*</span></label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password <span class="required-label">*</span></label>
                            <input type="password" class="form-control" name="password" minlength="6" required>
                            <small class="form-text text-muted">Password must be 6 or more characters</small>
                        </div>
                        <div class="form-group">
                            <label for="">Role <span class="required-label">*</span></label>
                            <select name="role" class="form-control" required>
                                @foreach ($roles as $item)
                                    <option value="{{ $item->lookup_value }}">{{ $item->lookup_desc }}</option>
                                @endforeach
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
