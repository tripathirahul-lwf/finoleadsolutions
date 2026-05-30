<?php
/**
 * Finolead Solutions - Tech Stack & Engineering Page
 */
$page_title = "Our Technology Stack, APIs & Infrastructure Core";
$page_desc = "Explore the enterprise engineering architecture of Finolead Solutions, featuring API integrations, cloud scales, and low-latency financial ledgers.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Header -->
<header class="page-header">
    <div class="page-header-glow"></div>
    <div class="container position-relative" style="z-index: 5;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="badge bg-accent-color bg-opacity-10 text-accent-color px-3 py-2 rounded-pill fw-bold mb-3">
                    Tech Stack & Architecture
                </div>
                <h1 class="display-5 fw-bold mb-3">Enterprise-Grade Performance & Scalability</h1>
                <p class="fs-5 text-muted mb-0">
                    Engineered using high-performance database cluster protocols, clean APIs, and modern risk models to guarantee sub-second execution speeds.
                </p>
            </div>
        </div>
    </div>
</header>

<!-- Tech Stack Grid -->
<section class="py-5 bg-white">
    <div class="container py-4">
        
        <div class="row align-items-center g-5 mb-5">
            <div class="col-lg-6">
                <h6 class="text-secondary-color text-uppercase fw-bold tracking-wider mb-2">Our Engineering Core</h6>
                <h2 class="fw-bold mb-3">Built for High-Concurrency Lending Channels</h2>
                <p class="text-muted mb-3">
                    Fintech environments require zero downtime and absolute data consistency. Finolead's modular components run on an API-first stack that isolates data tenants and partitions balances with complete precision.
                </p>
                <p class="text-muted">
                    Our platform scales from handling minor credit checks to routing millions of active repayment webhooks per day. The core architecture uses robust backend validations and secure database query protocols to ensure zero room for operational errors.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="p-4 bg-light rounded-4 shadow-sm border">
                    <h5 class="fw-bold mb-3 text-primary-color"><i class="bi bi-code-square me-2 text-secondary-color"></i>Core Developer Sandbox</h5>
                    <pre class="bg-dark text-success p-3 rounded-3 small mb-0" style="font-family: monospace; overflow-x: auto;">
POST /api/v1/origination/apply
Host: api.finolead.solutions
Authorization: Bearer sec_live_83f...
Content-Type: application/json

{
  "applicant_id": "cust_90124",
  "requested_amount": 25000.00,
  "tenure_days": 30,
  "bureau_bypass": false,
  "webhook_url": "https://callback.nbfc.com/loan"
}

// Response: 202 Accepted
// Underwriting Status: Processing (Sub-1s check)</pre>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-12 text-center mb-4">
                <h3 class="fw-bold">Platform Tech Components</h3>
            </div>
            
            <!-- Tech 1 -->
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-3 p-4 h-100 text-center">
                    <span class="fs-1 text-secondary-color d-block mb-3"><i class="bi bi-database-fill-gear"></i></span>
                    <h5 class="fw-bold mb-2">Clustered MySQL Core</h5>
                    <p class="text-muted small mb-0">Replicated database clusters with strict index optimizations to handle intensive reads and transactional writes seamlessly.</p>
                </div>
            </div>

            <!-- Tech 2 -->
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-3 p-4 h-100 text-center">
                    <span class="fs-1 text-accent-color d-block mb-3"><i class="bi bi-terminal-fill"></i></span>
                    <h5 class="fw-bold mb-2">High-Perf PHP 8.x</h5>
                    <p class="text-muted small mb-0">Modular object-oriented PHP engines running secure session checks and robust PDO parameterized query architectures.</p>
                </div>
            </div>

            <!-- Tech 3 -->
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-3 p-4 h-100 text-center">
                    <span class="fs-1 text-danger d-block mb-3"><i class="bi bi-lightning-charge-fill"></i></span>
                    <h5 class="fw-bold mb-2">Low-Latency Redis</h5>
                    <p class="text-muted small mb-0">High-speed distributed in-memory data store caching active API session configurations and system settings.</p>
                </div>
            </div>

            <!-- Tech 4 -->
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-3 p-4 h-100 text-center">
                    <span class="fs-1 text-warning d-block mb-3"><i class="bi bi-hdd-network-fill"></i></span>
                    <h5 class="fw-bold mb-2">AWS Scalability</h5>
                    <p class="text-muted small mb-0">Load-balanced microservices structured on isolated Virtual Private Clouds (VPC) with continuous backup guardrails.</p>
                </div>
            </div>
        </div>

    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
