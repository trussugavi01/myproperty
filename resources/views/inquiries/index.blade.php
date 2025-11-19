@extends('layouts.app')

@section('title', 'Inquiries')
@section('page-title', 'Property Inquiries')

@section('content')
<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div>
                        <h3 class="mb-2 fw-bold">Property Inquiries 📨</h3>
                        <p class="mb-0 opacity-75">Manage and respond to inquiries from potential buyers and renters.</p>
                    </div>
                    <div class="d-none d-md-block">
                        <i class="fas fa-envelope-open-text" style="font-size: 4rem; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h5 class="mb-0 fw-bold">Filter Inquiries</h5>
                        <p class="text-muted small mb-0">View inquiries by status</p>
                    </div>
                    <div class="btn-group" role="group">
                        <a href="{{ route(auth()->user()->role . '.inquiries.index', ['status' => 'new']) }}" 
                           class="btn {{ request('status') === 'new' ? 'btn-primary' : 'btn-outline-primary' }}">
                            <i class="fas fa-star me-1"></i>New
                        </a>
                        <a href="{{ route(auth()->user()->role . '.inquiries.index', ['status' => 'read']) }}" 
                           class="btn {{ request('status') === 'read' ? 'btn-info' : 'btn-outline-info' }}">
                            <i class="fas fa-eye me-1"></i>Read
                        </a>
                        <a href="{{ route(auth()->user()->role . '.inquiries.index', ['status' => 'responded']) }}" 
                           class="btn {{ request('status') === 'responded' ? 'btn-success' : 'btn-outline-success' }}">
                            <i class="fas fa-check me-1"></i>Responded
                        </a>
                        <a href="{{ route(auth()->user()->role . '.inquiries.index') }}" 
                           class="btn {{ !request('status') ? 'btn-secondary' : 'btn-outline-secondary' }}">
                            <i class="fas fa-list me-1"></i>All
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm animate-fade-in">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 fw-bold">All Inquiries</h5>
                <p class="text-muted small mb-0">{{ $inquiries->total() }} total inquiries</p>
            </div>
            <div class="card-body p-0">
                @forelse($inquiries as $inquiry)
                    <div class="d-flex align-items-start p-4 border-bottom hover-bg-light" style="transition: all 0.3s ease;">
                        <div class="me-3">
                            <div class="rounded-circle bg-{{ $inquiry->status === 'new' ? 'primary' : ($inquiry->status === 'read' ? 'info' : 'success') }} text-white d-flex align-items-center justify-content-center" 
                                 style="width: 48px; height: 48px; font-size: 1.25rem;">
                                <i class="fas fa-{{ $inquiry->status === 'new' ? 'envelope' : ($inquiry->status === 'read' ? 'envelope-open' : 'check-circle') }}"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="mb-1 fw-bold">{{ $inquiry->name }}</h6>
                                    <p class="text-muted small mb-1">
                                        <i class="fas fa-envelope me-1"></i>{{ $inquiry->email }}
                                        @if($inquiry->phone)
                                            <span class="ms-3"><i class="fas fa-phone me-1"></i>{{ $inquiry->phone }}</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="text-end">
                                    @if($inquiry->status === 'new')
                                        <span class="badge bg-primary px-3 py-2"><i class="fas fa-star me-1"></i>New</span>
                                    @elseif($inquiry->status === 'read')
                                        <span class="badge bg-info px-3 py-2"><i class="fas fa-eye me-1"></i>Read</span>
                                    @elseif($inquiry->status === 'responded')
                                        <span class="badge bg-success px-3 py-2"><i class="fas fa-check me-1"></i>Responded</span>
                                    @else
                                        <span class="badge bg-secondary px-3 py-2">Archived</span>
                                    @endif
                                    <br>
                                    <small class="text-muted"><i class="fas fa-clock me-1"></i>{{ $inquiry->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            
                            <div class="mb-2 p-2" style="background: #f8fafc; border-radius: 8px; border-left: 3px solid var(--bs-primary);">
                                <p class="text-muted small mb-1">
                                    <strong><i class="fas fa-building me-1"></i>Property:</strong> 
                                    <a href="{{ route('properties.show', $inquiry->property->slug) }}" target="_blank" class="text-decoration-none fw-semibold">
                                        {{ $inquiry->property->title }}
                                    </a>
                                </p>
                            </div>
                            
                            <p class="mb-3 text-muted">{{ Str::limit($inquiry->message, 150) }}</p>
                            
                            <div class="d-flex gap-2">
                                <a href="{{ route(auth()->user()->role . '.inquiries.show', $inquiry) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye me-1"></i>View Details
                                </a>
                                @if($inquiry->status !== 'responded')
                                    <form method="POST" action="{{ route(auth()->user()->role . '.inquiries.respond', $inquiry) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-check me-1"></i>Mark as Responded
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-inbox" style="font-size: 5rem; color: #e2e8f0;"></i>
                        </div>
                        <h5 class="fw-bold mb-2">No Inquiries Found</h5>
                        <p class="text-muted mb-4">You haven't received any inquiries yet. When someone contacts you about a property, it will appear here.</p>
                        <a href="{{ route(auth()->user()->role . '.properties.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add More Properties
                        </a>
                    </div>
                @endforelse

                @if($inquiries->hasPages())
                    <div class="d-flex justify-content-center p-4 border-top">
                        {{ $inquiries->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
