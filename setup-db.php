<?php
/**
 * Finolead Solutions - Database Auto-Setup & Seeder Wizard
 * Run this file in your browser to create the MySQL database and seed initial tables.
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'finolead_db';

$messages = [];
$success = true;

try {
    // 1. Establish base connection to MySQL server
    $messages[] = ["status" => "info", "text" => "Connecting to MySQL server at '$db_host'..."];
    $conn = new PDO("mysql:host=$db_host", $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    $messages[] = ["status" => "success", "text" => "Successfully connected to MySQL!"];

    // 2. Create the database if not exists
    $messages[] = ["status" => "info", "text" => "Creating database '$db_name' if not exists..."];
    $conn->exec("CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $messages[] = ["status" => "success", "text" => "Database '$db_name' created/verified successfully!"];

    // 3. Connect to the new database
    $conn->exec("USE `$db_name`");
    
    // 4. Create Tables
    $messages[] = ["status" => "info", "text" => "Creating database tables..."];
    
    // admin_users
    $conn->exec("CREATE TABLE IF NOT EXISTS `admin_users` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `username` VARCHAR(50) NOT NULL UNIQUE,
        `password` VARCHAR(255) NOT NULL,
        `email` VARCHAR(100) NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    $messages[] = ["status" => "success", "text" => "Table 'admin_users' created."];

    // contact_requests
    $conn->exec("CREATE TABLE IF NOT EXISTS `contact_requests` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(100) NOT NULL,
        `email` VARCHAR(100) NOT NULL,
        `phone` VARCHAR(20) DEFAULT NULL,
        `company` VARCHAR(100) DEFAULT NULL,
        `subject` VARCHAR(150) NOT NULL,
        `message` TEXT NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    $messages[] = ["status" => "success", "text" => "Table 'contact_requests' created."];

    // demo_requests
    $conn->exec("CREATE TABLE IF NOT EXISTS `demo_requests` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(100) NOT NULL,
        `email` VARCHAR(100) NOT NULL,
        `phone` VARCHAR(20) DEFAULT NULL,
        `company` VARCHAR(100) NOT NULL,
        `job_title` VARCHAR(100) DEFAULT NULL,
        `loan_volume` VARCHAR(50) DEFAULT NULL,
        `message` TEXT DEFAULT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    $messages[] = ["status" => "success", "text" => "Table 'demo_requests' created."];

    // newsletter_subscribers
    $conn->exec("CREATE TABLE IF NOT EXISTS `newsletter_subscribers` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `email` VARCHAR(100) NOT NULL UNIQUE,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    $messages[] = ["status" => "success", "text" => "Table 'newsletter_subscribers' created."];

    // jobs
    $conn->exec("CREATE TABLE IF NOT EXISTS `jobs` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(100) NOT NULL,
        `department` VARCHAR(50) NOT NULL,
        `location` VARCHAR(50) NOT NULL,
        `type` VARCHAR(50) NOT NULL,
        `experience` VARCHAR(50) NOT NULL,
        `description` TEXT NOT NULL,
        `requirements` TEXT NOT NULL,
        `benefits` TEXT NOT NULL,
        `status` VARCHAR(20) DEFAULT 'Active',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    $messages[] = ["status" => "success", "text" => "Table 'jobs' created."];

    // job_applications
    $conn->exec("CREATE TABLE IF NOT EXISTS `job_applications` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `job_id` INT NOT NULL,
        `name` VARCHAR(100) NOT NULL,
        `email` VARCHAR(100) NOT NULL,
        `phone` VARCHAR(20) NOT NULL,
        `resume_path` VARCHAR(255) NOT NULL,
        `cover_letter` TEXT DEFAULT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (`job_id`) REFERENCES `jobs`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    $messages[] = ["status" => "success", "text" => "Table 'job_applications' created."];

    // blog_posts
    $conn->exec("CREATE TABLE IF NOT EXISTS `blog_posts` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(150) NOT NULL,
        `slug` VARCHAR(150) NOT NULL UNIQUE,
        `summary` TEXT NOT NULL,
        `content` LONGTEXT NOT NULL,
        `image_path` VARCHAR(255) DEFAULT NULL,
        `category` VARCHAR(50) NOT NULL,
        `author` VARCHAR(100) DEFAULT 'Finolead Editorial',
        `status` VARCHAR(20) DEFAULT 'Published',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    $messages[] = ["status" => "success", "text" => "Table 'blog_posts' created."];

    // 5. Seed Core Data
    $messages[] = ["status" => "info", "text" => "Seeding initial database records..."];

    // Default Admin User
    $check_admin = $conn->query("SELECT COUNT(*) FROM `admin_users` WHERE `username` = 'admin'")->fetchColumn();
    if ($check_admin == 0) {
        $admin_pass = password_hash('admin123', PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO `admin_users` (`username`, `password`, `email`) VALUES (:u, :p, :e)");
        $stmt->execute([
            ':u' => 'admin',
            ':p' => $admin_pass,
            ':e' => 'admin@finolead.com'
        ]);
        $messages[] = ["status" => "success", "text" => "Seeded default administrator account: <strong>admin</strong> / <strong>admin123</strong>"];
    }

    // Careers Seeding
    $check_jobs = $conn->query("SELECT COUNT(*) FROM `jobs`")->fetchColumn();
    if ($check_jobs == 0) {
        $jobs_data = [
            [
                "title" => "Senior Full-Stack Engineer (Fintech/PHP)",
                "department" => "Engineering",
                "location" => "Mumbai (Hybrid)",
                "type" => "Full-Time",
                "experience" => "5-8 Years",
                "description" => "We are looking for a Senior Full-Stack PHP Developer who is passionate about building scalable microservices and database structures. You will own the core architecture of our Payday Loan CRM and Loan Origination Engine, integrating secure transaction pathways and banking APIs.",
                "requirements" => "Extensive experience with Core PHP, MVC frameworks, MySQL optimization, and RESTful API integrations.\nStrong knowledge of web security best practices (OWASP, SQLi prevention, CSRF, XSS).\nExperience with AWS, Docker, and caching layers like Redis.\nFamiliarity with financial technology or lending workflows is a huge plus.",
                "benefits" => "Competitive Salary + Annual Performance Bonus.\nComprehensive Medical & Health Insurance for family.\nFlexible remote days & custom workspace hardware.\nContinuous education budgets and certifications allowance."
            ],
            [
                "title" => "Lead Credit Risk Analyst",
                "department" => "Risk & Analytics",
                "location" => "Bangalore (Remote)",
                "type" => "Full-Time",
                "experience" => "4-6 Years",
                "description" => "Join our risk engine development team to engineer alternative credit scoring models using machine learning. You will collaborate with data scientists to optimize underwriting speeds and improve default forecast algorithms for NBFC integrations.",
                "requirements" => "Strong experience in SQL, Python/R, and statistical modeling tools.\nPrior experience at a digital lender, NBFC, or retail bank working in underwriting or credit risk analytics.\nFamiliarity with bureau APIs (CIBIL, Experian) and alternative data footprints.",
                "benefits" => "Generous ESOP packages.\nFully remote work option with flexible timings.\nPremium wellness subscription and learning stipends."
            ],
            [
                "title" => "Enterprise Sales Director - Lending Solutions",
                "department" => "Business Development",
                "location" => "Mumbai (On-site)",
                "type" => "Full-Time",
                "experience" => "8+ Years",
                "description" => "We are scaling our enterprise offerings to larger Tier-2 banks and Tier-1 NBFCs. You will drive commercial relationships with executive stakeholders, present technical capabilities of Finolead systems, and close large-scale SaaS contracts.",
                "requirements" => "Proven track record of B2B enterprise software sales directly into Indian banks, NBFCs, or microfinance institutions.\nTechnical understanding of CRM structures, Loan Origination workflow, and API integrations.\nExceptional negotiation, communication, and executive presentation capabilities.",
                "benefits" => "Industry-leading commission structure uncapped.\nExecutive vehicle and travel allowance.\nCorporate wellness benefits and club memberships."
            ]
        ];

        $stmt = $conn->prepare("INSERT INTO `jobs` (`title`, `department`, `location`, `type`, `experience`, `description`, `requirements`, `benefits`) VALUES (:title, :dept, :loc, :type, :exp, :descr, :reqs, :ben)");
        foreach ($jobs_data as $job) {
            $stmt->execute([
                ':title' => $job['title'],
                ':dept' => $job['department'],
                ':loc' => $job['location'],
                ':type' => $job['type'],
                ':exp' => $job['experience'],
                ':descr' => $job['description'],
                ':reqs' => $job['requirements'],
                ':ben' => $job['benefits']
            ]);
        }
        $messages[] = ["status" => "success", "text" => "Seeded 3 live Job Openings under Careers Desk."];
    }

    // Blog Seeding
    $check_blogs = $conn->query("SELECT COUNT(*) FROM `blog_posts`")->fetchColumn();
    if ($check_blogs == 0) {
        $blogs_data = [
            [
                "title" => "The Future of Digital Loan Origination Systems (LOS)",
                "slug" => "future-of-digital-loan-origination-systems",
                "summary" => "Explore how cloud microservices and alternative scoring criteria are redefining loan onboarding speed and accessibility for banks and NBFCs worldwide.",
                "category" => "Lending Tech",
                "content" => "The global digital lending space is moving at light speed. Ten years ago, securing a personal or business loan involved physical documentation, long queues at retail bank branches, and manual credit bureau requests that could stretch for days. Today, digital Loan Origination Systems (LOS) process massive applications and distribute capital within minutes.\n\nAt the core of this transformation is API-driven connectivity. Modern LOS systems integrate with government databases, banking gateways, and alternative credit data matrices in real time. Rather than relying entirely on historical credit scores, AI-driven underwriting engines parse alternative data metrics, including digital cash flows, utility transaction compliance, and invoice histories.\n\nFurthermore, by shifting to modular cloud architecture, financial institutions can launch personalized lending products within weeks rather than months. As competition increases, the ability to deliver lightning-fast, high-accuracy lending decisions will differentiate successful NBFCs and fintech startups from traditional counterparts."
            ],
            [
                "title" => "Reducing NPA with AI-Powered Recovery & Collection CRMs",
                "slug" => "reducing-npa-ai-recovery-collection-crms",
                "summary" => "Discover how data-driven automated collections, behavioral segmentation, and integrated dialers reduce non-performing assets without increasing staff overhead.",
                "category" => "Recovery & Collections",
                "content" => "Non-Performing Assets (NPAs) are one of the most critical challenges facing the banking and microfinance sectors. Traditional debt recovery strategies rely on manual cold-calling, uncoordinated agent visits, and expensive legal systems that often drag on with diminishing returns.\n\nAI-powered collection CRMs are transforming this dynamic. By implementing behavioral intelligence, collections desks can segment portfolios based on risk flags and repayment tendencies. High-probability clients receive soft automated SMS/WhatsApp alerts and secure payment link gateways. Meanwhile, specialized human agents are dynamically directed to high-value, high-risk cases that require direct negotiation.\n\nFurthermore, system integrations with predictive dialers ensure recovery agents spend time speaking to responsive clients rather than waiting on dial tones. Deploying AI-powered recovery engines leads to an average reduction of 25% in early-stage delinquencies while optimizing the administrative costs of recovery desks by 40%."
            ],
            [
                "title" => "Achieving SOC2 and ISO27001 Compliance in Fintech SaaS",
                "slug" => "achieving-soc2-iso27001-fintech-saas",
                "summary" => "Understand the fundamental technical parameters, data protection protocols, and audit benchmarks necessary to win the trust of Tier-1 banks.",
                "category" => "Compliance",
                "content" => "For any financial technology company, trust is the ultimate currency. If you are licensing CRM and lending systems to Tier-1 banks, NBFCs, or insurance underwriters, demonstrating robust security protocols is not just a nice-to-have benefit; it is a critical regulatory prerequisite.\n\nThis is where SOC2 Type II and ISO 27001 certifications become vital. These security frameworks require companies to implement comprehensive operational practices. These include continuous encryption (AES-256 for data-at-rest, TLS 1.3 for data-in-transit), secure server isolation, multi-factor admin authentication, secure code testing, and continuous activity logs.\n\nBy building solutions that adhere strictly to international database standards, Finolead Solutions ensures all tenant data is securely ring-fenced. Security audit validation provides banking stakeholders the ultimate assurance that critical customer financial profiles are safeguarded from malicious attempts and structural leakages."
            ]
        ];

        $stmt = $conn->prepare("INSERT INTO `blog_posts` (`title`, `slug`, `summary`, `content`, `category`) VALUES (:title, :slug, :summary, :content, :cat)");
        foreach ($blogs_data as $post) {
            $stmt->execute([
                ':title' => $post['title'],
                ':slug' => $post['slug'],
                ':summary' => $post['summary'],
                ':content' => $post['content'],
                ':cat' => $post['category']
            ]);
        }
        $messages[] = ["status" => "success", "text" => "Seeded 3 comprehensive Blog Articles."];
    }

    $messages[] = ["status" => "success", "text" => "Database auto-setup completed successfully!"];

} catch (PDOException $e) {
    $success = false;
    $messages[] = ["status" => "danger", "text" => "Database Setup Failed: " . $e->getMessage()];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finolead Solutions - Database Installer</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0b0f19;
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .setup-card {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5), 0 0 100px rgba(37, 99, 235, 0.15);
            max-width: 600px;
            width: 100%;
            overflow: hidden;
        }
        .setup-header {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            padding: 2.5rem 2rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .logo-text {
            font-weight: 800;
            font-size: 1.8rem;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #3b82f6, #14b8a6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .setup-body {
            padding: 2.5rem 2rem;
        }
        .log-item {
            padding: 10px 14px;
            border-radius: 12px;
            margin-bottom: 10px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            border: 1px solid transparent;
        }
        .log-info {
            background: rgba(37, 99, 235, 0.05);
            border-color: rgba(37, 99, 235, 0.15);
            color: #93c5fd;
        }
        .log-success {
            background: rgba(20, 184, 166, 0.05);
            border-color: rgba(20, 184, 166, 0.15);
            color: #99f6e4;
        }
        .log-danger {
            background: rgba(239, 68, 68, 0.05);
            border-color: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
        }
        .btn-fintech {
            background: linear-gradient(135deg, #2563eb, #14b8a6);
            border: none;
            color: #ffffff;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        .btn-fintech:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
            color: #ffffff;
        }
    </style>
</head>
<body>

<div class="setup-card">
    <div class="setup-header">
        <div class="logo-text mb-2"><i class="bi bi-wallet2 me-2"></i>FINOLEAD</div>
        <h4 class="mb-0 fw-bold">Database Setup Wizard</h4>
        <p class="text-muted small mb-0 mt-1">Configuring database and seeding data for Finolead Solutions website</p>
    </div>
    
    <div class="setup-body">
        <div class="mb-4">
            <?php foreach ($messages as $msg): ?>
                <div class="log-item log-<?php echo $msg['status']; ?>">
                    <span class="me-2">
                        <?php if ($msg['status'] === 'success'): ?>
                            <i class="bi bi-check-circle-fill text-teal"></i>
                        <?php elseif ($msg['status'] === 'danger'): ?>
                            <i class="bi bi-x-circle-fill text-danger"></i>
                        <?php else: ?>
                            <i class="bi bi-info-circle-fill text-primary"></i>
                        <?php endif; ?>
                    </span>
                    <div><?php echo $msg['text']; ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-4">
            <?php if ($success): ?>
                <div class="alert alert-success bg-opacity-10 border-success-subtle text-success py-3 px-4 rounded-4 mb-4">
                    <i class="bi bi-shield-check fs-2 d-block mb-2"></i>
                    <strong>System Ready!</strong> Database configuration, tables creation, and seed execution completed successfully.
                </div>
                <div class="d-grid gap-2">
                    <a href="index.php" class="btn btn-fintech">Go to Homepage</a>
                    <a href="admin/login.php" class="btn btn-outline-light border-secondary border-opacity-20 py-2 rounded-3 text-muted">Go to Admin Login (admin / admin123)</a>
                </div>
            <?php else: ?>
                <div class="alert alert-danger bg-opacity-10 border-danger-subtle text-danger py-3 px-4 rounded-4 mb-4">
                    <i class="bi bi-exclamation-triangle-fill fs-2 d-block mb-2"></i>
                    <strong>Setup Failed!</strong> Please verify that your local MySQL server is active in XAMPP and running on localhost with default credentials (user: root, password: "").
                </div>
                <a href="setup-db.php" class="btn btn-outline-danger py-2 px-4 rounded-3"><i class="bi bi-arrow-clockwise me-1"></i> Retry Installation</a>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
