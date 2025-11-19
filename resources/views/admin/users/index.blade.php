@extends('layouts.app')

@section('title', 'Manage Users')
@section('page-title', 'User Management')

@section('content')
<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div>
                        <h3 class="mb-2 fw-bold">User Management 👥</h3>
                        <p class="mb-0 opacity-75">Manage all platform users, roles, permissions, and account status.</p>
                    </div>
                    <div class="d-none d-md-block">
                        <i class="fas fa-users" style="font-size: 4rem; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm animate-fade-in" style="border-radius: 16px;">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-filter me-2 text-primary"></i>Search & Filter Users
                    </h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.users.index') }}">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-search text-primary"></i>
                                    </span>
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Search by name or email..." 
                                           value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-user-tag text-primary"></i>
                                    </span>
                                    <select name="role" class="form-select">
                                        <option value="">All Roles</option>
                                        <option value="agent" {{ request('role') == 'agent' ? 'selected' : '' }}>Agent</option>
                                        <option value="landlord" {{ request('role') == 'landlord' ? 'selected' : '' }}>Landlord</option>
                                        <option value="developer" {{ request('role') == 'developer' ? 'selected' : '' }}>Developer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search me-2"></i>Filter
                                </button>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-redo me-2"></i>Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm animate-fade-in" style="border-radius: 16px;">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-list me-2 text-primary"></i>All Users
                        </h5>
                        <span class="badge bg-primary px-3 py-2">{{ $users->total() }} users</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($users->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="fw-semibold">Name</th>
                                        <th class="fw-semibold">Email</th>
                                        <th class="fw-semibold">Role</th>
                                        <th class="fw-semibold">Phone</th>
                                        <th class="fw-semibold">Status</th>
                                        <th class="fw-semibold">Joined</th>
                                        <th class="fw-semibold text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" 
                                                         style="width: 40px; height: 40px;">
                                                        <i class="fas fa-user text-primary"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <strong class="d-block">{{ $user->name }}</strong>
                                                    <small class="text-muted">ID: {{ $user->id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="fas fa-envelope text-muted me-2"></i>
                                            <span>{{ $user->email }}</span>
                                        </td>
                                        <td>
                                            @php
                                                $roleColors = [
                                                    'admin' => 'danger',
                                                    'agent' => 'primary',
                                                    'landlord' => 'success',
                                                    'developer' => 'warning'
                                                ];
                                                $color = $roleColors[$user->role] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $color }} px-3 py-2">
                                                <i class="fas fa-user-tag me-1"></i>{{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td>
                                            <i class="fas fa-phone text-muted me-2"></i>
                                            <span>{{ $user->phone ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            @if($user->is_active)
                                                <span class="badge bg-success px-3 py-2">
                                                    <i class="fas fa-check-circle me-1"></i>Active
                                                </span>
                                            @else
                                                <span class="badge bg-danger px-3 py-2">
                                                    <i class="fas fa-times-circle me-1"></i>Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <i class="fas fa-calendar text-muted me-2"></i>
                                            <span>{{ $user->created_at->format('M d, Y') }}</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.users.show', $user) }}" 
                                                   class="btn btn-sm btn-outline-primary" title="View">
                                                    <i class="fas fa-eye me-1"></i>View
                                                </a>
                                                <a href="{{ route('admin.users.edit', $user) }}" 
                                                   class="btn btn-sm btn-outline-warning" title="Edit">
                                                    <i class="fas fa-edit me-1"></i>Edit
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                        <i class="fas fa-trash me-1"></i>Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="card-footer bg-white">
                            {{ $users->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-users" style="font-size: 5rem; color: #e2e8f0;"></i>
                            </div>
                            <h5 class="fw-bold mb-2">No Users Found</h5>
                            <p class="text-muted mb-4">No users match your search criteria. Try adjusting your filters.</p>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                                <i class="fas fa-redo me-2"></i>Reset Filters
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
