@extends('layouts.admin')
@section('page-title', __('Manage Drivers'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Drivers')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        <a href="{{ route('drivers.create') }}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i> {{__('Create')}}
        </a>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>{{__('Name')}}</th>
                                <th>{{__('License Number')}}</th>
                                <th>{{__('License Type')}}</th>
                                <th>{{__('Phone')}}</th>
                                <th>{{__('Status')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($drivers as $driver)
                                <tr>
                                    <td>{{ $driver->name }}</td>
                                    <td>{{ $driver->license_number }}</td>
                                    <td>{{ $driver->license_type }}</td>
                                    <td>{{ $driver->phone }}</td>
                                    <td>{{ $driver->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
