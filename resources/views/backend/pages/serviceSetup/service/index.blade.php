@extends('backend.layouts.master')
@section('title')
ServiceSetup - {{$title}}
@endsection

@section('styles')
<style>
.bootstrap-switch-large {
    width: 200px;
}
</style>
@endsection

@section('navbar-content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    Service Setup </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home') }}">Dashboard</a></li>
                    @if(helper::roleAccess('serviceSetup.service.index'))
                    <li class="breadcrumb-item"><a href="{{route('serviceSetup.service.index') }}">Service </a></li>
                    @endif
                    <li class="breadcrumb-item active"><span>Service  List</span></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('admin-content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Service  List</h3>
                <div class="card-tools">
                @if(helper::roleAccess('serviceSetup.service.create'))
                    <a class="btn btn-default" href="{{ route('serviceSetup.service.create') }}"><i class="fas fa-plus"></i>Add New</a>
                    @endif
                    <span id="buttons"></span>
                    <a class="btn btn-tool btn-default" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </a>
                    <a class="btn btn-tool btn-default" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            
            @php
            $columns = Helper::getTableProperty();
            @endphp
            <div class="card-body">
                <div class="table-responsive">
                    <table id="systemDatatable" class="display table-hover table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>SL</th>
                                @foreach($columns as $key => $value)
                                <th>{{ucfirst($value)}}</th>
                                @endforeach
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>SL</th>
                                @foreach($columns as $key => $value)
                                <th>{{ucfirst($value)}}</th>
                                @endforeach
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
        </div>
    </div>
    <!-- /.col-->
</div>
@endsection
