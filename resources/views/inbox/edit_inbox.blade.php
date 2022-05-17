@extends('layouts.app')

@section('content')
<div class="animated fadeIn">
    <a href="{{ route('inboxes.index') }}" class="btn btn-primary btn-xs"><i class="fa fa-chevron-left"></i> Kembali ke list</a>
    <h3 class="mb-2">Update Surat Masuk</h3>
    <div class="row">
        <div class="col-md-10">
            @include('layouts.partials.alert')
            <div class="card">
                <div class="card-body">
                    <div class="text-right">
                        <span class="required-label">*</span> wajib
                    </div>
                    <form action="{{ route('inboxes.update', $inbox) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nomor Surat <span class="required-label">*</span></label>
                                    <input type="text" class="form-control input-counter" name="nomor" value="{{ $inbox->nomor }}" maxlength="50" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Pengirim <span class="required-label">*</span></label>
                                    <input type="text" class="form-control input-counter" name="pengirim" value="{{ $inbox->pengirim }}" maxlength="200" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Penerima <span class="required-label">*</span></label>
                                    <input type="text" class="form-control input-counter" name="penerima" value="{{ $inbox->penerima }}" maxlength="200" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Ringkasan <span class="required-label">*</span></label>
                                    <textarea class="form-control input-counter" rows="3" name="ringkasan" maxlength="1000" required>{{ $inbox->ringkasan }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tgl Surat <span class="required-label">*</span></label>
                                    <input type="text" class="form-control datepicker" name="tgl_surat" value="{{ $inbox->tgl_surat }}" required autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="">Tgl Diterima <span class="required-label">*</span></label>
                                    <input type="text" class="form-control datepicker" name="tgl_diterima" value="{{ $inbox->tgl_diterima }}" required autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea name="keterangan" rows="3" class="form-control input-counter">{{ $inbox->keterangan }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Upload File <span class="required-label">*</span></label>
                                    @if ($inbox->file)
                                        <br>
                                        <a href="{{ asset('inbox/' . $inbox->file) }}" class="btn btn-sm btn-primary mb-2"><i class="fa fa-download"></i> Download</a>
                                    @endif
                                    <input type="file" class="form-control" name="file" accept=".jpg,.png,.pdf">
                                    <small class="text-muted">Format file : .jpg/.png/.pdf Maks. 5Mb</small>
                                </div>
                            </div>
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
