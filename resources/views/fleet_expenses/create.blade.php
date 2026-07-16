@extends('layouts.admin')
@section('page-title', __('Create Fleet Expense'))
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('fleet-expenses.store') }}" method="POST">
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
                            <label class="form-label">{{__('Type')}}</label>
                            <select name="expense_type" class="form-control" required>
                                <option value="Fuel">Fuel</option>
                                <option value="Maintenance">Maintenance</option>
                                <option value="Toll">Toll</option>
                                <option value="Parking">Parking</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('Amount')}}</label>
                            <input type="number" step="0.01" name="amount" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('Description')}}</label>
                            <input type="text" name="description" class="form-control" required>
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
