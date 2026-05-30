<?php
/**
 * Finolead Solutions - Career Job Detail & Secure Application Form
 */
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

$job_id = filter_var($_GET['id'] ?? '', FILTER_VALIDATE_INT);
$job = null;

if ($pdo && $job_id) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM `jobs` WHERE `id` = :id AND `status` = 'Active' LIMIT 1");
        $stmt->execute([':id' => $job_id]);
        $job = $stmt->fetch();
    } catch (PDOException $e) {
        $job = null;
    }
}

if (!$job) {
    redirect('index.php');
}

$errors = [];
$success_msg = '';

// Handle Application POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST['csrf_token'] ?? '';
    
    // 1. CSRF Protection
    if (!validate_csrf_token($csrf_token)) {
        $errors[] = 'Security token mismatch. Please try again.';
    } else {
        // Sanitize textual values
        $name = sanitize_input($_POST['name'] ?? '');
        $email = sanitize_input($_POST['email'] ?? '');
        $phone = sanitize_input($_POST['phone'] ?? '');
        $cover_letter = sanitize_input($_POST['cover_letter'] ?? '');

        // Validation
        if (empty($name) || strlen($name) < 3) {
            $errors[] = 'Please enter your full name.';
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address.';
        }
        if (empty($phone) || strlen($phone) < 10) {
            $errors[] = 'Please enter a valid contact phone number.';
        }

        // Resume validation & upload
        if (empty($_FILES['resume']['name'])) {
            $errors[] = 'Please upload your resume (PDF, DOC, or DOCX).';
        } else {
            $upload_dir = __DIR__ . '/../uploads';
            $upload_res = validate_resume_upload($_FILES['resume'], $upload_dir);
            if (!$upload_res['success']) {
                $errors[] = $upload_res['message'];
            }
        }

        // If no errors, persist application
        if (empty($errors)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO `job_applications` (`job_id`, `name`, `email`, `phone`, `resume_path`, `cover_letter`) VALUES (:job_id, :name, :email, :phone, :resume_path, :cover_letter)");
                $stmt->execute([
                    ':job_id' => $job_id,
                    ':name' => $name,
                    ':email' => $email,
                    ':phone' => $phone,
                    ':resume_path' => $upload_res['filepath'],
                    ':cover_letter' => $cover_letter
                ]);

                set_flash_message("Your application for '{$job['title']}' has been submitted successfully! Our talent acquisition team will review and connect shortly.", "success");
                redirect(WEB_ROOT . 'careers/' . $job_id);
            } catch (PDOException $e) {
                $errors[] = 'Failed to submit application: ' . $e->getMessage();
            }
        }
    }
}

$page_title = $job['title'] . " (" . $job['department'] . ")";
$page_desc = $job['description'];
require_once __DIR__ . '/../includes/header.php';
?>

<!-- Page Header -->
<header class="page-header" style="padding: 140px 0 50px;">
    <div class="page-header-glow"></div>
    <div class="container position-relative" style="z-index: 5;">
        <div class="row">
            <div class="col-lg-9">
                <a href="<?php echo WEB_ROOT; ?>careers" class="text-accent-color text-decoration-none fw-bold small mb-3 d-inline-block"><i class="bi bi-arrow-left me-1"></i> Back to Careers Desk</a>
                <div class="badge bg-secondary bg-opacity-10 text-secondary-color px-3 py-1 rounded-pill fw-bold mb-3 d-block d-sm-inline-block" style="width: max-content;">
                    <?php echo sanitize_html($job['department']); ?>
                </div>
                <h1 class="display-6 fw-bold mb-3 text-white"><?php echo sanitize_html($job['title']); ?></h1>
                <p class="text-muted small mb-0"><i class="bi bi-geo-alt me-1"></i><?php echo sanitize_html($job['location']); ?> &bull; <i class="bi bi-briefcase me-1"></i><?php echo sanitize_html($job['type']); ?> &bull; <i class="bi bi-briefcase-fill me-1"></i><?php echo sanitize_html($job['experience']); ?></p>
            </div>
        </div>
    </div>
</header>

<!-- Main Details Layout -->
<section class="py-5 bg-white">
    <div class="container py-3">
        <div class="row g-5">
            <!-- Left Column: Specs Details -->
            <div class="col-lg-7">
                <?php echo render_alert(); ?>
                
                <div class="pe-lg-4">
                    <h4 class="fw-bold mb-3 text-primary-color">Role Overview</h4>
                    <p class="text-muted mb-4"><?php echo nl2br(sanitize_html($job['description'])); ?></p>
                    
                    <h4 class="fw-bold mb-3 text-primary-color">Key Requirements</h4>
                    <p class="text-muted mb-4" style="line-height: 1.8;"><?php echo nl2br(sanitize_html($job['requirements'])); ?></p>
                    
                    <h4 class="fw-bold mb-3 text-primary-color">Compensation & Benefits</h4>
                    <p class="text-muted mb-0" style="line-height: 1.8;"><?php echo nl2br(sanitize_html($job['benefits'])); ?></p>
                </div>
            </div>
            
            <!-- Right Column: Application Form -->
            <div class="col-lg-5">
                <div class="card border-0 bg-light p-4 rounded-4 shadow-sm">
                    <h4 class="fw-bold mb-3 text-primary-color"><i class="bi bi-send-fill me-2 text-secondary-color"></i>Apply For Position</h4>
                    <p class="text-muted small mb-4">Complete the fields below and attach your resume. Our systems securely parse your profile details.</p>
                    
                    <!-- Display POST Errors -->
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger bg-opacity-10 border-danger-subtle text-danger py-2 px-3 rounded-3 mb-3 small">
                            <ul class="mb-0 ps-3">
                                <?php foreach ($errors as $err): ?>
                                    <li><?php echo sanitize_html($err); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" enctype="multipart/form-data" class="needs-validation-secure" novalidate>
                        <?php csrf_input(); ?>
                        
                        <!-- Full Name -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-primary-color">Full Name</label>
                            <input type="text" name="name" class="form-control rounded-3 shadow-none bg-white border-light-subtle" placeholder="e.g. Aniket Sharma" required>
                        </div>
                        
                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-primary-color">Email Address</label>
                            <input type="email" name="email" class="form-control rounded-3 shadow-none bg-white border-light-subtle" placeholder="e.g. aniket@gmail.com" required>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-primary-color">Contact Phone</label>
                            <input type="tel" name="phone" class="form-control rounded-3 shadow-none bg-white border-light-subtle" placeholder="e.g. +91 98765 43210" required>
                        </div>

                        <!-- Resume Upload -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-primary-color">Resume (PDF, DOC, DOCX - Max 5MB)</label>
                            <input type="file" name="resume" class="form-control bg-white rounded-3 shadow-none border-light-subtle" accept=".pdf,.doc,.docx" required>
                        </div>

                        <!-- Cover Letter -->
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-primary-color">Cover Letter / Note (Optional)</label>
                            <textarea name="cover_letter" class="form-control bg-white rounded-3 shadow-none border-light-subtle" rows="4" placeholder="Briefly state why you're a great fit for Finolead..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 shadow-sm"><i class="bi bi-cloud-arrow-up-fill me-1"></i> Submit Secure Application</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
