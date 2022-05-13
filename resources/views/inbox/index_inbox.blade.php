@extends('layouts.app')

@section('content')
<div class="animated fadeIn">
    <h3 class="mb-2">Daftar Surat Masuk</h3>
    <div class="row">
        <div class="col-12">
            @include('layouts.partials.alert')
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('inboxes.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatables">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nomor</th>
                                    <th>Pengirim</th>
                                    <th>Penerima</th>
                                    <th>Tanggal Surat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inboxes as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nomor }}</td>
                                    <td>{{ $item->pengirim }}</td>
                                    <td>{{ $item->penerima }}</td>
                                    <td>{{ $item->tgl_surat }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-primary btn-sm dropdown-toggle" href="javascript:void(0)" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Pilih Opsi
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="{{ route('inboxes.edit', $item->id) }}">Edit</a>
                                                <a class="dropdown-item" href="{{ route('inboxes.dispose', $item) }}">Disposisi</a>
                                                <form action="{{ route('inboxes.destroy', $item->id) }}" method="post" id="delete-{{ $item->id }}" onsubmit="return confirm('Anda yakin ?')">
                                                    @csrf
                                                    @method('DELETE')
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