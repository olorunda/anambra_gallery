@extends('layouts.admin')

@section('page_title', 'Dashboard')
@section('page_description', 'Welcome to the Anambra State content management system')

@section('content')
<div class="row g-4 mb-4">
    <!-- Pages Stats -->
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="d-flex align-items-center">
                <div class="stats-icon me-3" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
                    <i class="bi bi-file-text"></i>
                </div>
                <div>
                    <h3 class="mb-1 fw-bold">{{ \App\Models\Page::count() }}</h3>
                    <p class="text-muted mb-0 small">Pages</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Executive Council Members Stats -->
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="d-flex align-items-center">
                <div class="stats-icon me-3" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <h3 class="mb-1 fw-bold">{{ \App\Models\ExecutiveCouncilMember::count() }}</h3>
                    <p class="text-muted mb-0 small">Executive Council</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Artifacts Stats -->
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="d-flex align-items-center">
                <div class="stats-icon me-3" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                    <i class="bi bi-gem"></i>
                </div>
                <div>
                    <h3 class="mb-1 fw-bold">{{ \App\Models\Artifact::count() }}</h3>
                    <p class="text-muted mb-0 small">Artifacts</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Achievements Stats -->
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="d-flex align-items-center">
                <div class="stats-icon me-3" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <i class="bi bi-trophy"></i>
                </div>
                <div>
                    <h3 class="mb-1 fw-bold">{{ \App\Models\Achievement::count() }}</h3>
                    <p class="text-muted mb-0 small">Achievements</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Pages -->
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Pages</h5>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-sm btn-outline-light">
                    View All
                </a>
            </div>
            <div class="card-body">
                @php
                    $recentPages = \App\Models\Page::orderBy('updated_at', 'desc')->limit(5)->get();
                @endphp

                @if($recentPages->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentPages as $page)
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                                <div>
                                    <h6 class="mb-1">{{ $page->title }}</h6>
                                    <small class="text-muted">Updated {{ $page->updated_at->diffForHumans() }}</small>
                                </div>
                                <span class="badge bg-{{ $page->is_active ? 'success' : 'secondary' }}">
                                    {{ $page->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted mb-0">No pages created yet.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-3">
                    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i>
                        Create New Page
                    </a>

                    <a href="{{ route('admin.executive-council-members.create') }}" class="btn btn-outline-primary">
                        <i class="bi bi-person-plus me-2"></i>
                        Add Executive Council Member
                    </a>

                    <a href="{{ route('admin.artifacts.create') }}" class="btn btn-outline-primary">
                        <i class="bi bi-plus-lg me-2"></i>
                        Add Artifact
                    </a>

                    <a href="{{ route('admin.achievements.create') }}" class="btn btn-outline-primary">
                        <i class="bi bi-trophy me-2"></i>
                        Add Achievement
                    </a>

                    <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-gear me-2"></i>
                        Manage Settings
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- System Status -->
<div class="row g-4 mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">System Status</h5>
            </div>
            <div class="card-body">
                <div class="row text-center g-4">
                    <div class="col-md-4">
                        <div class="d-flex flex-column align-items-center">
                            <span class="badge bg-success fs-6 px-3 py-2 mb-2">
                                <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i>
                                Online
                            </span>
                            <small class="text-muted">Website Status</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="d-flex flex-column align-items-center">
                            <h2 class="fw-bold text-primary mb-2">{{ \App\Models\Page::where('is_active', true)->count() }}</h2>
                            <small class="text-muted">Active Pages</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="d-flex flex-column align-items-center">
                            <h2 class="fw-bold text-primary mb-2">{{ \App\Models\ExecutiveCouncilMember::where('is_active', true)->count() }}</h2>
                            <small class="text-muted">Active Members</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
