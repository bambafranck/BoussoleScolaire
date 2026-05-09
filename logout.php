<?php
/**
 * BoussoleScolaire - Page de Déconnexion
 * Fichier: php/logout.php
 */
session_start();

$_SESSION = array();

if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

session_destroy();

$base_path = '/BoursoleScolaire';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion - BoussoleScolaire</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo $base_path; ?>/css/styles.css">
    <link rel="stylesheet" href="<?php echo $base_path; ?>/css/logout.css">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <!-- Redirection automatique après 3 secondes -->
    <meta http-equiv="refresh" content="3;url=<?php echo $base_path; ?>/index.php">

    <style>
        /* Ajustements icônes dans les boutons */
        .btn-logout-primary,
        .btn-logout-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-logout-primary .lucide,
        .btn-logout-secondary .lucide {
            width: 17px;
            height: 17px;
            flex-shrink: 0;
        }
        /* Icône de succès centrale */
        .logout-icon .lucide {
            width: 56px;
            height: 56px;
        }
        /* Logo */
        .logout-logo-icon .lucide {
            width: 28px;
            height: 28px;
            stroke: #fff;
        }
    </style>
</head>
<body>

<div class="logout-container">

    <!-- Logo -->
    <div class="logout-logo">
        <div class="logout-logo-icon">
            <i data-lucide="compass"></i>
        </div>
        <div class="logout-logo-text">Boussole<span>Scolaire</span></div>
    </div>

    <!-- Icône de succès -->
    <div class="logout-icon">
        <i data-lucide="check-circle" style="color:#00c878;"></i>
    </div>

    <!-- Titre -->
    <h1 class="logout-title">
        Déconnexion <span>réussie !</span>
    </h1>

    <!-- Message -->
    <p class="logout-message">
        Vous avez été déconnecté avec succès. Merci d'avoir utilisé BoussoleScolaire.<br>
        À bientôt pour de nouvelles orientations !
    </p>

    <!-- Boutons -->
    <div class="logout-buttons">
        <a href="<?php echo $base_path; ?>/index.php" class="btn-logout-primary">
            <i data-lucide="home"></i> Retour à l'accueil
        </a>
        <a href="<?php echo $base_path; ?>/login.php" class="btn-logout-secondary">
            <i data-lucide="log-in"></i> Se reconnecter
        </a>
    </div>

    <!-- Compteur de redirection -->
    <div class="countdown">
        Redirection automatique dans <strong id="counter">3</strong> secondes...
        <div class="loading-bar">
            <div class="loading-fill"></div>
        </div>
    </div>

</div>

<script>
    lucide.createIcons();

    let seconds = 3;
    const counterElement = document.getElementById('counter');
    const countdown = setInterval(() => {
        seconds--;
        if (seconds > 0) {
            counterElement.textContent = seconds;
        } else {
            clearInterval(countdown);
            counterElement.textContent = '0';
        }
    }, 1000);
</script>
</body>
</html>