@extends('layouts.admin')

@section('page_title', 'Edit Artifact')
@section('page_description', 'Edit artifact details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Artifact: {{ $artifact->title }}</h5>
                <div>
                    <a href="{{ route('admin.artifacts.show', $artifact) }}" class="btn btn-outline-light btn-sm me-2">
                        <i class="bi bi-eye me-1"></i>
                        View
                    </a>
                    <a href="{{ route('admin.artifacts.index') }}" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>
                        Back to Artifacts
                    </a>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.artifacts.update', $artifact) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="row g-4">
                        <!-- Left Column -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="title" name="title" value="{{ old('title', $artifact->title) }}"
                                       placeholder="Enter artifact title" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('category') is-invalid @enderror"
                                       id="category" name="category" value="{{ old('category', $artifact->category) }}"
                                       placeholder="e.g., Pottery, Textiles, Sculptures, Jewelry" required>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                       id="slug" name="slug" value="{{ old('slug', $artifact->slug) }}"
                                       placeholder="Auto-generated from title if left empty">
                                <div class="form-text">Leave empty to auto-generate from title</div>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <label for="sort_order" class="form-label">Sort Order</label>
                                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                           id="sort_order" name="sort_order" value="{{ old('sort_order', $artifact->sort_order) }}" min="0">
                                    <div class="form-text">Lower numbers appear first</div>
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label class="form-label d-block">Status</label>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input @error('is_active') is-invalid @enderror"
                                               type="checkbox" name="is_active" value="1"
                                               id="is_active" {{ old('is_active', $artifact->is_active) ? 'checked' : '' }}>
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
                                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="12"
                                          placeholder="Enter detailed description of the artifact, its history, significance, and cultural context..." required>{{ old('description', $artifact->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Existing Images Section -->
                            @if($artifact->images->count() > 0)
                            <div class="mb-3">
                                <label class="form-label">Current Images</label>
                                <div id="existing-images" class="row g-3">
                                    @foreach($artifact->images as $image)
                                    <div class="col-md-4 col-sm-6" id="existing-image-{{ $image->id }}">
                                        <div class="card">
                                            <img src="{{ $image->url }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="{{ $image->alt_text }}">
                                            <div class="card-body p-2">
                                                <input type="text" name="existing_alt_texts[{{ $image->id }}]"
                                                       class="form-control form-control-sm mb-2"
                                                       placeholder="Alt text" value="{{ $image->alt_text }}">
                                                <input type="hidden" name="existing_image_ids[]" value="{{ $image->id }}">
                                                <button type="button" class="btn btn-danger btn-sm w-100"
                                                        onclick="removeExistingImage({{ $image->id }})">
                                                    <i class="bi bi-trash me-1"></i>Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- New Images Section -->
                            <div class="mb-3">
                                <label class="form-label">Add New Images</label>
                                <div class="border border-2 border-dashed rounded p-3" id="image-upload-area">
                                    <div class="text-center mb-3">
                                        <i class="bi bi-cloud-upload display-4 text-muted"></i>
                                        <p class="mb-2">Upload new artifact images</p>
                                        <small class="text-muted">
                                            Drag and drop files here or click to browse<br>
                                            Maximum 10 images total, 5MB each (JPEG, PNG, JPG, GIF, WebP)
                                        </small>
                                    </div>

                                    <input type="file" name="images[]" id="images" class="form-control @error('images.*') is-invalid @enderror"
                                           multiple accept="image/*" style="display: none;">

                                    <button type="button" class="btn btn-outline-primary w-100" onclick="document.getElementById('images').click()">
                                        <i class="bi bi-plus-circle me-2"></i>Select New Images
                                    </button>

                                    @error('images')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    @error('images.*')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Preview Area -->
                                <div id="image-preview-area" class="mt-3" style="display: none;">
                                    <label class="form-label">New Images Preview</label>
                                    <div id="image-previews" class="row g-3"></div>
                                </div>
                            </div>

                            <!-- Info Card -->
                            <div class="card bg-light">
                                <div class="card-header bg-transparent">
                                    <h6 class="mb-0">Artifact Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-muted small">
                                        <p class="mb-2"><strong>Last Updated:</strong> {{ $artifact->updated_at->format('M j, Y g:i A') }}</p>
                                        <p class="mb-2"><strong>Created:</strong> {{ $artifact->created_at->format('M j, Y g:i A') }}</p>
                                        <hr class="my-2">
                                        <p class="mb-2"><strong>Guidelines:</strong></p>
                                        <ul class="mb-0">
                                            <li>Provide detailed historical context</li>
                                            <li>Include cultural significance</li>
                                            <li>Mention materials and craftsmanship</li>
                                            <li>Add relevant dates or periods</li>
                                            <li>Note any special characteristics</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.artifacts.show', $artifact) }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Artifact</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    // Auto-generate slug from title
    titleInput.addEventListener('input', function() {
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

    // Image upload functionality
    const imageInput = document.getElementById('images');
    const imageUploadArea = document.getElementById('image-upload-area');
    const imagePreviewArea = document.getElementById('image-preview-area');
    const imagePreviews = document.getElementById('image-previews');
    let selectedFiles = [];

    // Handle file selection
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            handleFiles(e.target.files);
        });
    }

    // Drag and drop functionality
    if (imageUploadArea) {
        imageUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('border-primary');
        });

        imageUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('border-primary');
        });

        imageUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('border-primary');
            handleFiles(e.dataTransfer.files);
        });
    }

    function handleFiles(files) {
        const fileArray = Array.from(files);
        const existingImagesCount = document.querySelectorAll('#existing-images .col-md-4:not(.removed)').length;

        // Validate file count (total including existing)
        if (existingImagesCount + selectedFiles.length + fileArray.length > 10) {
            alert('Maximum 10 images allowed in total');
            return;
        }

        fileArray.forEach(file => {
            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert(`${file.name} is not an image file`);
                return;
            }

            // Validate file size (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert(`${file.name} is too large. Maximum size is 5MB`);
                return;
            }

            selectedFiles.push(file);
        });

        updatePreview();
        updateFileInput();
    }

    function updatePreview() {
        if (selectedFiles.length > 0) {
            imagePreviewArea.style.display = 'block';
            imagePreviews.innerHTML = '';

            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'col-md-4 col-sm-6';
                    previewDiv.innerHTML = `
                        <div class="card">
                            <img src="${e.target.result}" class="card-img-top" style="height: 150px; object-fit: cover;">
                            <div class="card-body p-2">
                                <input type="text" name="image_alt_texts[]" class="form-control form-control-sm"
                                       placeholder="Alt text for image" value="">
                                <button type="button" class="btn btn-danger btn-sm mt-2 w-100" onclick="removeNewImage(${index})">
                                    <i class="bi bi-trash me-1"></i>Remove
                                </button>
                            </div>
                        </div>
                    `;
                    imagePreviews.appendChild(previewDiv);
                };
                reader.readAsDataURL(file);
            });
        } else {
            imagePreviewArea.style.display = 'none';
        }
    }

    function updateFileInput() {
        if (imageInput) {
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            imageInput.files = dt.files;
        }
    }

    // Global functions for image management
    window.removeExistingImage = function(imageId) {
        if (confirm('Are you sure you want to remove this image?')) {
            const imageDiv = document.getElementById(`existing-image-${imageId}`);
            if (imageDiv) {
                imageDiv.style.display = 'none';
                imageDiv.classList.add('removed');

                // Remove the hidden input so the image won't be kept
                const hiddenInput = imageDiv.querySelector('input[name="existing_image_ids[]"]');
                if (hiddenInput) {
                    hiddenInput.remove();
                }
            }
        }
    };

    window.removeNewImage = function(index) {
        selectedFiles.splice(index, 1);
        updatePreview();
        updateFileInput();
    };
});
</script>
@endpush
@endsection
