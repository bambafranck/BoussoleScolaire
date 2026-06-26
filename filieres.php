<?php
/**
 * BoussoleScolaire - Page Filières
 * Fichier: filieres.php
 * VERSION MISE À JOUR - Avec liens cliquables vers détails
 */

session_start();

$page_title = "Filières";
$page_css = "filieres";

require_once 'config/database.php';

$stmt = $pdo->query("SELECT * FROM filiere WHERE actif = 1 ORDER BY nom_filiere ASC");
$filieres = $stmt->fetchAll();

include 'includes/header.php';
?>

<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

<div class="page-indicator">
    <i data-lucide="radio" style="width:14px;height:14px;vertical-align:middle;margin-right:6px;"></i>
    Page : Filières (filieres.php)
</div>

<div class="filieres-page">
    <div class="filieres-container">

        <div class="filieres-header">
            <div class="filieres-badge">
                <i data-lucide="library"></i>
                Catalogue des Filières
            </div>
            <h1>
                Explorez nos <span class="gradient-text">Filières</span>
            </h1>
            <p>
                Découvrez toutes les filières disponibles et trouvez celle qui correspond à vos ambitions.
            </p>
        </div>

        <div class="filieres-grid">
            <?php foreach ($filieres as $filiere): ?>
            <div class="filiere-card" onclick="window.location.href='detail_filiere.php?id=<?php echo $filiere['id_filiere']; ?>'">

                <div class="filiere-icon">
                    <i data-lucide="book-open"></i>
                </div>

                <h3>
                    <?php echo htmlspecialchars($filiere['nom_filiere']); ?>
                </h3>

                <p>
                    <?php echo htmlspecialchars($filiere['description']); ?>
                </p>

                <a href="detail_filiere.php?id=<?php echo $filiere['id_filiere']; ?>" class="filiere-link" onclick="event.stopPropagation();">
                    Voir les détails
                    <i data-lucide="arrow-right"></i>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        
        <?php if (empty($filieres)): ?>
        <div class="empty-state">
            <div class="empty-state-icon">
                <i data-lucide="book-x"></i>
            </div>
            <h3>Aucune filière disponible</h3>
            <p>Les filières seront bientôt ajoutées à la base de données.</p>
        </div>
        <?php endif; ?>

    </div>
</div>

<script>
    lucide.createIcons();
</script>

<?php include 'includes/footer.php'; ?>