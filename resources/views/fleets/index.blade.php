@extends('layouts.admin')
@section('page-title', __('Manage Fleets'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Fleets')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        <a href="{{ route('fleets.create') }}" class="btn btn-sm btn-primary">
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
                                <th>{{__('License Plate')}}</th>
                                <th>{{__('Year')}}</th>
                                <th>{{__('Status')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fleets as $fleet)
                                <tr>
                                    <td>{{ $fleet->name }}</td>
                                    <td>{{ $fleet->license_plate }}</td>
                                    <td>{{ $fleet->year }}</td>
                                    <td>{{ $fleet->status }}</td>
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
