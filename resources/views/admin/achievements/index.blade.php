@extends('layouts.admin')

@section('page_title', 'Achievements')
@section('page_description', 'Manage achievements')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0">
            {{ $achievements->total() }} achievements total
        </p>
    </div>
    <a href="{{ route('admin.achievements.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>
        Add Achievement
    </a>
</div>

<div class="card">
    @if($achievements->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Achievement Date</th>
                        <th>Status</th>
                        <th>Sort Order</th>
                        <th>Updated</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($achievements as $achievement)
                        <tr>
                            <td>
                                <div>
                                    <h6 class="mb-0 fw-medium">{{ $achievement->title }}</h6>
                                    <small class="text-muted">{{ $achievement->slug }}</small>
                                </div>
                            </td>
                            <td>
                                @if($achievement->category)
                                    <span class="badge bg-light text-dark">{{ $achievement->category }}</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                @if($achievement->achievement_date)
                                    <small class="text-muted">{{ $achievement->achievement_date->format('M j, Y') }}</small>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $achievement->is_active ? 'success' : 'secondary' }}">
                                    {{ $achievement->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $achievement->sort_order }}</td>
                            <td>
                                <small class="text-muted">{{ $achievement->updated_at->diffForHumans() }}</small>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.achievements.show', $achievement) }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.achievements.edit', $achievement) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.achievements.destroy', $achievement) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete this achievement?')">
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

        @if($achievements->hasPages())
            <div class="card-footer">
                {{ $achievements->links() }}
            </div>
        @endif
    @else
        <div class="card-body text-center py-5">
            <i class="bi bi-trophy text-muted mb-3" style="font-size: 3rem;"></i>
            <h5 class="mb-2">No achievements yet</h5>
            <p class="text-muted mb-4">Get started by adding your first achievement.</p>
            <a href="{{ route('admin.achievements.create') }}" class="btn btn-primary">
                Add First Achievement
            </a>
        </div>
    @endif
</div>
@endsection
