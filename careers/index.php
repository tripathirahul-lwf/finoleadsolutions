<?php
/**
 * Finolead Solutions - Careers Landing Page (Pulls from DB)
 */
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

$page_title = "Join Our Team | Live Career Opportunities & Culture";
$page_desc = "Explore job openings in fintech engineering, financial analytics, risk operations and enterprise B2B sales at Finolead Solutions.";

$jobs = [];
if ($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM `jobs` WHERE `status` = 'Active' ORDER BY `created_at` DESC");
        $jobs = $stmt->fetchAll();
    } catch (PDOException $e) {
        $jobs = [];
    }
}

require_once __DIR__ . '/../includes/header.php';
?>

<!-- Page Header -->
<header class="page-header">
    <div class="page-header-glow"></div>
    <div class="container position-relative" style="z-index: 5;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="badge bg-secondary bg-opacity-10 text-secondary-color px-3 py-2 rounded-pill fw-bold mb-3">
                    Careers Desk
                </div>
                <h1 class="display-5 fw-bold mb-3">Shape the Future of Financial Technology</h1>
                <p class="fs-5 text-muted mb-0">
                    We are engineers, analysts, builders, and designers dedicated to creating the most efficient, secure digital lending platforms.
                </p>
            </div>
        </div>
    </div>
</header>

<!-- Company Culture & Benefits -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row align-items-center g-5 mb-5">
            <div class="col-lg-6">
                <h6 class="text-secondary-color text-uppercase fw-bold tracking-wider mb-2">Our Culture</h6>
                <h2 class="fw-bold mb-3">We build software that matters</h2>
                <p class="text-muted mb-3">
                    At Finolead Solutions, you will work on high-availability cloud microservices and alternative underwriting algorithms that help retail banks and NBFCs disburse credit in under two seconds.
                </p>
                <p class="text-muted">
                    We operate with extreme transparency, value ownership, encourage dynamic learning budgets, and support flexible hybrid/remote settings.
                </p>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80" alt="Finolead Team Collaboration" class="img-fluid rounded-4 shadow-sm">
            </div>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-12 text-center mb-4">
                <h3 class="fw-bold">Company Perks & Benefits</h3>
            </div>
            <div class="col-md-4">
                <div class="glass-card p-4 h-100 text-center">
                    <span class="fs-1 text-secondary-color d-block mb-3"><i class="bi bi-wallet2"></i></span>
                    <h5 class="fw-bold mb-2">Competitive Pay & ESOPs</h5>
                    <p class="text-muted small mb-0">Industry-leading salaries with annual bonuses and long-term equity allocations for all core engineers and leaders.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card p-4 h-100 text-center">
                    <span class="fs-1 text-accent-color d-block mb-3"><i class="bi bi-heart-pulse-fill"></i></span>
                    <h5 class="fw-bold mb-2">Health & Wellness Cover</h5>
                    <p class="text-muted small mb-0">Comprehensive health insurance coverage for your family, including dental, checkups, and optical parameters.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card p-4 h-100 text-center">
                    <span class="fs-1 text-danger d-block mb-3"><i class="bi bi-laptop-fill"></i></span>
                    <h5 class="fw-bold mb-2">Hybrid Workspace & Hardware</h5>
                    <p class="text-muted small mb-0">Select your preferred high-end workstation setup (Mac/Thinkpad/Ubuntu) alongside monthly high-speed remote allowances.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Live Job Opportunities -->
<section class="py-5 bg-gradient-flow" id="openings">
    <div class="container py-4">
        <div class="text-center max-w-600 mx-auto mb-5">
            <h6 class="text-secondary-color text-uppercase fw-bold tracking-wider mb-2">Join Finolead</h6>
            <h2 class="fw-bold">Active Career Openings</h2>
            <p class="text-muted">Review our active positions across Engineering, Analytics, and Business Development.</p>
        </div>

        <div class="max-w-900 mx-auto">
            <?php if (!empty($jobs)): ?>
                <?php foreach ($jobs as $job): ?>
                    <div class="job-card d-md-flex align-items-center justify-content-between">
                        <div class="mb-3 mb-md-0">
                            <span class="badge bg-secondary bg-opacity-10 text-secondary-color px-2 py-1 rounded-pill small mb-2 d-inline-block"><?php echo sanitize_html($job['department']); ?></span>
                            <h4 class="fw-bold fs-5 text-primary-color mb-1"><?php echo sanitize_html($job['title']); ?></h4>
                            <span class="text-muted small"><i class="bi bi-geo-alt me-1"></i><?php echo sanitize_html($job['location']); ?> &bull; <i class="bi bi-briefcase me-1"></i><?php echo sanitize_html($job['type']); ?> &bull; <i class="bi bi-calendar-event me-1"></i><?php echo sanitize_html($job['experience']); ?> Exp</span>
                        </div>
                        <a href="<?php echo WEB_ROOT; ?>careers/<?php echo $job['id']; ?>" class="btn btn-primary px-4">View Specification & Apply</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center bg-white p-5 rounded-4 shadow-sm border border-light-subtle">
                    <span class="fs-1 text-muted d-block mb-2"><i class="bi bi-briefcase-fill"></i></span>
                    <h5 class="fw-bold text-muted mb-1">No Active Positions</h5>
                    <p class="text-muted small mb-0">We don't have any openings at the moment. Drop us a mail at <a href="mailto:careers@finolead.com" class="text-secondary-color fw-bold">careers@finolead.com</a> to keep your resume on file!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
