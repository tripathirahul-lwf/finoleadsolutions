<?php
/**
 * Finolead Solutions - Secure Admin Console Dashboard
 * Features: View Inquiries, Manage Demo Requests, Export Newsletter list,
 * Post Job Openings, Manage Applicants, Write & Publish Blog Posts.
 */
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

// Auth Guard
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    redirect('login.php');
}

$errors = [];
$success_msg = '';

// Check database connection
if (!$pdo) {
    die("Database connection failed. Please run <a href='../setup-db.php'>setup-db.php</a> to configure the system.");
}

// 1. Process Actions (GET actions: Delete requests)
$action = sanitize_input($_GET['action'] ?? '');
$id = filter_var($_GET['id'] ?? '', FILTER_VALIDATE_INT);

if (!empty($action) && $id) {
    try {
        if ($action === 'delete_inquiry') {
            $stmt = $pdo->prepare("DELETE FROM `contact_requests` WHERE `id` = :id");
            $stmt->execute([':id' => $id]);
            set_flash_message("Inquiry record deleted.", "success");
        } 
        elseif ($action === 'delete_demo') {
            $stmt = $pdo->prepare("DELETE FROM `demo_requests` WHERE `id` = :id");
            $stmt->execute([':id' => $id]);
            set_flash_message("Demo Booking record deleted.", "success");
        } 
        elseif ($action === 'delete_subscriber') {
            $stmt = $pdo->prepare("DELETE FROM `newsletter_subscribers` WHERE `id` = :id");
            $stmt->execute([':id' => $id]);
            set_flash_message("Subscriber removed.", "success");
        } 
        elseif ($action === 'delete_application') {
            // Get file path first to delete the file
            $stmt = $pdo->prepare("SELECT `resume_path` FROM `job_applications` WHERE `id` = :id");
            $stmt->execute([':id' => $id]);
            $filepath = $stmt->fetchColumn();
            if ($filepath && file_exists(__DIR__ . '/../' . $filepath)) {
                unlink(__DIR__ . '/../' . $filepath);
            }
            
            $stmt = $pdo->prepare("DELETE FROM `job_applications` WHERE `id` = :id");
            $stmt->execute([':id' => $id]);
            set_flash_message("Application deleted.", "success");
        } 
        elseif ($action === 'delete_job') {
            $stmt = $pdo->prepare("DELETE FROM `jobs` WHERE `id` = :id");
            $stmt->execute([':id' => $id]);
            set_flash_message("Job Opening removed.", "success");
        } 
        elseif ($action === 'delete_post') {
            $stmt = $pdo->prepare("DELETE FROM `blog_posts` WHERE `id` = :id");
            $stmt->execute([':id' => $id]);
            set_flash_message("Blog publication removed.", "success");
        }
        redirect('index.php');
    } catch (PDOException $e) {
        $errors[] = "Operation failed: " . $e->getMessage();
    }
}

// 2. Process POST Actions (Add Job / Add Blog)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST['csrf_token'] ?? '';
    
    if (!validate_csrf_token($csrf_token)) {
        $errors[] = "CSRF Verification failed.";
    } else {
        $form_type = sanitize_input($_POST['form_type'] ?? '');

        if ($form_type === 'add_job') {
            $title = sanitize_input($_POST['title'] ?? '');
            $department = sanitize_input($_POST['department'] ?? '');
            $location = sanitize_input($_POST['location'] ?? '');
            $type = sanitize_input($_POST['type'] ?? '');
            $experience = sanitize_input($_POST['experience'] ?? '');
            $description = sanitize_input($_POST['description'] ?? '');
            $requirements = sanitize_input($_POST['requirements'] ?? '');
            $benefits = sanitize_input($_POST['benefits'] ?? '');

            if (empty($title) || empty($department) || empty($location) || empty($description)) {
                $errors[] = "Please fill in all core job opening fields.";
            } else {
                try {
                    $stmt = $pdo->prepare("INSERT INTO `jobs` (`title`, `department`, `location`, `type`, `experience`, `description`, `requirements`, `benefits`) VALUES (:title, :dept, :loc, :type, :exp, :descr, :reqs, :ben)");
                    $stmt->execute([
                        ':title' => $title,
                        ':dept' => $department,
                        ':loc' => $location,
                        ':type' => $type,
                        ':exp' => $experience,
                        ':descr' => $description,
                        ':reqs' => $requirements,
                        ':ben' => $benefits
                    ]);
                    set_flash_message("Successfully posted new Job Opening: '{$title}'", "success");
                    redirect('index.php');
                } catch (PDOException $e) {
                    $errors[] = "Failed to post job: " . $e->getMessage();
                }
            }
        } 
        elseif ($form_type === 'add_blog') {
            $title = sanitize_input($_POST['title'] ?? '');
            $summary = sanitize_input($_POST['summary'] ?? '');
            $content = sanitize_input($_POST['content'] ?? '');
            $category = sanitize_input($_POST['category'] ?? '');
            
            // Auto generate slug from title
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));

            if (empty($title) || empty($summary) || empty($content) || empty($category)) {
                $errors[] = "Please fill in all blog publication fields.";
            } else {
                try {
                    // Check duplicate slug
                    $stmt = $pdo->prepare("SELECT COUNT(*) FROM `blog_posts` WHERE `slug` = :slug");
                    $stmt->execute([':slug' => $slug]);
                    if ($stmt->fetchColumn() > 0) {
                        $slug .= '-' . rand(100, 999);
                    }

                    $stmt = $pdo->prepare("INSERT INTO `blog_posts` (`title`, `slug`, `summary`, `content`, `category`) VALUES (:title, :slug, :summary, :content, :cat)");
                    $stmt->execute([
                        ':title' => $title,
                        ':slug' => $slug,
                        ':summary' => $summary,
                        ':content' => $content,
                        ':cat' => $category
                    ]);
                    set_flash_message("Successfully published new blog post: '{$title}'", "success");
                    redirect('index.php');
                } catch (PDOException $e) {
                    $errors[] = "Failed to publish blog post: " . $e->getMessage();
                }
            }
        }
    }
}

// 3. Fetch all datasets to render dashboard lists
try {
    $inquiries = $pdo->query("SELECT * FROM `contact_requests` ORDER BY `created_at` DESC")->fetchAll();
    $demos = $pdo->query("SELECT * FROM `demo_requests` ORDER BY `created_at` DESC")->fetchAll();
    $subscribers = $pdo->query("SELECT * FROM `newsletter_subscribers` ORDER BY `created_at` DESC")->fetchAll();
    $jobs = $pdo->query("SELECT * FROM `jobs` ORDER BY `created_at` DESC")->fetchAll();
    $posts = $pdo->query("SELECT * FROM `blog_posts` ORDER BY `created_at` DESC")->fetchAll();
    
    // Fetch Applications with Join
    $applications = $pdo->query("
        SELECT a.*, j.title AS job_title 
        FROM `job_applications` a 
        JOIN `jobs` j ON a.job_id = j.id 
        ORDER BY a.created_at DESC
    ")->fetchAll();

    // Aggregations
    $count_inquiries = count($inquiries);
    $count_demos = count($demos);
    $count_subscribers = count($subscribers);
    $count_apps = count($applications);

} catch (PDOException $e) {
    die("Data loading failed: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finolead Solutions - Admin Console Dashboard</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }
        .admin-sidebar {
            background-color: #0f172a;
            color: #94a3b8;
            min-height: 100vh;
            border-right: 1px solid rgba(255,255,255,0.05);
        }
        .admin-sidebar .nav-link {
            color: #94a3b8;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 6px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .admin-sidebar .nav-link:hover, 
        .admin-sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.05);
            color: white;
        }
        .admin-sidebar .nav-link.active {
            border-left: 4px solid #14b8a6;
        }
        .metric-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            border: 1px solid #e2e8f0;
            padding: 24px;
            transition: all 0.3s ease;
        }
        .metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .table-responsive {
            background: white;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }
        .table th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e2e8f0;
            padding: 14px 16px;
        }
        .table td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            vertical-align: middle;
            font-size: 0.85rem;
        }
        .btn-action {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-lg-2 admin-sidebar p-4 position-fixed d-none d-lg-block" style="top:0; bottom:0; left:0; z-index: 10;">
            <div class="d-flex align-items-center mb-5 mt-2">
                <span class="bg-secondary text-white rounded-3 p-2 me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background-color: #2563eb !important;">
                    <i class="bi bi-wallet2 fs-6"></i>
                </span>
                <span class="fw-bold text-white fs-5" style="letter-spacing: -0.5px;">FINOLEAD</span>
            </div>
            
            <div class="nav flex-column nav-pills" id="adminTabs" role="tablist" aria-orientation="vertical">
                <button class="nav-link text-start active" id="overview-tab" data-bs-toggle="pill" data-bs-target="#overview" type="button" role="tab"><i class="bi bi-grid-fill me-2"></i>Overview</button>
                <button class="nav-link text-start" id="inquiries-tab" data-bs-toggle="pill" data-bs-target="#inquiries" type="button" role="tab"><i class="bi bi-chat-left-text-fill me-2"></i>Inquiries <span class="badge bg-secondary bg-opacity-25 text-white float-end"><?php echo $count_inquiries; ?></span></button>
                <button class="nav-link text-start" id="demos-tab" data-bs-toggle="pill" data-bs-target="#demos" type="button" role="tab"><i class="bi bi-calendar-event-fill me-2"></i>Demos <span class="badge bg-secondary bg-opacity-25 text-white float-end"><?php echo $count_demos; ?></span></button>
                <button class="nav-link text-start" id="subscribers-tab" data-bs-toggle="pill" data-bs-target="#subscribers" type="button" role="tab"><i class="bi bi-people-fill me-2"></i>Subscribers <span class="badge bg-secondary bg-opacity-25 text-white float-end"><?php echo $count_subscribers; ?></span></button>
                <button class="nav-link text-start" id="careers-tab" data-bs-toggle="pill" data-bs-target="#careers" type="button" role="tab"><i class="bi bi-briefcase-fill me-2"></i>Careers <span class="badge bg-secondary bg-opacity-25 text-white float-end"><?php echo $count_apps; ?></span></button>
                <button class="nav-link text-start" id="blog-tab" data-bs-toggle="pill" data-bs-target="#blog" type="button" role="tab"><i class="bi bi-journal-text me-2"></i>Blog Desk</button>
            </div>
            
            <div class="mt-5 pt-5">
                <div class="text-muted small mb-2 px-2">Operator: <strong><?php echo sanitize_html($_SESSION['admin_user']); ?></strong></div>
                <a href="logout.php" class="btn btn-outline-danger w-100 py-2 rounded-3 small"><i class="bi bi-box-arrow-left me-1"></i> Log Out</a>
            </div>
        </div>

        <!-- Main Display Content -->
        <div class="col-lg-10 offset-lg-2 p-5" style="min-height: 100vh;">
            
            <!-- Global Dashboard Alerts -->
            <?php echo render_alert(); ?>
            <?php if(!empty($errors)): ?>
                <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4 small" role="alert">
                    <ul class="mb-0 ps-3">
                        <?php foreach($errors as $err): ?>
                            <li><?php echo sanitize_html($err); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Tab Content Screens -->
            <div class="tab-content" id="adminTabContent">
                
                <!-- Tab 1: Overview -->
                <div class="tab-pane fade show active" id="overview" role="tabpanel">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h2 class="fw-bold mb-1 text-primary-color">Control Console Overview</h2>
                            <p class="text-muted small mb-0">Operational statistics and summary activities logs.</p>
                        </div>
                        <a href="../setup-db.php" class="btn btn-sm btn-outline-secondary py-2 rounded-3"><i class="bi bi-arrow-clockwise me-1"></i>Reset Database</a>
                    </div>
                    
                    <div class="row g-4 mb-5">
                        <div class="col-md-3">
                            <div class="metric-card">
                                <span class="text-muted small d-block mb-1">Total Inquiries</span>
                                <h3 class="fw-bold mb-0 text-primary-color"><?php echo $count_inquiries; ?></h3>
                                <span class="text-secondary small d-block mt-2"><i class="bi bi-chat-dots me-1"></i>From contact form</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric-card">
                                <span class="text-muted small d-block mb-1">Demo Bookings</span>
                                <h3 class="fw-bold mb-0 text-primary-color"><?php echo $count_demos; ?></h3>
                                <span class="text-accent small d-block mt-2"><i class="bi bi-shield-check me-1"></i>From request funnel</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric-card">
                                <span class="text-muted small d-block mb-1">Subscribers</span>
                                <h3 class="fw-bold mb-0 text-primary-color"><?php echo $count_subscribers; ?></h3>
                                <span class="text-warning small d-block mt-2"><i class="bi bi-mailbox me-1"></i>Weekly insights list</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric-card">
                                <span class="text-muted small d-block mb-1">Job Applications</span>
                                <h3 class="fw-bold mb-0 text-primary-color"><?php echo $count_apps; ?></h3>
                                <span class="text-danger small d-block mt-2"><i class="bi bi-briefcase me-1"></i>Under active review</span>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 bg-white p-4 rounded-4 shadow-sm">
                        <h4 class="fw-bold mb-3 text-primary-color"><i class="bi bi-activity text-secondary-color me-2"></i>Quick Activity Logs</h4>
                        <p class="text-muted small">System is live, secure, and running active. All databases conform to regulatory schemas.</p>
                    </div>
                </div>

                <!-- Tab 2: Inquiries -->
                <div class="tab-pane fade" id="inquiries" role="tabpanel">
                    <h3 class="fw-bold mb-1 text-primary-color">Customer Inquiries</h3>
                    <p class="text-muted small mb-4">View submitted messages directly from contact.php.</p>
                    
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Name & Organization</th>
                                    <th>Email & Phone</th>
                                    <th>Subject & Message</th>
                                    <th>Submitted At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($inquiries)): ?>
                                    <?php foreach ($inquiries as $inq): ?>
                                        <tr>
                                            <td>
                                                <strong class="text-dark d-block"><?php echo sanitize_html($inq['name']); ?></strong>
                                                <span class="text-muted small"><?php echo sanitize_html($inq['company'] ?? 'Independent'); ?></span>
                                            </td>
                                            <td>
                                                <span class="d-block"><?php echo sanitize_html($inq['email']); ?></span>
                                                <span class="text-muted small"><?php echo sanitize_html($inq['phone'] ?? 'N/A'); ?></span>
                                            </td>
                                            <td style="max-width: 300px;">
                                                <strong class="text-secondary d-block small mb-1"><?php echo sanitize_html($inq['subject']); ?></strong>
                                                <p class="text-muted small mb-0" style="font-size: 0.8rem; line-height: 1.4;"><?php echo nl2br(sanitize_html($inq['message'])); ?></p>
                                            </td>
                                            <td>
                                                <span class="small text-muted"><?php echo date('M d, Y H:i', strtotime($inq['created_at'])); ?></span>
                                            </td>
                                            <td>
                                                <a href="index.php?action=delete_inquiry&id=<?php echo $inq['id']; ?>" class="btn btn-outline-danger btn-action" onclick="return confirm('Delete inquiry record?');"><i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">No inquiries received yet.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab 3: Demos -->
                <div class="tab-pane fade" id="demos" role="tabpanel">
                    <h3 class="fw-bold mb-1 text-primary-color">Enterprise Demo Bookings</h3>
                    <p class="text-muted small mb-4">View scheduled demonstrations and monthly volume projections from request-demo.php.</p>
                    
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Client Details</th>
                                    <th>Organization Scale</th>
                                    <th>Custom Specifications</th>
                                    <th>Booked Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($demos)): ?>
                                    <?php foreach ($demos as $demo): ?>
                                        <tr>
                                            <td>
                                                <strong class="text-dark d-block"><?php echo sanitize_html($demo['name']); ?></strong>
                                                <span class="text-muted small"><?php echo sanitize_html($demo['job_title'] ?? 'Fintech Officer'); ?></span>
                                            </td>
                                            <td>
                                                <strong class="text-secondary d-block"><?php echo sanitize_html($demo['company']); ?></strong>
                                                <span class="badge bg-accent-color bg-opacity-10 text-accent-color small"><?php echo sanitize_html($demo['loan_volume']); ?> / mo</span>
                                            </td>
                                            <td style="max-width: 300px;">
                                                <p class="text-muted small mb-0" style="font-size: 0.8rem; line-height: 1.4;"><?php echo nl2br(sanitize_html($demo['message'] ?? 'None')); ?></p>
                                            </td>
                                            <td>
                                                <span class="small text-muted"><?php echo date('M d, Y H:i', strtotime($demo['created_at'])); ?></span>
                                            </td>
                                            <td>
                                                <a href="index.php?action=delete_demo&id=<?php echo $demo['id']; ?>" class="btn btn-outline-danger btn-action" onclick="return confirm('Delete demo request?');"><i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">No demo requests registered yet.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab 4: Subscribers -->
                <div class="tab-pane fade" id="subscribers" role="tabpanel">
                    <h3 class="fw-bold mb-1 text-primary-color">Newsletter Subscribers</h3>
                    <p class="text-muted small mb-4">Export or audit email details collected from footer subscription blocks.</p>
                    
                    <div class="table-responsive max-w-600">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Subscriber Email</th>
                                    <th>Joined At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($subscribers)): ?>
                                    <?php foreach ($subscribers as $sub): ?>
                                        <tr>
                                            <td>
                                                <strong class="text-dark"><?php echo sanitize_html($sub['email']); ?></strong>
                                            </td>
                                            <td>
                                                <span class="small text-muted"><?php echo date('M d, Y H:i', strtotime($sub['created_at'])); ?></span>
                                            </td>
                                            <td>
                                                <a href="index.php?action=delete_subscriber&id=<?php echo $sub['id']; ?>" class="btn btn-outline-danger btn-action" onclick="return confirm('Remove subscriber?');"><i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted">No subscribers registered yet.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab 5: Careers Manager -->
                <div class="tab-pane fade" id="careers" role="tabpanel">
                    <div class="row g-4 mb-5">
                        <!-- Left Screen: Job Applications -->
                        <div class="col-lg-7">
                            <h3 class="fw-bold mb-1 text-primary-color">Job Applications</h3>
                            <p class="text-muted small mb-4">Review submitted resumes and cover notes from applicant candidates.</p>
                            
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Applicant</th>
                                            <th>Target Position</th>
                                            <th>Cover Note</th>
                                            <th>Resume</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($applications)): ?>
                                            <?php foreach ($applications as $app): ?>
                                                <tr>
                                                    <td>
                                                        <strong class="text-dark d-block"><?php echo sanitize_html($app['name']); ?></strong>
                                                        <span class="text-muted small"><?php echo sanitize_html($app['email']); ?></span><br>
                                                        <span class="text-muted small"><?php echo sanitize_html($app['phone']); ?></span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-secondary small"><?php echo sanitize_html($app['job_title']); ?></span>
                                                    </td>
                                                    <td style="max-width: 200px;">
                                                        <p class="text-muted small mb-0" style="font-size: 0.75rem; line-height: 1.4;"><?php echo nl2br(sanitize_html($app['cover_letter'] ?? 'None')); ?></p>
                                                    </td>
                                                    <td>
                                                        <a href="../<?php echo sanitize_html($app['resume_path']); ?>" target="_blank" class="btn btn-sm btn-outline-primary py-1 px-2 text-decoration-none small"><i class="bi bi-file-earmark-pdf-fill me-1"></i>View Resume</a>
                                                    </td>
                                                    <td>
                                                        <a href="index.php?action=delete_application&id=<?php echo $app['id']; ?>" class="btn btn-outline-danger btn-action" onclick="return confirm('Delete applicant record?');"><i class="bi bi-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="text-center py-4 text-muted">No applications received yet.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Right Screen: Add Job Opening -->
                        <div class="col-lg-5">
                            <div class="card border-0 bg-light p-4 rounded-4 shadow-sm mb-4">
                                <h4 class="fw-bold mb-3"><i class="bi bi-plus-circle-fill text-secondary-color me-2"></i>Post Job Position</h4>
                                
                                <form method="POST">
                                    <?php csrf_input(); ?>
                                    <input type="hidden" name="form_type" value="add_job">
                                    
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-primary-color">Position Title</label>
                                        <input type="text" name="title" class="form-control bg-white" placeholder="e.g. Lead Credit Analyst" required>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-6">
                                            <label class="form-label small fw-bold text-primary-color">Department</label>
                                            <input type="text" name="department" class="form-control bg-white" placeholder="e.g. Engineering" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label small fw-bold text-primary-color">Location</label>
                                            <input type="text" name="location" class="form-control bg-white" placeholder="e.g. Mumbai (Hybrid)" required>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-6">
                                            <label class="form-label small fw-bold text-primary-color">Job Type</label>
                                            <input type="text" name="type" class="form-control bg-white" placeholder="e.g. Full-Time" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label small fw-bold text-primary-color">Experience Exp</label>
                                            <input type="text" name="experience" class="form-control bg-white" placeholder="e.g. 3-5 Years" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-primary-color">Job Description</label>
                                        <textarea name="description" class="form-control bg-white" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-primary-color">Key Requirements</label>
                                        <textarea name="requirements" class="form-control bg-white" rows="3" placeholder="Enter requirements on separate lines..."></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-primary-color">Benefits Perks</label>
                                        <textarea name="benefits" class="form-control bg-white" rows="3" placeholder="Enter benefits on separate lines..."></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-2 mt-2 rounded-3 shadow-sm">Publish Active Job</button>
                                </form>
                            </div>

                            <!-- List of current active jobs -->
                            <div class="card border-0 bg-light p-4 rounded-4 shadow-sm">
                                <h5 class="fw-bold mb-3">Current Active Openings</h5>
                                <?php if (!empty($jobs)): ?>
                                    <div class="d-flex flex-column gap-2">
                                        <?php foreach ($jobs as $j): ?>
                                            <div class="d-flex justify-content-between align-items-center bg-white p-2 rounded-3 border">
                                                <div>
                                                    <strong class="text-primary small d-block"><?php echo sanitize_html($j['title']); ?></strong>
                                                    <span class="text-muted small" style="font-size:0.7rem;"><?php echo sanitize_html($j['department']); ?> &bull; <?php echo sanitize_html($j['location']); ?></span>
                                                </div>
                                                <a href="index.php?action=delete_job&id=<?php echo $j['id']; ?>" class="btn btn-sm btn-outline-danger py-1" onclick="return confirm('Remove career opening?');"><i class="bi bi-trash"></i></a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-muted small">No active jobs posted.</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 6: Blog Publications Desk -->
                <div class="tab-pane fade" id="blog" role="tabpanel">
                    <div class="row g-4 mb-5">
                        <!-- Left Screen: Current Blog Posts -->
                        <div class="col-lg-7">
                            <h3 class="fw-bold mb-1 text-primary-color">Published Publications</h3>
                            <p class="text-muted small mb-4">View or delete published blog insights articles.</p>
                            
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Publication Details</th>
                                            <th>Category & Slug</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($posts)): ?>
                                            <?php foreach ($posts as $p): ?>
                                                <tr>
                                                    <td>
                                                        <strong class="text-dark d-block"><?php echo sanitize_html($p['title']); ?></strong>
                                                        <p class="text-muted small mb-0" style="font-size: 0.75rem; max-width: 250px; line-height: 1.3;"><?php echo sanitize_html($p['summary']); ?></p>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-accent-color bg-opacity-10 text-accent-color small d-block mb-1" style="width: max-content;"><?php echo sanitize_html($p['category']); ?></span>
                                                        <span class="text-muted small" style="font-size: 0.7rem;"><?php echo sanitize_html($p['slug']); ?></span>
                                                    </td>
                                                    <td>
                                                        <span class="small text-muted"><?php echo date('M d, Y', strtotime($p['created_at'])); ?></span>
                                                    </td>
                                                    <td>
                                                        <a href="index.php?action=delete_post&id=<?php echo $p['id']; ?>" class="btn btn-outline-danger btn-action" onclick="return confirm('Delete publication?');"><i class="bi bi-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center py-4 text-muted">No blog publications found.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Right Screen: Write Blog Post -->
                        <div class="col-lg-5">
                            <div class="card border-0 bg-light p-4 rounded-4 shadow-sm">
                                <h4 class="fw-bold mb-3"><i class="bi bi-plus-circle-fill text-accent-color me-2"></i>Write Insight Publication</h4>
                                
                                <form method="POST">
                                    <?php csrf_input(); ?>
                                    <input type="hidden" name="form_type" value="add_blog">
                                    
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-primary-color">Article Title</label>
                                        <input type="text" name="title" class="form-control bg-white" placeholder="e.g. Navigating Fair Recovery Guidelines" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-primary-color">Category</label>
                                        <input type="text" name="category" class="form-control bg-white" placeholder="e.g. Compliance" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-primary-color">Summary (1-2 sentences)</label>
                                        <textarea name="summary" class="form-control bg-white" rows="2" placeholder="Brief outline showing in publication grid..." required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-primary-color">Article Content</label>
                                        <textarea name="content" class="form-control bg-white" rows="8" placeholder="Complete article content. Separate paragraphs using double line breaks..." required></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-accent text-white w-100 py-2 mt-2 rounded-3 shadow-sm">Publish Insight Article</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper JS via CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
