@extends('layouts.admin')
@section('page-title', __('Create Fleet'))
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('fleets.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('License Plate')}}</label>
                            <input type="text" name="license_plate" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('Year')}}</label>
                            <input type="number" name="year" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('Engine Capacity')}}</label>
                            <input type="text" name="engine_capacity" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('STNK Expiry Date')}}</label>
                            <input type="date" name="stnk_expiry_date" class="form-control" required>
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
