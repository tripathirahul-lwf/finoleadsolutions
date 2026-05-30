<?php
/**
 * Finolead Solutions - Request Enterprise Demo Funnel & Processing
 */
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$errors = [];
$success_msg = '';

// Pre-fill parameters if arriving from specialized services/sectors
$pre_selected_product = sanitize_input($_GET['product'] ?? $_GET['service'] ?? '');
$pre_selected_sector = sanitize_input($_GET['sector'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST['csrf_token'] ?? '';
    
    // 1. CSRF Verification
    if (!validate_csrf_token($csrf_token)) {
        $errors[] = 'Security token mismatch. Please reload the page.';
    } else {
        $name = sanitize_input($_POST['name'] ?? '');
        $email = sanitize_input($_POST['email'] ?? '');
        $phone = sanitize_input($_POST['phone'] ?? '');
        $company = sanitize_input($_POST['company'] ?? '');
        $job_title = sanitize_input($_POST['job_title'] ?? '');
        $loan_volume = sanitize_input($_POST['loan_volume'] ?? '');
        $message = sanitize_input($_POST['message'] ?? '');

        // Validation
        if (empty($name) || strlen($name) < 3) {
            $errors[] = 'Please enter your name.';
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid business email address.';
        }
        if (empty($company)) {
            $errors[] = 'Please enter your organization name.';
        }
        if (empty($loan_volume)) {
            $errors[] = 'Please select your projected monthly lending volume scale.';
        }

        // If no errors, persist demo request
        if (empty($errors)) {
            try {
                if ($pdo) {
                    $stmt = $pdo->prepare("INSERT INTO `demo_requests` (`name`, `email`, `phone`, `company`, `job_title`, `loan_volume`, `message`) VALUES (:name, :email, :phone, :company, :job_title, :loan_volume, :message)");
                    $stmt->execute([
                        ':name' => $name,
                        ':email' => $email,
                        ':phone' => $phone,
                        ':company' => $company,
                        ':job_title' => $job_title,
                        ':loan_volume' => $loan_volume,
                        ':message' => $message
                    ]);

                    set_flash_message("Demo Session Request Booked! A specialized Fintech Solutions Architect will email your access keys and invite you to our sandbox testing channel within 1 business hour.", "success");
                    redirect('request-demo');
                } else {
                    $errors[] = 'Database connection failed. Please run setup-db.php first.';
                }
            } catch (PDOException $e) {
                $errors[] = 'Failed to book demo slot: ' . $e->getMessage();
            }
        }
    }
}

$page_title = "Schedule Enterprise Demo | Sandbox Access Gateway";
$page_desc = "Book a secure personalized system demo and explore alternative underwriting engines, repayment automation modules, and co-lending ledgers.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Header -->
<header class="page-header">
    <div class="page-header-glow"></div>
    <div class="container position-relative" style="z-index: 5;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="badge bg-accent-color bg-opacity-10 text-accent-color px-3 py-2 rounded-pill fw-bold mb-3">
                    Demo Request
                </div>
                <h1 class="display-5 fw-bold mb-3">Experience Finolead Solutions</h1>
                <p class="fs-5 text-muted mb-0">
                    Submit your enterprise credentials to access our live sandbox testing environments, orchestrate loan flows, and parse credit data.
                </p>
            </div>
        </div>
    </div>
</header>

<!-- Funnel Form and Specifications -->
<section class="py-5 bg-white">
    <div class="container py-4">
        
        <div class="row g-5">
            <!-- Left Side: Features and Onboarding Info -->
            <div class="col-lg-5">
                <div class="pe-lg-4">
                    <h3 class="fw-bold mb-4 text-primary-color">What to Expect</h3>
                    
                    <div class="d-flex align-items-start gap-3 mb-4">
                        <span class="bg-light p-2 rounded-3 text-secondary-color fs-4"><i class="bi bi-person-video3"></i></span>
                        <div>
                            <h5 class="fw-bold mb-1 fs-6">Personalized System Audit</h5>
                            <p class="text-muted small mb-0">A 30-minute deep dive with a solutions architect customized to review your specific co-lending ledger or collections objectives.</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 mb-4">
                        <span class="bg-light p-2 rounded-3 text-accent-color fs-4"><i class="bi bi-key-fill"></i></span>
                        <div>
                            <h5 class="fw-bold mb-1 fs-6">Developer API Sandbox Access</h5>
                            <p class="text-muted small mb-0">Receive temporary authorization tokens to invoke our mock CIBIL underwriting callback URLs and check ledger updates.</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 mb-5">
                        <span class="bg-light p-2 rounded-3 text-danger fs-4"><i class="bi bi-file-earmark-bar-graph-fill"></i></span>
                        <div>
                            <h5 class="fw-bold mb-1 fs-6">Custom NPA Impact Report</h5>
                            <p class="text-muted small mb-0">Get a synthetic model projection outlining how automated collections (FinoCollect) will impact your early DPD buckets.</p>
                        </div>
                    </div>

                    <div class="card border-0 bg-light p-4 rounded-4">
                        <h6 class="fw-bold text-primary-color mb-3"><i class="bi bi-patch-check-fill text-secondary-color me-2"></i>Audit Compliances</h6>
                        <div class="row g-2 text-center text-muted small">
                            <div class="col-4 border-end"><i class="bi bi-lock-fill d-block fs-4 text-danger mb-1"></i>SOC2 Lvl 2</div>
                            <div class="col-4 border-end"><i class="bi bi-shield-fill-check d-block fs-4 text-secondary-color mb-1"></i>ISO 27001</div>
                            <div class="col-4"><i class="bi bi-credit-card-fill d-block fs-4 text-accent-color mb-1"></i>PCI DSS</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Secure Funnel Form -->
            <div class="col-lg-7">
                <div class="border border-light-subtle bg-white p-5 rounded-4 shadow-sm">
                    <h3 class="fw-bold mb-3 text-primary-color">Request System Access</h3>
                    <p class="text-muted small mb-4">Complete the fields below to schedule your demo. All information is processed securely under SOC2 data rules.</p>
                    
                    <?php echo render_alert(); ?>

                    <!-- Display PHP Errors -->
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger bg-opacity-10 border-danger-subtle text-danger py-2 px-3 rounded-3 mb-3 small">
                            <ul class="mb-0 ps-3">
                                <?php foreach ($errors as $err): ?>
                                    <li><?php echo sanitize_html($err); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" class="needs-validation-secure" novalidate>
                        <?php csrf_input(); ?>

                        <div class="row g-3 mb-3">
                            <!-- Name -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-primary-color">Full Name</label>
                                <input type="text" name="name" class="form-control rounded-3 shadow-none border-light-subtle bg-light" placeholder="e.g. Ramesh Kulkarni" required>
                            </div>
                            
                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-primary-color">Business Email</label>
                                <input type="email" name="email" class="form-control rounded-3 shadow-none border-light-subtle bg-light" placeholder="e.g. ramesh@apexcredits.com" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <!-- Phone -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-primary-color">Contact Phone</label>
                                <input type="tel" name="phone" class="form-control rounded-3 shadow-none border-light-subtle bg-light" placeholder="e.g. +91 99876 54321">
                            </div>
                            
                            <!-- Company -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-primary-color">Company Name</label>
                                <input type="text" name="company" class="form-control rounded-3 shadow-none border-light-subtle bg-light" placeholder="e.g. Apex Credit NBFC Group" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <!-- Job Title -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-primary-color">Job Title</label>
                                <input type="text" name="job_title" class="form-control rounded-3 shadow-none border-light-subtle bg-light" placeholder="e.g. VP of Risk Operations">
                            </div>
                            
                            <!-- Monthly Lending Volume Scale -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-primary-color">Monthly Loan Volume</label>
                                <select name="loan_volume" class="form-select rounded-3 shadow-none border-light-subtle bg-light" required>
                                    <option value="" disabled selected>Select volume scale</option>
                                    <option value="Under $1 Million">Under $1 Million / Month</option>
                                    <option value="$1M - $5 Million">$1M - $5 Million / Month</option>
                                    <option value="$5M - $20 Million">$5M - $20 Million / Month</option>
                                    <option value="Over $20 Million">Over $20 Million / Month</option>
                                </select>
                            </div>
                        </div>

                        <!-- Special Request Message -->
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-primary-color">Custom Specifications (Optional)</label>
                            <textarea name="message" class="form-control rounded-3 shadow-none border-light-subtle bg-light" rows="4" placeholder="Mention if you are interested in a specific module (e.g. FinoCore, FinoCollect, FinoAI) or have particular bank API integration goals..."><?php echo !empty($pre_selected_product) ? "Interested in evaluating: " . sanitize_html($pre_selected_product) . ". " : ''; ?><?php echo !empty($pre_selected_sector) ? "Target Industry Sector: " . sanitize_html($pre_selected_sector) . ". " : ''; ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-accent text-white w-100 py-3 rounded-3 shadow-sm"><i class="bi bi-calendar-event me-1"></i> Book Live Demonstration Slot</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
