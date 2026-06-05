<?php
/**
 * BoussoleScolaire - Configuration Base de Données HÉBERGEMENT
 * Fichier: config/database.HEBERGEMENT.php
 *
 * INSTRUCTIONS POUR L'HÉBERGEMENT:
 * ================================
 * 1. Renommez ce fichier en "database.php" (supprimez ".HEBERGEMENT")
 * 2. Modifiez les valeurs ci-dessous avec les informations de votre hébergeur
 * 3. Ces informations vous sont fournies par votre hébergeur (cPanel, Plesk, etc.)
 */

// ============================================
// CONFIGURATION BASE DE DONNÉES - À MODIFIER
// ============================================

// Exemples de valeurs courantes pour différents hébergeurs:
//
// HOSTINGER:
// - DB_HOST: 'localhost' ou 'mysql.hostinger.com'
// - DB_NAME: 'u123456789_boussolescolaire'
// - DB_USER: 'u123456789_admin'
// - DB_PASS: 'votre_mot_de_passe_securise'
//
// O2SWITCH:
// - DB_HOST: 'localhost'
// - DB_NAME: 'votre_compte_boussolescolaire'
// - DB_USER: 'votre_compte_admin'
// - DB_PASS: 'votre_mot_de_passe'
//
// OVH:
// - DB_HOST: 'mysql51-XX.pro' ou 'mysql51-XX.perso'
// - DB_NAME: 'votre_base'
// - DB_USER: 'votre_utilisateur'
// - DB_PASS: 'votre_mot_de_passe'

define('DB_HOST', 'localhost');              // Adresse du serveur MySQL
define('DB_NAME', 'boussolescolaire');        // Nom de votre base de données
define('DB_USER', 'root');                    // Nom d'utilisateur MySQL
define('DB_PASS', '');                        // Mot de passe MySQL

// ============================================
// CONNEXION PDO
// ============================================

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
    // En production, ne pas afficher les détails de l'erreur
    error_log("Erreur de connexion à la base de données : " . $e->getMessage());
    die("Erreur de connexion à la base de données. Veuillez contacter l'administrateur.");
}

// ============================================
// FONCTIONS UTILITAIRES
// ============================================

/**
 * Vérifier si l'utilisateur est connecté
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Vérifier si l'utilisateur est admin
 */
function isAdmin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
}

/**
 * Rediriger vers une page
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Sécuriser une chaîne de caractères
 */
function securiser($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Formater un nombre en FCFA
 */
function formatMoney($montant) {
    return number_format($montant, 0, ',', ' ') . ' FCFA';
}

/**
 * Obtenir le temps écoulé depuis une date
 */
function timeAgo($datetime) {
    $time = strtotime($datetime);
    $diff = time() - $time;

    if ($diff < 60) {
        return 'Il y a ' . $diff . ' sec';
    } elseif ($diff < 3600) {
        return 'Il y a ' . floor($diff / 60) . ' min';
    } elseif ($diff < 86400) {
        return 'Il y a ' . floor($diff / 3600) . ' h';
    } elseif ($diff < 604800) {
        return 'Il y a ' . floor($diff / 86400) . ' j';
    } else {
        return date('d/m/Y', $time);
    }
}

/**
 * Générer un message flash
 */
function setFlash($type, $message) {
    $_SESSION['flash_type'] = $type; // success, error, warning, info
    $_SESSION['flash_message'] = $message;
}

/**
 * Afficher et supprimer le message flash
 */
function getFlash() {
    if (isset($_SESSION['flash_message'])) {
        $type = $_SESSION['flash_type'] ?? 'info';
        $message = $_SESSION['flash_message'];

        unset($_SESSION['flash_type']);
        unset($_SESSION['flash_message']);

        return ['type' => $type, 'message' => $message];
    }
    return null;
}

/**
 * Vérifier les permissions admin
 */
function requireAdmin() {
    if (!isLoggedIn() || !isAdmin()) {
        $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        header('Location: ' . $base . '/login.php');
        exit();
    }
}

/**
 * Vérifier que l'utilisateur est connecté
 */
function requireLogin() {
    if (!isLoggedIn()) {
        $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        header('Location: ' . $base . '/login.php');
        exit();
    }
}
