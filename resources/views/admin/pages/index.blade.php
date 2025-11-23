@extends('layouts.admin')

@section('page_title', 'Pages')
@section('page_description', 'Manage website pages and content')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0">
            {{ $pages->total() }} pages total
        </p>
    </div>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>
        Create Page
    </a>
</div>

<div class="card">
    @if($pages->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Page</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Sort Order</th>
                        <th>Updated</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td>
                                <div>
                                    <h6 class="mb-0 fw-medium">{{ $page->title }}</h6>
                                    @if($page->subtitle)
                                        <small class="text-muted">{{ Str::limit($page->subtitle, 50) }}</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <code class="text-sm">{{ $page->slug }}</code>
                            </td>
                            <td>
                                <span class="badge bg-{{ $page->is_active ? 'success' : 'secondary' }}">
                                    {{ $page->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $page->sort_order }}</td>
                            <td>
                                <small class="text-muted">{{ $page->updated_at->diffForHumans() }}</small>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.pages.show', $page) }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete this page?')">
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

        @if($pages->hasPages())
            <div class="card-footer">
                {{ $pages->links() }}
            </div>
        @endif
    @else
        <div class="card-body text-center py-5">
            <i class="bi bi-file-text text-muted mb-3" style="font-size: 3rem;"></i>
            <h5 class="mb-2">No pages yet</h5>
            <p class="text-muted mb-4">Get started by creating your first page.</p>
            <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
                Create First Page
            </a>
        </div>
    @endif
</div>
@endsection
