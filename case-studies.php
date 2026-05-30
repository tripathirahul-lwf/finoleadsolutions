<?php
/**
 * Finolead Solutions - Case Studies / Success Stories Page
 */
$page_title = "Client Case Studies & Financial Success Stories";
$page_desc = "Review real-world outcomes where Banks, NBFCs, and MFIs reduced NPA defaults, scaled origination speeds, and optimized debt collection costs using Finolead.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Header -->
<header class="page-header">
    <div class="page-header-glow"></div>
    <div class="container position-relative" style="z-index: 5;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="badge bg-secondary bg-opacity-10 text-secondary-color px-3 py-2 rounded-pill fw-bold mb-3">
                    Success Stories
                </div>
                <h1 class="display-5 fw-bold mb-3">Proven Financial Outcomes</h1>
                <p class="fs-5 text-muted mb-0">
                    Discover how leading banks, NBFC platforms, and microfinance organizations partner with Finolead Solutions to transform their operational metrics.
                </p>
            </div>
        </div>
    </div>
</header>

<!-- Case Studies Grid -->
<section class="py-5 bg-white">
    <div class="container py-4">
        
        <div class="row g-5">
            <!-- Case Study 1 -->
            <div class="col-lg-6">
                <div class="glass-card p-4 h-100 d-flex flex-column justify-content-between">
                    <div>
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=600&q=80" alt="FinCap Case Study" class="img-fluid rounded-3 mb-4 shadow-sm" style="height: 240px; width: 100%; object-fit: cover;">
                        <span class="badge bg-secondary bg-opacity-10 text-secondary-color px-3 py-1 rounded-pill fw-bold small mb-2 d-inline-block">NBFC Sector</span>
                        <h3 class="fw-bold mb-3">Scalability Boost: 400% Growth in Origination Volume</h3>
                        <h6 class="text-primary-color mb-3 fw-semibold">Client: FinCap Solutions (Tier-2 NBFC)</h6>
                        <p class="text-muted small">
                            <strong>The Challenge:</strong> Legacy underwriting workflows delayed loan approvals by up to 3 business days, resulting in a staggering 60% lead abandonment rate.
                        </p>
                        <p class="text-muted small">
                            <strong>Our Action:</strong> Implemented FinoCore LOS, integrating instant bureau validation APIs and bank statement parsers to support sub-second automated scoring rules.
                        </p>
                        <div class="bg-light p-3 rounded-3 mb-4">
                            <h4 class="fw-bold text-secondary-color mb-1">+400%</h4>
                            <span class="small text-muted">Origination volume increase in 9 months</span>
                        </div>
                    </div>
                    <a href="<?php echo WEB_ROOT; ?>request-demo" class="btn btn-outline-primary w-100 mt-auto">Request Case Study Briefing</a>
                </div>
            </div>

            <!-- Case Study 2 -->
            <div class="col-lg-6">
                <div class="glass-card p-4 h-100 d-flex flex-column justify-content-between">
                    <div>
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=600&q=80" alt="Prime Retail Bank Case Study" class="img-fluid rounded-3 mb-4 shadow-sm" style="height: 240px; width: 100%; object-fit: cover;">
                        <span class="badge bg-accent bg-opacity-10 text-accent-color px-3 py-1 rounded-pill fw-bold small mb-2 d-inline-block">Banking Sector</span>
                        <h3 class="fw-bold mb-3">Delinquency Mitigation: 35% Reduction in NPA Defaults</h3>
                        <h6 class="text-primary-color mb-3 fw-semibold">Client: Prime Retail Bank</h6>
                        <p class="text-muted small">
                            <strong>The Challenge:</strong> Outbound manual debt-collection teams had low customer contact rates, high operational costs, and mounting non-performing assets.
                        </p>
                        <p class="text-muted small">
                            <strong>Our Action:</strong> Integrated FinoCollect automated messaging cycles, interactive predictive dialers, and custom conversational voicebot nodes.
                        </p>
                        <div class="bg-light p-3 rounded-3 mb-4">
                            <h4 class="fw-bold text-accent-color mb-1">-35%</h4>
                            <span class="small text-muted">NPA Delinquencies reduced in early-stage DPD</span>
                        </div>
                    </div>
                    <a href="<?php echo WEB_ROOT; ?>request-demo" class="btn btn-outline-primary w-100 mt-auto" style="border-color: var(--accent); color: var(--accent);">Request Case Study Briefing</a>
                </div>
            </div>
        </div>

    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
