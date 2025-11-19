import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);

// Image preview for property uploads
document.addEventListener('DOMContentLoaded', function() {
    // Image upload preview
    const imageInput = document.getElementById('property-images');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const preview = document.getElementById('image-preview');
            if (preview) {
                preview.innerHTML = '';
                const files = Array.from(e.target.files);
                
                files.forEach(file => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const div = document.createElement('div');
                            div.className = 'col-md-3 mb-3';
                            div.innerHTML = `
                                <div class="position-relative">
                                    <img src="${e.target.result}" class="img-fluid rounded" alt="Preview">
                                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            `;
                            preview.appendChild(div);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    }

    // Inquiry modal
    const inquiryButtons = document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#inquiryModal"]');
    inquiryButtons.forEach(button => {
        button.addEventListener('click', function() {
            const propertyId = this.dataset.propertyId;
            const propertyTitle = this.dataset.propertyTitle;
            
            document.getElementById('inquiry-property-id').value = propertyId;
            document.getElementById('inquiry-property-title').textContent = propertyTitle;
        });
    });

    // Submit inquiry via AJAX
    const inquiryForm = document.getElementById('inquiry-form');
    if (inquiryForm) {
        inquiryForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Sending...';
            
            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Show success message at top of page
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-success alert-dismissible fade show';
                    alertDiv.innerHTML = `
                        <i class="fas fa-check-circle me-2"></i>${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    
                    // Insert at top of container
                    const container = document.querySelector('.container');
                    if (container) {
                        container.insertBefore(alertDiv, container.firstChild);
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                    
                    // Reset form
                    this.reset();
                    
                    // Close modal immediately
                    const modal = bootstrap.Modal.getInstance(document.getElementById('inquiryModal'));
                    if (modal) modal.hide();
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    }

    // Initialize charts if Chart.js is available
    const chartElements = document.querySelectorAll('[data-chart]');
    chartElements.forEach(element => {
        const chartType = element.dataset.chart;
        const chartData = JSON.parse(element.dataset.chartData || '{}');
        
        new Chart(element, {
            type: chartType,
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: chartType !== 'line'
                    }
                }
            }
        });
    });

    // Price range slider
    const priceRange = document.getElementById('price-range');
    if (priceRange) {
        const priceDisplay = document.getElementById('price-display');
        priceRange.addEventListener('input', function() {
            if (priceDisplay) {
                priceDisplay.textContent = '₦' + parseInt(this.value).toLocaleString();
            }
        });
    }

    // Confirm delete actions
    const deleteButtons = document.querySelectorAll('[data-confirm-delete]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });
});
