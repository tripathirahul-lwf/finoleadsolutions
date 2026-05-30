<?php
/**
 * Finolead Solutions - Database Connection Configuration
 * Uses PDO for secure, prepared SQL execution.
 */

$db_host = 'localhost';
$db_name = 'finolead_db';
$db_user = 'root';
$db_pass = '';

try {
    // Create PDO connection with options for security and error handling
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    // If the database doesn't exist, we might be running setup. 
    // We'll let setup-db.php handle its own connection if this fails.
    $pdo = null;
}
?>
