@extends('layouts.app')

@section('content')
<div class="animated fadeIn">
    <h3 class="mb-2">Berita</h3>
    <div class="row">
        <div class="col-12">
            @include('layouts.partials.alert')
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('news.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Berita</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatables" id="news-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Judul</th>
                                    <th>Isi</th>
                                    <th>Gambar</th>
                                    <th>Dibuat pada</th>
                                    <th>Dibuat oleh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($news as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ \Str::limit(strip_tags($item->desc), 50, '...') }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/' . $item->image_url) }}" alt="Thumbnail" srcset="" width="100">
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-primary btn-sm dropdown-toggle" href="javascript:void(0)" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Pilih Opsi
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="{{ route('news.edit', $item->id) }}">Edit</a>
                                                <form action="{{ route('news.destroy', $item->id) }}" method="post" id="delete-{{ $item->id }}" onsubmit="return confirm('Anda yakin ?')">
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