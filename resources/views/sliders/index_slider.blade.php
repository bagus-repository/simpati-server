@extends('layouts.app')

@section('content')
<div class="animated fadeIn">
    <h3 class="mb-2">Data Slider</h3>
    <div class="row">
        <div class="col-12">
            @include('layouts.partials.alert')
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('slide.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Slider</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatables" id="sliders-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($slides as $slide)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $slide->judul }}</td>
                                    <td>
                                        <img src="{{ $slide->file_link }}" alt="Thumbnail" srcset="" width="100">
                                    </td>
                                    <td>
                                        <form action="{{ route('slide.update', $slide) }}" method="post" id="sliders-update-{{ $slide->id }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="sts" value="{{ $slide->sts ? '0':'1' }}">
                                            <button type="submit" class="btn btn-{{ $slide->sts ? 'danger':'success' }} btn-xs">{{ $slide->sts ? 'Non-aktif':'Aktifkan' }}</button>
                                        </form>
                                        <form action="{{ route('slide.destroy', $slide) }}" method="post" id="delete-{{ $slide->id }}" onsubmit="return confirm('Anda yakin ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs" data-btn="NC">Hapus</button>
                                        </form>
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