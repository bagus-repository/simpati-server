@extends('layouts.app')

@section('content')
<div class="animated fadeIn">
    <a href="{{ route('news.index') }}" class="btn btn-primary btn-xs"><i class="fa fa-chevron-left"></i> Kembali ke list</a>
    <h3 class="mb-2">Buat Berita</h3>
    <div class="row">
        <div class="col-md-10">
            @include('layouts.partials.alert')
            <div class="card">
                <div class="card-body">
                    <div class="text-right">
                        <span class="required-label">*</span> wajib
                    </div>
                    <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Judul <span class="required-label">*</span></label>
                            <input type="text" class="form-control input-counter" name="title" maxlength="200" required>
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi <span class="required-label">*</span></label>
                            <textarea name="desc" rows="3" class="form-control html-editor"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Thumbnail <span class="required-label">*</span></label>
                            <input type="file" name="thumbnail" class="form-control" accept=".jpg" required>
                            <span class="text-muted">Format : .jpg Maks. 512Kb</span>
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
