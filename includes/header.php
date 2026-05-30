<?php
/**
 * Finolead Solutions - Premium Reusable Layout Header
 * Features: Sticky Glassmorphic Navigation, Responsive Design, and Gorgeous Mega Menu
 */
require_once __DIR__ . '/functions.php';

// Detect active page to set active classes in navigation links
$current_page = basename($_SERVER['PHP_SELF']);
$current_dir = basename(dirname($_SERVER['PHP_SELF']));

// Base path helper (handles root vs subdirectory paths like blog/ and careers/)
$base_path = ($current_dir === 'blog' || $current_dir === 'careers' || $current_dir === 'admin') ? '../' : './';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Dynamic Title & SEO Metadata -->
    <title><?php echo isset($page_title) ? $page_title . " | Finolead Solutions" : "Finolead Solutions | Premium Fintech SaaS CRM & Lending Systems"; ?></title>
    <meta name="description" content="<?php echo isset($page_desc) ? $page_desc : "Finolead Solutions delivers enterprise-grade Loan Origination, AI-driven Recovery & Collections, Payday Lending CRMs and custom financial architectures for NBFCs, Banks, and Digital Lenders."; ?>">
    <meta name="keywords" content="<?php echo isset($page_keywords) ? $page_keywords : "Fintech Software Development Company, Loan Management Software, Collection CRM Software, Lead Management CRM, Recovery Management Software, Payday Loan CRM, Custom CRM Development, Financial Software Solutions, Loan Origination System, NBFC Software Solutions, Banking CRM Software, Recovery CRM"; ?>">
    <meta name="author" content="Finolead Solutions">
    <meta name="robots" content="index, follow">
    
    <!-- Canonical URL Integration -->
    <?php
    $url_mapping = [
        'index.php' => '',
        'about.php' => 'about',
        'services.php' => 'services',
        'products.php' => 'products',
        'industries.php' => 'industries',
        'technology.php' => 'technology',
        'security.php' => 'security',
        'case-studies.php' => 'case-studies',
        'contact.php' => 'contact',
        'request-demo.php' => 'request-demo',
    ];
    $pretty_path = $url_mapping[$current_page] ?? '';
    if ($current_dir === 'blog') {
        if ($current_page === 'index.php') {
            $pretty_path = 'blog';
        } elseif ($current_page === 'post.php' && isset($post['slug'])) {
            $pretty_path = 'blog/' . $post['slug'];
        }
    } elseif ($current_dir === 'careers') {
        if ($current_page === 'index.php') {
            $pretty_path = 'careers';
        } elseif ($current_page === 'job.php' && isset($job['id'])) {
            $pretty_path = 'careers/' . $job['id'];
        }
    }
    if ($current_page === 'services.php' && isset($_GET['service'])) {
        $pretty_path = 'services/' . sanitize_input($_GET['service']);
    }
    $canonical_url = get_absolute_url($pretty_path);
    ?>
    <link rel="canonical" href="<?php echo $canonical_url; ?>">
    
    <!-- Open Graph Tags (Facebook / Social Platforms) -->
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo isset($page_title) ? $page_title : "Finolead Solutions | Premium Fintech SaaS CRM & Lending Systems"; ?>">
    <meta property="og:description" content="<?php echo isset($page_desc) ? $page_desc : "Finolead Solutions delivers enterprise-grade Loan Origination, AI-driven Recovery & Collections, Payday Lending CRMs and custom financial architectures for NBFCs, Banks, and Digital Lenders."; ?>">
    <meta property="og:url" content="<?php echo $canonical_url; ?>">
    <meta property="og:site_name" content="Finolead Solutions">
    <meta property="og:image" content="<?php echo get_absolute_url('assets/images/favicon.svg'); ?>">
    <meta property="og:image:width" content="512">
    <meta property="og:image:height" content="512">
    <meta property="og:image:type" content="image/svg+xml">

    <!-- Twitter/X Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo isset($page_title) ? $page_title : "Finolead Solutions | Premium Fintech SaaS CRM & Lending Systems"; ?>">
    <meta name="twitter:description" content="<?php echo isset($page_desc) ? $page_desc : "Finolead Solutions delivers enterprise-grade Loan Origination, AI-driven Recovery & Collections, Payday Lending CRMs and custom financial architectures for NBFCs, Banks, and Digital Lenders."; ?>">
    <meta name="twitter:image" content="<?php echo get_absolute_url('assets/images/favicon.svg'); ?>">
    
    <!-- Favicon & Touch Icons -->
    <link rel="icon" type="image/svg+xml" href="<?php echo WEB_ROOT; ?>assets/images/favicon.svg">
    <link rel="apple-touch-icon" href="<?php echo WEB_ROOT; ?>assets/images/favicon.svg">
    
    <!-- Google Fonts (Preloaded for Core Web Vitals Performance) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"></noscript>
    
    <!-- Bootstrap 5 CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons via CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- Custom Theme Styles -->
    <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>assets/css/style.css">
    
    <!-- Slick Slider CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    
    <!-- Chart.js CDN (Loaded on demand or globally for dashboard visualizations) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- 1. Organization JSON-LD Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Finolead Solutions",
      "alternateName": "Finolead",
      "url": "https://finoleadsolutions.com",
      "logo": "https://finoleadsolutions.com/assets/images/favicon.svg",
      "sameAs": [
        "https://twitter.com/finolead",
        "https://www.linkedin.com/company/finolead"
      ]
    }
    </script>

    <!-- 2. Website Search JSON-LD Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "https://finoleadsolutions.com",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://finoleadsolutions.com/blog?search={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>

    <!-- 3. Dynamic Breadcrumbs JSON-LD Schema -->
    <?php
    $breadcrumbs = [
        ["name" => "Home", "url" => get_absolute_url('')]
    ];
    if ($pretty_path !== '') {
        $parts = array_filter(explode('/', $pretty_path));
        $running_path = '';
        foreach ($parts as $p) {
            $running_path .= $p . '/';
            $breadcrumbs[] = [
                "name" => ucwords(str_replace('-', ' ', $p)),
                "url" => get_absolute_url($running_path)
            ];
        }
    }
    ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        <?php 
        $list_elements = [];
        foreach ($breadcrumbs as $index => $bc) {
            $pos = $index + 1;
            $list_elements[] = '{
              "@type": "ListItem",
              "position": ' . $pos . ',
              "name": "' . sanitize_html($bc['name']) . '",
              "item": "' . sanitize_html($bc['url']) . '"
            }';
        }
        echo implode(',', $list_elements);
        ?>
      ]
    }
    </script>

    <!-- 4. Local Business JSON-LD Schema (Rendered on Home, About & Contact Pages) -->
    <?php if ($current_page === 'index.php' || $current_page === 'about.php' || $current_page === 'contact.php'): ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "Finolead Solutions Office",
      "image": "https://finoleadsolutions.com/assets/images/favicon.svg",
      "@id": "https://finoleadsolutions.com/#localbusiness",
      "url": "https://finoleadsolutions.com",
      "telephone": "+912269024500",
      "priceRange": "$$$",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "602, Naman Centre, G-Block, Bandra Kurla Complex (BKC)",
        "addressLocality": "Mumbai",
        "postalCode": "400051",
        "addressRegion": "MH",
        "addressCountry": "IN"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 19.0664,
        "longitude": 72.8661
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday"
        ],
        "opens": "09:00",
        "closes": "18:00"
      }
    }
    </script>
    <?php endif; ?>

    <!-- 5. Article & BlogPosting JSON-LD Schema (Rendered on Blog Details Page) -->
    <?php if ($current_page === 'post.php' && isset($post)): ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BlogPosting",
      "headline": "<?php echo sanitize_html($post['title']); ?>",
      "description": "<?php echo sanitize_html($post['summary']); ?>",
      "image": "https://finoleadsolutions.com/assets/images/favicon.svg",
      "datePublished": "<?php echo date('c', strtotime($post['created_at'])); ?>",
      "dateModified": "<?php echo date('c', strtotime($post['created_at'])); ?>",
      "author": {
        "@type": "Person",
        "name": "<?php echo sanitize_html($post['author'] ?? 'Finolead Editorial'); ?>"
      },
      "publisher": {
        "@type": "Organization",
        "name": "Finolead Solutions",
        "logo": {
          "@type": "ImageObject",
          "url": "https://finoleadsolutions.com/assets/images/favicon.svg"
        }
      },
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?php echo $canonical_url; ?>"
      }
    }
    </script>
    <?php endif; ?>

    <!-- 6. JobPosting JSON-LD Schema (Rendered on Career Details Page) -->
    <?php if ($current_page === 'job.php' && isset($job)): ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "JobPosting",
      "title": "<?php echo sanitize_html($job['title']); ?>",
      "description": "<?php echo sanitize_html($job['description'] . '\n\nKey Requirements:\n' . $job['requirements']); ?>",
      "datePosted": "<?php echo date('c', strtotime($job['created_at'])); ?>",
      "validThrough": "<?php echo date('c', strtotime('+1 year', strtotime($job['created_at']))); ?>",
      "employmentType": "FULL_TIME",
      "hiringOrganization": {
        "@type": "Organization",
        "name": "Finolead Solutions",
        "sameAs": "https://finoleadsolutions.com",
        "logo": "https://finoleadsolutions.com/assets/images/favicon.svg"
      },
      "jobLocation": {
        "@type": "Place",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "602, Naman Centre, G-Block, BKC",
          "addressLocality": "Mumbai",
          "addressRegion": "MH",
          "postalCode": "400051",
          "addressCountry": "IN"
        }
      },
      "baseSalary": {
        "@type": "MonetaryAmount",
        "currency": "INR",
        "value": {
          "@type": "QuantitativeValue",
          "unitText": "YEAR"
        }
      }
    }
    </script>
    <?php endif; ?>
</head>
<body>
<header>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg glass-nav fixed-top p-0">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center fw-800 fs-4 text-primary-color" href="<?php echo WEB_ROOT; ?>">
            <img src="<?php echo WEB_ROOT; ?>assets/images/logo.webp" alt="Finolead Solutions Logo" loading="lazy">
        </a>
        
        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Navbar Navigation links -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto me-3 mb-2 mb-lg-0 align-items-center">
                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link px-3 fw-600 <?php echo $current_page === 'index.php' ? 'text-secondary-color active' : 'text-primary-color'; ?>" href="<?php echo WEB_ROOT; ?>">Home</a>
                </li>
                
                <!-- About -->
                <li class="nav-item">
                    <a class="nav-link px-3 fw-600 <?php echo $current_page === 'about.php' ? 'text-secondary-color active' : 'text-primary-color'; ?>" href="<?php echo WEB_ROOT; ?>about">About</a>
                </li>
                
                <!-- Mega Menu (Services) -->
                <li class="nav-item dropdown">
                    <a class="nav-link px-3 fw-600 dropdown-toggle <?php echo ($current_page === 'services.php') ? 'text-secondary-color active' : 'text-primary-color'; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Services & CRMs
                    </a>
                    <div class="dropdown-menu mega-menu">
                        <div class="row g-2">
                            <!-- Left Column: Core CRMs -->
                            <div class="col-md-6">
                                <h6 class="text-secondary-color fw-bold px-2 mb-2 small text-uppercase tracking-wider">Lending & Recovery CRMs</h6>
                                <a href="<?php echo WEB_ROOT; ?>services/payday-loan-crm" class="mega-menu-item">
                                    <div class="mega-menu-icon"><i class="bi bi-currency-dollar"></i></div>
                                    <div>
                                        <div class="mega-menu-title">Payday Loan CRM</div>
                                        <p class="mega-menu-desc">High-velocity microfinance & payday engine.</p>
                                    </div>
                                </a>
                                <a href="<?php echo WEB_ROOT; ?>services/collection-crm" class="mega-menu-item">
                                    <div class="mega-menu-icon"><i class="bi bi-wallet2"></i></div>
                                    <div>
                                        <div class="mega-menu-title">Collection CRM</div>
                                        <p class="mega-menu-desc">Dynamic automated collection structures.</p>
                                    </div>
                                </a>
                                <a href="<?php echo WEB_ROOT; ?>services/lead-management-crm" class="mega-menu-item">
                                    <div class="mega-menu-icon"><i class="bi bi-people"></i></div>
                                    <div>
                                        <div class="mega-menu-title">Lead Management CRM</div>
                                        <p class="mega-menu-desc">Secure marketing funnels & agent desks.</p>
                                    </div>
                                </a>
                                <a href="<?php echo WEB_ROOT; ?>services/recovery-management-software" class="mega-menu-item">
                                    <div class="mega-menu-icon"><i class="bi bi-shield-check"></i></div>
                                    <div>
                                        <div class="mega-menu-title">Recovery CRM</div>
                                        <p class="mega-menu-desc">Delinquency risk mapping & legal engines.</p>
                                    </div>
                                </a>
                            </div>
                            <!-- Right Column: Engineering Platforms -->
                            <div class="col-md-6">
                                <h6 class="text-accent-color fw-bold px-2 mb-2 small text-uppercase tracking-wider">Enterprise Architectures</h6>
                                <a href="<?php echo WEB_ROOT; ?>services/loan-management-software" class="mega-menu-item">
                                    <div class="mega-menu-icon" style="color: var(--accent); background: rgba(20, 184, 166, 0.1);"><i class="bi bi-bank"></i></div>
                                    <div>
                                        <div class="mega-menu-title">Loan Origination System (LOS)</div>
                                        <p class="mega-menu-desc">Automated bureaus underwriting & disbursement.</p>
                                    </div>
                                </a>
                                <a href="<?php echo WEB_ROOT; ?>services#fintech-dev" class="mega-menu-item">
                                    <div class="mega-menu-icon" style="color: var(--accent); background: rgba(20, 184, 166, 0.1);"><i class="bi bi-cpu"></i></div>
                                    <div>
                                        <div class="mega-menu-title">Fintech Development</div>
                                        <p class="mega-menu-desc">Bespoke secure financial platforms.</p>
                                    </div>
                                </a>
                                <a href="<?php echo WEB_ROOT; ?>services#erp-dev" class="mega-menu-item">
                                    <div class="mega-menu-icon" style="color: var(--accent); background: rgba(20, 184, 166, 0.1);"><i class="bi bi-grid-1x2"></i></div>
                                    <div>
                                        <div class="mega-menu-title">ERP Development</div>
                                        <p class="mega-menu-desc">Cross-department financial ledger integrations.</p>
                                    </div>
                                </a>
                                <a href="<?php echo WEB_ROOT; ?>services#ai-automation" class="mega-menu-item">
                                    <div class="mega-menu-icon" style="color: var(--accent); background: rgba(20, 184, 166, 0.1);"><i class="bi bi-robot"></i></div>
                                    <div>
                                        <div class="mega-menu-title">AI Automation</div>
                                        <p class="mega-menu-desc">Smart chatbots & risk analytics modules.</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row pt-2 mt-2 border-top border-light-subtle">
                            <div class="col text-center">
                                <a href="<?php echo WEB_ROOT; ?>services" class="text-secondary-color fw-bold text-decoration-none small">
                                    View All Services <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                
                <!-- Products -->
                <li class="nav-item">
                    <a class="nav-link px-3 fw-600 <?php echo $current_page === 'products.php' ? 'text-secondary-color active' : 'text-primary-color'; ?>" href="<?php echo WEB_ROOT; ?>products">Products</a>
                </li>

                <!-- Resources Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link px-3 fw-600 dropdown-toggle <?php echo ($current_page === 'industries.php' || $current_page === 'technology.php' || $current_page === 'security.php' || $current_page === 'case-studies.php' || $current_dir === 'blog' || $current_page === 'blog.php' || $current_dir === 'careers' || $current_page === 'careers.php') ? 'text-secondary-color active' : 'text-primary-color'; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Resources
                    </a>
                    <ul class="dropdown-menu shadow border-light-subtle rounded-3 py-2" style="min-width: 220px;">
                        <li><a class="dropdown-item py-2 px-3 fw-500 <?php echo $current_page === 'case-studies.php' ? 'text-secondary-color bg-light' : 'text-primary-color'; ?>" href="<?php echo WEB_ROOT; ?>case-studies"><i class="bi bi-file-earmark-bar-graph me-2"></i>Case Studies</a></li>
                        <li><a class="dropdown-item py-2 px-3 fw-500 <?php echo $current_page === 'industries.php' ? 'text-secondary-color bg-light' : 'text-primary-color'; ?>" href="<?php echo WEB_ROOT; ?>industries"><i class="bi bi-building me-2"></i>Industries</a></li>
                        <li><a class="dropdown-item py-2 px-3 fw-500 <?php echo $current_page === 'technology.php' ? 'text-secondary-color bg-light' : 'text-primary-color'; ?>" href="<?php echo WEB_ROOT; ?>technology"><i class="bi bi-cpu me-2"></i>Technology</a></li>
                        <li><a class="dropdown-item py-2 px-3 fw-500 <?php echo $current_page === 'security.php' ? 'text-secondary-color bg-light' : 'text-primary-color'; ?>" href="<?php echo WEB_ROOT; ?>security"><i class="bi bi-shield-check me-2"></i>Security & Compliance</a></li>
                        <li><hr class="dropdown-divider border-light-subtle my-1"></li>
                        <li><a class="dropdown-item py-2 px-3 fw-500 <?php echo ($current_dir === 'blog' || $current_page === 'blog.php') ? 'text-secondary-color bg-light' : 'text-primary-color'; ?>" href="<?php echo WEB_ROOT; ?>blog"><i class="bi bi-journal-text me-2"></i>Blog Insights</a></li>
                        <li><a class="dropdown-item py-2 px-3 fw-500 <?php echo ($current_dir === 'careers' || $current_page === 'careers.php') ? 'text-secondary-color bg-light' : 'text-primary-color'; ?>" href="<?php echo WEB_ROOT; ?>careers"><i class="bi bi-briefcase me-2"></i>Careers Board</a></li>
                    </ul>
                </li>
            </ul>
            
            <!-- CTAs -->
            <div class="d-flex align-items-center gap-3">
                <a href="<?php echo WEB_ROOT; ?>contact" class="btn btn-link text-primary-color text-decoration-none fw-600 px-2 d-none d-xl-inline">Contact</a>
                <a href="<?php echo WEB_ROOT; ?>request-demo" class="btn btn-primary shadow-sm px-4">Request Demo</a>
            </div>
        </div>
    </div>
</nav>
</header>
<main>
