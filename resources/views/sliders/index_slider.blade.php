@extends('layouts.app')

@section('content')
<div class="animated fadeIn">
    <h3 class="mb-2">Data Slider</h3>
    <div class="row">
        <div class="col-12">
            @include('layouts.partials.alert')
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('sliders.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Slider</a>
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
                                @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $slider->judul }}</td>
                                    <td>
                                        <img src="{{ asset('sliders/' . $item->file) }}" alt="Thumbnail" srcset="" width="100">
                                    </td>
                                    <td>
                                        <form action="{{ route('sliders.update', $slider->id) }}" method="post" id="sliders-update-{{ $slider->id }}">
                                            @csrf
                                            <input type="hidden" name="sts" value="{{ $slider->sts ? '1':'0' }}">
                                            <button type="submit" class="btn btn-{{ $slider->sts ? 'danger':'success' }} btn-xs">{{ $slider->sts ? 'Non-aktif':'Aktifkan' }}</button>
                                        </form>
                                        <form action="{{ route('sliders.delete', $slider->id) }}" method="post" id="delete-{{ $slider->id }}" onsubmit="return confirm('Anda yakin ?')">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
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