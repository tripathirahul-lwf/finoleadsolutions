<?php
/**
 * Finolead Solutions - Security & Helper Functions
 * Includes Session management, CSRF prevention, Input Sanitization, and File Validation.
 */

// Calculate the web root path dynamically (absolute path from the domain root)
$project_root_phys = str_replace('\\', '/', realpath(__DIR__ . '/../'));
$doc_root_phys = str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'] ?? ''));

$web_root = '/';
if (!empty($doc_root_phys) && strpos($project_root_phys, $doc_root_phys) === 0) {
    $web_root = substr($project_root_phys, strlen($doc_root_phys));
    $web_root = '/' . ltrim($web_root, '/') . '/';
}
$web_root = preg_replace('#/+#', '/', $web_root);
define('WEB_ROOT', $web_root);

// Start secure session if not already started
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    
    // Check if HTTPS is used to set secure cookies
    $secure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
    
    session_start([
        'cookie_lifetime' => 86400,
        'cookie_secure' => $secure,
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
    ]);
}

/**
 * Generate and retrieve CSRF Token
 */
function get_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validate CSRF Token
 */
function validate_csrf_token($token) {
    if (!isset($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Output hidden CSRF Input Field
 */
function csrf_input() {
    echo '<input type="hidden" name="csrf_token" value="' . sanitize_html(get_csrf_token()) . '">';
}

/**
 * Sanitize Output for HTML contexts (Prevents XSS)
 */
function sanitize_html($data) {
    return htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Sanitize User Input (Trim and clean raw input)
 */
function sanitize_input($data) {
    if (is_array($data)) {
        return array_map('sanitize_input', $data);
    }
    return trim($data ?? '');
}

/**
 * Safe redirect helper
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Validate Resume Uploads for Job Applications
 */
function validate_resume_upload($file, $upload_dir) {
    $allowed_extensions = ['pdf', 'doc', 'docx'];
    $max_size = 5 * 1024 * 1024; // 5 MB

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'Upload failed with error code ' . $file['error']];
    }

    if ($file['size'] > $max_size) {
        return ['success' => false, 'message' => 'File size exceeds maximum limit of 5MB.'];
    }

    $filename = basename($file['name']);
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed_extensions)) {
        return ['success' => false, 'message' => 'Invalid file format. Only PDF, DOC, and DOCX files are allowed.'];
    }

    // Double check MIME type for safety
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    $allowed_mimes = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];

    if (!in_array($mime, $allowed_mimes)) {
        return ['success' => false, 'message' => 'Invalid file content. The file MIME type does not match.'];
    }

    // Create safe unique filename
    $unique_filename = bin2hex(random_bytes(16)) . '.' . $ext;
    
    // Ensure upload directory exists
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $destination = rtrim($upload_dir, '/') . '/' . $unique_filename;

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return [
            'success' => true, 
            'filename' => $unique_filename, 
            'filepath' => 'uploads/' . $unique_filename
        ];
    }

    return ['success' => false, 'message' => 'Failed to save the uploaded file.'];
}

/**
 * Render Flash Alert Banner
 */
function render_alert() {
    if (isset($_SESSION['flash_message'])) {
        $msg = $_SESSION['flash_message']['text'];
        $type = $_SESSION['flash_message']['type']; // success, danger, warning, info
        unset($_SESSION['flash_message']);
        
        return "
        <div class='alert alert-{$type} alert-dismissible fade show shadow-sm' role='alert'>
            <div class='d-flex align-items-center'>
                <span class='me-2'><i class='bi " . ($type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill') . "'></i></span>
                <div>{$msg}</div>
            </div>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
    return '';
}

/**
 * Set flash message helper
 */
function set_flash_message($text, $type = 'success') {
    $_SESSION['flash_message'] = [
        'text' => $text,
        'type' => $type
    ];
}

/**
 * Get dynamic absolute production URL for canonicals
 */
function get_absolute_url($path = '') {
    $domain = 'https://finoleadsolutions.com/';
    return $domain . ltrim($path, '/');
}
?>
