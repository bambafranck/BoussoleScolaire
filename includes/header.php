<?php
/**
 * Header propre et fonctionnel
 */

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$is_logged_in = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
$is_admin     = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';

$user_prenom = $_SESSION['user_prenom'] ?? '';
$user_nom    = $_SESSION['user_nom']    ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title . ' - ' : '' ?>BoussoleScolaire</title>
    <meta name="description" content="Plateforme d'orientation scolaire intelligente">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= $base_path ?>/css/styles.css">
    <?php if (isset($page_css)): ?>
        <link rel="stylesheet" href="<?= $base_path ?>/css/<?= $page_css ?>.css">
    <?php endif; ?>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <style>
        .logo-icon .lucide   { width:24px; height:24px; stroke:#fff; stroke-width:2; }
        .btn-logout .lucide  { width:15px; height:15px; vertical-align:middle; margin-right:4px; }
    </style>
</head>
<body>

<nav>
    <a href="<?= $base_path ?>/index.php" class="logo">
        <div class="logo-icon">
            <i data-lucide="compass"></i>
        </div>
        <div class="logo-text">Boussole<span>Scolaire</span></div>
    </a>

    <?php if (!$is_logged_in): ?>
        <ul class="nav-links">
            <li><a href="<?= $base_path ?>/index.php">Accueil</a></li>
            <li><a href="<?= $base_path ?>/test.php">Test Orientation</a></li>
            <li><a href="<?= $base_path ?>/filieres.php">Filières</a></li>
            <li><a href="<?= $base_path ?>/formations.php">Formations</a></li>
            <li><a href="<?= $base_path ?>/apropos.php">À Propos</a></li>
        </ul>

        <div class="nav-btns">
            <a href="<?= $base_path ?>/login.php" class="btn-login">Connexion</a>
            <a href="<?= $base_path ?>/login.php?action=inscription" class="btn-signup">Inscription</a>
        </div>

    <?php else: ?>
        <ul class="nav-links">
            <li><a href="<?= $base_path ?>/index.php">Accueil</a></li>
            <li><a href="<?= $base_path ?>/test.php">Test</a></li>
            <li><a href="<?= $base_path ?>/resultats.php">Résultats</a></li>

            <?php if ($is_admin): ?>
                <li><a href="<?= $base_path ?>/admin.php">Admin</a></li>
            <?php endif; ?>
        </ul>

        <div class="nav-right">
            <div class="nav-user">
                Bonjour, <strong><?= htmlspecialchars($user_prenom, ENT_QUOTES, 'UTF-8'); ?></strong>
            </div>
            <a href="<?= $base_path ?>/logout.php" class="btn-logout">
                <i data-lucide="log-out"></i> Déconnexion
            </a>
        </div>
    <?php endif; ?>
</nav>

<script>lucide.createIcons();</script>