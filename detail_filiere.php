<?php
/**
 * BoussoleScolaire - Détail Filière
 * Design moderne et complet
 */

session_start();
require_once 'config/database.php';

$id_filiere = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$id_filiere) {
    header('Location: filieres.php');
    exit();
}

// Récupérer la filière
$stmt = $pdo->prepare("SELECT * FROM filiere WHERE id_filiere = ? AND actif = 1");
$stmt->execute([$id_filiere]);
$filiere = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$filiere) {
    header('Location: filieres.php');
    exit();
}

// Compter les établissements
$stmt = $pdo->prepare("
    SELECT COUNT(*) as nb_etablissements
    FROM filiere_etablissement
    WHERE id_filiere = ?
");
$stmt->execute([$id_filiere]);
$stats = $stmt->fetch(PDO::FETCH_ASSOC);

// Récupérer les établissements
$stmt = $pdo->prepare("
    SELECT e.*, COUNT(o.id_offre) as nb_formations
    FROM etablissement e
    JOIN filiere_etablissement fe ON e.id_etablissement = fe.id_etablissement
    LEFT JOIN offre_formation o ON o.id_etablissement = e.id_etablissement
        AND o.id_filiere = ? AND o.actif = 1
    WHERE fe.id_filiere = ? AND e.actif = 1
    GROUP BY e.id_etablissement
    ORDER BY e.nom_etablissement
");
$stmt->execute([$id_filiere, $id_filiere]);
$etablissements = $stmt->fetchAll(PDO::FETCH_ASSOC);

$page_title = htmlspecialchars($filiere['nom_filiere']);
include 'includes/header.php';
?>

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

.hero-section {
    background: linear-gradient(135deg, #00c878 0%, #ff8c3a 100%);
    padding: 120px 20px 80px;
    color: white;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="white" opacity="0.1"/></svg>');
    animation: drift 20s linear infinite;
}

@keyframes drift {
    0% { transform: translateY(0); }
    100% { transform: translateY(-100px); }
}

.hero-content {
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.hero-icon {
    width: 100px;
    height: 100px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-radius: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
}

.hero-title {
    font-size: 56px;
    font-weight: 900;
    margin-bottom: 16px;
    font-family: 'Poppins', sans-serif;
    text-shadow: 0 2px 20px rgba(0,0,0,0.1);
}

.hero-description {
    font-size: 20px;
    opacity: 0.95;
    line-height: 1.7;
    max-width: 800px;
    margin-bottom: 32px;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 28px;
    background: rgba(255,255,255,0.2);
    border: 2px solid rgba(255,255,255,0.3);
    color: white;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 700;
    transition: all 0.3s;
    backdrop-filter: blur(10px);
}

.btn-back:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-2px);
}

.main-content {
    max-width: 1200px;
    margin: -40px auto 80px;
    padding: 0 20px;
    position: relative;
    z-index: 3;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 24px;
    margin-bottom: 40px;
}

.stat-card {
    background: white;
    padding: 32px;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    text-align: center;
    transition: transform 0.3s;
}

.stat-card:hover {
    transform: translateY(-8px);
}

.stat-icon {
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, #00c878 0%, #00a062 100%);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
}

.stat-value {
    font-size: 36px;
    font-weight: 900;
    background: linear-gradient(135deg, #00c878, #ff8c3a);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 8px;
}

.stat-label {
    font-size: 14px;
    color: #6b7280;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.content-card {
    background: white;
    padding: 48px;
    border-radius: 24px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    margin-bottom: 32px;
}

.section-title {
    font-size: 32px;
    font-weight: 800;
    color: #1a1a2e;
    margin-bottom: 32px;
    display: flex;
    align-items: center;
    gap: 16px;
}

.section-title i {
    width: 36px;
    height: 36px;
    color: #00c878;
}

.info-row {
    display: grid;
    grid-template-columns: 200px 1fr;
    padding: 20px 0;
    border-bottom: 1px solid #f3f4f6;
    align-items: start;
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: 700;
    color: #374151;
    font-size: 15px;
}

.info-value {
    color: #1a1a2e;
    font-size: 16px;
    line-height: 1.6;
}

.debouches-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 16px;
}

.debouche-item {
    background: linear-gradient(135deg, #f0fdf4 0%, #d6fce9 100%);
    padding: 20px;
    border-radius: 12px;
    border-left: 4px solid #00c878;
    font-weight: 600;
    color: #00a062;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s;
}

.debouche-item:hover {
    transform: translateX(8px);
    box-shadow: 0 4px 12px rgba(0, 200, 120, 0.2);
}

.etablissement-card {
    background: linear-gradient(135deg, #fafafa 0%, #f5f5f5 100%);
    border: 2px solid #e5e7eb;
    border-radius: 16px;
    padding: 32px;
    margin-bottom: 24px;
    transition: all 0.3s;
}

.etablissement-card:hover {
    border-color: #00c878;
    box-shadow: 0 8px 24px rgba(0, 200, 120, 0.15);
}

.etablissement-name {
    font-size: 24px;
    font-weight: 800;
    color: #1a1a2e;
    margin-bottom: 16px;
}

.etablissement-info {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 20px;
}

.etablissement-tag {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: white;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
}

.contact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #e5e7eb;
}

.contact-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.contact-label {
    font-size: 12px;
    color: #9ca3af;
    font-weight: 600;
    text-transform: uppercase;
}

.contact-value {
    font-size: 15px;
    color: #1a1a2e;
    font-weight: 600;
}

.btn-info-etablissement {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 28px;
    background: linear-gradient(135deg, #4f86f7 0%, #3b82f6 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 15px;
    text-decoration: none;
    transition: all 0.3s;
    box-shadow: 0 4px 12px rgba(79, 134, 247, 0.3);
    margin-top: 20px;
}

.btn-info-etablissement:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(79, 134, 247, 0.4);
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
}

.btn-info-etablissement i {
    width: 20px;
    height: 20px;
}
</style>

<div class="hero-section">
    <div class="hero-content">
        <div class="hero-icon">
            <i data-lucide="graduation-cap" style="width:50px;height:50px;color:white;stroke-width:2;"></i>
        </div>
        <h1 class="hero-title"><?php echo htmlspecialchars($filiere['nom_filiere']); ?></h1>
        <p class="hero-description"><?php echo htmlspecialchars($filiere['description']); ?></p>
        <div style="display: flex; gap: 16px; flex-wrap: wrap; margin-top: 30px;">
            <a href="filieres.php" class="btn-back">
                <i data-lucide="arrow-left" style="width:20px;height:20px;"></i>
                Retour aux filières
            </a>
            <?php if (count($etablissements) > 0): ?>
            <a href="#etablissements" class="btn-info-etablissement">
                <i data-lucide="building-2" style="width:20px;height:20px;"></i>
                Voir les établissements (<?php echo count($etablissements); ?>)
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="main-content">
    
    <!-- Statistiques clés -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i data-lucide="clock" style="width:28px;height:28px;color:white;"></i>
            </div>
            <div class="stat-value"><?php echo $filiere['duree_annees']; ?> ans</div>
            <div class="stat-label">Durée</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i data-lucide="banknote" style="width:28px;height:28px;color:white;"></i>
            </div>
            <div class="stat-value"><?php echo number_format($filiere['cout_moyen'] / 1000000, 1); ?>M</div>
            <div class="stat-label">Coût moyen FCFA</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i data-lucide="school" style="width:28px;height:28px;color:white;"></i>
            </div>
            <div class="stat-value"><?php echo $stats['nb_etablissements']; ?></div>
            <div class="stat-label">Établissements</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i data-lucide="award" style="width:28px;height:28px;color:white;"></i>
            </div>
            <div class="stat-value"><?php echo htmlspecialchars($filiere['niveau_requis']); ?></div>
            <div class="stat-label">Niveau requis</div>
        </div>
    </div>

    <!-- Informations détaillées -->
    <div class="content-card">
        <div class="section-title">
            <i data-lucide="info"></i>
            Informations détaillées
        </div>
        
        <div class="info-row">
            <div class="info-label">Nom de la filière</div>
            <div class="info-value"><?php echo htmlspecialchars($filiere['nom_filiere']); ?></div>
        </div>
        
        <div class="info-row">
            <div class="info-label">Description</div>
            <div class="info-value"><?php echo htmlspecialchars($filiere['description']); ?></div>
        </div>
        
        <div class="info-row">
            <div class="info-label">Durée des études</div>
            <div class="info-value"><?php echo $filiere['duree_annees']; ?> année<?php echo $filiere['duree_annees'] > 1 ? 's' : ''; ?></div>
        </div>
        
        <div class="info-row">
            <div class="info-label">Coût moyen</div>
            <div class="info-value"><?php echo number_format($filiere['cout_moyen'], 0, ',', ' '); ?> FCFA par an</div>
        </div>
        
        <div class="info-row">
            <div class="info-label">Niveau requis</div>
            <div class="info-value"><?php echo htmlspecialchars($filiere['niveau_requis']); ?></div>
        </div>
    </div>

    <!-- Débouchés professionnels -->
    <div class="content-card">
        <div class="section-title">
            <i data-lucide="briefcase"></i>
            Débouchés professionnels
        </div>
        
        <div class="debouches-list">
            <?php foreach (explode(',', $filiere['debouches']) as $debouche): ?>
            <div class="debouche-item">
                <i data-lucide="check-circle" style="width:20px;height:20px;color:#00c878;flex-shrink:0;"></i>
                <?php echo trim(htmlspecialchars($debouche)); ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Établissements -->
    <?php if (count($etablissements) > 0): ?>
    <div class="content-card" id="etablissements">
        <div class="section-title">
            <i data-lucide="map-pin"></i>
            Où étudier cette filière ? (<?php echo count($etablissements); ?> établissement<?php echo count($etablissements) > 1 ? 's' : ''; ?>)
        </div>
        
        <?php foreach ($etablissements as $etab): ?>
        <div class="etablissement-card">
            <div class="etablissement-name">
                <?php if (!empty($etab['site_web'])): ?>
                <a href="<?php echo htmlspecialchars($etab['site_web']); ?>" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                    <?php echo htmlspecialchars($etab['nom_etablissement']); ?>
                    <i data-lucide="external-link" style="width:20px;height:20px;color:#00c878;"></i>
                </a>
                <?php else: ?>
                <?php echo htmlspecialchars($etab['nom_etablissement']); ?>
                <?php endif; ?>
            </div>
            
            <div class="etablissement-info">
                <div class="etablissement-tag">
                    <i data-lucide="map-pin" style="width:16px;height:16px;"></i>
                    <?php echo htmlspecialchars($etab['ville']); ?>
                </div>
                <div class="etablissement-tag">
                    <i data-lucide="building-2" style="width:16px;height:16px;"></i>
                    <?php echo ucfirst(str_replace('_', ' ', htmlspecialchars($etab['type_etablissement']))); ?>
                </div>
                <div class="etablissement-tag">
                    <i data-lucide="bookmark" style="width:16px;height:16px;"></i>
                    <?php echo $etab['nb_formations']; ?> formation<?php echo $etab['nb_formations'] > 1 ? 's' : ''; ?>
                </div>
            </div>
            
            <?php if ($etab['email'] || $etab['telephone']): ?>
            <div class="contact-grid">
                <?php if ($etab['email']): ?>
                <div class="contact-item">
                    <div class="contact-label">Email</div>
                    <div class="contact-value"><?php echo htmlspecialchars($etab['email']); ?></div>
                </div>
                <?php endif; ?>

                <?php if ($etab['telephone']): ?>
                <div class="contact-item">
                    <div class="contact-label">Téléphone</div>
                    <div class="contact-value"><?php echo htmlspecialchars($etab['telephone']); ?></div>
                </div>
                <?php endif; ?>

                <?php if ($etab['adresse']): ?>
                <div class="contact-item">
                    <div class="contact-label">Adresse</div>
                    <div class="contact-value"><?php echo htmlspecialchars($etab['adresse']); ?></div>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</div>

<script>
    lucide.createIcons();
</script>

<?php include 'includes/footer.php'; ?>