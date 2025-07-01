@extends('layouts.app')

@section('title', 'Custom Fields')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Custom Fields</h4>
    <a href="{{ route('admin.custom-fields.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add Custom Field
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Module</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Required</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customFields as $field)
                    <tr>
                        <td>
                            <span class="badge bg-{{ $field->module === 'customer' ? 'primary' : 'success' }}">
                                {{ ucfirst($field->module) }}
                            </span>
                        </td>
                        <td>{{ $field->name }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ ucfirst($field->type) }}</span>
                        </td>
                        <td>
                            @if($field->is_required)
                                <span class="badge bg-danger">Required</span>
                            @else
                                <span class="badge bg-light text-dark">Optional</span>
                            @endif
                        </td>
                        <td>
                            @if($field->type === 'dropdown' && $field->options)
                                {{ implode(', ', $field->options) }}
                            @elseif($field->type === 'lookup' && $field->lookup_module)
                                Lookup: {{ ucfirst($field->lookup_module) }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            No custom fields found. 
                            <a href="{{ route('admin.custom-fields.create') }}" class="text-primary">Create your first custom field</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($customFields->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Showing {{ $customFields->firstItem() }} to {{ $customFields->lastItem() }} of {{ $customFields->total() }} results
                </div>
                <div>
                    <nav>
                        <ul class="pagination mb-0">
                            {{-- Previous Page Link --}}
                            @if ($customFields->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">Previous</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $customFields->previousPageUrl() }}">Previous</a></li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($customFields->getUrlRange(1, $customFields->lastPage()) as $page => $url)
                                @if ($page == $customFields->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($customFields->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $customFields->nextPageUrl() }}">Next</a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link">Next</span></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
