@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-users fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Customers</h5>
                <a href="{{ route('admin.customers') }}" class="btn btn-primary">View Customers</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-file-invoice fa-3x text-success mb-3"></i>
                <h5 class="card-title">Invoices</h5>
                <a href="{{ route('admin.invoices') }}" class="btn btn-success">View Invoices</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-cogs fa-3x text-info mb-3"></i>
                <h5 class="card-title">Custom Fields</h5>
                <a href="{{ route('admin.custom-fields') }}" class="btn btn-info">View Custom Fields</a>
            </div>
        </div>
    </div>
</div>
@endsection
