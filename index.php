<?php
/**
 * Finolead Solutions - Premium Fintech Homepage
 */
$page_title = "The Operating System for Modern Digital Lending";
$page_desc = "Finolead Solutions delivers enterprise-grade Loan Origination, AI-driven Recovery & Collections, Payday Lending CRMs and custom financial architectures for NBFCs, Banks, and Digital Lenders.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- 1. Hero Section -->
<section class="hero-wrapper">
    <div class="hero-glow-1"></div>
    <div class="hero-glow-2"></div>
    <div class="container position-relative" style="z-index: 5;">
        <div class="row align-items-center g-5">
            <!-- Hero Pitch -->
            <div class="col-lg-6 animate-fade-in">
                <div class="badge bg-secondary-color  bg-opacity-10 text-white px-3 py-2 rounded-pill fw-bold mb-3">
                    <i class="bi bi-shield-lock me-1"></i> SOC2 & ISO 27001 Certified Platform
                </div>
                <h1 class="display-4 fw-800 text-primary-color mb-3" style="font-weight: 800; letter-spacing: -2px; line-height: 1.15;">
                    The Operating System for <span class="gradient-text-accent">Modern Lending</span>
                </h1>
                <p class="fs-5 text-muted mb-4 pe-lg-4">
                    Supercharge your origination velocities, orchestrate automated recovery collections, and drastically reduce NPAs with our AI-driven lending CRM platforms.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="<?php echo WEB_ROOT; ?>request-demo" class="btn btn-primary btn-lg shadow px-4 py-3"><i class="bi bi-calendar-event me-2"></i>Schedule Enterprise Demo</a>
                    <a href="<?php echo WEB_ROOT; ?>products" class="btn btn-outline-light border-secondary border-opacity-20 text-primary-color px-4 py-3"><i class="bi bi-cpu me-2"></i>Explore Core Products</a>
                </div>
            </div>
            
            <!-- Hero Dashboard Mockup -->
            <div class="col-lg-6">
                <div class="dashboard-mockup animate-float">
                    <div class="mockup-header d-flex align-items-center justify-content-between">
                        <div class="d-flex gap-1">
                            <span class="mockup-dot dot-red"></span>
                            <span class="mockup-dot dot-yellow"></span>
                            <span class="mockup-dot dot-green"></span>
                        </div>
                        <div class="text-muted small" style="font-size: 0.75rem;"><i class="bi bi-lock me-1"></i>fino-admin.finolead.solutions/dashboard</div>
                        <div><i class="bi bi-arrow-clockwise text-muted"></i></div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="mockup-card">
                                <span class="text-muted small d-block mb-1">Today's Origination Volume</span>
                                <strong class="text-white fs-4">$184,250</strong>
                                <span class="text-success small d-block mt-1"><i class="bi bi-arrow-up-right me-1"></i>+12.4% vs yesterday</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mockup-card">
                                <span class="text-muted small d-block mb-1">Average Application Processing</span>
                                <strong class="text-white fs-4">1.2 Seconds</strong>
                                <span class="text-success small d-block mt-1"><i class="bi bi-activity me-1"></i>Bureau API: Active</span>
                            </div>
                        </div>
                    </div>
                    <!-- Chart canvas initialized by main.js -->
                    <div style="height: 240px; position: relative;">
                        <canvas id="dashboardChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. Trusted By Companies -->
<section class="py-5 border-top border-bottom border-light-subtle bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 text-center text-lg-start mb-4 mb-lg-0">
                <span class="fw-bold text-primary-color text-uppercase small tracking-wider">Trusted by Leading Lenders</span>
            </div>
            <div class="col-lg-9">
                <div class="row g-4 align-items-center justify-content-center text-center">
                    <div class="col-md-3 col-6">
                        <!-- SVG Fake Bank Logo -->
                        <span class="fw-bold text-muted opacity-50 fs-5"><i class="bi bi-bank me-2"></i>AXIS PRIME</span>
                    </div>
                    <div class="col-md-3 col-6">
                        <span class="fw-bold text-muted opacity-50 fs-5"><i class="bi bi-credit-card me-2"></i>APEX NBFC</span>
                    </div>
                    <div class="col-md-3 col-6">
                        <span class="fw-bold text-muted opacity-50 fs-5"><i class="bi bi-arrow-repeat me-2"></i>RAPID CREDIT</span>
                    </div>
                    <div class="col-md-3 col-6">
                        <span class="fw-bold text-muted opacity-50 fs-5"><i class="bi bi-shield-fill-check me-2"></i>MUTHOOT PRO</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Services Overview -->
<section class="py-5 bg-gradient-flow">
    <div class="container py-4">
        <div class="text-center max-w-600 mx-auto mb-5">
            <h6 class="text-secondary-color text-uppercase fw-bold tracking-wider mb-2">Our Capabilities</h6>
            <h2 class="display-6 fw-bold">Modular Banking & Lending CRM Suites</h2>
            <p class="text-muted">Select components engineered specifically for financial speed and regulatory compliance.</p>
        </div>
        
        <div class="row g-4">
            <!-- Services Cards -->
            <div class="col-lg-4 col-md-6">
                <div class="crm-card">
                    <div class="crm-icon-wrapper bg-primary-color text-white">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Payday Loan CRM</h4>
                    <p class="text-muted mb-4 small">
                        Automate micro-credit cycles, calculate custom high-velocity rollover interests, and handle fast short-term digital disbursals instantly.
                    </p>
                    <a href="<?php echo WEB_ROOT; ?>services/payday-loan-crm" class="text-secondary-color fw-bold text-decoration-none small">Explore CRM <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="crm-card">
                    <div class="crm-icon-wrapper bg-secondary-color text-white">
                        <i class="bi bi-wallet2"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Collection CRM</h4>
                    <p class="text-muted mb-4 small">
                        Dynamic automated payment links, smart dialer integration, predictive queue management, and soft alert schedules.
                    </p>
                    <a href="<?php echo WEB_ROOT; ?>services/collection-crm" class="text-secondary-color fw-bold text-decoration-none small">Explore CRM <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="crm-card">
                    <div class="crm-icon-wrapper bg-accent-color text-white">
                        <i class="bi bi-people"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Lead Management CRM</h4>
                    <p class="text-muted mb-4 small">
                        Unify digital leads from multiple marketing platforms, scoring applicants instantly, and directing high-probability customers to sales agents.
                    </p>
                    <a href="<?php echo WEB_ROOT; ?>services/lead-management-crm" class="text-secondary-color fw-bold text-decoration-none small">Explore CRM <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="crm-card">
                    <div class="crm-icon-wrapper bg-danger text-white">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Recovery CRM</h4>
                    <p class="text-muted mb-4 small">
                        Manage late-stage NPAs, allocate portfolios to field collection agencies, track settlement paths, and coordinate legal actions.
                    </p>
                    <a href="<?php echo WEB_ROOT; ?>services/recovery-management-software" class="text-secondary-color fw-bold text-decoration-none small">Explore CRM <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="crm-card">
                    <div class="crm-icon-wrapper bg-warning text-dark">
                        <i class="bi bi-bank"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Loan Origination (LOS)</h4>
                    <p class="text-muted mb-4 small">
                        Underwrite loan applications in sub-seconds. Integrates directly with bureaus (CIBIL, Experian) and e-KYC platforms.
                    </p>
                    <a href="<?php echo WEB_ROOT; ?>services/loan-management-software" class="text-secondary-color fw-bold text-decoration-none small">Explore System <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="crm-card">
                    <div class="crm-icon-wrapper bg-dark text-white">
                        <i class="bi bi-robot"></i>
                    </div>
                    <h4 class="fw-bold mb-3">AI & Conversational Bot</h4>
                    <p class="text-muted mb-4 small">
                        Resolve applicant queries with multilingual conversational voicebots and chatbots. Predicts defaults during application stage.
                    </p>
                    <a href="<?php echo WEB_ROOT; ?>services#ai-automation" class="text-secondary-color fw-bold text-decoration-none small">Explore AI <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. Statistics Counter -->
<section class="py-5 bg-primary-color text-white position-relative overflow-hidden">
    <div style="position: absolute; width: 400px; height: 400px; background: radial-gradient(circle, rgba(37,99,235,0.15) 0%, rgba(255,255,255,0) 70%); top: -200px; left: -100px; pointer-events: none;"></div>
    <div class="container py-4 position-relative" style="z-index: 5;">
        <div class="row g-4 text-center">
            <div class="col-md-3 col-6">
                <div class="counter-box">
                    <div class="counter-value text-accent-color" data-target="450" data-suffix="M+">0</div>
                    <p class="text-white small mb-0 mt-2">Volume Processed</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="counter-box">
                    <div class="counter-value text-white" data-target="99" data-suffix=".99%">0</div>
                    <p class="text-white small mb-0 mt-2">Platform Uptime SLA</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="counter-box">
                    <div class="counter-value text-accent-color" data-target="12" data-suffix="s">0</div>
                    <p class="text-white small mb-0 mt-2">Avg Underwrite Speed</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="counter-box">
                    <div class="counter-value text-white" data-target="300" data-suffix="+">0</div>
                    <p class="text-white small mb-0 mt-2">NBFCs & Banks Integrated</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. Product Showcase & Dashboard Mockup -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <h6 class="text-accent-color text-uppercase fw-bold tracking-wider mb-2">FinoCollect Module</h6>
                <h2 class="display-6 fw-bold mb-4">Empower Collections desks with automated payment recovery workflows</h2>
                <p class="text-muted mb-4">
                    Traditional debt recovery is slow, expensive, and error-prone. FinoCollect automates interactions, routing, notifications, and ledger tracking in real-time.
                </p>
                <div class="d-flex align-items-start gap-3 mb-3">
                    <span class="bg-light p-2 rounded-3 text-secondary-color"><i class="bi bi-chat-left-text-fill fs-5"></i></span>
                    <div>
                        <h5 class="fw-bold mb-1 fs-6">Omnichannel Messaging</h5>
                        <p class="text-muted small mb-0">Recover payments using interactive voicebots, dynamic WhatsApp links, and SMS triggers.</p>
                    </div>
                </div>
                <div class="d-flex align-items-start gap-3 mb-4">
                    <span class="bg-light p-2 rounded-3 text-accent-color"><i class="bi bi-diagram-3-fill fs-5"></i></span>
                    <div>
                        <h5 class="fw-bold mb-1 fs-6">Dynamic Risk Allocation</h5>
                        <p class="text-muted small mb-0">Direct high-risk, high-ticket accounts to specialized agents automatically.</p>
                    </div>
                </div>
                <a href="<?php echo WEB_ROOT; ?>products" class="btn btn-primary px-4">See FinoCollect in Action</a>
            </div>
            <div class="col-lg-7">
                <div class="p-3 bg-light rounded-4 shadow-sm border border-light-subtle position-relative">
                    <span class="badge bg-accent-color text-white position-absolute top-0 end-0 mt-4 me-4" style="z-index: 10;">Interactive Simulator</span>
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80" alt="Finolead Dashboard Preview" class="img-fluid rounded-3 shadow" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 6. Why Choose Us -->
<section class="py-5 bg-gradient-flow">
    <div class="container py-4">
        <div class="text-center max-w-600 mx-auto mb-5">
            <h6 class="text-secondary-color text-uppercase fw-bold tracking-wider mb-2">The Finolead Edge</h6>
            <h2 class="display-6 fw-bold">Why Top Financial Brands Partner with Us</h2>
            <p class="text-muted">Built for rapid scalability, compliance assurance, and frictionless integrations.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="glass-card p-4 h-100">
                    <div class="text-secondary-color fs-2 mb-3"><i class="bi bi-lightning-charge-fill"></i></div>
                    <h5 class="fw-bold mb-2">Ultra-Fast Integration</h5>
                    <p class="text-muted small mb-0">
                        Plug our secure modular APIs directly into your mobile app or website core. Goes live in a fraction of traditional ERP setup times.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card p-4 h-100">
                    <div class="text-accent-color fs-2 mb-3"><i class="bi bi-shield-fill-check"></i></div>
                    <h5 class="fw-bold mb-2">Regulatory Guardrails</h5>
                    <p class="text-muted small mb-0">
                        Built-in compliances mapping local reserve bank rules, data residence parameters, and fair-practice recovery standards.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card p-4 h-100">
                    <div class="text-danger fs-2 mb-3"><i class="bi bi-graph-up-arrow"></i></div>
                    <h5 class="fw-bold mb-2">Analytics & Deep Insights</h5>
                    <p class="text-muted small mb-0">
                        Monitor lead quality, agent output metrics, NPA percentages, and recovery velocities in real-time through custom layouts.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 7. Testimonials Section (Enhanced Premium Slick Slider) -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center max-w-600 mx-auto mb-5">
            <h6 class="text-secondary-color text-uppercase fw-bold tracking-wider mb-2">Success Stories</h6>
            <h2 class="display-6 fw-bold">Proven Outcomes from the Front Lines</h2>
            <p class="text-muted">Hear directly from the leadership teams of NBFCs and banks integrated with Finolead Solutions.</p>
        </div>
        
        <div class="testimonial-slider mt-4">
            <!-- Testimonial 1 -->
            <div class="px-2 pb-4">
                <div class="card border-0 glass-card h-100 p-4 position-relative overflow-hidden shadow-sm" style="border-radius: 20px; border: 1px solid rgba(226, 232, 240, 0.8) !important;">
                    <!-- Glowing Top Line Accent -->
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 5px; background: linear-gradient(90deg, var(--secondary), var(--accent));"></div>
                    
                    <!-- Quote Accent Background Icon -->
                    <div class="position-absolute opacity-10" style="top: 15px; right: 20px; font-size: 3.5rem; pointer-events: none; color: var(--secondary);">
                        <i class="bi bi-quote"></i>
                    </div>
                    
                    <!-- Star Rating Indicators -->
                    <div class="mb-3 text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    
                    <p class="text-muted small mb-4 italic" style="line-height: 1.65; flex-grow: 1; font-style: italic;">
                        "Integrating FinoCollect reduced our early-stage NPA default rate by an absolute 28% in the first quarter itself. The automated messaging cycles freed our risk desk to focus on complex underwriting metrics."
                    </p>
                    
                    <div class="d-flex align-items-center gap-3 mt-auto pt-3 border-top border-light-subtle">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80" alt="Rajesh Mehta" class="rounded-circle border border-2 border-primary-color" style="width: 50px; height: 50px; object-fit: cover;">
                        <div>
                            <h6 class="fw-bold mb-0 text-primary-color">Rajesh Mehta</h6>
                            <span class="text-muted small d-block" style="font-size: 0.75rem;">Chief Risk Officer</span>
                            <span class="text-secondary-color fw-bold" style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px;">Apex NBFC Group</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="px-2 pb-4">
                <div class="card border-0 glass-card h-100 p-4 position-relative overflow-hidden shadow-sm" style="border-radius: 20px; border: 1px solid rgba(226, 232, 240, 0.8) !important;">
                    <!-- Glowing Top Line Accent -->
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 5px; background: linear-gradient(90deg, var(--accent), var(--secondary));"></div>
                    
                    <!-- Quote Accent Background Icon -->
                    <div class="position-absolute opacity-10" style="top: 15px; right: 20px; font-size: 3.5rem; pointer-events: none; color: var(--accent);">
                        <i class="bi bi-quote"></i>
                    </div>
                    
                    <!-- Star Rating Indicators -->
                    <div class="mb-3 text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    
                    <p class="text-muted small mb-4 italic" style="line-height: 1.65; flex-grow: 1; font-style: italic;">
                        "The Loan Origination System (LOS) delivered by Finolead is flawless. Our customer acquisition funnel checks credit reports and issues instant approvals in under 1.5 seconds. Customer trust has skyrocketed."
                    </p>
                    
                    <div class="d-flex align-items-center gap-3 mt-auto pt-3 border-top border-light-subtle">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&q=80" alt="Priya Nair" class="rounded-circle border border-2 border-primary-color" style="width: 50px; height: 50px; object-fit: cover;">
                        <div>
                            <h6 class="fw-bold mb-0 text-primary-color">Priya Nair</h6>
                            <span class="text-muted small d-block" style="font-size: 0.75rem;">Director of Operations</span>
                            <span class="text-secondary-color fw-bold" style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px;">FinCap Solutions</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Testimonial 3 -->
            <div class="px-2 pb-4">
                <div class="card border-0 glass-card h-100 p-4 position-relative overflow-hidden shadow-sm" style="border-radius: 20px; border: 1px solid rgba(226, 232, 240, 0.8) !important;">
                    <!-- Glowing Top Line Accent -->
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 5px; background: linear-gradient(90deg, var(--secondary), var(--accent));"></div>
                    
                    <!-- Quote Accent Background Icon -->
                    <div class="position-absolute opacity-10" style="top: 15px; right: 20px; font-size: 3.5rem; pointer-events: none; color: var(--secondary);">
                        <i class="bi bi-quote"></i>
                    </div>
                    
                    <!-- Star Rating Indicators -->
                    <div class="mb-3 text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    
                    <p class="text-muted small mb-4 italic" style="line-height: 1.65; flex-grow: 1; font-style: italic;">
                        "Deploying Finolead's custom lead scoring engine and robust API bridges took our onboarding from days to minutes. A game-changer for digital lenders seeking compliance and speed."
                    </p>
                    
                    <div class="d-flex align-items-center gap-3 mt-auto pt-3 border-top border-light-subtle">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=150&q=80" alt="Aravind Swamy" class="rounded-circle border border-2 border-primary-color" style="width: 50px; height: 50px; object-fit: cover;">
                        <div>
                            <h6 class="fw-bold mb-0 text-primary-color">Aravind Swamy</h6>
                            <span class="text-muted small d-block" style="font-size: 0.75rem;">VP of Engineering</span>
                            <span class="text-secondary-color fw-bold" style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px;">Rapid Credit Corp</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 4 -->
            <div class="px-2 pb-4">
                <div class="card border-0 glass-card h-100 p-4 position-relative overflow-hidden shadow-sm" style="border-radius: 20px; border: 1px solid rgba(226, 232, 240, 0.8) !important;">
                    <!-- Glowing Top Line Accent -->
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 5px; background: linear-gradient(90deg, var(--accent), var(--secondary));"></div>
                    
                    <!-- Quote Accent Background Icon -->
                    <div class="position-absolute opacity-10" style="top: 15px; right: 20px; font-size: 3.5rem; pointer-events: none; color: var(--accent);">
                        <i class="bi bi-quote"></i>
                    </div>
                    
                    <!-- Star Rating Indicators -->
                    <div class="mb-3 text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    
                    <p class="text-muted small mb-4 italic" style="line-height: 1.65; flex-grow: 1; font-style: italic;">
                        "Finolead's custom Payday CRM revolutionized our loan product launch. We integrated their APIs in under 10 days and processed over 50,000 disbursals in the very first month with zero downtime."
                    </p>
                    
                    <div class="d-flex align-items-center gap-3 mt-auto pt-3 border-top border-light-subtle">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=150&q=80" alt="Vikram Malhotra" class="rounded-circle border border-2 border-primary-color" style="width: 50px; height: 50px; object-fit: cover;">
                        <div>
                            <h6 class="fw-bold mb-0 text-primary-color">Vikram Malhotra</h6>
                            <span class="text-muted small d-block" style="font-size: 0.75rem;">Head of Digital Lending</span>
                            <span class="text-secondary-color fw-bold" style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px;">Axis Prime Finance</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 5 -->
            <div class="px-2 pb-4">
                <div class="card border-0 glass-card h-100 p-4 position-relative overflow-hidden shadow-sm" style="border-radius: 20px; border: 1px solid rgba(226, 232, 240, 0.8) !important;">
                    <!-- Glowing Top Line Accent -->
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 5px; background: linear-gradient(90deg, var(--secondary), var(--accent));"></div>
                    
                    <!-- Quote Accent Background Icon -->
                    <div class="position-absolute opacity-10" style="top: 15px; right: 20px; font-size: 3.5rem; pointer-events: none; color: var(--secondary);">
                        <i class="bi bi-quote"></i>
                    </div>
                    
                    <!-- Star Rating Indicators -->
                    <div class="mb-3 text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    
                    <p class="text-muted small mb-4 italic" style="line-height: 1.65; flex-grow: 1; font-style: italic;">
                        "Operating in highly regulated microfinance markets requires absolute structural compliance. Finolead's automated recovery workflows safeguard our collection activities under strict central bank policies."
                    </p>
                    
                    <div class="d-flex align-items-center gap-3 mt-auto pt-3 border-top border-light-subtle">
                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=150&q=80" alt="Meera Sengupta" class="rounded-circle border border-2 border-primary-color" style="width: 50px; height: 50px; object-fit: cover;">
                        <div>
                            <h6 class="fw-bold mb-0 text-primary-color">Meera Sengupta</h6>
                            <span class="text-muted small d-block" style="font-size: 0.75rem;">Chief Compliance Officer</span>
                            <span class="text-secondary-color fw-bold" style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px;">Muthoot Pro Lending</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 8. FAQ Accordion -->
<section class="py-5 bg-gradient-flow">
    <div class="container py-4">
        <div class="text-center max-w-600 mx-auto mb-5">
            <h6 class="text-secondary-color text-uppercase fw-bold tracking-wider mb-2">FAQ</h6>
            <h2 class="display-6 fw-bold">Frequently Asked Questions</h2>
            <p class="text-muted">Answers to common structural, security, and onboarding questions.</p>
        </div>
        
        <div class="accordion max-w-800 mx-auto" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        Is Finolead Solutions compliant with reserve bank lending guidelines?
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">
                        Absolutely. All Finolead engines (LOS, Collection CRM, Recovery modules) are built to strictly follow local reserve bank standards, consumer data privacy rules, digital lending disclosure frameworks, and fair-practice recovery mandates.
                    </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                        How secure is applicant data stored in your SaaS systems?
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">
                        Data security is our top priority. We implement end-to-end data encryption (AES-256 for data at rest, TLS 1.3 for data in transit), secure server partitioning, regular system vulnerability scans, and have achieved SOC2 and ISO 27001 certifications.
                    </div>
                </div>
            </div>
 
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                        Can we integrate your CRM modules with our pre-existing banking ledger?
                    </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">
                        Yes. Finolead CRMs are designed to be fully modular and API-first. You can integrate specific dashboards (like FinoCollect or FinoCore scoring engines) directly into your existing core banking database using our secure developer webhooks.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 
<!-- 9. Contact CTA -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="bg-gradient-premium rounded-4 p-5 position-relative overflow-hidden text-center text-white">
            <div style="position: absolute; width: 400px; height: 400px; background: radial-gradient(circle, rgba(20,184,166,0.15) 0%, rgba(255,255,255,0) 70%); bottom: -200px; right: -100px; pointer-events: none;"></div>
            <div style="position: absolute; width: 300px; height: 300px; background: radial-gradient(circle, rgba(37,99,235,0.15) 0%, rgba(255,255,255,0) 70%); top: -150px; left: -100px; pointer-events: none;"></div>
            
            <div class="position-relative" style="z-index: 5;">
                <h2 class="display-6 fw-bold text-white mb-3">Ready to Accelerate Your Lending Operations?</h2>
                <p class="fs-5 text-white-50 max-w-600 mx-auto mb-4">
                    Join over 300 banks, digital lending platforms, and microfinance organizations running on Finolead Solutions.
                </p>
                <div class="d-flex justify-content-center flex-wrap gap-3">
                    <a href="<?php echo WEB_ROOT; ?>request-demo" class="btn btn-accent btn-lg px-4 py-3">Book Your Enterprise Demo</a>
                    <a href="<?php echo WEB_ROOT; ?>contact" class="btn btn-outline-light px-4 py-3">Contact Advisory Desk</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Load jQuery and Slick Slider JS for Testimonial Carousel -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.testimonial-slider').slick({
        dots: true,
        infinite: true,
        speed: 600,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        arrows: false,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
