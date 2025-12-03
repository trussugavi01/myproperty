@extends('layouts.public')

@section('title', 'Terms and Conditions')

@section('content')
<!-- Hero Section -->
<section class="position-relative overflow-hidden" style="background: linear-gradient(135deg, #5568d3 0%, #6b4a9e 100%); padding: 80px 0 40px 0;">
    <!-- Pattern Overlay -->
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); opacity: 0.4;"></div>
    <!-- Gradient Overlay -->
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.05) 100%);"></div>
    
    <div class="container position-relative">
        <div class="row">
            <div class="col-12 text-center text-white">
                <h1 class="display-4 fw-bold mb-3" style="text-shadow: 0 2px 20px rgba(0,0,0,0.15);">📜 Terms and Conditions</h1>
                <p class="lead mb-0" style="opacity: 0.95; text-shadow: 0 1px 10px rgba(0,0,0,0.1);">Last Updated: {{ date('F d, Y') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="position-relative" style="background: linear-gradient(180deg, #fafbfc 0%, #ffffff 50%, #fafbfc 100%); padding: 60px 0;">
    <!-- Subtle pattern overlay -->
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; background-image: radial-gradient(circle at 2px 2px, rgba(102, 126, 234, 0.03) 1px, transparent 0); background-size: 40px 40px; pointer-events: none;"></div>
    
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 mb-4" style="border-radius: 20px; backdrop-filter: blur(10px); background: rgba(255,255,255,0.98); box-shadow: 0 20px 60px rgba(0,0,0,0.1), 0 0 0 1px rgba(255,255,255,0.3);">
                    <div class="card-body p-5">
                        <!-- Introduction -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">1. Introduction</h2>
                            <p class="text-muted">Welcome to LAFRIQUE Properties ("we," "our," or "us"). These Terms and Conditions ("Terms") govern your access to and use of our website, mobile applications, and services (collectively, the "Platform"). By accessing or using our Platform, you agree to be bound by these Terms.</p>
                            <p class="text-muted">If you do not agree to these Terms, please do not use our Platform.</p>
                        </div>

                        <!-- Definitions -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">2. Definitions</h2>
                            <ul class="text-muted">
                                <li><strong>"User"</strong> refers to anyone who accesses or uses the Platform.</li>
                                <li><strong>"Agent"</strong> refers to real estate agents who list properties on the Platform.</li>
                                <li><strong>"Landlord"</strong> refers to property owners who list properties on the Platform.</li>
                                <li><strong>"Developer"</strong> refers to real estate developers who list properties on the Platform.</li>
                                <li><strong>"Listing"</strong> refers to any property advertisement posted on the Platform.</li>
                                <li><strong>"Services"</strong> refers to all features, tools, and functionalities provided by the Platform.</li>
                            </ul>
                        </div>

                        <!-- Eligibility -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">3. Eligibility</h2>
                            <p class="text-muted">To use our Platform, you must:</p>
                            <ul class="text-muted">
                                <li>Be at least 18 years of age</li>
                                <li>Have the legal capacity to enter into binding contracts</li>
                                <li>Provide accurate and complete registration information</li>
                                <li>Maintain the security of your account credentials</li>
                                <li>Comply with all applicable laws and regulations in your jurisdiction</li>
                            </ul>
                        </div>

                        <!-- User Accounts -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">4. User Accounts</h2>
                            <h5 class="fw-semibold mb-3">4.1 Account Registration</h5>
                            <p class="text-muted">To access certain features, you must create an account. You agree to provide accurate, current, and complete information during registration and to update such information to keep it accurate, current, and complete.</p>
                            
                            <h5 class="fw-semibold mb-3 mt-4">4.2 Account Security</h5>
                            <p class="text-muted">You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account. You must immediately notify us of any unauthorized use of your account.</p>
                            
                            <h5 class="fw-semibold mb-3 mt-4">4.3 Account Termination</h5>
                            <p class="text-muted">We reserve the right to suspend or terminate your account at any time for violations of these Terms or for any other reason at our sole discretion.</p>
                        </div>

                        <!-- Property Listings -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">5. Property Listings</h2>
                            <h5 class="fw-semibold mb-3">5.1 Listing Requirements</h5>
                            <p class="text-muted">When creating a property listing, you must:</p>
                            <ul class="text-muted">
                                <li>Provide accurate and truthful information about the property</li>
                                <li>Upload clear, authentic photos of the property</li>
                                <li>Have the legal right to list the property</li>
                                <li>Ensure all information complies with applicable laws</li>
                                <li>Not include misleading or fraudulent information</li>
                            </ul>
                            
                            <h5 class="fw-semibold mb-3 mt-4">5.2 Listing Approval</h5>
                            <p class="text-muted">All listings are subject to our review and approval. We reserve the right to reject, remove, or modify any listing that violates these Terms or our content policies.</p>
                            
                            <h5 class="fw-semibold mb-3 mt-4">5.3 Listing Accuracy</h5>
                            <p class="text-muted">You are solely responsible for the accuracy and legality of your listings. We do not verify the accuracy of listings and are not responsible for any errors or omissions.</p>
                        </div>

                        <!-- Subscription and Payments -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">6. Subscription and Payments</h2>
                            <h5 class="fw-semibold mb-3">6.1 Subscription Plans</h5>
                            <p class="text-muted">We offer various subscription plans with different features and pricing. By subscribing, you agree to pay the applicable fees as described on our pricing page.</p>
                            
                            <h5 class="fw-semibold mb-3 mt-4">6.2 Payment Terms</h5>
                            <p class="text-muted">Payments are processed through secure third-party payment processors. You authorize us to charge your payment method for all fees incurred.</p>
                            
                            <h5 class="fw-semibold mb-3 mt-4">6.3 Refund Policy</h5>
                            <p class="text-muted">Subscription fees are non-refundable except as required by law or as expressly stated in our refund policy. You may cancel your subscription at any time, but no refunds will be provided for the current billing period.</p>
                            
                            <h5 class="fw-semibold mb-3 mt-4">6.4 Price Changes</h5>
                            <p class="text-muted">We reserve the right to change our pricing at any time. Price changes will be communicated in advance and will apply to subsequent billing periods.</p>
                        </div>

                        <!-- Prohibited Activities -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">7. Prohibited Activities</h2>
                            <p class="text-muted">You agree not to:</p>
                            <ul class="text-muted">
                                <li>Use the Platform for any illegal or unauthorized purpose</li>
                                <li>Post false, misleading, or fraudulent listings</li>
                                <li>Violate any laws or regulations</li>
                                <li>Infringe on intellectual property rights</li>
                                <li>Transmit viruses, malware, or other harmful code</li>
                                <li>Attempt to gain unauthorized access to the Platform</li>
                                <li>Harass, abuse, or harm other users</li>
                                <li>Scrape or collect data from the Platform without permission</li>
                                <li>Impersonate any person or entity</li>
                                <li>Interfere with the proper functioning of the Platform</li>
                            </ul>
                        </div>

                        <!-- Intellectual Property -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">8. Intellectual Property</h2>
                            <h5 class="fw-semibold mb-3">8.1 Platform Content</h5>
                            <p class="text-muted">All content on the Platform, including text, graphics, logos, images, and software, is the property of LAFRIQUE Properties or its licensors and is protected by international copyright laws.</p>
                            
                            <h5 class="fw-semibold mb-3 mt-4">8.2 User Content</h5>
                            <p class="text-muted">By posting content on the Platform, you grant us a non-exclusive, worldwide, royalty-free license to use, reproduce, modify, and display such content for the purpose of operating and promoting the Platform.</p>
                            
                            <h5 class="fw-semibold mb-3 mt-4">8.3 Trademarks</h5>
                            <p class="text-muted">LAFRIQUE Properties and our logos are trademarks of our company. You may not use our trademarks without our prior written permission.</p>
                        </div>

                        <!-- Disclaimer of Warranties -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">9. Disclaimer of Warranties</h2>
                            <p class="text-muted">THE PLATFORM IS PROVIDED "AS IS" AND "AS AVAILABLE" WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED. WE DO NOT WARRANT THAT:</p>
                            <ul class="text-muted">
                                <li>The Platform will be uninterrupted, secure, or error-free</li>
                                <li>The information on the Platform is accurate or reliable</li>
                                <li>Any defects will be corrected</li>
                                <li>The Platform is free from viruses or harmful components</li>
                            </ul>
                        </div>

                        <!-- Limitation of Liability -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">10. Limitation of Liability</h2>
                            <p class="text-muted">TO THE MAXIMUM EXTENT PERMITTED BY LAW, WE SHALL NOT BE LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES, OR ANY LOSS OF PROFITS OR REVENUES, WHETHER INCURRED DIRECTLY OR INDIRECTLY, OR ANY LOSS OF DATA, USE, GOODWILL, OR OTHER INTANGIBLE LOSSES.</p>
                            <p class="text-muted">OUR TOTAL LIABILITY SHALL NOT EXCEED THE AMOUNT YOU PAID TO US IN THE TWELVE (12) MONTHS PRECEDING THE CLAIM.</p>
                        </div>

                        <!-- Indemnification -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">11. Indemnification</h2>
                            <p class="text-muted">You agree to indemnify, defend, and hold harmless LAFRIQUE Properties, its affiliates, officers, directors, employees, and agents from any claims, liabilities, damages, losses, and expenses arising from:</p>
                            <ul class="text-muted">
                                <li>Your use of the Platform</li>
                                <li>Your violation of these Terms</li>
                                <li>Your violation of any rights of another party</li>
                                <li>Your content posted on the Platform</li>
                            </ul>
                        </div>

                        <!-- Dispute Resolution -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">12. Dispute Resolution</h2>
                            <h5 class="fw-semibold mb-3">12.1 Governing Law</h5>
                            <p class="text-muted">These Terms shall be governed by and construed in accordance with applicable international laws.</p>
                            
                            <h5 class="fw-semibold mb-3 mt-4">12.2 Arbitration</h5>
                            <p class="text-muted">Any dispute arising from these Terms shall be resolved through binding arbitration in accordance with international arbitration standards.</p>
                            
                            <h5 class="fw-semibold mb-3 mt-4">12.3 Jurisdiction</h5>
                            <p class="text-muted">Disputes that cannot be resolved through arbitration shall be subject to the jurisdiction of competent courts.</p>
                        </div>

                        <!-- Changes to Terms -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">13. Changes to Terms</h2>
                            <p class="text-muted">We reserve the right to modify these Terms at any time. We will notify you of material changes by posting the updated Terms on the Platform and updating the "Last Updated" date. Your continued use of the Platform after such changes constitutes your acceptance of the new Terms.</p>
                        </div>

                        <!-- Contact Information -->
                        <div class="mb-0">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">14. Contact Information</h2>
                            <p class="text-muted">If you have any questions about these Terms, please contact us at:</p>
                            <div class="alert" style="background: linear-gradient(135deg, #f8f9ff 0%, #f0f4ff 100%); border: none; border-radius: 15px;">
                                <p class="mb-2"><strong>LAFRIQUE Properties</strong></p>
                                <p class="mb-2"><i class="fas fa-envelope text-primary me-2"></i>Email: legal@propertieslafrique.com</p>
                                <p class="mb-2"><i class="fas fa-phone text-primary me-2"></i>Phone: +234 XXX XXX XXXX</p>
                                <p class="mb-0"><i class="fas fa-map-marker-alt text-primary me-2"></i>Address: Africa</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Back to Home -->
                <div class="text-center">
                    <a href="{{ route('home') }}" class="btn btn-lg px-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white; border-radius: 10px;">
                        <i class="fas fa-home me-2"></i>Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
