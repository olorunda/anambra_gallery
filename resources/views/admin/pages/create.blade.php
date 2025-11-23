@extends('layouts.admin')

@section('page_title', 'Create Page')
@section('page_description', 'Add a new page to the website')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create New Page</h5>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left me-1"></i>
                    Back to Pages
                </a>
            </div>

            <form method="POST" action="{{ route('admin.pages.store') }}">
                @csrf

                <div class="card-body">
                    <div class="row g-4">
                        <!-- Left Column -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="title" name="title" value="{{ old('title') }}"
                                       placeholder="Enter page title" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                       id="slug" name="slug" value="{{ old('slug') }}"
                                       placeholder="Auto-generated from title if left empty">
                                <div class="form-text">Leave empty to auto-generate from title</div>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="subtitle" class="form-label">Subtitle</label>
                                <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                       id="subtitle" name="subtitle" value="{{ old('subtitle') }}"
                                       placeholder="Optional page subtitle">
                                @error('subtitle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="background_image" class="form-label">Background Image URL</label>
                                <input type="url" class="form-control @error('background_image') is-invalid @enderror"
                                       id="background_image" name="background_image" value="{{ old('background_image') }}"
                                       placeholder="https://example.com/image.jpg">
                                @error('background_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="seal_image" class="form-label">Seal Image URL</label>
                                <input type="url" class="form-control @error('seal_image') is-invalid @enderror"
                                       id="seal_image" name="seal_image" value="{{ old('seal_image') }}"
                                       placeholder="https://example.com/seal.jpg">
                                @error('seal_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control @error('content') is-invalid @enderror"
                                          id="content" name="content" rows="8"
                                          placeholder="Enter page content...">{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <label for="sort_order" class="form-label">Sort Order</label>
                                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                           id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label class="form-label d-block">Status</label>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input @error('is_active') is-invalid @enderror"
                                               type="checkbox" name="is_active" value="1"
                                               id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                        @error('is_active')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Meta Data Section -->
                            <div class="card bg-light">
                                <div class="card-header bg-transparent">
                                    <h6 class="mb-0">Meta Data (Optional)</h6>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted small mb-3">
                                        Add custom metadata as key-value pairs. Click "Add Field" to add more.
                                    </p>

                                    <div id="meta-fields">
                                        <!-- Meta fields will be added here dynamically -->
                                    </div>

                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addMetaField()">
                                        <i class="bi bi-plus-lg me-1"></i>
                                        Add Field
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create Page</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
let metaFieldCount = 0;

function addMetaField(key = '', value = '') {
    const container = document.getElementById('meta-fields');
    const fieldId = `meta-field-${metaFieldCount}`;

    const fieldHtml = `
        <div id="${fieldId}" class="grid grid-cols-2 gap-2 mb-2">
            <input
                type="text"
                name="meta_data[${metaFieldCount}][key]"
                placeholder="Key"
                value="${key}"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            >
            <div class="flex space-x-2">
                <input
                    type="text"
                    name="meta_data[${metaFieldCount}][value]"
                    placeholder="Value"
                    value="${value}"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                >
                <button
                    type="button"
                    onclick="removeMetaField('${fieldId}')"
                    class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                >
                    ×
                </button>
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', fieldHtml);
    metaFieldCount++;
}

function removeMetaField(fieldId) {
    document.getElementById(fieldId).remove();
}

// Initialize with existing meta data if editing
@if(old('meta_data'))
    @foreach(old('meta_data') as $meta)
        addMetaField('{{ $meta['key'] ?? '' }}', '{{ $meta['value'] ?? '' }}');
    @endforeach
@endif
</script>
@endpush
@endsection
