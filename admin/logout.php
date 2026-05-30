<?php
/**
 * Finolead Solutions - Admin Secure Logout Action
 */
require_once __DIR__ . '/../includes/functions.php';

// Unset all admin sessions
if (isset($_SESSION['admin_logged_in'])) {
    unset($_SESSION['admin_logged_in']);
    unset($_SESSION['admin_id']);
    unset($_SESSION['admin_user']);
}

// Destroy completely
session_destroy();

// Redirect back to login
redirect('login.php');
?>
