@extends('layouts.app')

@section('content')
<div class="animated fadeIn mt-3">
    <h3>Dashboard</h3>
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="card bg-primary">
                <div class="card-body">
                    <h2><i class="fa fa-users"></i> {{ $counter->users }}</h2>
                    <h4>Pengguna</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card bg-primary">
                <div class="card-body">
                    <h2><i class="fa fa-list"></i> {{ $counter->efilling }}</h2>
                    <h4>E-filling</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card bg-success">
                <div class="card-body">
                    <h2><i class="fa fa-inbox"></i> {{ $counter->inboxes }}</h2>
                    <h4>Surat Masuk</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card bg-red">
                <div class="card-body">
                    <h2><i class="fa fa-inbox"></i> {{ $counter->outboxes }}</h2>
                    <h4>Surat Keluar</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
