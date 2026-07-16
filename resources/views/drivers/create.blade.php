@extends('layouts.admin')
@section('page-title', __('Create Driver'))
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('drivers.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('License Number')}}</label>
                            <input type="text" name="license_number" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('License Type')}}</label>
                            <input type="text" name="license_type" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('License Expiry Date')}}</label>
                            <input type="date" name="license_expiry_date" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('Phone')}}</label>
                            <input type="text" name="phone" class="form-control" required>
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
