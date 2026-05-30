<?php
/**
 * Finolead Solutions - Products Showcase Page
 */
$page_title = "Proprietary Fintech SaaS Products";
$page_desc = "Explore our core product lineup: FinoCore (Core Lending), FinoCollect (Automated Recovery), FinoAI (Risk Underwriting), and FinoPay (Transactions Routing).";
require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Header -->
<header class="page-header">
    <div class="page-header-glow"></div>
    <div class="container position-relative" style="z-index: 5;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="badge bg-accent-color bg-opacity-10 text-white px-3 py-2 rounded-pill fw-bold mb-3">
                    Fintech SaaS Products
                </div>
                <h1 class="display-5 fw-bold mb-3">State-of-the-Art Financial Engine Products</h1>
                <p class="fs-5 text-muted mb-0">
                    Engineered to serve as secure, high-concurrency building blocks for commercial credit platforms, collections desks, and banking hubs.
                </p>
            </div>
        </div>
    </div>
</header>

<!-- Products Display -->
<section class="py-5 bg-white">
    <div class="container py-4">
        
        <!-- Product 1: FinoCore -->
        <div class="row align-items-center g-5 mb-5 pb-5 border-bottom border-light-subtle" id="finocore">
            <div class="col-lg-6">
                <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold mb-3">Lending Core</div>
                <h2 class="display-6 fw-bold mb-3">FinoCore</h2>
                <h5 class="text-secondary-color fw-semibold mb-3">Enterprise Core Lending Engine</h5>
                <p class="text-muted mb-4">
                    FinoCore is the standard operating system for digital loan management. It controls customer accounts, validates profiles, executes multi-stage workflow assignments, maintains balance ledgers, generates dynamic payment notices, and tracks settlement compliance.
                </p>
                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <h6 class="fw-bold mb-1"><i class="bi bi-gear-fill text-secondary-color me-2"></i>Automated Flows</h6>
                            <p class="text-muted small mb-0">Custom multi-branch underwriting routing.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <h6 class="fw-bold mb-1"><i class="bi bi-clock-history text-secondary-color me-2"></i>Ledger Auditing</h6>
                            <p class="text-muted small mb-0">Double-entry accounting log with immutable traces.</p>
                        </div>
                    </div>
                </div>
                <a href="<?php echo WEB_ROOT; ?>request-demo?product=finocore" class="btn btn-primary px-4 py-2">Book FinoCore Demo</a>
            </div>
            <div class="col-lg-6">
                <div class="p-4 bg-light rounded-4 shadow-sm border text-center">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=600&q=80" alt="FinoCore Interface Mockup" class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>

        <!-- Product 2: FinoCollect -->
        <div class="row align-items-center g-5 mb-5 pb-5 border-bottom border-light-subtle" id="finocollect">
            <div class="col-lg-6 order-lg-2">
                <div class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill fw-bold mb-3">Delinquency Desk</div>
                <h2 class="display-6 fw-bold mb-3">FinoCollect</h2>
                <h5 class="text-accent-color fw-semibold mb-3">Automated Recovery & Collections Suite</h5>
                <p class="text-muted mb-4">
                    Eliminate manual debt recovery inefficiencies. FinoCollect coordinates outbound reminders via automated voice alerts, WhatsApp transaction templates, and soft reminders. Segregates and maps delinquency portfolios dynamically, allocating complex debts to collectors automatically.
                </p>
                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <h6 class="fw-bold mb-1"><i class="bi bi-chat-dots-fill text-accent-color me-2"></i>Omnichannel</h6>
                            <p class="text-muted small mb-0">Voice, SMS, and secure payment links.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <h6 class="fw-bold mb-1"><i class="bi bi-geo-alt-fill text-accent-color me-2"></i>Field App</h6>
                            <p class="text-muted small mb-0">GPS coordination for door-to-door collection desks.</p>
                        </div>
                    </div>
                </div>
                <a href="<?php echo WEB_ROOT; ?>request-demo?product=finocollect" class="btn btn-accent text-white px-4 py-2">Book FinoCollect Demo</a>
            </div>
            <div class="col-lg-6 order-lg-1">
                <div class="p-4 bg-light rounded-4 shadow-sm border text-center">
                    <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=600&q=80" alt="FinoCollect Interface Mockup" class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>

        <!-- Product 3: FinoAI -->
        <div class="row align-items-center g-5" id="finoai">
            <div class="col-lg-6">
                <div class="badge bg-warning bg-opacity-10 text-dark px-3 py-2 rounded-pill fw-bold mb-3">Intelligence Node</div>
                <h2 class="display-6 fw-bold mb-3">FinoAI</h2>
                <h5 class="text-warning fw-semibold mb-3">Alternative Credit Scoring & Risk Analytics</h5>
                <p class="text-muted mb-4">
                    FinoAI goes beyond simple historical credit scores. By deploying statistical models and natural language parsing parameters, it scans bank statement summaries, utility cash flows, and customer digital patterns to evaluate credit risk.
                </p>
                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <h6 class="fw-bold mb-1"><i class="bi bi-cpu-fill text-warning me-2"></i>Predictive Underwrite</h6>
                            <p class="text-muted small mb-0">Evaluates default risks in fractions of seconds.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <h6 class="fw-bold mb-1"><i class="bi bi-graph-up text-warning me-2"></i>Bureau Analytics</h6>
                            <p class="text-muted small mb-0">Continuous validation algorithms.</p>
                        </div>
                    </div>
                </div>
                <a href="<?php echo WEB_ROOT; ?>request-demo?product=finoai" class="btn btn-dark-fintech px-4 py-2">Book FinoAI Demo</a>
            </div>
            <div class="col-lg-6">
                <div class="p-4 bg-light rounded-4 shadow-sm border text-center">
                    <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=600&q=80" alt="FinoAI Dashboard Preview" class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>

    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
