<?php
/**
 * Finolead Solutions - Blog Insights Landing Page (Pulls from DB)
 */
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

$page_title = "Fintech Insights, Digital Lending & Compliance Publications";
$page_desc = "Read the latest publications, research notes, and market updates from Finolead Editorial on SaaS collections, credit risk underwriting, and SOC2 benchmarks.";

// Establish database variables
$posts = [];
$search = sanitize_input($_GET['search'] ?? '');
$category = sanitize_input($_GET['category'] ?? '');

if ($pdo) {
    try {
        $query = "SELECT * FROM `blog_posts` WHERE `status` = 'Published'";
        $params = [];

        if (!empty($search)) {
            $query .= " AND (`title` LIKE :search OR `summary` LIKE :search OR `content` LIKE :search)";
            $params[':search'] = '%' . $search . '%';
        }

        if (!empty($category)) {
            $query .= " AND `category` = :cat";
            $params[':cat'] = $category;
        }

        $query .= " ORDER BY `created_at` DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $posts = $stmt->fetchAll();

        // Get active categories list for filters
        $categories = $pdo->query("SELECT DISTINCT `category` FROM `blog_posts` WHERE `status` = 'Published'")->fetchAll(PDO::FETCH_COLUMN);

    } catch (PDOException $e) {
        $posts = [];
        $categories = [];
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
                    Fintech Insights
                </div>
                <h1 class="display-5 fw-bold mb-3">Finolead Editorial Desk</h1>
                <p class="fs-5 text-muted mb-0">
                    Deep dives, industry guidelines, and technical strategies covering modern digital collections, alternative scoring models, and banking systems.
                </p>
            </div>
        </div>
    </div>
</header>

<!-- Blog Section -->
<section class="py-5 bg-white">
    <div class="container py-4">
        
        <!-- Search & Filter Controls -->
        <div class="row g-3 mb-5 align-items-center">
            <!-- Search bar -->
            <div class="col-lg-4">
                <form method="GET" class="d-flex position-relative">
                    <input type="text" name="search" class="form-control rounded-pill pe-5" placeholder="Search publications..." value="<?php echo sanitize_html($search); ?>">
                    <?php if (!empty($category)): ?>
                        <input type="hidden" name="category" value="<?php echo sanitize_html($category); ?>">
                    <?php endif; ?>
                    <button type="submit" class="btn btn-link position-absolute end-0 top-0 h-100 px-3 text-secondary-color" style="border:none;"><i class="bi bi-search"></i></button>
                </form>
            </div>
            
            <!-- Category Tabs -->
            <div class="col-lg-8 text-lg-end">
                <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
                    <a href="<?php echo WEB_ROOT; ?>blog" class="btn btn-sm <?php echo empty($category) ? 'btn-primary' : 'btn-outline-light text-muted border-secondary border-opacity-10'; ?> rounded-pill px-3">All Articles</a>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                            <a href="<?php echo WEB_ROOT; ?>blog?category=<?php echo urlencode($cat); ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>" class="btn btn-sm <?php echo $category === $cat ? 'btn-primary' : 'btn-outline-light text-muted border-secondary border-opacity-10'; ?> rounded-pill px-3"><?php echo sanitize_html($cat); ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Publications Grid -->
        <div class="row g-4">
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-card position-relative d-flex flex-column h-100">
                            <!-- Image visual -->
                            <div class="position-relative">
                                <span class="blog-badge"><?php echo sanitize_html($post['category']); ?></span>
                                <img src="https://images.unsplash.com/photo-1450133064473-71024230f91b?auto=format&fit=crop&w=400&q=80" alt="Blog Image Mock" class="img-fluid w-100" style="height: 200px; object-fit: cover;">
                            </div>
                            <!-- Contents -->
                            <div class="p-4 d-flex flex-column justify-content-between flex-grow-1">
                                <div>
                                    <span class="text-muted small d-block mb-2"><?php echo date('M d, Y', strtotime($post['created_at'])); ?> &bull; by <?php echo sanitize_html($post['author']); ?></span>
                                    <h4 class="fw-bold fs-5 mb-2"><a href="<?php echo WEB_ROOT; ?>blog/<?php echo sanitize_html($post['slug']); ?>" class="text-primary-color text-decoration-none hover-secondary"><?php echo sanitize_html($post['title']); ?></a></h4>
                                    <p class="text-muted small mb-4">
                                        <?php echo sanitize_html($post['summary']); ?>
                                    </p>
                                </div>
                                <a href="<?php echo WEB_ROOT; ?>blog/<?php echo sanitize_html($post['slug']); ?>" class="text-secondary-color fw-bold text-decoration-none small mt-auto">Read Publication <i class="bi bi-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <span class="fs-1 text-muted d-block mb-3"><i class="bi bi-journal-x"></i></span>
                    <h5 class="fw-bold text-muted">No Publications Found</h5>
                    <p class="text-muted small">We couldn't find any articles matching your filters. <a href="<?php echo WEB_ROOT; ?>blog" class="text-secondary-color fw-bold">Reset Filters</a></p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
