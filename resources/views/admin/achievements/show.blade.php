@extends('layouts.admin')

@section('page_title', $achievement->title)
@section('page_description', 'Achievement details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $achievement->title }}</h5>
                <div class="btn-group">
                    <a href="{{ route('admin.achievements.index') }}" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>
                        Back to Achievements
                    </a>
                    <a href="{{ route('admin.achievements.edit', $achievement) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-pencil me-1"></i>
                        Edit Achievement
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    <!-- Left Column - Achievement Info -->
                    <div class="col-lg-4">
                        <div class="text-center mb-4">
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3 mx-auto"
                                 style="width: 200px; height: 200px;">
                                <i class="bi bi-trophy" style="font-size: 4rem; color: #6c757d;"></i>
                            </div>
                            <h4 class="mb-1">{{ $achievement->title }}</h4>
                            @if($achievement->category)
                                <p class="text-muted mb-3">{{ $achievement->category }}</p>
                            @endif

                            <div class="d-flex justify-content-center gap-2 mb-3">
                                <span class="badge bg-{{ $achievement->is_active ? 'success' : 'secondary' }} fs-6">
                                    {{ $achievement->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>

                            @if($achievement->slug)
                                <p class="text-muted small">
                                    <strong>Slug:</strong> <code>{{ $achievement->slug }}</code>
                                </p>
                            @endif
                        </div>

                        <!-- Achievement Details Card -->
                        <div class="card bg-light">
                            <div class="card-header bg-transparent">
                                <h6 class="mb-0">Achievement Details</h6>
                            </div>
                            <div class="card-body">
                                @if($achievement->achievement_date)
                                    <div class="mb-3">
                                        <label class="form-label small text-muted fw-bold">ACHIEVEMENT DATE</label>
                                        <p class="mb-0">{{ $achievement->achievement_date->format('M j, Y') }}</p>
                                        <small class="text-muted">{{ $achievement->achievement_date->diffForHumans() }}</small>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label class="form-label small text-muted fw-bold">SORT ORDER</label>
                                    <p class="mb-0">{{ $achievement->sort_order }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small text-muted fw-bold">CREATED</label>
                                    <p class="mb-0">{{ $achievement->created_at->format('M j, Y \a\t g:i A') }}</p>
                                    <small class="text-muted">{{ $achievement->created_at->diffForHumans() }}</small>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label small text-muted fw-bold">LAST UPDATED</label>
                                    <p class="mb-0">{{ $achievement->updated_at->format('M j, Y \a\t g:i A') }}</p>
                                    <small class="text-muted">{{ $achievement->updated_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Achievement Content -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Description</h6>
                            </div>
                            <div class="card-body">
                                @if($achievement->description)
                                    <div class="description-content">
                                        {!! nl2br(e($achievement->description)) !!}
                                    </div>
                                @else
                                    <p class="text-muted fst-italic">No description available.</p>
                                @endif
                            </div>
                        </div>

                        @if($achievement->content)
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h6 class="mb-0">Content</h6>
                                </div>
                                <div class="card-body">
                                    <div class="content-content">
                                        {!! nl2br(e($achievement->content)) !!}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($achievement->meta_data && count($achievement->meta_data) > 0)
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h6 class="mb-0">Additional Data</h6>
                                </div>
                                <div class="card-body">
                                    <pre class="bg-light p-3 rounded"><code>{{ json_encode($achievement->meta_data, JSON_PRETTY_PRINT) }}</code></pre>
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
                                        <a href="{{ route('admin.achievements.edit', $achievement) }}" class="btn btn-outline-primary w-100">
                                            <i class="bi bi-pencil me-2"></i>
                                            Edit Achievement
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        @if($achievement->slug)
                                            <a href="{{ route('achievement', $achievement->slug) }}"
                                               target="_blank" class="btn btn-outline-info w-100">
                                                <i class="bi bi-eye me-2"></i>
                                                View Public Page
                                            </a>
                                        @else
                                            <button class="btn btn-outline-secondary w-100" disabled>
                                                <i class="bi bi-eye me-2"></i>
                                                No Public Page
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-12">
                                        <form method="POST" action="{{ route('admin.achievements.destroy', $achievement) }}"
                                              onsubmit="return confirm('Are you sure you want to delete this achievement? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger w-100">
                                                <i class="bi bi-trash me-2"></i>
                                                Delete Achievement
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
.description-content,
.content-content {
    line-height: 1.6;
    text-align: justify;
}
</style>
@endpush
@endsection
