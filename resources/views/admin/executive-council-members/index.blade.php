@extends('layouts.admin')

@section('page_title', 'Executive Council Members')
@section('page_description', 'Manage executive council members')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0">
            {{ $members->total() }} members total
        </p>
    </div>
    <a href="{{ route('admin.executive-council-members.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>
        Add Member
    </a>
</div>

<div class="card">
    @if($members->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Display Order</th>
                        <th>Updated</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($member->image)
                                        <img src="{{ $member->image_url }}" alt="{{ $member->name }}"
                                             class="rounded-circle me-3" style="width: 48px; height: 48px; object-fit: cover;">
                                    @endif
                                    <div>
                                        <h6 class="mb-0 fw-medium">{{ $member->name }}</h6>
                                        <small class="text-muted">{{ $member->slug }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-medium">{{ $member->position }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $member->is_active ? 'success' : 'secondary' }}">
                                    {{ $member->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $member->display_order }}</td>
                            <td>
                                <small class="text-muted">{{ $member->updated_at->diffForHumans() }}</small>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.executive-council-members.show', $member) }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.executive-council-members.edit', $member) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.executive-council-members.destroy', $member) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete this member?')">
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

        @if($members->hasPages())
            <div class="card-footer">
                {{ $members->links() }}
            </div>
        @endif
    @else
        <div class="card-body text-center py-5">
            <i class="bi bi-people text-muted mb-3" style="font-size: 3rem;"></i>
            <h5 class="mb-2">No executive council members yet</h5>
            <p class="text-muted mb-4">Get started by adding your first executive council member.</p>
            <a href="{{ route('admin.executive-council-members.create') }}" class="btn btn-primary">
                Add First Member
            </a>
        </div>
    @endif
</div>
@endsection
