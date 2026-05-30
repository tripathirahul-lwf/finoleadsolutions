<?php
/**
 * Finolead Solutions - Secure Contact Us Page & Inquiries Handling
 */
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$errors = [];
$success_msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST['csrf_token'] ?? '';
    
    // 1. CSRF Verification
    if (!validate_csrf_token($csrf_token)) {
        $errors[] = 'Security token mismatch. Please reload the page.';
    } else {
        // Sanitize and read text parameters
        $name = sanitize_input($_POST['name'] ?? '');
        $email = sanitize_input($_POST['email'] ?? '');
        $country_code = sanitize_input($_POST['country_code'] ?? '+91');
        $raw_phone = sanitize_input($_POST['phone'] ?? '');
        $company = sanitize_input($_POST['company'] ?? '');
        $subject = sanitize_input($_POST['subject'] ?? '');
        $message = sanitize_input($_POST['message'] ?? '');
        
        // Assemble phone number with selected country code
        $phone = $country_code . ' ' . $raw_phone;

        // Strictly typed schema backend validations (mirroring Zod client-side rules)
        if (empty($name) || strlen($name) < 3 || strlen($name) > 50 || !preg_match("/^[a-zA-Z\s]+$/", $name)) {
            $errors[] = 'Name must be between 3 and 50 characters, containing only letters and spaces.';
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid business email address.';
        }
        $digits_only = preg_replace('/[\s\-()]/', '', $raw_phone);
        if (empty($raw_phone) || strlen($digits_only) < 7 || strlen($digits_only) > 12 || !ctype_digit($digits_only)) {
            $errors[] = 'Contact phone must contain between 7 and 12 digits (excluding country code).';
        }
        if (empty($company) || strlen($company) < 2) {
            $errors[] = 'Company Name must be at least 2 characters.';
        }
        if (empty($subject)) {
            $errors[] = 'Please select a valid query subject.';
        }
        if (empty($message) || strlen($message) < 10 || strlen($message) > 2000) {
            $errors[] = 'Your message must be between 10 and 2000 characters.';
        }

        // If no errors, persist query
        if (empty($errors)) {
            try {
                if ($pdo) {
                    $stmt = $pdo->prepare("INSERT INTO `contact_requests` (`name`, `email`, `phone`, `company`, `subject`, `message`) VALUES (:name, :email, :phone, :company, :subject, :message)");
                    $stmt->execute([
                        ':name' => $name,
                        ':email' => $email,
                        ':phone' => $phone,
                        ':company' => $company,
                        ':subject' => $subject,
                        ':message' => $message
                    ]);
                    
                    // Redirect to dynamic, personalized thankyou page
                    redirect('thankyou?name=' . urlencode($name));
                } else {
                    $errors[] = 'Database connection failed. Please run setup-db.php.';
                }
            } catch (PDOException $e) {
                $errors[] = 'Failed to submit query: ' . $e->getMessage();
            }
        }
    }
}

$page_title = "Contact Us | Business Advisory & Support Desk";
$page_desc = "Get in touch with Finolead Solutions' business advisory team to discuss custom CRM solutions, integration APIs, and database migrations.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Header -->
<header class="page-header">
    <div class="page-header-glow"></div>
    <div class="container position-relative" style="z-index: 5;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="badge bg-secondary bg-opacity-10 text-secondary-color px-3 py-2 rounded-pill fw-bold mb-3">
                    Contact Us
                </div>
                <h1 class="display-5 fw-bold mb-3">Connect with our Advisory Team</h1>
                <p class="fs-5 text-muted mb-0">
                    Discuss custom CRM deployments, core platform licensing, integration APIs, or schedule a technical system review.
                </p>
            </div>
        </div>
    </div>
</header>

<!-- Contact Form & Coordinates -->
<section class="py-5 bg-white">
    <div class="container py-4">
        
        <div class="row g-5">
            <!-- Left Column: Coordinates -->
            <div class="col-lg-5">
                <div class="pe-lg-4">
                    <h3 class="fw-bold mb-4 text-primary-color">Operational Hubs</h3>
                    
                    <!-- Card 1 -->
                    <div class="card border-0 bg-light p-4 rounded-4 mb-4">
                        <span class="fs-2 text-secondary-color d-block mb-2"><i class="bi bi-geo-alt-fill"></i></span>
                        <h5 class="fw-bold mb-1">Corporate Head Office</h5>
                        <p class="text-muted small mb-0">
                            Finolead Solutions Pvt. Ltd.<br>
                            602, Naman Centre, G-Block,<br>
                            Bandra Kurla Complex (BKC), Mumbai, 400051
                        </p>
                    </div>

                    <!-- Card 2 -->
                    <div class="card border-0 bg-light p-4 rounded-4 mb-4">
                        <span class="fs-2 text-accent-color d-block mb-2"><i class="bi bi-envelope-check-fill"></i></span>
                        <h5 class="fw-bold mb-1">Direct Communications</h5>
                        <p class="text-muted small mb-1"><strong>Enterprise Advisory:</strong> advisory@finolead.com</p>
                        <p class="text-muted small mb-1"><strong>Integration Desk:</strong> devsupport@finolead.com</p>
                        <p class="text-muted small mb-0"><strong>General Phone:</strong> +91 (22) 6902-4500</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="card border-0 bg-gradient-premium text-white p-4 rounded-4">
                        <span class="fs-2 text-warning d-block mb-2"><i class="bi bi-chat-dots-fill"></i></span>
                        <h5 class="fw-bold text-white mb-1">Looking for a direct Demo?</h5>
                        <p class="text-white-50 small mb-3 pe-lg-3">Orchestrate transaction charts and preview custom parameters under our live testing sandbox.</p>
                        <a href="<?php echo WEB_ROOT; ?>request-demo" class="btn btn-accent text-white w-100 py-2 rounded-3">Launch Onboarding Funnel</a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Secure Inquiries Form -->
            <div class="col-lg-7">
                <div class="border border-light-subtle bg-white p-5 rounded-4 shadow-sm">
                    <h3 class="fw-bold mb-3 text-primary-color">Submit Enterprise Query</h3>
                    <p class="text-muted small mb-4 pe-lg-4">Complete the secure form below. We will assign a specialized fintech solutions architect to your query within 2 business hours.</p>
                    
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

                    <form method="POST" id="enterpriseQueryForm" class="needs-validation-secure" novalidate>
                        <?php csrf_input(); ?>

                        <div class="row g-3 mb-3">
                            <!-- Name -->
                            <div class="col-md-6">
                                <label for="formName" class="form-label small fw-bold text-primary-color">Full Name</label>
                                <input type="text" name="name" id="formName" class="form-control rounded-3 shadow-none border-light-subtle bg-light" placeholder="e.g. Vikram Sharma" required>
                                <div class="invalid-feedback text-danger small mt-1" id="nameFeedback"></div>
                            </div>
                            
                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="formEmail" class="form-label small fw-bold text-primary-color">Business Email</label>
                                <input type="email" name="email" id="formEmail" class="form-control rounded-3 shadow-none border-light-subtle bg-light" placeholder="e.g. vikram@apexcredit.com" required>
                                <div class="invalid-feedback text-danger small mt-1" id="emailFeedback"></div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <!-- Phone with Country Code Selector -->
                            <div class="col-md-6">
                                <label for="formPhone" class="form-label small fw-bold text-primary-color">Contact Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-light-subtle rounded-start-3" style="font-size: 0.9rem; padding: 12px; border: 1px solid #CBD5E1; color: var(--text-muted);">
                                        <select name="country_code" id="countryCodeSelect" class="border-0 bg-transparent p-0 shadow-none" style="outline: none; font-size: 0.85rem; font-weight: 600; cursor: pointer; color: var(--text-main);">
                                            <option value="+91">+91 (IN)</option>
                                            <option value="+1">+1 (US)</option>
                                            <option value="+44">+44 (UK)</option>
                                            <option value="+61">+61 (AU)</option>
                                            <option value="+65">+65 (SG)</option>
                                            <option value="+971">+971 (AE)</option>
                                            <option value="+353">+353 (IE)</option>
                                        </select>
                                    </span>
                                    <input type="tel" name="phone" id="formPhone" class="form-control rounded-end-3 shadow-none border-light-subtle bg-light" placeholder="98123 45678" style="border-left: none !important;" required>
                                </div>
                                <div class="invalid-feedback text-danger small mt-1" id="phoneFeedback" style="display: none;"></div>
                            </div>
                            
                            <!-- Company -->
                            <div class="col-md-6">
                                <label for="formCompany" class="form-label small fw-bold text-primary-color">Company Name</label>
                                <input type="text" name="company" id="formCompany" class="form-control rounded-3 shadow-none border-light-subtle bg-light" placeholder="e.g. Apex Credit NBFC" required>
                                <div class="invalid-feedback text-danger small mt-1" id="companyFeedback"></div>
                            </div>
                        </div>

                        <!-- Subject -->
                        <div class="mb-3">
                            <label for="formSubject" class="form-label small fw-bold text-primary-color">Query Subject</label>
                            <select name="subject" id="formSubject" class="form-select rounded-3 shadow-none border-light-subtle bg-light" required>
                                <option value="" disabled selected>Select subject of query</option>
                                <option value="FinoCore Lending Licensing">FinoCore Lending Core Licensing</option>
                                <option value="FinoCollect Recovery CRM">FinoCollect Automated Collection CRM</option>
                                <option value="Custom CRM Development">Custom CRM/ERP Architecture Dev</option>
                                <option value="AI Underwriting Engine Integration">Alternative AI Risk Model Integration</option>
                                <option value="General Enterprise Advisory">General Business Partnerships</option>
                            </select>
                            <div class="invalid-feedback text-danger small mt-1" id="subjectFeedback"></div>
                        </div>

                        <!-- Message -->
                        <div class="mb-4">
                            <label for="formMessage" class="form-label small fw-bold text-primary-color">Your Message</label>
                            <textarea name="message" id="formMessage" class="form-control rounded-3 shadow-none border-light-subtle bg-light" rows="5" placeholder="Provide a brief description of your digital lending volume, business challenges or architectural goals..." required></textarea>
                            <div class="invalid-feedback text-danger small mt-1" id="messageFeedback"></div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 shadow-sm"><i class="bi bi-shield-fill-check me-1"></i> Send Encrypted Query</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Zod-like Live Client-Side Schema Validation -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('enterpriseQueryForm');
    
    // Zod-like Schema Definition
    const zodSchema = {
        name: {
            validate: (val) => val.trim().length >= 3 && val.trim().length <= 50 && /^[a-zA-Z\s]+$/.test(val),
            error: 'Name must be between 3 and 50 characters, containing only letters and spaces.'
        },
        email: {
            validate: (val) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val),
            error: 'Please enter a valid business email address.'
        },
        phone: {
            validate: (val) => {
                const digits = val.replace(/[\s\-()]/g, '');
                return /^\d{7,12}$/.test(digits);
            },
            error: 'Phone number must contain between 7 and 12 digits (excluding country code).'
        },
        company: {
            validate: (val) => val.trim().length >= 2,
            error: 'Company Name must be at least 2 characters.'
        },
        subject: {
            validate: (val) => val !== '' && val !== null,
            error: 'Please select a valid query subject.'
        },
        message: {
            validate: (val) => val.trim().length >= 10 && val.trim().length <= 2000,
            error: 'Your message must be between 10 and 2000 characters.'
        }
    };

    const inputs = {
        name: document.getElementById('formName'),
        email: document.getElementById('formEmail'),
        phone: document.getElementById('formPhone'),
        company: document.getElementById('formCompany'),
        subject: document.getElementById('formSubject'),
        message: document.getElementById('formMessage')
    };

    const feedbacks = {
        name: document.getElementById('nameFeedback'),
        email: document.getElementById('emailFeedback'),
        phone: document.getElementById('phoneFeedback'),
        company: document.getElementById('companyFeedback'),
        subject: document.getElementById('subjectFeedback'),
        message: document.getElementById('messageFeedback')
    };

    // Real-time validation handler
    function validateField(fieldKey) {
        const input = inputs[fieldKey];
        const feedback = feedbacks[fieldKey];
        const schema = zodSchema[fieldKey];
        const val = input.value;

        if (schema.validate(val)) {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
            feedback.style.display = 'none';
            feedback.textContent = '';
            
            if (fieldKey === 'phone') {
                input.style.borderLeft = 'none';
            }
            return true;
        } else {
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
            feedback.style.display = 'block';
            feedback.textContent = schema.error;
            
            if (fieldKey === 'phone') {
                input.style.borderLeft = 'none';
            }
            return false;
        }
    }

    // Attach real-time input event listeners
    Object.keys(inputs).forEach(key => {
        const eventType = inputs[key].tagName === 'SELECT' ? 'change' : 'input';
        inputs[key].addEventListener(eventType, function() {
            validateField(key);
        });
        
        inputs[key].addEventListener('blur', function() {
            validateField(key);
        });
    });

    // Form submission validation
    form.addEventListener('submit', function (e) {
        let isFormValid = true;
        
        Object.keys(inputs).forEach(key => {
            const isFieldValid = validateField(key);
            if (!isFieldValid) {
                isFormValid = false;
            }
        });

        if (!isFormValid) {
            e.preventDefault();
            e.stopPropagation();
            
            // Focus on the first invalid field
            const firstInvalid = form.querySelector('.is-invalid');
            if (firstInvalid) {
                firstInvalid.focus();
            }
        }
    });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
