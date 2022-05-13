@extends('layouts.app')

@section('content')
<div class="animated fadeIn">
    <h3 class="mb-2">Daftar Permintaan E-filling</h3>
    <div class="row">
        <div class="col-12">
            @include('layouts.partials.alert')
            <div class="card">
                <div class="card-body">
                    <h4>Filter By</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" method="get">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control">
                                        @foreach ($filters as $item)
                                            <option value="{{ $item->lookup_value }}" {{ $filterStatus == $item->lookup_value ? 'selected':'' }}>{{ $item->lookup_desc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered datatables">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Oleh</th>
                                    <th>Permohonan</th>
                                    <th>Tanggal</th>
                                    <th>Approval Oleh</th>
                                    <th>Approval Pada</th>
                                    <th>Status</th>
                                    <th class="no-sort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->service_no }}</td>
                                    <td>{{ $item->request_by->name }}</td>
                                    <td>{{ $item->filling_type->lookup_desc }}</td>
                                    <td>{{ $item->created_date }}</td>
                                    <td>{{ $item->approval_by ? $item->approval_by->name:'' }}</td>
                                    <td>{{ $item->apv_date }}</td>
                                    <td>{!! txtsts_efilling($item->sts) !!}</td>
                                    <td>
                                        <a target="_blank" class="btn btn-xs btn-success" href="{{ $item->file_link }}"><i class="fa fa-download"></i> Download File</a>
                                        @if ($item->sts == 0)
                                            <button class="btn btn-xs btn-primary" onclick="submitApproval(this)" data-service-no="{{ $item->service_no }}" data-service-sts="{{ $item->sts }}"><i class="fa fa-check"></i> Approval</button>
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
@include('control.datatables')
<script>
    function submitApproval(e) {
        var jqEl = $(e);
        var modal = $('#ApprovalModal');
        var form = $('#ApprovalForm');
        form.find('input[name=sts]').val(jqEl.data('service-sts'));
        form.find('input[name=service_no]').val(jqEl.data('service-no'));
        reInitInputCounter();
        modal.modal('toggle');
    }

    function changeApprovalInput(params) {
        $('#ApprovalForm').find('input[name=approval]').val(params);
    }
</script>
@endsection

@section('modals')
<div class="modal fade" tabindex="-1" role="dialog" id="ApprovalModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Buat Approval</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('efilling.approval', '') }}" method="post" id="ApprovalForm">
                @csrf
                <input type="hidden" name="sts">
                <input type="hidden" name="approval">
                <input type="hidden" name="service_no">
                <div class="form-group">
                    <label for="">Approval Note</label>
                    <textarea name="apvnote" rows="3" class="form-control input-counter" maxlength="200"></textarea>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" onclick="changeApprovalInput('rjt')" class="btn btn-danger"><i class="fa fa-times"></i> Tolak</button>
            <button type="submit" onclick="changeApprovalInput('apv')" class="btn btn-primary"><i class="fa fa-check"></i> Setujui</button>
        </div>
        </form>
      </div>
    </div>
</div>
@endsection