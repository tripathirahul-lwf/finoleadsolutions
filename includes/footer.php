<?php
/**
 * Finolead Solutions - Premium Reusable Layout Footer
 * Features: Structured Sitemap, Quick Contact Details, Dynamic Absolute Path Links
 */
require_once __DIR__ . '/functions.php';
?>

</main>

<!-- Floating WhatsApp CTA Widget -->
<a href="https://wa.me/912269024500?text=I%20am%20interested%20in%20evaluating%20Finolead%20Lending%20CRM%20systems."
    class="btn btn-success position-fixed bottom-0 end-0 m-4 p-3 rounded-circle shadow-lg d-flex align-items-center justify-content-center animate-bounce"
    style="width: 60px; height: 60px; z-index: 999; background-color: #25d366; border: none; font-size: 1.8rem;"
    target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
    <i class="bi bi-whatsapp text-white"></i>
</a>

<!-- Footer Section -->
<footer class="footer-dark pt-5 pb-4">
    <!-- Glow effects in dark footer -->
    <div
        style="position: absolute; width: 300px; height: 300px; background: radial-gradient(circle, rgba(20,184,166,0.04) 0%, rgba(255,255,255,0) 70%); bottom: 0; left: 0; pointer-events: none;">
    </div>

    <div class="container">
        <div class="row g-4 mb-5">
            <!-- Brand & Pitch -->
            <div class="col-lg-4 col-md-12">
                <a class="navbar-brand d-flex mb-3 align-items-center fw-800 fs-4 text-primary-color"
                    href="<?php echo WEB_ROOT; ?>">
                    <img src="<?php echo WEB_ROOT; ?>assets/images/logo.webp" alt="Finolead Solutions Logo"
                        loading="lazy">
                </a>
                <!-- UI/UX Enhancement: Changed text-muted to text-white-50 for high readability on dark footer background -->
                <p class="text-white-50 small mb-4 pe-lg-4" style="line-height: 1.65;">
                    Finolead Solutions is an industry-leading fintech software provider. We engineer high-velocity
                    automated lending platforms, collections engines, and secure CRM systems for retail banks, NBFCs,
                    and financial startups.
                </p>
                <div class="d-flex gap-3">
                    <a href="#"
                        class="btn btn-outline-light border-secondary border-opacity-20 p-2 rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 38px; height: 38px;"><i class="bi bi-twitter"></i></a>
                    <a href="#"
                        class="btn btn-outline-light border-secondary border-opacity-20 p-2 rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 38px; height: 38px;"><i class="bi bi-linkedin"></i></a>
                    <a href="#"
                        class="btn btn-outline-light border-secondary border-opacity-20 p-2 rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 38px; height: 38px;"><i class="bi bi-facebook"></i></a>
                    <a href="#"
                        class="btn btn-outline-light border-secondary border-opacity-20 p-2 rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 38px; height: 38px;"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <!-- Column 2: Sitemap (Corporate) -->
            <div class="col-lg-2 col-md-4 col-6">
                <h5 class="mb-3 text-white">Corporate</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a href="<?php echo WEB_ROOT; ?>">Home</a></li>
                    <li class="mb-2"><a href="<?php echo WEB_ROOT; ?>about">About Us</a></li>
                    <li class="mb-2"><a href="<?php echo WEB_ROOT; ?>products">Core Products</a></li>
                    <li class="mb-2"><a href="<?php echo WEB_ROOT; ?>case-studies">Case Studies</a></li>
                    <li class="mb-2"><a href="<?php echo WEB_ROOT; ?>contact">Contact Us</a></li>
                </ul>
            </div>

            <!-- Column 3: Lending CRMs & Solutions -->
            <div class="col-lg-3 col-md-4 col-6">
                <h5 class="mb-3 text-white">Lending CRM Suites</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a href="<?php echo WEB_ROOT; ?>services/payday-loan-crm">Payday Loan CRM</a></li>
                    <li class="mb-2"><a href="<?php echo WEB_ROOT; ?>services/collection-crm">Intelligent Collection
                            CRM</a></li>
                    <li class="mb-2"><a href="<?php echo WEB_ROOT; ?>services/lead-management-crm">Lead Management
                            CRM</a></li>
                    <li class="mb-2"><a href="<?php echo WEB_ROOT; ?>services/recovery-management-software">Enterprise
                            Recovery CRM</a></li>
                    <li class="mb-2"><a href="<?php echo WEB_ROOT; ?>services/loan-management-software">Loan Origination
                            LOS</a></li>
                </ul>
            </div>

            <!-- Column 4: Resources & Legal -->
            <div class="col-lg-3 col-md-4 col-12">
                <h5 class="mb-3 text-white">Resources & Admin</h5>
                <ul class="list-unstyled mb-0 row g-2">
                    <li class="col-md-12 col-6 mb-1"><a href="<?php echo WEB_ROOT; ?>industries">Industries Served</a>
                    </li>
                    <li class="col-md-12 col-6 mb-1"><a href="<?php echo WEB_ROOT; ?>technology">Technology Stack</a>
                    </li>
                    <li class="col-md-12 col-6 mb-1"><a href="<?php echo WEB_ROOT; ?>security">Security & SLA</a></li>
                    <li class="col-md-12 col-6 mb-1"><a href="<?php echo WEB_ROOT; ?>blog">Blog Publications</a></li>
                    <li class="col-md-12 col-6 mb-1"><a href="<?php echo WEB_ROOT; ?>careers">Careers Desk</a></li>
                    <li class="col-md-12 col-6 mb-1"><a href="<?php echo WEB_ROOT; ?>admin/login.php"><i
                                class="bi bi-shield-lock me-1"></i>Admin Console</a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom Row -->
        <div class="row pt-4 border-top border-secondary border-opacity-10 align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <span class="small text-muted">&copy; <?php echo date('Y'); ?> Finolead Solutions Private Limited. All
                    rights reserved.</span>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="small text-muted me-3 text-decoration-none">Privacy Policy</a>
                <a href="#" class="small text-muted me-3 text-decoration-none">Terms of Platform</a>
                <a href="#" class="small text-muted text-decoration-none">SLA Agreement</a>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap Bundle with Popper JS via CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom Core Scripts -->
<script src="<?php echo WEB_ROOT; ?>assets/js/main.js"></script>

</body>

</html>