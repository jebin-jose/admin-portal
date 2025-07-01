@extends('layouts.app')

@section('title', 'Invoices')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Invoices</h4>
    <a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add Invoice
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="invoicesTable">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
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
    loadInvoices();
});

function loadInvoices() {
    $.get('/api/list?module=invoice', function(data) {
        const tbody = $('#invoicesTable tbody');
        tbody.empty();
        
        data.forEach(function(invoice) {
            const statusClass = invoice.status === 'paid' ? 'success' : (invoice.status === 'cancelled' ? 'danger' : 'warning');
            tbody.append(`
                <tr>
                    <td>${invoice.customer ? invoice.customer.name : 'N/A'}</td>
                    <td>${invoice.date}</td>
                    <td>$${parseFloat(invoice.amount).toFixed(2)}</td>
                    <td><span class="badge bg-${statusClass}">${invoice.status}</span></td>
                    <td>
                        <a href="/admin/invoices/${invoice.id}/edit" class="btn btn-sm btn-outline-primary">
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
