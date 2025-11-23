@extends('layouts.admin')

@section('page_title', $artifact->title)
@section('page_description', 'Artifact details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $artifact->title }}</h5>
                <div class="btn-group">
                    <a href="{{ route('admin.artifacts.index') }}" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>
                        Back to Artifacts
                    </a>
                    <a href="{{ route('admin.artifacts.edit', $artifact) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-pencil me-1"></i>
                        Edit Artifact
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    <!-- Left Column - Artifact Info -->
                    <div class="col-lg-4">
                        <div class="text-center mb-4">
                            <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3 mx-auto"
                                 style="width: 200px; height: 200px;">
                                <i class="bi bi-archive" style="font-size: 4rem; color: #6c757d;"></i>
                            </div>
                            <h4 class="mb-1">{{ $artifact->title }}</h4>
                            <p class="text-muted mb-3">{{ $artifact->category }}</p>

                            <div class="d-flex justify-content-center gap-2 mb-3">
                                <span class="badge bg-{{ $artifact->is_active ? 'success' : 'secondary' }} fs-6">
                                    {{ $artifact->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>

                            @if($artifact->slug)
                                <p class="text-muted small">
                                    <strong>Slug:</strong> <code>{{ $artifact->slug }}</code>
                                </p>
                            @endif
                        </div>

                        <!-- Artifact Details Card -->
                        <div class="card bg-light">
                            <div class="card-header bg-transparent">
                                <h6 class="mb-0">Artifact Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label small text-muted fw-bold">CATEGORY</label>
                                    <p class="mb-0">{{ $artifact->category }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small text-muted fw-bold">SORT ORDER</label>
                                    <p class="mb-0">{{ $artifact->sort_order }}</p>
                                </div>

                                @if($artifact->images()->count() > 0)
                                    <div class="mb-3">
                                        <label class="form-label small text-muted fw-bold">IMAGES</label>
                                        <p class="mb-0">{{ $artifact->images()->count() }} image(s)</p>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label class="form-label small text-muted fw-bold">CREATED</label>
                                    <p class="mb-0">{{ $artifact->created_at->format('M j, Y \a\t g:i A') }}</p>
                                    <small class="text-muted">{{ $artifact->created_at->diffForHumans() }}</small>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label small text-muted fw-bold">LAST UPDATED</label>
                                    <p class="mb-0">{{ $artifact->updated_at->format('M j, Y \a\t g:i A') }}</p>
                                    <small class="text-muted">{{ $artifact->updated_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Description -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Description</h6>
                            </div>
                            <div class="card-body">
                                @if($artifact->description)
                                    <div class="description-content">
                                        {!! nl2br(e($artifact->description)) !!}
                                    </div>
                                @else
                                    <p class="text-muted fst-italic">No description available.</p>
                                @endif
                            </div>
                        </div>

                        @if($artifact->images()->count() > 0)
                            <!-- Images Section -->
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h6 class="mb-0">Images ({{ $artifact->images()->count() }})</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        @foreach($artifact->images as $image)
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-body text-center">
                                                        <p class="small text-muted mb-0">Image #{{ $loop->iteration }}</p>
                                                        <p class="small text-muted mb-0">Sort: {{ $image->sort_order ?? 0 }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Quick Actions -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h6 class="mb-0">Quick Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-2">
                                    <div class="col-sm-6">
                                        <a href="{{ route('admin.artifacts.edit', $artifact) }}" class="btn btn-outline-primary w-100">
                                            <i class="bi bi-pencil me-2"></i>
                                            Edit Artifact
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <button class="btn btn-outline-secondary w-100" disabled>
                                            <i class="bi bi-eye me-2"></i>
                                            View Public Page
                                        </button>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-12">
                                        <form method="POST" action="{{ route('admin.artifacts.destroy', $artifact) }}"
                                              onsubmit="return confirm('Are you sure you want to delete this artifact? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger w-100">
                                                <i class="bi bi-trash me-2"></i>
                                                Delete Artifact
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.description-content {
    line-height: 1.6;
    text-align: justify;
}
</style>
@endpush
@endsection
