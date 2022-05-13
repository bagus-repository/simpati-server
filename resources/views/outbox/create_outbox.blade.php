@extends('layouts.app')

@section('content')
<div class="animated fadeIn">
    <a href="{{ route('outboxes.index') }}" class="btn btn-primary btn-xs"><i class="fa fa-chevron-left"></i> Kembali ke list</a>
    <h3 class="mb-2">Buat Surat Keluar</h3>
    <div class="row">
        <div class="col-md-12">
            @include('layouts.partials.alert')
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('outboxes.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nomor Surat</label>
                                    <input type="text" class="form-control" name="nomor" maxlength="50" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Pengirim</label>
                                    <input type="text" class="form-control" name="pengirim" maxlength="200" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Penerima</label>
                                    <input type="text" class="form-control" name="penerima" maxlength="200" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Ringkasan</label>
                                    <textarea class="form-control" rows="3" name="ringkasan" maxlength="1000" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tgl Surat</label>
                                    <input type="text" class="form-control datepicker" name="tgl_surat" required autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="">Tgl Keluar</label>
                                    <input type="text" class="form-control datepicker" name="tgl_keluar" required autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea name="keterangan" rows="3" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Upload File</label>
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
@include('control.date_picker')
@endsection
