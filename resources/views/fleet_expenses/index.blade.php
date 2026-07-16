@extends('layouts.admin')
@section('page-title', __('Manage Fleet Expenses'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Expenses')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        <a href="{{ route('fleet-expenses.create') }}" class="btn btn-sm btn-primary">
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
                                <th>{{__('Type')}}</th>
                                <th>{{__('Amount')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expenses as $expense)
                                <tr>
                                    <td>{{ $expense->fleet->license_plate }}</td>
                                    <td>{{ $expense->expense_type }}</td>
                                    <td>{{ $expense->amount }}</td>
                                    <td>{{ $expense->status }}</td>
                                    <td>
                                        @if($expense->status === 'Pending')
                                            <form action="{{ route('fleet-expenses.approve', $expense->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">{{__('Approve')}}</button>
                                            </form>
                                        @elseif($expense->status === 'Approved')
                                            <form action="{{ route('fleet-expenses.post', $expense->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-info">{{__('Post to Finance')}}</button>
                                            </form>
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
@endsection
