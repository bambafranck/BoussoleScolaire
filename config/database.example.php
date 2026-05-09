<?php
/**
 * BoussoleScolaire - Configuration Base de Données (EXEMPLE)
 * Copiez ce fichier en database.php et adaptez les valeurs
 * cp config/database.example.php config/database.php
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'boussolescolaire');
define('DB_USER', 'root');
define('DB_PASS', ''); // Votre mot de passe MySQL

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

function isLoggedIn() { return isset($_SESSION['user_id']); }
function isAdmin() { return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true; }
function redirect($url) { header("Location: $url"); exit(); }
function securiser($data) {
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
function formatMoney($montant) { return number_format($montant, 0, ',', ' ') . ' FCFA'; }
function requireAdmin() {
    if (!isLoggedIn() || !isAdmin()) { header('Location: /BoursoleScolaire/login.php'); exit(); }
}
function requireLogin() {
    if (!isLoggedIn()) { header('Location: /BoursoleScolaire/login.php'); exit(); }
}
