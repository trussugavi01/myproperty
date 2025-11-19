@extends('layouts.app')

@section('title', 'Pending Approvals')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Pending Approvals</h2>
                <a href="{{ route('admin.listings.index') }}" class="btn btn-secondary">
                    <i class="fas fa-list me-2"></i>All Listings
                </a>
            </div>
        </div>
    </div>

    <!-- Pending Listings -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    @if($properties->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Property</th>
                                        <th>Owner</th>
                                        <th>Type</th>
                                        <th>Location</th>
                                        <th>Price</th>
                                        <th>Submitted</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($properties as $property)
                                    <tr>
                                        <td>
                                            <strong>{{ Str::limit($property->title, 40) }}</strong>
                                        </td>
                                        <td>
                                            {{ $property->user->name }}<br>
                                            <small class="text-muted">{{ $property->user->email }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ ucfirst($property->property_type) }}</span>
                                        </td>
                                        <td>{{ $property->location->name ?? 'N/A' }}</td>
                                        <td>{{ $property->formatted_price }}</td>
                                        <td>{{ $property->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.listings.show', $property) }}" 
                                                   class="btn btn-sm btn-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                                <form action="{{ route('admin.listings.approve', $property) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-success" 
                                                            title="Approve">
                                                        <i class="fas fa-check"></i> Approve
                                                    </button>
                                                </form>

                                                <button type="button" class="btn btn-sm btn-danger" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#rejectModal{{ $property->id }}"
                                                        title="Reject">
                                                    <i class="fas fa-times"></i> Reject
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Reject Modal -->
                                    <div class="modal fade" id="rejectModal{{ $property->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Reject Property</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('admin.listings.reject', $property) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to reject this property?</p>
                                                        <div class="mb-3">
                                                            <label for="rejection_notes" class="form-label">Rejection Notes *</label>
                                                            <textarea name="rejection_notes" class="form-control" 
                                                                      rows="4" required 
                                                                      placeholder="Provide a reason for rejection..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Reject Property</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="card-footer bg-white">
                            {{ $properties->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                            <p class="text-muted">No pending approvals</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
