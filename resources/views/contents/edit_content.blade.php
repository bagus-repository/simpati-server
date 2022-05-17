@extends('layouts.app')

@section('content')
<div class="animated fadeIn">
    <a href="{{ route('contents.index') }}" class="btn btn-primary btn-xs"><i class="fa fa-chevron-left"></i> Kembali ke list</a>
    <h3 class="mb-2">Update Konten</h3>
    <div class="row">
        <div class="col-md-10">
            @include('layouts.partials.alert')
            <div class="card">
                <div class="card-body">
                    <div class="text-right">
                        <span class="required-label">*</span> wajib
                    </div>
                    <form action="{{ route('contents.update', $content) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Nama Konten <span class="required-label">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ $content->header->lookup_desc }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Isi Konten <span class="required-label">*</span></label>
                            <textarea name="content" rows="3" class="form-control html-editor">{!! $content->content !!}</textarea>
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
