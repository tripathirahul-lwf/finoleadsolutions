<?php
/**
 * Finolead Solutions - Secure Admin Login Gateway
 */
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

// If already logged in, redirect to dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    redirect('index.php');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST['csrf_token'] ?? '';
    
    // 1. CSRF Protection
    if (!validate_csrf_token($csrf_token)) {
        $errors[] = 'Security token mismatch. Please reload.';
    } else {
        $username = sanitize_input($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $errors[] = 'Please fill in both fields.';
        }

        if (empty($errors)) {
            if ($pdo) {
                try {
                    $stmt = $pdo->prepare("SELECT * FROM `admin_users` WHERE `username` = :user LIMIT 1");
                    $stmt->execute([':user' => $username]);
                    $admin = $stmt->fetch();

                    if ($admin && password_verify($password, $admin['password'])) {
                        // Establish secure admin session
                        $_SESSION['admin_logged_in'] = true;
                        $_SESSION['admin_id'] = $admin['id'];
                        $_SESSION['admin_user'] = $admin['username'];
                        
                        set_flash_message("Welcome back, Administrator!", "success");
                        redirect('index.php');
                    } else {
                        $errors[] = 'Invalid username or password credentials.';
                    }
                } catch (PDOException $e) {
                    $errors[] = 'Authentication failed: ' . $e->getMessage();
                }
            } else {
                $errors[] = 'Database connection failed. Please run setup-db.php first.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finolead Solutions - Admin Login Gateway</title>
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
        .login-card {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5), 0 0 100px rgba(37, 99, 235, 0.15);
            max-width: 450px;
            width: 100%;
            overflow: hidden;
        }
        .login-header {
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
        .login-body {
            padding: 2.5rem 2rem;
        }
        .form-control {
            background-color: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #f8fafc;
            padding: 12px 16px;
            border-radius: 12px;
        }
        .form-control:focus {
            background-color: rgba(15, 23, 42, 0.8);
            border-color: #3b82f6;
            color: #f8fafc;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.25);
        }
        .btn-fintech {
            background: linear-gradient(135deg, #2563eb, #14b8a6);
            border: none;
            color: #ffffff;
            font-weight: 600;
            padding: 12px;
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

<div class="login-card">
    <div class="login-header">
        <div class="logo-text mb-2"><i class="bi bi-wallet2 me-2"></i>FINOLEAD</div>
        <h4 class="mb-0 fw-bold">Admin Console Gateway</h4>
        <p class="text-muted small mb-0 mt-1">Please enter your authorized console credentials</p>
    </div>
    
    <div class="login-body">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger bg-opacity-10 border-danger-subtle text-danger py-2 px-3 rounded-3 mb-3 small">
                <ul class="mb-0 ps-3">
                    <?php foreach ($errors as $err): ?>
                        <li><?php echo sanitize_html($err); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" class="needs-validation" novalidate>
            <?php csrf_input(); ?>
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-muted">Admin Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 border-opacity-10" style="border: 1px solid rgba(255,255,255,0.1); border-right: none; color: #64748b;"><i class="bi bi-person-fill"></i></span>
                    <input type="text" name="username" class="form-control border-start-0" style="border-top-left-radius: 0; border-bottom-left-radius: 0;" placeholder="e.g. admin" required>
                </div>
            </div>
            
            <div class="mb-4">
                <label class="form-label small fw-bold text-muted">Password Key</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 border-opacity-10" style="border: 1px solid rgba(255,255,255,0.1); border-right: none; color: #64748b;"><i class="bi bi-key-fill"></i></span>
                    <input type="password" name="password" class="form-control border-start-0" style="border-top-left-radius: 0; border-bottom-left-radius: 0;" placeholder="Enter password" required>
                </div>
            </div>

            <button type="submit" class="btn btn-fintech w-100 py-3 rounded-3 shadow-sm">Authorize & Log In</button>
        </form>
    </div>
</div>

</body>
</html>
