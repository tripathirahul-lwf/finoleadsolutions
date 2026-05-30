<?php
/**
 * Finolead Solutions - Newsletter Submission Endpoint (AJAX)
 */

header('Content-Type: application/json');

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit();
}

// Sanitize inputs
$csrf_token = $_POST['csrf_token'] ?? '';
$email = sanitize_input($_POST['email'] ?? '');

// 1. CSRF Protection
if (!validate_csrf_token($csrf_token)) {
    echo json_encode(['success' => false, 'message' => 'Security token mismatch. Refreshed page.']);
    exit();
}

// 2. Validate email
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid business email address.']);
    exit();
}

// 3. Database Check & Insertion
if (!$pdo) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed. Please run setup-db.php first.']);
    exit();
}

try {
    // Check if email already exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM `newsletter_subscribers` WHERE `email` = :email");
    $stmt->execute([':email' => $email]);
    if ($stmt->fetchColumn() > 0) {
        echo json_encode(['success' => true, 'message' => 'You are already subscribed to our insights!']);
        exit();
    }

    // Insert new subscriber
    $stmt = $pdo->prepare("INSERT INTO `newsletter_subscribers` (`email`) VALUES (:email)");
    $stmt->execute([':email' => $email]);
    
    echo json_encode(['success' => true, 'message' => 'Successfully subscribed to weekly insights!']);
    exit();

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'An error occurred during subscription: ' . $e->getMessage()]);
    exit();
}
?>
