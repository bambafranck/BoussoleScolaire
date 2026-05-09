<?php
/**
 * BoussoleScolaire - Formations SANS texte d'icône
 * N'affiche que les vrais emojis, pas les noms
 */

session_start();
$page_title = "Formations";
$page_css = "index";
require_once 'config/database.php';

$stmt = $pdo->query("
    SELECT 
        o.id_offre,
        o.titre_offre,
        o.type_formation,
        o.duree,
        o.cout,
        o.places_disponibles,
        f.nom_filiere,
        f.icone,
        e.nom_etablissement,
        e.ville,
        e.type_etablissement
    FROM offre_formation o
    JOIN filiere f ON o.id_filiere = f.id_filiere
    JOIN etablissement e ON o.id_etablissement = e.id_etablissement
    WHERE o.actif = 1
    ORDER BY e.nom_etablissement ASC
");
$formations = $stmt->fetchAll();

// Fonction pour vérifier si c'est un vrai emoji
function isEmoji($str) {
    return mb_strlen($str) <= 4 && preg_match('/[\x{1F300}-\x{1F9FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}]/u', $str);
}

include 'includes/header.php';
?>

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

<div class="page-indicator">
    <i data-lucide="radio" style="width:14px;height:14px;vertical-align:middle;margin-right:6px;"></i>
    Page : Formations (formations.php)
</div>

<div style="background:#fff; min-height:100vh; padding-top:100px;">
    <div style="max-width:1200px; margin:0 auto; padding:40px 20px;">
        
        <div style="text-align:center; margin-bottom:50px;">
            <div style="display:inline-flex; align-items:center; gap:8px; color:#ff8c3a; font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:2px; margin-bottom:12px;">
                <i data-lucide="graduation-cap" style="width:16px;height:16px;"></i>
                Offres de Formation
            </div>
            <h1 style="font-family:'Poppins',sans-serif; font-size:38px; font-weight:800; color:#1a1a2e; margin-bottom:16px;">
                Trouvez la <span style="background:linear-gradient(135deg,#00c878,#ff8c3a);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">formation parfaite</span>
            </h1>
            <p style="color:#6b7280; font-size:16px; max-width:600px; margin:0 auto;">
                Parcourez les formations disponibles dans nos établissements partenaires.
            </p>
        </div>

        <div style="display:grid; gap:20px;">
            <?php foreach ($formations as $formation): ?>
            <div style="background:#fff; border:2px solid #f0f0f0; border-radius:16px; padding:32px; transition:0.3s; cursor:pointer;"
                 onclick="window.location.href='detail_formation.php?id=<?php echo $formation['id_offre']; ?>'"
                 onmouseover="this.style.borderColor='#ff8c3a'; this.style.boxShadow='0 4px 20px rgba(255,140,58,0.15)';"
                 onmouseout="this.style.borderColor='#f0f0f0'; this.style.boxShadow='none';">
                
                <div style="display:flex; gap:24px; align-items:flex-start; flex-wrap:wrap;">
                    
                    <!-- Icône - N'affiche QUE si c'est un emoji -->
                    <?php if (isEmoji($formation['icone'])): ?>
                    <div style="flex-shrink:0;">
                        <div style="width:80px; height:80px; background:linear-gradient(135deg,rgba(255,140,58,0.15),rgba(0,200,120,0.15)); border-radius:16px; display:flex; align-items:center; justify-content:center;">
                            <span style="font-size:36px;"><?php echo $formation['icone']; ?></span>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Contenu -->
                    <div style="flex:1; min-width:250px;">
                        <h3 style="font-family:'Poppins',sans-serif; font-size:22px; font-weight:700; color:#1a1a2e; margin-bottom:8px;">
                            <?php echo htmlspecialchars($formation['titre_offre']); ?>
                        </h3>
                        
                        <div style="display:flex; gap:16px; margin-bottom:12px; flex-wrap:wrap;">
                            <span style="display:inline-flex; align-items:center; gap:5px; color:#6b7280; font-size:14px;">
                                <i data-lucide="school" style="width:14px;height:14px;"></i>
                                <strong><?php echo htmlspecialchars($formation['nom_etablissement']); ?></strong>
                            </span>
                            <span style="display:inline-flex; align-items:center; gap:5px; color:#6b7280; font-size:14px;">
                                <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                                <?php echo htmlspecialchars($formation['ville']); ?>
                            </span>
                        </div>
                        
                        <div style="display:flex; flex-wrap:wrap; gap:8px; margin-bottom:16px;">
                            <span style="display:inline-flex; align-items:center; gap:5px; background:#d6fce9; color:#00a062; padding:6px 14px; border-radius:20px; font-size:13px; font-weight:600;">
                                <i data-lucide="book-open" style="width:13px;height:13px;"></i>
                                <?php echo htmlspecialchars($formation['nom_filiere']); ?>
                            </span>
                            <span style="display:inline-flex; align-items:center; gap:5px; background:#e0f2fe; color:#0369a1; padding:6px 14px; border-radius:20px; font-size:13px; font-weight:600;">
                                <i data-lucide="clipboard-list" style="width:13px;height:13px;"></i>
                                <?php echo ucfirst(htmlspecialchars($formation['type_formation'])); ?>
                            </span>
                            <span style="display:inline-flex; align-items:center; gap:5px; background:#fff0e0; color:#e67320; padding:6px 14px; border-radius:20px; font-size:13px; font-weight:600;">
                                <i data-lucide="clock" style="width:13px;height:13px;"></i>
                                <?php echo htmlspecialchars($formation['duree']); ?>
                            </span>
                        </div>
                        
                        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(150px,1fr)); gap:16px; padding-top:16px; border-top:1px solid #f0f0f0;">
                            <div>
                                <div style="display:flex; align-items:center; gap:4px; font-size:12px; color:#9ca3af; margin-bottom:4px;">
                                    <i data-lucide="banknote" style="width:12px;height:12px;"></i> Coût
                                </div>
                                <div style="font-size:16px; font-weight:700; color:#1a1a2e;">
                                    <?php echo number_format($formation['cout'], 0, ',', ' '); ?> FCFA
                                </div>
                            </div>
                            <div>
                                <div style="display:flex; align-items:center; gap:4px; font-size:12px; color:#9ca3af; margin-bottom:4px;">
                                    <i data-lucide="building-2" style="width:12px;height:12px;"></i> Type
                                </div>
                                <div style="font-size:14px; font-weight:600; color:#374151;">
                                    <?php echo ucfirst(str_replace('_', ' ', htmlspecialchars($formation['type_etablissement']))); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div style="margin-top:16px; padding-top:16px; border-top:1px solid #f0f0f0; text-align:center;">
                            <span style="color:#ff8c3a; font-weight:700; font-size:13px; display:inline-flex; align-items:center; gap:6px; justify-content:center;">
                                <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
                                Voir les détails et s'inscrire
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <?php if (empty($formations)): ?>
        <div style="text-align:center; padding:60px 20px; background:#f9fafb; border-radius:16px;">
            <div style="width:72px; height:72px; background:linear-gradient(135deg,rgba(0,200,120,0.1),rgba(255,140,58,0.1)); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
                <i data-lucide="graduation-cap" style="width:32px;height:32px;color:#9ca3af;stroke-width:1.5;"></i>
            </div>
            <h3 style="font-family:'Poppins',sans-serif; font-size:20px; color:#374151; margin-bottom:8px;">
                Aucune formation disponible
            </h3>
            <p style="color:#9ca3af; font-size:14px;">
                Les formations seront bientôt ajoutées à la base de données.
            </p>
        </div>
        <?php endif; ?>

    </div>
</div>

<script>
    lucide.createIcons();
</script>

<?php include 'includes/footer.php'; ?>