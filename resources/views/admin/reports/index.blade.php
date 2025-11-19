@extends('layouts.app')

@section('title', 'Reports')
@section('page-title', 'Reports & Analytics')

@section('content')
<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 20px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div>
                        <h3 class="mb-2 fw-bold">Reports & Analytics 📊</h3>
                        <p class="mb-0 opacity-75">Comprehensive insights into your platform's performance, listings, inquiries, and revenue.</p>
                    </div>
                    <div class="d-none d-md-block">
                        <i class="fas fa-chart-line" style="font-size: 4rem; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 animate-fade-in" style="border-radius: 16px; transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle" 
                             style="width: 80px; height: 80px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                            <i class="fas fa-building fa-2x text-white"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-2">Listings Report</h5>
                    <p class="text-muted small mb-4">View detailed statistics about property listings, types, categories, and trends.</p>
                    <a href="{{ route('admin.reports.listings') }}" class="btn btn-primary w-100">
                        <i class="fas fa-chart-bar me-2"></i>View Report
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 animate-fade-in" style="border-radius: 16px; transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle" 
                             style="width: 80px; height: 80px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                            <i class="fas fa-envelope fa-2x text-white"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-2">Inquiries Report</h5>
                    <p class="text-muted small mb-4">Track and analyze customer inquiries, response times, and status trends.</p>
                    <a href="{{ route('admin.reports.inquiries') }}" class="btn btn-warning w-100">
                        <i class="fas fa-chart-pie me-2"></i>View Report
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 animate-fade-in" style="border-radius: 16px; transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle" 
                             style="width: 80px; height: 80px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <i class="fas fa-money-bill-wave fa-2x text-white"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-2">Revenue Report</h5>
                    <p class="text-muted small mb-4">Monitor revenue, payment methods, transactions, and financial trends.</p>
                    <a href="{{ route('admin.reports.revenue') }}" class="btn btn-success w-100">
                        <i class="fas fa-chart-line me-2"></i>View Report
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
