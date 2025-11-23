@extends('layouts.admin')

@section('page_title', $member->name)
@section('page_description', 'Executive council member details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $member->name }}</h5>
                <div class="btn-group">
                    <a href="{{ route('admin.executive-council-members.index') }}" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>
                        Back to Members
                    </a>
                    <a href="{{ route('admin.executive-council-members.edit', $member) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-pencil me-1"></i>
                        Edit Member
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    <!-- Left Column - Member Info -->
                    <div class="col-lg-4">
                        <div class="text-center mb-4">
                            @if($member->image)
                                <img src="{{ $member->image }}" alt="{{ $member->name }}"
                                     class="img-fluid rounded-circle mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3 mx-auto"
                                     style="width: 200px; height: 200px;">
                                    <i class="bi bi-person" style="font-size: 4rem; color: #6c757d;"></i>
                                </div>
                            @endif
                            <h4 class="mb-1">{{ $member->name }}</h4>
                            <p class="text-muted mb-3">{{ $member->position }}</p>

                            <div class="d-flex justify-content-center gap-2 mb-3">
                                <span class="badge bg-{{ $member->is_active ? 'success' : 'secondary' }} fs-6">
                                    {{ $member->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>

                            @if($member->slug)
                                <p class="text-muted small">
                                    <strong>Slug:</strong> <code>{{ $member->slug }}</code>
                                </p>
                            @endif
                        </div>

                        <!-- Member Details Card -->
                        <div class="card bg-light">
                            <div class="card-header bg-transparent">
                                <h6 class="mb-0">Member Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label small text-muted fw-bold">DISPLAY ORDER</label>
                                    <p class="mb-0">{{ $member->display_order }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small text-muted fw-bold">CREATED</label>
                                    <p class="mb-0">{{ $member->created_at->format('M j, Y \a\t g:i A') }}</p>
                                    <small class="text-muted">{{ $member->created_at->diffForHumans() }}</small>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label small text-muted fw-bold">LAST UPDATED</label>
                                    <p class="mb-0">{{ $member->updated_at->format('M j, Y \a\t g:i A') }}</p>
                                    <small class="text-muted">{{ $member->updated_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Biography -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Biography</h6>
                            </div>
                            <div class="card-body">
                                @if($member->biography)
                                    <div class="biography-content">
                                        {!! nl2br(e($member->biography)) !!}
                                    </div>
                                @else
                                    <p class="text-muted fst-italic">No biography available.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h6 class="mb-0">Quick Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-2">
                                    <div class="col-sm-6">
                                        <a href="{{ route('admin.executive-council-members.edit', $member) }}" class="btn btn-outline-primary w-100">
                                            <i class="bi bi-pencil me-2"></i>
                                            Edit Member
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        @if($member->slug)
                                            <a href="{{ route('executive-council-member', $member->slug) }}"
                                               target="_blank" class="btn btn-outline-info w-100">
                                                <i class="bi bi-eye me-2"></i>
                                                View Public Profile
                                            </a>
                                        @else
                                            <button class="btn btn-outline-secondary w-100" disabled>
                                                <i class="bi bi-eye me-2"></i>
                                                No Public Profile
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-12">
                                        <form method="POST" action="{{ route('admin.executive-council-members.destroy', $member) }}"
                                              onsubmit="return confirm('Are you sure you want to delete this member? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger w-100">
                                                <i class="bi bi-trash me-2"></i>
                                                Delete Member
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
.biography-content {
    line-height: 1.6;
    text-align: justify;
}
</style>
@endpush
@endsection
