@extends('layouts.app')

@section('content')
<div class="animated fadeIn">
    <h3 class="mb-2">Atur Pelayanan</h3>
    <div class="row">
        <div class="col-12">
            @include('layouts.partials.alert')
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelayanan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contents as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->lookup_desc }}</td>
                                    <td>
                                        @if ($item->lcontent)
                                            <a href="{{ route('services.edit', $item->lcontent->id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Update</a>
                                        @else
                                            <a href="{{ route('services.create', ['type' => $item->lookup_value]) }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Buat</a>
                                        @endif
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
@endsection