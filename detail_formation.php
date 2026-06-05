<?php
/**
 * Détail Formation - BoussoleScolaire
 * Fichier: detail_formation.php
 */

session_start();
require_once 'config/database.php';

$id_offre = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id_offre) {
    header('Location: formations.php');
    exit();
}

function isEmoji($str) {
    return mb_strlen($str) <= 4 && preg_match('/[\x{1F300}-\x{1F9FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}]/u', $str);
}

$stmt = $pdo->prepare("
    SELECT
        o.id_offre, o.titre_offre, o.type_formation, o.duree, o.cout, o.id_etablissement,
        o.places_disponibles, o.date_debut, o.date_limite_inscription,
        f.nom_filiere, f.description as filiere_description, f.icone, f.debouches,
        e.nom_etablissement, e.ville, e.type_etablissement, e.adresse, e.email, e.telephone, e.site_web
    FROM offre_formation o
    JOIN filiere f ON o.id_filiere = f.id_filiere
    JOIN etablissement e ON o.id_etablissement = e.id_etablissement
    WHERE o.id_offre = ? AND o.actif = 1
");
$stmt->execute([$id_offre]);
$formation = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$formation) {
    header('Location: formations.php');
    exit();
}

$stmt = $pdo->prepare("
    SELECT o.id_offre, o.titre_offre, o.duree, o.cout, f.nom_filiere, f.icone
    FROM offre_formation o
    JOIN filiere f ON o.id_filiere = f.id_filiere
    WHERE o.id_etablissement = (SELECT id_etablissement FROM offre_formation WHERE id_offre = ?) 
    AND o.id_offre != ? AND o.actif = 1
    LIMIT 5
");
$stmt->execute([$id_offre, $id_offre]);
$autres_formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($formation['titre_offre']); ?> - BoussoleScolaire</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #f9fafb; color: #1a1a2e; }
        .header { background: linear-gradient(135deg, #ff8c3a 0%, #00c878 100%); color: white; padding: 60px 20px 80px; }
        .header-content { max-width: 1200px; margin: 0 auto; }
        .header-icon { width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; }
        .header-icon .lucide { width: 40px; height: 40px; stroke: #fff; stroke-width: 1.5; }
        h1 { font-size: 36px; font-weight: 800; margin-bottom: 16px; }
        .subtitle { display: flex; align-items: center; gap: 7px; font-size: 20px; opacity: 0.95; margin-bottom: 8px; font-weight: 600; }
        .subtitle .lucide { width: 18px; height: 18px; }
        .description { font-size: 16px; opacity: 0.9; line-height: 1.6; max-width: 800px; }
        .btn-back { display: inline-flex; align-items: center; gap: 7px; margin-top: 30px; padding: 12px 24px; background: rgba(255,255,255,0.2); color: white; border: 2px solid white; border-radius: 10px; font-weight: 700; text-decoration: none; transition: all 0.3s; }
        .btn-back:hover { background: rgba(255,255,255,0.3); }
        .btn-back .lucide { width: 16px; height: 16px; }
        .content { max-width: 1200px; margin: -40px auto 60px; padding: 0 20px; }
        .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .info-card { background: white; padding: 24px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-left: 4px solid #ff8c3a; }
        .info-icon { width: 44px; height: 44px; background: #fff0e0; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px; }
        .info-icon .lucide { width: 22px; height: 22px; color: #ff8c3a; }
        .info-label { font-size: 13px; color: #6b7280; font-weight: 600; text-transform: uppercase; margin-bottom: 8px; }
        .info-value { font-size: 24px; font-weight: 800; }
        .section { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); margin-bottom: 30px; }
        .section-title { display: flex; align-items: center; gap: 8px; font-size: 24px; font-weight: 800; margin-bottom: 20px; }
        .section-title .lucide { width: 22px; height: 22px; color: #ff8c3a; }
        .badge { display: inline-flex; align-items: center; gap: 5px; padding: 8px 16px; border-radius: 20px; font-size: 13px; font-weight: 700; margin: 4px; }
        .badge .lucide { width: 13px; height: 13px; }
        .badge-green { background: #d6fce9; color: #00a062; }
        .badge-blue  { background: #e0f2fe; color: #0369a1; }
        .badge-orange{ background: #fff0e0; color: #e67320; }
        .etablissement-box { background: #f9fafb; border-radius: 12px; padding: 24px; border: 2px solid #e5e7eb; }
        .etablissement-box h3 { font-size: 22px; font-weight: 800; margin-bottom: 12px; }
        .contact-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px; margin-top: 20px; }
        .contact-item { background: white; padding: 16px; border-radius: 8px; }
        .contact-label { display: flex; align-items: center; gap: 5px; font-size: 12px; color: #6b7280; font-weight: 600; margin-bottom: 8px; }
        .contact-label .lucide { width: 13px; height: 13px; }
        .contact-value { font-size: 14px; color: #1a1a2e; font-weight: 600; }
        .btn-website { display: inline-flex; align-items: center; gap: 7px; padding: 12px 24px; background: #ff8c3a; color: white; border-radius: 8px; text-decoration: none; font-weight: 700; margin-top: 16px; transition: all 0.3s; }
        .btn-website:hover { background: #e67320; }
        .btn-website .lucide { width: 16px; height: 16px; }
        .debouches-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 12px; }
        .debouche-item { display: flex; align-items: center; gap: 8px; background: #f9fafb; padding: 12px 16px; border-radius: 8px; border-left: 3px solid #00c878; font-size: 14px; font-weight: 600; }
        .debouche-item .lucide { width: 14px; height: 14px; color: #00c878; flex-shrink: 0; }
        .autres-formations { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 16px; }
        .autre-card { background: #f9fafb; padding: 20px; border-radius: 10px; border: 2px solid #e5e7eb; cursor: pointer; transition: all 0.3s; text-decoration: none; color: inherit; display: block; }
        .autre-card:hover { border-color: #ff8c3a; transform: translateY(-2px); }
        .autre-card h4 { font-size: 16px; font-weight: 700; margin-bottom: 8px; }
        .autre-card-meta { display: flex; align-items: center; gap: 5px; font-size: 13px; color: #6b7280; margin: 8px 0; }
        .autre-card-meta .lucide { width: 13px; height: 13px; }
        .autre-card-footer { display: flex; align-items: center; gap: 5px; font-size: 12px; color: #9ca3af; }
        .autre-card-footer .lucide { width: 12px; height: 12px; }
        .alert-success { display: flex; align-items: center; gap: 8px; background: #d4edda; color: #155724; padding: 16px; border-radius: 8px; border-left: 4px solid #28a745; margin-bottom: 20px; }
        .alert-success .lucide { width: 18px; height: 18px; flex-shrink: 0; }
        .alert-warning { display: flex; align-items: center; gap: 8px; background: #fff3cd; color: #856404; padding: 16px; border-radius: 8px; border-left: 4px solid #ffc107; margin-bottom: 20px; }
        .alert-warning .lucide { width: 18px; height: 18px; flex-shrink: 0; }
        .deadline-box { display: flex; align-items: flex-start; gap: 10px; background: #fef3c7; padding: 16px; border-radius: 10px; margin-top: 20px; border-left: 4px solid #f59e0b; }
        .deadline-box .lucide { width: 18px; height: 18px; color: #92400e; margin-top: 2px; flex-shrink: 0; }
        .location-row { display: flex; align-items: center; gap: 6px; color: #6b7280; margin: 12px 0; }
        .location-row .lucide { width: 15px; height: 15px; }
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
            margin-top: 16px;
        }
        .btn-info-etablissement:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 134, 247, 0.4);
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }
        .btn-info-etablissement i { width: 20px; height: 20px; }
        .info-message {
            background: #eff6ff;
            border-left: 4px solid #4f86f7;
            padding: 14px 18px;
            border-radius: 8px;
            margin-top: 16px;
            font-size: 14px;
            color: #1e40af;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .info-message .lucide {
            width: 18px;
            height: 18px;
            color: #4f86f7;
            flex-shrink: 0;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<div class="header">
    <div class="header-content">
        <?php if (isEmoji($formation['icone'])): ?>
            <div style="font-size:48px; margin-bottom:20px;"><?php echo $formation['icone']; ?></div>
        <?php else: ?>
            <div class="header-icon">
                <i data-lucide="graduation-cap"></i>
            </div>
        <?php endif; ?>

        <h1><?php echo htmlspecialchars($formation['titre_offre']); ?></h1>
        <p class="subtitle">
            <i data-lucide="book-open"></i>
            <?php echo htmlspecialchars($formation['nom_filiere']); ?>
        </p>
        <p class="description"><?php echo htmlspecialchars($formation['filiere_description']); ?></p>
        <a href="formations.php" class="btn-back">
            <i data-lucide="arrow-left"></i> Retour aux formations
        </a>
    </div>
</div>

<div class="content">


    <!-- INFO CARDS -->
    <div class="info-grid">
        <div class="info-card">
            <div class="info-icon"><i data-lucide="clock"></i></div>
            <div class="info-label">Durée</div>
            <div class="info-value"><?php echo htmlspecialchars($formation['duree']); ?></div>
        </div>
        <div class="info-card">
            <div class="info-icon"><i data-lucide="banknote"></i></div>
            <div class="info-label">Coût</div>
            <div class="info-value"><?php echo number_format($formation['cout'], 0, ',', ' '); ?> FCFA</div>
        </div>
        <?php if ($formation['date_debut']): ?>
        <div class="info-card">
            <div class="info-icon"><i data-lucide="calendar"></i></div>
            <div class="info-label">Début</div>
            <div class="info-value"><?php echo date('d/m/Y', strtotime($formation['date_debut'])); ?></div>
        </div>
        <?php endif; ?>
    </div>

    <!-- INFORMATIONS FORMATION -->
    <div class="section">
        <div class="section-title">
            <i data-lucide="info"></i> Informations sur la formation
        </div>
        <div style="margin-bottom: 20px;">
            <span class="badge badge-green">
                <i data-lucide="book-open"></i> <?php echo htmlspecialchars($formation['nom_filiere']); ?>
            </span>
            <span class="badge badge-blue">
                <i data-lucide="clipboard-list"></i> <?php echo ucfirst(htmlspecialchars($formation['type_formation'])); ?>
            </span>
            <span class="badge badge-orange">
                <i data-lucide="clock"></i> <?php echo htmlspecialchars($formation['duree']); ?>
            </span>
        </div>
        <p style="color: #4b5563; line-height: 1.8;">
            <?php echo nl2br(htmlspecialchars($formation['filiere_description'])); ?>
        </p>
        <?php if ($formation['date_limite_inscription']): ?>
        <div class="deadline-box">
            <i data-lucide="timer"></i>
            <div>
                <h4 style="font-size:16px; font-weight:700; margin-bottom:8px; color:#92400e;">Date limite d'inscription</h4>
                <p style="color:#78350f; font-weight:600;"><?php echo date('d/m/Y', strtotime($formation['date_limite_inscription'])); ?></p>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- DÉBOUCHÉS -->
    <?php if ($formation['debouches']): ?>
    <div class="section">
        <div class="section-title">
            <i data-lucide="briefcase"></i> Débouchés professionnels
        </div>
        <div class="debouches-grid">
            <?php foreach (explode(',', $formation['debouches']) as $debouche): ?>
            <div class="debouche-item">
                <i data-lucide="check"></i>
                <?php echo trim(htmlspecialchars($debouche)); ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- ÉTABLISSEMENT -->
    <div class="section">
        <div class="section-title">
            <i data-lucide="building-2"></i> Établissement
        </div>
        <div class="etablissement-box">
            <h3>
                <?php if (!empty($formation['site_web'])): ?>
                <a href="<?php echo htmlspecialchars($formation['site_web']); ?>" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: none; display: inline-flex; align-items: center; gap: 10px;">
                    <?php echo htmlspecialchars($formation['nom_etablissement']); ?>
                    <i data-lucide="external-link" style="width:22px;height:22px;color:#ff8c3a;"></i>
                </a>
                <?php else: ?>
                <?php echo htmlspecialchars($formation['nom_etablissement']); ?>
                <?php endif; ?>
            </h3>
            <span class="badge badge-blue">
                <?php echo ucfirst(str_replace('_', ' ', htmlspecialchars($formation['type_etablissement']))); ?>
            </span>
            <?php if ($formation['ville']): ?>
            <p class="location-row">
                <i data-lucide="map-pin"></i>
                <?php echo htmlspecialchars($formation['ville']); ?>
            </p>
            <?php endif; ?>
            <?php if ($formation['adresse']): ?>
            <p class="location-row" style="font-size:14px;">
                <i data-lucide="navigation"></i>
                <?php echo htmlspecialchars($formation['adresse']); ?>
            </p>
            <?php endif; ?>
            <div class="contact-grid">
                <?php if ($formation['email']): ?>
                <div class="contact-item">
                    <div class="contact-label"><i data-lucide="mail"></i> Email</div>
                    <div class="contact-value"><?php echo htmlspecialchars($formation['email']); ?></div>
                </div>
                <?php endif; ?>
                <?php if ($formation['telephone']): ?>
                <div class="contact-item">
                    <div class="contact-label"><i data-lucide="phone"></i> Téléphone</div>
                    <div class="contact-value"><?php echo htmlspecialchars($formation['telephone']); ?></div>
                </div>
                <?php endif; ?>
            </div>

            <div class="info-message">
                <i data-lucide="info"></i>
                <span>Pour plus d'informations sur cette formation, contactez directement l'établissement</span>
            </div>

            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <?php if ($formation['site_web']): ?>
                <a href="<?php echo htmlspecialchars($formation['site_web']); ?>" target="_blank" class="btn-website">
                    <i data-lucide="external-link"></i> Visiter le site
                </a>
                <?php endif; ?>

                <?php if ($formation['email']): ?>
                <a href="mailto:<?php echo htmlspecialchars($formation['email']); ?>?subject=Demande d'information - <?php echo urlencode($formation['titre_offre']); ?>" class="btn-info-etablissement">
                    <i data-lucide="mail"></i> Envoyer un email
                </a>
                <?php endif; ?>

                <?php if ($formation['telephone']): ?>
                <a href="tel:<?php echo htmlspecialchars($formation['telephone']); ?>" class="btn-info-etablissement">
                    <i data-lucide="phone"></i> Appeler
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- AUTRES FORMATIONS -->
    <?php if (count($autres_formations) > 0): ?>
    <div class="section">
        <div class="section-title">
            <i data-lucide="graduation-cap"></i> Autres formations de cet établissement
        </div>
        <div class="autres-formations">
            <?php foreach ($autres_formations as $autre): ?>
            <a href="detail_formation.php?id=<?php echo $autre['id_offre']; ?>" class="autre-card">
                <?php if (isEmoji($autre['icone'])): ?>
                <div style="font-size:24px; margin-bottom:8px;"><?php echo $autre['icone']; ?></div>
                <?php else: ?>
                <div style="width:40px;height:40px;background:#fff0e0;border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:8px;">
                    <i data-lucide="book-open" style="width:20px;height:20px;color:#ff8c3a;"></i>
                </div>
                <?php endif; ?>
                <h4><?php echo htmlspecialchars($autre['titre_offre']); ?></h4>
                <div class="autre-card-meta">
                    <i data-lucide="library"></i>
                    <?php echo htmlspecialchars($autre['nom_filiere']); ?>
                </div>
                <div class="autre-card-footer">
                    <i data-lucide="clock"></i> <?php echo htmlspecialchars($autre['duree']); ?>
                    &nbsp;•&nbsp;
                    <i data-lucide="banknote"></i> <?php echo number_format($autre['cout'], 0, ',', ' '); ?> FCFA
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

</div>

<script>lucide.createIcons();</script>
</body>
</html>