<?php
/**
 * Finolead Solutions - Blog Details Reader (Pulls from DB)
 */
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

$slug = sanitize_input($_GET['slug'] ?? '');
$post = null;

if ($pdo && !empty($slug)) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM `blog_posts` WHERE `slug` = :slug AND `status` = 'Published' LIMIT 1");
        $stmt->execute([':slug' => $slug]);
        $post = $stmt->fetch();
        
        // Fetch recent posts for sidebar
        if ($post) {
            $stmt_recent = $pdo->prepare("SELECT * FROM `blog_posts` WHERE `id` != :id AND `status` = 'Published' ORDER BY `created_at` DESC LIMIT 3");
            $stmt_recent->execute([':id' => $post['id']]);
            $recent_posts = $stmt_recent->fetchAll();
        }
    } catch (PDOException $e) {
        $post = null;
    }
}

if (!$post) {
    // If post not found, redirect to clean blog list
    redirect(WEB_ROOT . 'blog');
}

$page_title = $post['title'];
$page_desc = $post['summary'];
require_once __DIR__ . '/../includes/header.php';
?>

<!-- Page Header (Short variant for reading focus) -->
<header class="page-header" style="padding: 140px 0 50px;">
    <div class="page-header-glow"></div>
    <div class="container position-relative" style="z-index: 5;">
        <div class="row">
            <div class="col-lg-9">
                <a href="<?php echo WEB_ROOT; ?>blog" class="text-accent-color text-decoration-none fw-bold small mb-3 d-inline-block"><i class="bi bi-arrow-left me-1"></i> Back to Insights Index</a>
                <div class="badge bg-secondary bg-opacity-10 text-secondary-color px-3 py-1 rounded-pill fw-bold mb-3 d-block d-sm-inline-block" style="width: max-content;">
                    <?php echo sanitize_html($post['category']); ?>
                </div>
                <h1 class="display-6 fw-bold mb-3 text-white"><?php echo sanitize_html($post['title']); ?></h1>
                <p class="text-muted small mb-0">Published: <?php echo date('F d, Y', strtotime($post['created_at'])); ?> &bull; Written by: <?php echo sanitize_html($post['author']); ?></p>
            </div>
        </div>
    </div>
</header>

<!-- Main Reading Layout -->
<section class="py-5 bg-white">
    <div class="container py-3">
        <div class="row g-5">
            <!-- Left Side: Article Content -->
            <div class="col-lg-8">
                <!-- Cover Image Mock -->
                <img src="https://images.unsplash.com/photo-1450133064473-71024230f91b?auto=format&fit=crop&w=800&q=80" alt="<?php echo sanitize_html($post['title']); ?>" class="img-fluid rounded-4 mb-4 shadow-sm" style="width: 100%; height: 350px; object-fit: cover;">
                
                <!-- Article Text -->
                <article class="pe-lg-4 fs-6 text-dark" style="line-height: 1.8;">
                    <?php 
                    // Format content paragraphs nicely
                    $paragraphs = explode("\n\n", $post['content']);
                    foreach ($paragraphs as $para) {
                        echo '<p class="mb-4">' . nl2br(sanitize_html($para)) . '</p>';
                    }
                    ?>
                </article>
                
                <!-- Share panel -->
                <div class="border-top border-bottom border-light-subtle py-3 my-5 d-flex align-items-center justify-content-between">
                    <span class="small text-muted fw-bold">Did you find this insightful? Share:</span>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-light border-secondary border-opacity-20 p-2 rounded-circle text-primary-color" style="width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="btn btn-outline-light border-secondary border-opacity-20 p-2 rounded-circle text-primary-color" style="width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="btn btn-outline-light border-secondary border-opacity-20 p-2 rounded-circle text-primary-color" style="width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;"><i class="bi bi-link-45deg"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Right Side: Sidebar Recent Posts -->
            <div class="col-lg-4">
                <div class="card border-0 bg-light p-4 rounded-4 mb-4">
                    <h5 class="fw-bold mb-3 text-primary-color"><i class="bi bi-journal-text me-2 text-secondary-color"></i>Recent Publications</h5>
                    <?php if (!empty($recent_posts)): ?>
                        <div class="d-flex flex-column gap-3">
                            <?php foreach ($recent_posts as $recent): ?>
                                <div class="pb-3 border-bottom border-secondary border-opacity-10 last-border-none" style="border-bottom: 1px solid rgba(0,0,0,0.05);">
                                    <span class="text-accent-color small fw-bold d-block mb-1"><?php echo sanitize_html($recent['category']); ?></span>
                                    <h6 class="fw-bold mb-1"><a href="<?php echo WEB_ROOT; ?>blog/<?php echo sanitize_html($recent['slug']); ?>" class="text-primary-color text-decoration-none hover-secondary small"><?php echo sanitize_html($recent['title']); ?></a></h6>
                                    <span class="text-muted small" style="font-size: 0.75rem;"><?php echo date('M d, Y', strtotime($recent['created_at'])); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <span class="text-muted small">No other publications found.</span>
                    <?php endif; ?>
                </div>

                <div class="card border-0 bg-primary-color text-white p-4 rounded-4 text-center">
                    <h5 class="fw-bold text-white mb-2">Need Custom Credit Platform Tech?</h5>
                    <p class="text-white-50 small mb-4">Integrate with CIBIL APIs, automate underwriting scoring rules, and deploy soft automated collections.</p>
                    <a href="<?php echo WEB_ROOT; ?>request-demo" class="btn btn-accent text-white w-100">Schedule Demo Session</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
