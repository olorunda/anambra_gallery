@extends('layouts.admin')

@section('page_title', 'Add Executive Council Member')
@section('page_description', 'Add a new executive council member')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Add New Executive Council Member</h5>
                <a href="{{ route('admin.executive-council-members.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left me-1"></i>
                    Back to Members
                </a>
            </div>

            <form method="POST" action="{{ route('admin.executive-council-members.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="row g-4">
                        <!-- Left Column -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') }}"
                                       placeholder="Enter member's full name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('position') is-invalid @enderror"
                                       id="position" name="position" value="{{ old('position') }}"
                                       placeholder="e.g., Governor, Deputy Governor, Commissioner for Finance" required>
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                       id="slug" name="slug" value="{{ old('slug') }}"
                                       placeholder="Auto-generated from name if left empty">
                                <div class="form-text">Leave empty to auto-generate from name</div>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image Upload <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                       id="image" name="image" accept="image/*" required>
                                <div class="form-text">Supported formats: JPG, PNG, GIF, WebP (Max: 2MB)</div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <label for="display_order" class="form-label">Display Order</label>
                                    <input type="number" class="form-control @error('display_order') is-invalid @enderror"
                                           id="display_order" name="display_order" value="{{ old('display_order', 0) }}" min="0">
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
                                               id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
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
                                          placeholder="Enter member's biography, achievements, and background..." required>{{ old('biography') }}</textarea>
                                @error('biography')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image Preview -->
                            <div class="card bg-light">
                                <div class="card-header bg-transparent">
                                    <h6 class="mb-0">Image Preview</h6>
                                </div>
                                <div class="card-body text-center">
                                    <div id="image-preview" class="d-none">
                                        <img id="preview-img" src="" alt="Preview" class="img-thumbnail mb-2" style="max-width: 200px; max-height: 200px;">
                                        <p class="text-muted small mb-0">Image preview</p>
                                    </div>
                                    <div id="no-preview" class="text-muted py-4">
                                        <i class="bi bi-image" style="font-size: 3rem;"></i>
                                        <p class="mb-0">Select an image file to see preview</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.executive-council-members.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Add Member</button>
                </div>
            </form>
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

    // Auto-generate slug from name
    nameInput.addEventListener('input', function() {
        if (!slugInput.value || slugInput.dataset.autoGenerated === 'true') {
            const slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
            slugInput.value = slug;
            slugInput.dataset.autoGenerated = 'true';
        }
    });

    // Clear auto-generation flag when user manually edits slug
    slugInput.addEventListener('input', function() {
        this.dataset.autoGenerated = 'false';
    });

    // Image preview
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewContainer.classList.remove('d-none');
                noPreviewContainer.classList.add('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add('d-none');
            noPreviewContainer.classList.remove('d-none');
        }
    });
});
</script>
@endpush
@endsection
