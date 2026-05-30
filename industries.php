<?php
/**
 * Finolead Solutions - Industries Served Page
 */
$page_title = "Lending Software for Banks, NBFCs, and MFIs";
$page_desc = "Discover custom credit solutions engineered for Retail Banks, NBFC lending partners, digital Fintech startups, and Microfinance (MFI) desks.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Header -->
<header class="page-header">
    <div class="page-header-glow"></div>
    <div class="container position-relative" style="z-index: 5;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="badge bg-secondary bg-opacity-10 text-secondary-color px-3 py-2 rounded-pill fw-bold mb-3">
                    Target Sectors
                </div>
                <h1 class="display-5 fw-bold mb-3">Engineered for Every Lending Scale</h1>
                <p class="fs-5 text-muted mb-0">
                    From Tier-1 commercial banks to high-growth digital microlenders, we deploy credit rails optimized for your regulatory and transactional volume.
                </p>
            </div>
        </div>
    </div>
</header>

<!-- Industries Grid -->
<section class="py-5 bg-white">
    <div class="container py-4">
        
        <div class="row g-4">
            <!-- Industry 1: Banks -->
            <div class="col-md-6 mb-4">
                <div class="glass-card p-5 h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="text-secondary-color fs-1 mb-3"><i class="bi bi-bank"></i></div>
                        <h3 class="fw-bold mb-3 text-primary-color">Retail & Commercial Banks</h3>
                        <p class="text-muted small mb-4">
                            Deploy secure, isolated cloud instances of FinoCore and FinoCollect to supercharge legacy banking ERPs. We integrate dynamic bureaus queries, verify statements, and reduce manual collection queues with bank-grade ISO compliance.
                        </p>
                        <ul class="list-unstyled mb-4 small">
                            <li class="mb-2 text-muted"><i class="bi bi-check2 text-secondary-color me-2"></i> Integrates directly with core banking databases</li>
                            <li class="mb-2 text-muted"><i class="bi bi-check2 text-secondary-color me-2"></i> Active-active high-availability multi-region backup systems</li>
                            <li class="mb-2 text-muted"><i class="bi bi-check2 text-secondary-color me-2"></i> SOC2 audit-ready logging logs</li>
                        </ul>
                    </div>
                    <a href="<?php echo WEB_ROOT; ?>request-demo?sector=banking" class="btn btn-outline-primary w-100 mt-auto">Discuss Banking Modules</a>
                </div>
            </div>

            <!-- Industry 2: NBFCs -->
            <div class="col-md-6 mb-4">
                <div class="glass-card p-5 h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="text-accent-color fs-1 mb-3"><i class="bi bi-building"></i></div>
                        <h3 class="fw-bold mb-3 text-primary-color">NBFC Lending Partners</h3>
                        <p class="text-muted small mb-4">
                            Non-Banking Financial Companies demand extreme origination speed and robust default risk mitigation. Finolead streamlines NBFC loan origination in sub-seconds and automates early DPD collections using omnichannel payment links.
                        </p>
                        <ul class="list-unstyled mb-4 small">
                            <li class="mb-2 text-muted"><i class="bi bi-check2 text-accent-color me-2"></i> Flexible co-lending ledger distribution architectures</li>
                            <li class="mb-2 text-muted"><i class="bi bi-check2 text-accent-color me-2"></i> Instant alternative scoring models</li>
                            <li class="mb-2 text-muted"><i class="bi bi-check2 text-accent-color me-2"></i> Smart collection escalation matrices</li>
                        </ul>
                    </div>
                    <a href="<?php echo WEB_ROOT; ?>request-demo?sector=nbfc" class="btn btn-outline-primary w-100 mt-auto" style="border-color: var(--accent); color: var(--accent);">Discuss NBFC Systems</a>
                </div>
            </div>

            <!-- Industry 3: Startups -->
            <div class="col-md-6">
                <div class="glass-card p-5 h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="text-warning fs-1 mb-3"><i class="bi bi-rocket-takeoff-fill"></i></div>
                        <h3 class="fw-bold mb-3 text-primary-color">Fintech Startups & Digital Lenders</h3>
                        <p class="text-muted small mb-4">
                            Get your digital lending product to market in weeks rather than quarters. Leverage our clean modular APIs, secure Webhooks, e-KYC partners, and pre-integrated payment gateway engines.
                        </p>
                        <ul class="list-unstyled mb-4 small">
                            <li class="mb-2 text-muted"><i class="bi bi-check2 text-warning me-2"></i> Clean developer sandbox and detailed documentation</li>
                            <li class="mb-2 text-muted"><i class="bi bi-check2 text-warning me-2"></i> High scalability support to grow with user acquisition</li>
                            <li class="mb-2 text-muted"><i class="bi bi-check2 text-warning me-2"></i> Pay-as-you-scale API subscription pricing</li>
                        </ul>
                    </div>
                    <a href="<?php echo WEB_ROOT; ?>request-demo?sector=startup" class="btn btn-outline-dark w-100 mt-auto">Discuss Startup Sandbox</a>
                </div>
            </div>

            <!-- Industry 4: MFIs -->
            <div class="col-md-6">
                <div class="glass-card p-5 h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="text-danger fs-1 mb-3"><i class="bi bi-globe"></i></div>
                        <h3 class="fw-bold mb-3 text-primary-color">Microfinance Institutions (MFIs)</h3>
                        <p class="text-muted small mb-4">
                            Bridge remote areas with collections tools designed specifically for rural field environments. Finolead supports GPS location tracking for field agents, offline data caching, and automated bilingual voice/SMS message channels.
                        </p>
                        <ul class="list-unstyled mb-4 small">
                            <li class="mb-2 text-muted"><i class="bi bi-check2 text-danger me-2"></i> GPS geo-tagged agent route coordination</li>
                            <li class="mb-2 text-muted"><i class="bi bi-check2 text-danger me-2"></i> Mobile-responsive portal with low-bandwidth support</li>
                            <li class="mb-2 text-muted"><i class="bi bi-check2 text-danger me-2"></i> Dynamic localized voice notice broadcasts</li>
                        </ul>
                    </div>
                    <a href="<?php echo WEB_ROOT; ?>request-demo?sector=mfi" class="btn btn-outline-danger w-100 mt-auto">Discuss MFI Integration</a>
                </div>
            </div>
        </div>

    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
