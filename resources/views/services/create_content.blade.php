@extends('layouts.app')

@section('content')
<div class="animated fadeIn">
    <a href="{{ route('services.index') }}" class="btn btn-primary btn-xs"><i class="fa fa-chevron-left"></i> Kembali ke list</a>
    <h3 class="mb-2">Buat Pelayanan</h3>
    <div class="row">
        <div class="col-md-10">
            @include('layouts.partials.alert')
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('services.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="{{ $type->lookup_value }}">
                        <div class="form-group">
                            <label for="">Nama Pelayanan</label>
                            <input type="text" class="form-control" name="name" value="{{ $type->lookup_desc }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Isi Konten</label>
                            <textarea name="content" rows="3" class="form-control html-editor"></textarea>
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
