@extends('layouts.app')

@section('title', 'Create Custom Field')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Create Custom Field</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.custom-fields.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="module" class="form-label">Module <span class="text-danger">*</span></label>
                        <select class="form-control @error('module') is-invalid @enderror" id="module" name="module" required>
                            <option value="">Select Module</option>
                            <option value="customer" {{ old('module') == 'customer' ? 'selected' : '' }}>Customer</option>
                            <option value="invoice" {{ old('module') == 'invoice' ? 'selected' : '' }}>Invoice</option>
                        </select>
                        @error('module')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Field Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="type" class="form-label">Field Type <span class="text-danger">*</span></label>
                        <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="">Select Type</option>
                            <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Text</option>
                            <option value="date" {{ old('type') == 'date' ? 'selected' : '' }}>Date</option>
                            <option value="decimal" {{ old('type') == 'decimal' ? 'selected' : '' }}>Decimal</option>
                            <option value="dropdown" {{ old('type') == 'dropdown' ? 'selected' : '' }}>Dropdown</option>
                            <option value="lookup" {{ old('type') == 'lookup' ? 'selected' : '' }}>Lookup</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_required" name="is_required" value="1" {{ old('is_required') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_required">
                                This field is required
                            </label>
                        </div>
                        @error('is_required')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Dropdown Options -->
                    <div id="dropdown-options" class="mb-3" style="display: none;">
                        <label class="form-label">Dropdown Options</label>
                        <div id="options-container">
                            @if(old('options'))
                                @foreach(old('options') as $index => $option)
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control @error('options.'.$index) is-invalid @enderror" name="options[]" placeholder="Option {{ $index + 1 }}" value="{{ $option }}">
                                        <button type="button" class="btn btn-outline-danger remove-option">Remove</button>
                                        @error('options.'.$index)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="options[]" placeholder="Option 1">
                                    <button type="button" class="btn btn-outline-danger remove-option">Remove</button>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-outline-primary" id="add-option">Add Option</button>
                        @error('options')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Lookup Module -->
                    <div id="lookup-module" class="mb-3" style="display: none;">
                        <label for="lookup_module" class="form-label">Lookup Module</label>
                        <select class="form-control @error('lookup_module') is-invalid @enderror" id="lookup_module" name="lookup_module">
                            <option value="">Select Module</option>
                            <option value="customer" {{ old('lookup_module') == 'customer' ? 'selected' : '' }}>Customer</option>
                            <option value="invoice" {{ old('lookup_module') == 'invoice' ? 'selected' : '' }}>Invoice</option>
                        </select>
                        @error('lookup_module')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.custom-fields') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Custom Field</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    const oldType = '{{ old("type") }}';
    if (oldType === 'dropdown') {
        $('#dropdown-options').show();
    } else if (oldType === 'lookup') {
        $('#lookup-module').show();
    }
    
    $('#type').on('change', function() {
        const type = $(this).val();
        $('#dropdown-options').hide();
        $('#lookup-module').hide();
        
        if (type === 'dropdown') {
            $('#dropdown-options').show();
        } else if (type === 'lookup') {
            $('#lookup-module').show();
        }
    });
    
    $('#add-option').on('click', function() {
        const optionCount = $('#options-container .input-group').length + 1;
        $('#options-container').append(`
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="options[]" placeholder="Option ${optionCount}">
                <button type="button" class="btn btn-outline-danger remove-option">Remove</button>
            </div>
        `);
    });
    
    $(document).on('click', '.remove-option', function() {

        if ($('#options-container .input-group').length > 1) {
            $(this).closest('.input-group').remove();
        } else {
            alert('At least one option is required for dropdown fields.');
        }
    });
});
</script>
@endsection
