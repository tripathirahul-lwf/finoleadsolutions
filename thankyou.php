<?php
/**
 * Finolead Solutions - Professional Thank You Page
 */
require_once __DIR__ . '/includes/functions.php';

$name = sanitize_input($_GET['name'] ?? 'Enterprise Leader');
$page_title = "Thank You | Inquiry Received";
$page_desc = "Your secure inquiry has been successfully encrypted and received. We will assign a specialized fintech solutions architect to your query shortly.";
require_once __DIR__ . '/includes/header.php';
?>

<section class="d-flex align-items-center justify-content-center position-relative overflow-hidden" style="min-height: 80vh; padding: 120px 0 60px; background-color: var(--bg-light);">
    <!-- Decorative Glow Effects -->
    <div style="position: absolute; width: 500px; height: 500px; background: radial-gradient(circle, rgba(37,99,235,0.06) 0%, rgba(255,255,255,0) 70%); top: -100px; left: -100px; pointer-events: none;"></div>
    <div style="position: absolute; width: 400px; height: 400px; background: radial-gradient(circle, rgba(20,184,166,0.06) 0%, rgba(255,255,255,0) 70%); bottom: -100px; right: -100px; pointer-events: none;"></div>

    <div class="container position-relative" style="z-index: 5;">
        <div class="max-w-600 mx-auto text-center animate-fade-in">
            <!-- Glassmorphic Thank You Card -->
            <div class="card border-0 glass-card p-5 shadow-lg position-relative overflow-hidden" style="border-radius: 28px; border: 1px solid rgba(255, 255, 255, 0.8) !important;">
                
                <!-- Glowing Top Accent -->
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: linear-gradient(90deg, var(--secondary), var(--accent));"></div>
                
                <!-- Animated Success Icon Wrapper -->
                <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle p-4 mb-4" style="width: 90px; height: 90px; border: 2px solid rgba(25, 135, 84, 0.2); animation: float 6s ease-in-out infinite;">
                    <i class="bi bi-shield-fill-check text-success" style="font-size: 3rem;"></i>
                </div>
                
                <h1 class="display-6 fw-800 text-primary-color mb-3" style="font-weight: 800; letter-spacing: -1.5px;">Inquiry Received!</h1>
                
                <h5 class="fw-600 text-secondary-color mb-3">Thank you, <?php echo htmlspecialchars($name); ?>.</h5>
                
                <p class="text-muted small mb-4 px-lg-3" style="line-height: 1.7;">
                    Your secure enterprise query has been successfully encrypted and routed to our support desk. A specialized fintech solutions architect has been assigned and will contact you within <strong>2 business hours</strong>.
                </p>
                
                <!-- Transaction Details Box -->
                <div class="bg-light rounded-4 p-4 border border-light-subtle text-start mb-4">
                    <h6 class="fw-bold text-primary-color mb-3 small text-uppercase tracking-wider"><i class="bi bi-info-circle-fill me-2 text-secondary-color"></i>Transmission Audit</h6>
                    <div class="d-flex justify-content-between py-2 border-bottom border-light-subtle fs-7">
                        <span class="text-muted">Security Protocol</span>
                        <strong class="text-primary-color"><i class="bi bi-lock-fill text-success me-1"></i>TLS 1.3 (AES-256)</strong>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom border-light-subtle fs-7">
                        <span class="text-muted">Response SLA</span>
                        <strong class="text-primary-color">Under 2 Hours</strong>
                    </div>
                    <div class="d-flex justify-content-between py-2 fs-7">
                        <span class="text-muted">Tracking Code</span>
                        <strong class="text-secondary-color fw-bold">FL-<?php echo strtoupper(substr(md5(uniqid()), 0, 10)); ?></strong>
                    </div>
                </div>
                
                <!-- Back Buttons -->
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                    <a href="<?php echo WEB_ROOT; ?>" class="btn btn-primary px-4 py-2.5 shadow-sm rounded-3"><i class="bi bi-house-door-fill me-2"></i>Return Home</a>
                    <a href="<?php echo WEB_ROOT; ?>products" class="btn btn-outline-light border-secondary border-opacity-20 text-primary-color px-4 py-2.5 rounded-3"><i class="bi bi-cpu me-2"></i>Browse Products</a>
                </div>
                
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
