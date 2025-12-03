@extends('layouts.public')

@section('title', 'Privacy Policy')

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
                <h1 class="display-4 fw-bold mb-3" style="text-shadow: 0 2px 20px rgba(0,0,0,0.15);">🔒 Privacy Policy</h1>
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
                            <p class="text-muted">LAFRIQUE Properties ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our website, mobile applications, and services (collectively, the "Platform").</p>
                            <p class="text-muted">By using our Platform, you consent to the data practices described in this Privacy Policy. If you do not agree with this Privacy Policy, please do not use our Platform.</p>
                        </div>

                        <!-- Information We Collect -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">2. Information We Collect</h2>
                            
                            <h5 class="fw-semibold mb-3">2.1 Personal Information</h5>
                            <p class="text-muted">We collect personal information that you voluntarily provide to us when you:</p>
                            <ul class="text-muted">
                                <li><strong>Register for an account:</strong> Name, email address, phone number, password</li>
                                <li><strong>Create a profile:</strong> Business name, professional credentials, profile photo</li>
                                <li><strong>List a property:</strong> Property details, photos, location, contact information</li>
                                <li><strong>Make inquiries:</strong> Name, email, phone number, message content</li>
                                <li><strong>Subscribe to services:</strong> Payment information, billing address</li>
                                <li><strong>Contact us:</strong> Any information you provide in communications</li>
                            </ul>
                            
                            <h5 class="fw-semibold mb-3 mt-4">2.2 Automatically Collected Information</h5>
                            <p class="text-muted">When you access our Platform, we automatically collect certain information, including:</p>
                            <ul class="text-muted">
                                <li><strong>Device Information:</strong> IP address, browser type, operating system, device identifiers</li>
                                <li><strong>Usage Data:</strong> Pages viewed, time spent on pages, links clicked, search queries</li>
                                <li><strong>Location Data:</strong> Approximate location based on IP address</li>
                                <li><strong>Cookies and Tracking:</strong> Information collected through cookies, web beacons, and similar technologies</li>
                            </ul>
                            
                            <h5 class="fw-semibold mb-3 mt-4">2.3 Information from Third Parties</h5>
                            <p class="text-muted">We may receive information about you from third parties, such as:</p>
                            <ul class="text-muted">
                                <li>Social media platforms (if you connect your account)</li>
                                <li>Payment processors</li>
                                <li>Analytics providers</li>
                                <li>Marketing partners</li>
                            </ul>
                        </div>

                        <!-- How We Use Your Information -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">3. How We Use Your Information</h2>
                            <p class="text-muted">We use the information we collect for the following purposes:</p>
                            
                            <h5 class="fw-semibold mb-3 mt-4">3.1 To Provide and Maintain Our Services</h5>
                            <ul class="text-muted">
                                <li>Create and manage your account</li>
                                <li>Process and display property listings</li>
                                <li>Facilitate communication between users</li>
                                <li>Process payments and subscriptions</li>
                                <li>Provide customer support</li>
                            </ul>
                            
                            <h5 class="fw-semibold mb-3 mt-4">3.2 To Improve Our Platform</h5>
                            <ul class="text-muted">
                                <li>Analyze usage patterns and trends</li>
                                <li>Develop new features and functionality</li>
                                <li>Conduct research and analytics</li>
                                <li>Test and troubleshoot issues</li>
                            </ul>
                            
                            <h5 class="fw-semibold mb-3 mt-4">3.3 To Communicate With You</h5>
                            <ul class="text-muted">
                                <li>Send transactional emails (account notifications, listing updates)</li>
                                <li>Respond to your inquiries and requests</li>
                                <li>Send marketing communications (with your consent)</li>
                                <li>Provide important updates about our services</li>
                            </ul>
                            
                            <h5 class="fw-semibold mb-3 mt-4">3.4 For Security and Legal Compliance</h5>
                            <ul class="text-muted">
                                <li>Prevent fraud and abuse</li>
                                <li>Enforce our Terms and Conditions</li>
                                <li>Comply with legal obligations</li>
                                <li>Protect our rights and property</li>
                            </ul>
                        </div>

                        <!-- How We Share Your Information -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">4. How We Share Your Information</h2>
                            <p class="text-muted">We may share your information in the following circumstances:</p>
                            
                            <h5 class="fw-semibold mb-3">4.1 With Other Users</h5>
                            <p class="text-muted">When you create a property listing, certain information (such as your name, contact details, and property information) will be visible to other users of the Platform.</p>
                            
                            <h5 class="fw-semibold mb-3 mt-4">4.2 With Service Providers</h5>
                            <p class="text-muted">We share information with third-party service providers who perform services on our behalf, including:</p>
                            <ul class="text-muted">
                                <li>Payment processors (Paystack, Flutterwave)</li>
                                <li>Cloud hosting providers</li>
                                <li>Email service providers</li>
                                <li>Analytics providers</li>
                                <li>Customer support tools</li>
                            </ul>
                            
                            <h5 class="fw-semibold mb-3 mt-4">4.3 For Legal Reasons</h5>
                            <p class="text-muted">We may disclose your information if required by law or in response to:</p>
                            <ul class="text-muted">
                                <li>Legal process or government requests</li>
                                <li>Enforcement of our Terms and Conditions</li>
                                <li>Protection of our rights, property, or safety</li>
                                <li>Investigation of fraud or security issues</li>
                            </ul>
                            
                            <h5 class="fw-semibold mb-3 mt-4">4.4 Business Transfers</h5>
                            <p class="text-muted">In the event of a merger, acquisition, or sale of assets, your information may be transferred to the acquiring entity.</p>
                            
                            <h5 class="fw-semibold mb-3 mt-4">4.5 With Your Consent</h5>
                            <p class="text-muted">We may share your information for any other purpose with your explicit consent.</p>
                        </div>

                        <!-- Cookies and Tracking Technologies -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">5. Cookies and Tracking Technologies</h2>
                            <p class="text-muted">We use cookies and similar tracking technologies to collect and track information about your use of our Platform.</p>
                            
                            <h5 class="fw-semibold mb-3">5.1 Types of Cookies We Use</h5>
                            <ul class="text-muted">
                                <li><strong>Essential Cookies:</strong> Required for the Platform to function properly</li>
                                <li><strong>Analytics Cookies:</strong> Help us understand how users interact with our Platform</li>
                                <li><strong>Functional Cookies:</strong> Remember your preferences and settings</li>
                                <li><strong>Marketing Cookies:</strong> Used to deliver relevant advertisements</li>
                            </ul>
                            
                            <h5 class="fw-semibold mb-3 mt-4">5.2 Managing Cookies</h5>
                            <p class="text-muted">You can control cookies through your browser settings. However, disabling cookies may affect the functionality of our Platform.</p>
                        </div>

                        <!-- Data Security -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">6. Data Security</h2>
                            <p class="text-muted">We implement appropriate technical and organizational measures to protect your personal information, including:</p>
                            <ul class="text-muted">
                                <li>Encryption of data in transit and at rest</li>
                                <li>Secure server infrastructure</li>
                                <li>Regular security assessments</li>
                                <li>Access controls and authentication</li>
                                <li>Employee training on data protection</li>
                            </ul>
                            <p class="text-muted">However, no method of transmission over the internet or electronic storage is 100% secure. While we strive to protect your information, we cannot guarantee absolute security.</p>
                        </div>

                        <!-- Data Retention -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">7. Data Retention</h2>
                            <p class="text-muted">We retain your personal information for as long as necessary to:</p>
                            <ul class="text-muted">
                                <li>Provide our services to you</li>
                                <li>Comply with legal obligations</li>
                                <li>Resolve disputes</li>
                                <li>Enforce our agreements</li>
                            </ul>
                            <p class="text-muted">When we no longer need your information, we will securely delete or anonymize it.</p>
                        </div>

                        <!-- Your Rights and Choices -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">8. Your Rights and Choices</h2>
                            <p class="text-muted">You have the following rights regarding your personal information:</p>
                            
                            <h5 class="fw-semibold mb-3">8.1 Access and Correction</h5>
                            <p class="text-muted">You can access and update your account information at any time through your account settings.</p>
                            
                            <h5 class="fw-semibold mb-3 mt-4">8.2 Data Portability</h5>
                            <p class="text-muted">You have the right to request a copy of your personal information in a structured, commonly used format.</p>
                            
                            <h5 class="fw-semibold mb-3 mt-4">8.3 Deletion</h5>
                            <p class="text-muted">You can request deletion of your account and personal information by contacting us. Note that we may retain certain information as required by law.</p>
                            
                            <h5 class="fw-semibold mb-3 mt-4">8.4 Marketing Communications</h5>
                            <p class="text-muted">You can opt out of marketing emails by clicking the "unsubscribe" link in any marketing email or by updating your account preferences.</p>
                            
                            <h5 class="fw-semibold mb-3 mt-4">8.5 Do Not Track</h5>
                            <p class="text-muted">Our Platform does not currently respond to "Do Not Track" signals from browsers.</p>
                        </div>

                        <!-- Children's Privacy -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">9. Children's Privacy</h2>
                            <p class="text-muted">Our Platform is not intended for children under the age of 18. We do not knowingly collect personal information from children. If we become aware that we have collected information from a child under 18, we will take steps to delete such information.</p>
                        </div>

                        <!-- International Data Transfers -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">10. International Data Transfers</h2>
                            <p class="text-muted">Your information may be transferred to and processed in countries other than Nigeria. We ensure that appropriate safeguards are in place to protect your information in accordance with this Privacy Policy.</p>
                        </div>

                        <!-- Third-Party Links -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">11. Third-Party Links</h2>
                            <p class="text-muted">Our Platform may contain links to third-party websites. We are not responsible for the privacy practices of these websites. We encourage you to review the privacy policies of any third-party sites you visit.</p>
                        </div>

                        <!-- Changes to Privacy Policy -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">12. Changes to This Privacy Policy</h2>
                            <p class="text-muted">We may update this Privacy Policy from time to time. We will notify you of material changes by:</p>
                            <ul class="text-muted">
                                <li>Posting the updated Privacy Policy on our Platform</li>
                                <li>Updating the "Last Updated" date</li>
                                <li>Sending you an email notification (for significant changes)</li>
                            </ul>
                            <p class="text-muted">Your continued use of the Platform after such changes constitutes your acceptance of the updated Privacy Policy.</p>
                        </div>

                        <!-- Nigeria Data Protection Regulation -->
                        <div class="mb-5">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">13. Nigeria Data Protection Regulation (NDPR)</h2>
                            <p class="text-muted">We comply with the Nigeria Data Protection Regulation (NDPR) 2019. As a data subject in Nigeria, you have specific rights under the NDPR, including:</p>
                            <ul class="text-muted">
                                <li>Right to information about data processing</li>
                                <li>Right of access to your personal data</li>
                                <li>Right to rectification of inaccurate data</li>
                                <li>Right to erasure (right to be forgotten)</li>
                                <li>Right to restrict processing</li>
                                <li>Right to data portability</li>
                                <li>Right to object to processing</li>
                            </ul>
                            <p class="text-muted">To exercise any of these rights, please contact our Data Protection Officer using the contact information below.</p>
                        </div>

                        <!-- Contact Information -->
                        <div class="mb-0">
                            <h2 class="fw-bold mb-3" style="color: #5568d3;">14. Contact Us</h2>
                            <p class="text-muted">If you have any questions, concerns, or requests regarding this Privacy Policy or our data practices, please contact us:</p>
                            <div class="alert" style="background: linear-gradient(135deg, #f8f9ff 0%, #f0f4ff 100%); border: none; border-radius: 15px;">
                                <p class="mb-2"><strong>Data Protection Officer</strong></p>
                                <p class="mb-2"><strong>LAFRIQUE Properties</strong></p>
                                <p class="mb-2"><i class="fas fa-envelope text-primary me-2"></i>Email: privacy@propertieslafrique.com</p>
                                <p class="mb-2"><i class="fas fa-shield-alt text-primary me-2"></i>DPO Email: dpo@propertieslafrique.com</p>
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
