@extends('layouts.admin')

@section('page_title', 'Edit ' . $member->name)
@section('page_description', 'Update executive council member details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit {{ $member->name }}</h5>
                <div class="btn-group">
                    <a href="{{ route('admin.executive-council-members.index') }}" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>
                        Back to Members
                    </a>
                    <a href="{{ route('admin.executive-council-members.show', $member) }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-eye me-1"></i>
                        View Details
                    </a>
                </div>
            </div>

            <form method="POST" id="submitForm" action="{{ route('admin.executive-council-members.update', $member) }}">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="row g-4">
                        <!-- Left Column -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', $member->name) }}"
                                       placeholder="Enter member's full name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('position') is-invalid @enderror"
                                       id="position" name="position" value="{{ old('position', $member->position) }}"
                                       placeholder="e.g., Governor, Deputy Governor, Commissioner for Finance" required>
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                       id="slug" name="slug" value="{{ old('slug', $member->slug) }}"
                                       placeholder="Auto-generated from name if left empty">
                                <div class="form-text">Leave empty to auto-generate from name</div>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image URL <span class="text-danger">*</span></label>
                                <input type="url" class="form-control @error('image') is-invalid @enderror"
                                       id="image" name="image" value="{{ old('image', $member->image) }}"
                                       placeholder="https://example.com/portrait.jpg" required>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <label for="display_order" class="form-label">Display Order</label>
                                    <input type="number" class="form-control @error('display_order') is-invalid @enderror"
                                           id="display_order" name="display_order" value="{{ old('display_order', $member->display_order) }}" min="0">
                                    <div class="form-text">Lower numbers appear first</div>
                                    @error('display_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label class="form-label d-block">Status</label>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input @error('is_active') is-invalid @enderror"
                                               type="checkbox" name="is_active" value="1"
                                               id="is_active" {{ old('is_active', $member->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                        @error('is_active')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="biography" class="form-label">Biography <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('biography') is-invalid @enderror"
                                          id="biography" name="biography" rows="12"
                                          placeholder="Enter member's biography, achievements, and background..." required>{{ old('biography', $member->biography) }}</textarea>
                                @error('biography')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Current Image & Preview -->
                            <div class="card bg-light">
                                <div class="card-header bg-transparent">
                                    <h6 class="mb-0">Current Image & Preview</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <!-- Current Image -->
                                        <div class="col-6">
                                            <p class="small text-muted mb-2">Current Image</p>
                                            @if($member->image)
                                                <img src="{{ $member->image }}" alt="{{ $member->name }}"
                                                     class="img-thumbnail" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                                            @else
                                                <div class="bg-secondary d-flex align-items-center justify-content-center"
                                                     style="width: 150px; height: 150px;">
                                                    <i class="bi bi-image text-white" style="font-size: 2rem;"></i>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- New Image Preview -->
                                        <div class="col-6">
                                            <p class="small text-muted mb-2">New Image Preview</p>
                                            <div id="image-preview" class="d-none">
                                                <img id="preview-img" src="" alt="Preview"
                                                     class="img-thumbnail" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                                            </div>
                                            <div id="no-preview" class="bg-light d-flex align-items-center justify-content-center"
                                                 style="width: 150px; height: 150px;">
                                                <div class="text-center text-muted">
                                                    <i class="bi bi-image" style="font-size: 2rem;"></i>
                                                    <p class="small mb-0 mt-2">Enter new URL to preview</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
                <div class="card-footer d-flex justify-content-between">
                    <div>
                        <form id="deleteForm" method="POST" action="{{ route('admin.executive-council-members.destroy', $member) }}"
                              onsubmit="return confirm('Are you sure you want to delete this member? This action cannot be undone.')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="document.querySelector('#deleteForm').submit()" class="btn btn-outline-danger">
                                <i class="bi bi-trash me-1"></i>
                                Delete Member
                            </button>
                        </form>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.executive-council-members.show', $member) }}" class="btn btn-secondary">Cancel</a>
                        <button type="button" onclick="document.querySelector('#submitForm').submit()" class="btn btn-primary">Update Member</button>
                    </div>
                </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    const imageInput = document.getElementById('image');
    const previewContainer = document.getElementById('image-preview');
    const noPreviewContainer = document.getElementById('no-preview');
    const previewImg = document.getElementById('preview-img');

    const originalSlug = slugInput.value;
    let slugModified = false;

    // Auto-generate slug from name
    nameInput.addEventListener('input', function() {
        if (!slugModified || slugInput.value === '' || isAutoGeneratedSlug(slugInput.value, originalSlug)) {
            const slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
            slugInput.value = slug;
            slugModified = false;
        }
    });

    // Track manual slug edits
    slugInput.addEventListener('input', function() {
        slugModified = true;
    });

    // Image preview
    imageInput.addEventListener('input', function() {
        const url = this.value.trim();
        if (url && isValidUrl(url)) {
            previewImg.src = url;
            previewImg.onload = function() {
                previewContainer.classList.remove('d-none');
                noPreviewContainer.classList.add('d-none');
            };
            previewImg.onerror = function() {
                previewContainer.classList.add('d-none');
                noPreviewContainer.classList.remove('d-none');
            };
        } else {
            previewContainer.classList.add('d-none');
            noPreviewContainer.classList.remove('d-none');
        }
    });

    function isValidUrl(string) {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;
        }
    }

    function isAutoGeneratedSlug(current, original) {
        // Simple heuristic to check if slug looks auto-generated
        return current === original || current === '';
    }
});
</script>
@endpush
@endsection
