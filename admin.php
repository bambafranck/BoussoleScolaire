<?php
/**
 * BoussoleScolaire - Dashboard Admin
 * Fichier: admin.php
 */

session_start();
require_once 'config/database.php';

// Vérifier si l'utilisateur est admin
if (!isLoggedIn() || !isAdmin()) {
    redirect('index.php');
}

// Récupérer les statistiques
$stats = [];

$stmt = $pdo->query("SELECT COUNT(*) as total FROM utilisateur WHERE role = 'user'");
$stats['utilisateurs'] = $stmt->fetch()['total'];

$stmt = $pdo->query("SELECT COUNT(*) as total FROM test_orientation WHERE statut = 'termine'");
$stats['tests'] = $stmt->fetch()['total'];

$stmt = $pdo->query("SELECT COUNT(*) as total FROM filiere WHERE actif = 1");
$stats['filieres'] = $stmt->fetch()['total'];

$stmt = $pdo->query("SELECT COUNT(*) as total FROM etablissement WHERE actif = 1");
$stats['etablissements'] = $stmt->fetch()['total'];

$stmt = $pdo->query("
    SELECT id_utilisateur, nom, prenom, email, type_utilisateur, date_inscription
    FROM utilisateur
    WHERE role = 'user'
    ORDER BY date_inscription DESC
    LIMIT 5
");
$derniers_utilisateurs = $stmt->fetchAll();

$activites = [];

$stmt = $pdo->query("
    SELECT t.id_test, u.prenom, u.nom, t.date_fin
    FROM test_orientation t
    JOIN utilisateur u ON t.id_utilisateur = u.id_utilisateur
    WHERE t.statut = 'termine'
    ORDER BY t.date_fin DESC
    LIMIT 10
");
$tests_recents = $stmt->fetchAll();

foreach ($tests_recents as $test) {
    $activites[] = [
        'type' => 'test',
        'titre' => 'Test complété',
        'description' => $test['prenom'] . ' ' . $test['nom'] . ' a terminé son test',
        'date' => $test['date_fin']
    ];
}

$stmt = $pdo->query("
    SELECT id_utilisateur, prenom, nom, date_inscription
    FROM utilisateur
    WHERE role = 'user'
    ORDER BY date_inscription DESC
    LIMIT 5
");
$nouveaux_users = $stmt->fetchAll();

foreach ($nouveaux_users as $user) {
    $activites[] = [
        'type' => 'user',
        'titre' => 'Nouvel utilisateur',
        'description' => $user['prenom'] . ' ' . $user['nom'] . ' s\'est inscrit',
        'date' => $user['date_inscription']
    ];
}

usort($activites, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

$activites = array_slice($activites, 0, 4);

function temps_ecoule($datetime) {
    $time = strtotime($datetime);
    $diff = time() - $time;
    
    if ($diff < 60) return 'Il y a ' . $diff . ' sec';
    if ($diff < 3600) return 'Il y a ' . floor($diff / 60) . ' min';
    if ($diff < 86400) return 'Il y a ' . floor($diff / 3600) . ' h';
    if ($diff < 604800) return 'Il y a ' . floor($diff / 86400) . ' j';
    return date('d/m/Y', $time);
}

$page_title = "Dashboard Admin";
$page_css = "admin";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - BoussoleScolaire</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/<?php echo $page_css; ?>.css">

    <style>
        /* Taille uniforme pour toutes les icônes Lucide */
        .lucide {
            width: 18px;
            height: 18px;
            stroke-width: 2;
            vertical-align: middle;
            flex-shrink: 0;
        }
        .stat-icon .lucide  { width: 22px; height: 22px; }
        .menu-icon .lucide  { width: 18px; height: 18px; }
        .sidebar-logo-icon .lucide { width: 28px; height: 28px; stroke: #fff; }
        .recent-icon .lucide { width: 16px; height: 16px; }
        .topbar-search span .lucide { width: 16px; height: 16px; color: #9ca3af; }
        .page-indicator .dot { display: none; } /* le point reste ou supprimez-le */
    </style>
</head>
<body>

<div class="page-indicator">
    <i data-lucide="radio" style="width:14px;height:14px;vertical-align:middle;margin-right:6px;"></i>
    Page : Tableau de Bord Admin (admin.php)
</div>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="sidebar-logo-icon"><i data-lucide="compass"></i></div>
        <div class="sidebar-logo-text">Boussole<span>Scolaire</span></div>
    </div>

    <div class="sidebar-menu">
        <div class="menu-label">Principal</div>
        <a href="admin.php" class="menu-item active">
            <span class="menu-icon"><i data-lucide="layout-dashboard"></i></span> Tableau de Bord
        </a>
        <a href="admin_utilisateurs.php" class="menu-item">
            <span class="menu-icon"><i data-lucide="users"></i></span> Utilisateurs
            <span class="menu-badge"><?php echo $stats['utilisateurs']; ?></span>
        </a>
        <a href="admin_filieres.php" class="menu-item">
            <span class="menu-icon"><i data-lucide="book-open"></i></span> Filières
        </a>
        <a href="admin_etablissements.php" class="menu-item">
            <span class="menu-icon"><i data-lucide="school"></i></span> Établissements
        </a>

        <div class="menu-label">Gestion</div>
        <a href="admin_questions.php" class="menu-item">
            <span class="menu-icon"><i data-lucide="help-circle"></i></span> Questions du Test
        </a>
        <a href="admin_tests.php" class="menu-item">
            <span class="menu-icon"><i data-lucide="bar-chart-2"></i></span> Tests &amp; Statistiques
        </a>

        <div class="menu-label">Système</div>
        <a href="index.php" class="menu-item">
            <span class="menu-icon"><i data-lucide="home"></i></span> Voir le Site
        </a>
        <a href="logout.php" class="menu-item">
            <span class="menu-icon"><i data-lucide="log-out"></i></span> Déconnexion
        </a>
    </div>

    <div class="sidebar-bottom">
        <div class="sidebar-user">
            <div class="sidebar-avatar"><i data-lucide="user-circle-2"></i></div>
            <div class="sidebar-user-info">
                <h5><?php echo htmlspecialchars($_SESSION['user_prenom']); ?></h5>
                <p><?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
            </div>
        </div>
    </div>
</aside>

<!-- MAIN CONTENT -->
<div class="main">
    <!-- TOPBAR -->
    <div class="topbar">
        <div class="topbar-left">
            <h1><i data-lucide="hand-metal" style="width:24px;height:24px;margin-right:8px;vertical-align:middle;"></i> Tableau de Bord</h1>
            <p>Bienvenue, voici un résumé de votre plateforme</p>
        </div>
        <div class="topbar-right">
            <div class="topbar-search">
                <span><i data-lucide="search"></i></span>
                <input type="text" placeholder="Rechercher...">
            </div>
            <button class="btn-add" onclick="alert('Fonctionnalité en cours')">
                <i data-lucide="plus" style="width:15px;height:15px;margin-right:4px;vertical-align:middle;"></i> Ajouter
            </button>
        </div>
    </div>

    <!-- STAT CARDS -->
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-bg" style="background: var(--green)"></div>
            <div class="stat-top">
                <div class="stat-icon g"><i data-lucide="users"></i></div>
                <div class="stat-change up">
                    <i data-lucide="trending-up" style="width:13px;height:13px;margin-right:2px;"></i> +12%
                </div>
            </div>
            <h2><?php echo number_format($stats['utilisateurs']); ?></h2>
            <p>Utilisateurs Actifs</p>
            <div class="mini-bars">
                <div class="mini-bar g" style="height: 60%"></div>
                <div class="mini-bar g" style="height: 45%"></div>
                <div class="mini-bar g" style="height: 70%"></div>
                <div class="mini-bar g" style="height: 55%"></div>
                <div class="mini-bar g" style="height: 80%"></div>
                <div class="mini-bar g" style="height: 65%"></div>
                <div class="mini-bar g" style="height: 100%"></div>
            </div> 
        </div>

        <div class="stat-card">
            <div class="stat-bg" style="background: var(--orange)"></div>
            <div class="stat-top">
                <div class="stat-icon o"><i data-lucide="flask-conical"></i></div>
                <div class="stat-change up">
                    <i data-lucide="trending-up" style="width:13px;height:13px;margin-right:2px;"></i> +8%
                </div>
            </div>
            <h2><?php echo number_format($stats['tests']); ?></h2>
            <p>Tests Effectués</p>
            <div class="mini-bars">
                <div class="mini-bar o" style="height: 50%"></div>
                <div class="mini-bar o" style="height: 65%"></div>
                <div class="mini-bar o" style="height: 40%"></div>
                <div class="mini-bar o" style="height: 75%"></div>
                <div class="mini-bar o" style="height: 60%"></div>
                <div class="mini-bar o" style="height: 90%"></div>
                <div class="mini-bar o" style="height: 100%"></div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-bg" style="background: #4f86f7"></div>
            <div class="stat-top">
                <div class="stat-icon b"><i data-lucide="library"></i></div>
                <div class="stat-change up">
                    <i data-lucide="trending-up" style="width:13px;height:13px;margin-right:2px;"></i> +3
                </div>
            </div>
            <h2><?php echo $stats['filieres']; ?></h2>
            <p>Filières Disponibles</p>
            <div class="mini-bars">
                <div class="mini-bar b" style="height: 70%"></div>
                <div class="mini-bar b" style="height: 70%"></div>
                <div class="mini-bar b" style="height: 70%"></div>
                <div class="mini-bar b" style="height: 70%"></div>
                <div class="mini-bar b" style="height: 75%"></div>
                <div class="mini-bar b" style="height: 80%"></div>
                <div class="mini-bar b" style="height: 100%"></div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-bg" style="background: #a855f7"></div>
            <div class="stat-top">
                <div class="stat-icon p"><i data-lucide="building-2"></i></div>
                <div class="stat-change up">
                    <i data-lucide="trending-up" style="width:13px;height:13px;margin-right:2px;"></i> +2
                </div>
            </div>
            <h2><?php echo $stats['etablissements']; ?></h2>
            <p>Établissements</p>
            <div class="mini-bars">
                <div class="mini-bar p" style="height: 85%"></div>
                <div class="mini-bar p" style="height: 85%"></div>
                <div class="mini-bar p" style="height: 90%"></div>
                <div class="mini-bar p" style="height: 90%"></div>
                <div class="mini-bar p" style="height: 90%"></div>
                <div class="mini-bar p" style="height: 85%"></div>
                <div class="mini-bar p" style="height: 100%"></div>
            </div>
        </div>
    </div>

    <!-- LOWER GRID -->
    <div class="lower-grid">
        <!-- USERS TABLE -->
        <div class="card">
            <div class="card-header">
                <h3><i data-lucide="users" style="width:17px;height:17px;margin-right:6px;vertical-align:middle;"></i> Derniers Utilisateurs</h3>
                <a href="admin_utilisateurs.php">Voir tous →</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Niveau</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($derniers_utilisateurs as $user): ?>
                    <tr>
                        <td>
                            <div class="td-user">
                                <div class="td-avatar"><?php echo strtoupper(substr($user['prenom'], 0, 1) . substr($user['nom'], 0, 1)); ?></div>
                                <div>
                                    <div class="td-name"><?php echo htmlspecialchars($user['prenom'] . ' ' . $user['nom']); ?></div>
                                    <div class="td-email"><?php echo htmlspecialchars($user['email']); ?></div>
                                </div>
                            </div>
                        </td>
                        <td><?php echo ucfirst($user['type_utilisateur']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($user['date_inscription'])); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    
                    <?php if (empty($derniers_utilisateurs)): ?>
                    <tr>
                        <td colspan="3" style="text-align:center; color:#9ca3af;">Aucun utilisateur</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- RIGHT COLUMN -->
        <div>
            <div class="card" style="margin-bottom: 22px">
                <div class="card-header">
                    <h3><i data-lucide="bell" style="width:17px;height:17px;margin-right:6px;vertical-align:middle;"></i> Activités Récentes</h3>
                </div>
                <?php foreach ($activites as $activite): ?>
                <div class="recent-card">
                    <div class="recent-icon <?php echo $activite['type'] == 'test' ? 'g' : 'b'; ?>">
                        <?php if ($activite['type'] == 'test'): ?>
                            <i data-lucide="check-circle"></i>
                        <?php else: ?>
                            <i data-lucide="user-plus"></i>
                        <?php endif; ?>
                    </div>
                    <div>
                        <h5><?php echo $activite['titre']; ?></h5>
                        <p><?php echo $activite['description']; ?></p>
                    </div>
                    <span class="time"><?php echo temps_ecoule($activite['date']); ?></span>
                </div>
                <?php endforeach; ?>
                
                <?php if (empty($activites)): ?>
                <p style="text-align:center; color:#9ca3af; padding:20px;">Aucune activité récente</p>
                <?php endif; ?>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3><i data-lucide="pie-chart" style="width:17px;height:17px;margin-right:6px;vertical-align:middle;"></i> Statistiques Rapides</h3>
                </div>
                <div style="display: flex; justify-content: space-between; text-align: center">
                    <div>
                        <div style="font-family: 'Poppins', sans-serif; font-size: 22px; font-weight: 800; color: var(--green)">98%</div>
                        <div style="font-size: 12px; color: #9ca3af">Satisfaction</div>
                    </div>
                    <div>
                        <div style="font-family: 'Poppins', sans-serif; font-size: 22px; font-weight: 800; color: var(--orange)">
                            <?php 
                            $avg_stmt = $pdo->query("SELECT AVG(score_global) as avg FROM test_orientation WHERE statut = 'termine'");
                            $avg = $avg_stmt->fetch();
                            echo $avg['avg'] ? round($avg['avg']) : '0';
                            ?>%
                        </div>
                        <div style="font-size: 12px; color: #9ca3af">Moy. Score</div>
                    </div>
                    <div>
                        <div style="font-family: 'Poppins', sans-serif; font-size: 22px; font-weight: 800; color: #4f86f7">
                            <?php 
                            $month_stmt = $pdo->query("SELECT COUNT(*) as total FROM test_orientation WHERE MONTH(date_fin) = MONTH(NOW()) AND YEAR(date_fin) = YEAR(NOW())");
                            $month = $month_stmt->fetch();
                            echo $month['total'];
                            ?>
                        </div>
                        <div style="font-size: 12px; color: #9ca3af">Ce mois</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Initialiser les icônes Lucide -->
<script>
    lucide.createIcons();
</script>

</body>
</html>