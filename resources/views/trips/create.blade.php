@extends('layouts.admin')
@section('page-title', __('Create Trip'))
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('trips.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('Fleet')}}</label>
                            <select name="fleet_id" class="form-control" required>
                                @foreach($fleets as $fleet)
                                    <option value="{{ $fleet->id }}">{{ $fleet->license_plate }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('Driver')}}</label>
                            <select name="driver_id" class="form-control" required>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('Destination')}}</label>
                            <input type="text" name="route_destination" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('Purpose')}}</label>
                            <input type="text" name="purpose" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('Start Date')}}</label>
                            <input type="datetime-local" name="start_date" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('Start Odometer')}}</label>
                            <input type="number" name="start_odometer" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{__('Create')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
