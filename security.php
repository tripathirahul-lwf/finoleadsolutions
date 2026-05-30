<?php
/**
 * Finolead Solutions - Security & Compliance Page
 */
$page_title = "Bank-Grade Security, SOC2 & ISO 27001 Compliance";
$page_desc = "Review our comprehensive security framework, end-to-end data encryption protocols, GDPR compliance, and active compliance certificates.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Header -->
<header class="page-header">
    <div class="page-header-glow"></div>
    <div class="container position-relative" style="z-index: 5;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-bold mb-3">
                    Security First
                </div>
                <h1 class="display-5 fw-bold mb-3">Bank-Grade Data Protection & Compliance</h1>
                <p class="fs-5 text-muted mb-0">
                    We maintain rigorous technical frameworks to secure sensitive financial profiles and comply with international digital banking standards.
                </p>
            </div>
        </div>
    </div>
</header>

<!-- Security Highlights -->
<section class="py-5 bg-white">
    <div class="container py-4">
        
        <div class="row g-4 mb-5 text-center">
            <!-- Badge 1 -->
            <div class="col-md-3 col-6">
                <div class="p-4 bg-light rounded-4 border">
                    <span class="fs-1 text-danger d-block mb-2"><i class="bi bi-shield-lock-fill"></i></span>
                    <h5 class="fw-bold mb-1">SOC2 Type II</h5>
                    <span class="text-muted small">Audited Operations</span>
                </div>
            </div>
            <!-- Badge 2 -->
            <div class="col-md-3 col-6">
                <div class="p-4 bg-light rounded-4 border">
                    <span class="fs-1 text-secondary-color d-block mb-2"><i class="bi bi-patch-check-fill"></i></span>
                    <h5 class="fw-bold mb-1">ISO 27001</h5>
                    <span class="text-muted small">Information Security</span>
                </div>
            </div>
            <!-- Badge 3 -->
            <div class="col-md-3 col-6">
                <div class="p-4 bg-light rounded-4 border">
                    <span class="fs-1 text-accent-color d-block mb-2"><i class="bi bi-globe2"></i></span>
                    <h5 class="fw-bold mb-1">GDPR</h5>
                    <span class="text-muted small">Data Privacy Compliant</span>
                </div>
            </div>
            <!-- Badge 4 -->
            <div class="col-md-3 col-6">
                <div class="p-4 bg-light rounded-4 border">
                    <span class="fs-1 text-warning d-block mb-2"><i class="bi bi-credit-card-fill"></i></span>
                    <h5 class="fw-bold mb-1">PCI-DSS Lvl 1</h5>
                    <span class="text-muted small">Secure Transactions</span>
                </div>
            </div>
        </div>

        <div class="row align-items-center g-5 pt-4">
            <div class="col-lg-6">
                <h3 class="fw-bold mb-3">Technical Safeguards Overview</h3>
                <p class="text-muted mb-4">
                    Finolead Solutions isolates client databases, meaning tenant records are completely segregated in dedicated cloud database rings. Our platform is protected by active edge defense shields and real-time monitoring blocks.
                </p>
                
                <div class="d-flex gap-3 mb-3">
                    <span class="text-secondary-color fs-4"><i class="bi bi-arrow-right-circle-fill"></i></span>
                    <div>
                        <h5 class="fw-bold mb-1 fs-6">E2E Encryption Rails</h5>
                        <p class="text-muted small mb-0">All client financial profiles are encrypted using AES-256 at rest, and TLS 1.3 standards in transit.</p>
                    </div>
                </div>

                <div class="d-flex gap-3 mb-3">
                    <span class="text-secondary-color fs-4"><i class="bi bi-arrow-right-circle-fill"></i></span>
                    <div>
                        <h5 class="fw-bold mb-1 fs-6">Vulnerability Scans (DAST/SAST)</h5>
                        <p class="text-muted small mb-0">Our platform undergoes regular structural inspections by third-party certified cybersecurity engineers.</p>
                    </div>
                </div>

                <div class="d-flex gap-3">
                    <span class="text-secondary-color fs-4"><i class="bi bi-arrow-right-circle-fill"></i></span>
                    <div>
                        <h5 class="fw-bold mb-1 fs-6">Role-Based Access Management</h5>
                        <p class="text-muted small mb-0">Administrative tools implement strict granular rights structures, requiring Multi-Factor Authentication (MFA).</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="bg-gradient-premium rounded-4 p-5 text-white position-relative overflow-hidden">
                    <div style="position: absolute; width: 300px; height: 300px; background: radial-gradient(circle, rgba(239,68,68,0.1) 0%, rgba(255,255,255,0) 70%); bottom: -150px; right: -100px; pointer-events: none;"></div>
                    
                    <div class="position-relative" style="z-index: 5;">
                        <h4 class="fw-bold text-white mb-3"><i class="bi bi-shield-shaded me-2 text-danger"></i>Platform Security Parameters</h4>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3 d-flex align-items-center">
                                <i class="bi bi-lock-fill text-danger me-3 fs-5"></i>
                                <div>
                                    <h6 class="mb-0 text-white fw-bold">SQLi & XSS Defense</h6>
                                    <p class="text-white-50 small mb-0">Input validations filter malicious codes automatically.</p>
                                </div>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="bi bi-key-fill text-danger me-3 fs-5"></i>
                                <div>
                                    <h6 class="mb-0 text-white fw-bold">CSRF Tokens Safeguards</h6>
                                    <p class="text-white-50 small mb-0">All layout submissions implement encrypted state checks.</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="bi bi-hdd-stack-fill text-danger me-3 fs-5"></i>
                                <div>
                                    <h6 class="mb-0 text-white fw-bold">Immutable Transaction Log</h6>
                                    <p class="text-white-50 small mb-0">Every core database state update writes an un-deletable trace.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
