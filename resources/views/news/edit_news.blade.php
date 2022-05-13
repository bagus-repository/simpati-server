@extends('layouts.app')

@section('content')
<div class="animated fadeIn">
    <a href="{{ route('news.index') }}" class="btn btn-primary btn-xs"><i class="fa fa-chevron-left"></i> Kembali ke list</a>
    <h3 class="mb-2">Edit Berita</h3>
    <div class="row">
        <div class="col-md-10">
            @include('layouts.partials.alert')
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('news.update', $news->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Judul</label>
                            <input type="text" class="form-control input-counter" name="title" maxlength="200" value="{{ $news->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="desc" rows="3" class="form-control html-editor">{!! $news->desc !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Thumbnail</label>
                            <br>
                            <img src="{{ asset('uploads/' . $news->image_url) }}" alt="Thumbnail" srcset="" width="100">
                            <input type="file" name="thumbnail" class="form-control" accept=".jpg">
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
