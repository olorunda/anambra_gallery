@extends('layouts.admin')

@section('page_title', 'Artifacts')
@section('page_description', 'Manage gallery artifacts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0">
            {{ $artifacts->total() }} artifacts total
        </p>
    </div>
    <a href="{{ route('admin.artifacts.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>
        Add Artifact
    </a>
</div>

<div class="card">
    @if($artifacts->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Artifact</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Sort Order</th>
                        <th>Updated</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($artifacts as $artifact)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6 class="mb-0 fw-medium">{{ $artifact->title }}</h6>
                                        <small class="text-muted">{{ $artifact->slug }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-medium">{{ $artifact->category }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $artifact->is_active ? 'success' : 'secondary' }}">
                                    {{ $artifact->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $artifact->sort_order }}</td>
                            <td>
                                <small class="text-muted">{{ $artifact->updated_at->diffForHumans() }}</small>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.artifacts.show', $artifact) }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.artifacts.edit', $artifact) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.artifacts.destroy', $artifact) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete this artifact?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($artifacts->hasPages())
            <div class="card-footer">
                {{ $artifacts->links() }}
            </div>
        @endif
    @else
        <div class="card-body text-center py-5">
            <i class="bi bi-archive text-muted mb-3" style="font-size: 3rem;"></i>
            <h5 class="mb-2">No artifacts yet</h5>
            <p class="text-muted mb-4">Get started by adding your first artifact to the gallery.</p>
            <a href="{{ route('admin.artifacts.create') }}" class="btn btn-primary">
                Add First Artifact
            </a>
        </div>
    @endif
</div>
@endsection
