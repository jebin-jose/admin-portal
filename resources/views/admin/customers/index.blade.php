@extends('layouts.app')

@section('title', 'Customers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Customers</h4>
    <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add Customer
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="customersTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be loaded via AJAX -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    loadCustomers();
});

function loadCustomers() {
    $.get('/api/list?module=customer', function(data) {
        const tbody = $('#customersTable tbody');
        tbody.empty();
        
        data.forEach(function(customer) {
            tbody.append(`
                <tr>
                    <td>${customer.name}</td>
                    <td>${customer.email || '-'}</td>
                    <td>${customer.phone || '-'}</td>
                    <td>
                        <a href="/admin/customers/${customer.id}/edit" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </td>
                </tr>
            `);
        });
    });
}
</script>
@endsection
