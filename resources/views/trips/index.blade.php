@extends('layouts.admin')
@section('page-title', __('Manage Trips'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Trips')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        <a href="{{ route('trips.create') }}" class="btn btn-sm btn-primary">
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
                                <th>{{__('Fleet')}}</th>
                                <th>{{__('Driver')}}</th>
                                <th>{{__('Destination')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Status')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trips as $trip)
                                <tr>
                                    <td>{{ $trip->fleet->license_plate }}</td>
                                    <td>{{ $trip->driver->name }}</td>
                                    <td>{{ $trip->route_destination }}</td>
                                    <td>{{ $trip->start_date }}</td>
                                    <td>{{ $trip->status }}</td>
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
