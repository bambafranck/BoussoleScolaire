<?php
/**
 * BoussoleScolaire - Page Filières
 * Fichier: filieres.php
 * VERSION MISE À JOUR - Avec liens cliquables vers détails
 */

session_start();

$page_title = "Filières";
$page_css = "index";

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

<div style="background:#fff; min-height:100vh; padding-top:100px;">
    <div style="max-width:1100px; margin:0 auto; padding:40px 20px;">
        
        <div style="text-align:center; margin-bottom:50px;">
            <div style="display:inline-flex; align-items:center; gap:8px; color:#00c878; font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:2px; margin-bottom:12px;">
                <i data-lucide="library" style="width:16px;height:16px;"></i>
                Catalogue des Filières
            </div>
            <h1 style="font-family:'Poppins',sans-serif; font-size:38px; font-weight:800; color:#1a1a2e; margin-bottom:16px;">
                Explorez nos <span style="background:linear-gradient(135deg,#00c878,#ff8c3a);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Filières</span>
            </h1>
            <p style="color:#6b7280; font-size:16px; max-width:600px; margin:0 auto;">
                Découvrez toutes les filières disponibles et trouvez celle qui correspond à vos ambitions.
            </p>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(320px,1fr)); gap:24px;">
            <?php foreach ($filieres as $filiere): ?>
            <div style="background:#fff; border:2px solid #f0f0f0; border-radius:16px; padding:28px; transition:0.3s; cursor:pointer;" 
                 onclick="window.location.href='detail_filiere.php?id=<?php echo $filiere['id_filiere']; ?>'"
                 onmouseover="this.style.borderColor='#00c878'; this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(11, 11, 11, 0.1)';"
                 onmouseout="this.style.borderColor='#f0f0f0'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                
                <div style="width:56px; height:56px; background:linear-gradient(135deg,rgba(0,200,120,0.1),rgba(21, 20, 20, 0.1)); border-radius:14px; display:flex; align-items:center; justify-content:center; margin-bottom:20px;">
                    <i data-lucide="book-open" style="width:28px;height:28px;color:#00c878;stroke-width:1.5;"></i>
                </div>
                
                <h3 style="font-family:'Poppins',sans-serif; font-size:20px; font-weight:700; color:#1a1a2e; margin-bottom:10px;">
                    <?php echo htmlspecialchars($filiere['nom_filiere']); ?>
                </h3>
                
                <p style="color:#6b7280; font-size:14px; line-height:1.6; margin-bottom:16px;">
                    <?php echo htmlspecialchars($filiere['description']); ?>
                </p>
                
                <div style="display:flex; flex-wrap:wrap; gap:8px; margin-bottom:16px;">
                    <span style="display:inline-flex; align-items:center; gap:5px; background:#d6fce9; color:#00a062; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:600;">
                        <i data-lucide="calendar" style="width:12px;height:12px;"></i>
                        <?php echo $filiere['duree_annees']; ?> an(s)
                    </span>
                    <span style="display:inline-flex; align-items:center; gap:5px; background:#fff0e0; color:#e67320; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:600;">
                        <i data-lucide="banknote" style="width:12px;height:12px;"></i>
                        <?php echo number_format($filiere['cout_moyen'], 0, ',', ' '); ?> FCFA
                    </span>
                </div>
                
                <div style="padding-top:16px; border-top:1px solid #f0f0f0;">
                    <div style="display:flex; align-items:center; gap:5px; font-size:12px; color:#9ca3af; margin-bottom:4px;">
                        <i data-lucide="briefcase" style="width:13px;height:13px;"></i>
                        <strong>Débouchés :</strong>
                    </div>
                    <div style="font-size:13px; color:#374151;">
                        <?php echo htmlspecialchars($filiere['debouches']); ?>
                    </div>
                </div>
                
                <!-- Indicateur cliquable -->
                <div style="margin-top:16px; padding-top:16px; border-top:1px solid #f0f0f0; text-align:center;">
                    <span style="color:#00c878; font-weight:700; font-size:13px; display:inline-flex; align-items:center; gap:6px; justify-content:center;">
                        <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
                        Voir les détails complets
                    </span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <?php if (empty($filieres)): ?>
        <div style="text-align:center; padding:60px 20px; background:#f9fafb; border-radius:16px;">
            <div style="width:72px; height:72px; background:linear-gradient(135deg,rgba(0,200,120,0.1),rgba(255,140,58,0.1)); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
                <i data-lucide="book-x" style="width:32px;height:32px;color:#9ca3af;stroke-width:1.5;"></i>
            </div>
            <h3 style="font-family:'Poppins',sans-serif; font-size:20px; color:#374151; margin-bottom:8px;">
                Aucune filière disponible
            </h3>
            <p style="color:#9ca3af; font-size:14px;">
                Les filières seront bientôt ajoutées à la base de données.
            </p>
        </div>
        <?php endif; ?>

    </div>
</div>

<script>
    lucide.createIcons();
</script>

<?php include 'includes/footer.php'; ?>