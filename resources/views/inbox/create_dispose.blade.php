@extends('layouts.app')

@section('content')
<div class="animated fadeIn">
    <a href="{{ route('inboxes.dispose', $inbox) }}" class="btn btn-primary btn-xs"><i class="fa fa-chevron-left"></i> Kembali ke list</a>
    <h3 class="mb-2">Buat Disposisi {{ $inbox->nomor }}</h3>
    <div class="row">
        <div class="col-md-12">
            @include('layouts.partials.alert')
            <div class="card">
                <div class="card-body">
                    <div class="text-right">
                        <span class="required-label">*</span> wajib
                    </div>
                    <form action="{{ route('inboxes.dispose.store', $inbox) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="">Kepada <span class="required-label">*</span></label>
                                    <select name="classifies_id" class="form-control" required>
                                        @foreach ($classifies as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama . " ($item->jabatan)" }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Batas Waktu <span class="required-label">*</span></label>
                                    <input type="text" class="form-control datepicker" name="batas_waktu" required autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="">Ringkasan <span class="required-label">*</span></label>
                                    <textarea class="form-control" rows="3" name="ringkasan" maxlength="1000" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea class="form-control" rows="3" name="keterangan" maxlength="1000"></textarea>
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
