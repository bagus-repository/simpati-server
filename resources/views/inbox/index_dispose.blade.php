@extends('layouts.app')

@section('content')
<div class="animated fadeIn">
    <h3 class="mb-2">Daftar Disposisi {{ $inbox->nomor }}</h3>
    <div class="row">
        <div class="col-12">
            @include('layouts.partials.alert')
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('inboxes.dispose.create', $inbox) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatables">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tujuan</th>
                                    <th>Isi</th>
                                    <th>Batas Waktu</th>
                                    <th>Catatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inbox->disposes as $dispose)
                                <tr>
                                    <td>{{ $dispose->id }}</td>
                                    <td>{{ $dispose->classify->nama }} ({{ $dispose->classify->jabatan }})</td>
                                    <td>{{ $dispose->ringkasan }}</td>
                                    <td>{{ $dispose->batas_waktu }}</td>
                                    <td>{{ $dispose->keterangan }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-primary btn-sm dropdown-toggle" href="javascript:void(0)" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Pilih Opsi
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="{{ route('inboxes.dispose.edit', [
                                                    'inbox' => $inbox,
                                                    'dispose' => $dispose,
                                                ]) }}">Edit</a>
                                                <form action="{{ route('inboxes.dispose.destroy', $dispose) }}" method="post" id="delete-{{ $dispose->id }}" onsubmit="return confirm('Anda yakin ?')">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item" data-btn="NC">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('control.datatables')
@endsection