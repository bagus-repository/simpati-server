@extends('layouts.app')

@section('content')
<div class="animated fadeIn">
    <a href="{{ route('classifies.index') }}" class="btn btn-primary btn-xs"><i class="fa fa-chevron-left"></i> Kembali ke list</a>
    <h3 class="mb-2">Update Klasifikasi</h3>
    <div class="row">
        <div class="col-md-10">
            @include('layouts.partials.alert')
            <div class="card">
                <div class="card-body">
                    <div class="text-right">
                        <span class="required-label">*</span> wajib
                    </div>
                    <form action="{{ route('classifies.update', $classify->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Nama <span class="required-label">*</span></label>
                            <input type="text" class="form-control" name="nama" value="{{ $classify->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jabatan <span class="required-label">*</span></label>
                            <input type="text" class="form-control" name="jabatan" value="{{ $classify->jabatan }}" required>
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
@include('control.text_editor')
@endsection
