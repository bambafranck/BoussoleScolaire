<?php
/**
 * BoussoleScolaire - Résultats du Test AMÉLIORÉ
 * Fichier: resultats.php
 * VERSION : Scoring équilibré + Emojis filtrés
 */

session_start();
require_once 'config/database.php';

if (!isLoggedIn() || isAdmin()) {
    header('Location: login.php');
    exit();
}

// Fonction pour vérifier si c'est un emoji
function isEmoji($str) {
    return mb_strlen($str) <= 4 && preg_match('/[\x{1F300}-\x{1F9FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}]/u', $str);
}

$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'] ?? 'etudiant';
$base_path = '/BoursoleScolaire';

// Vérifier que l'utilisateur existe en base (session potentiellement périmée)
$stmt = $pdo->prepare("SELECT id_utilisateur FROM utilisateur WHERE id_utilisateur = ?");
$stmt->execute([$user_id]);
if (!$stmt->fetch()) {
    session_destroy();
    header('Location: login.php');
    exit();
}

// Vérifier que le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: test.php');
    exit();
}

// Récupérer les données du test
$niveau = isset($_POST['niveau']) ? trim($_POST['niveau']) : '';
$serie = isset($_POST['serie']) ? trim($_POST['serie']) : '';
$domaine = isset($_POST['domaine']) ? trim($_POST['domaine']) : '';
$serieOrDomaine = !empty($serie) ? $serie : $domaine;

// Récupérer les 6 réponses
$reponses = [];
for ($i = 1; $i <= 6; $i++) {
    $reponses["q$i"] = isset($_POST["q$i"]) ? trim($_POST["q$i"]) : '';
}

// Vérification de sécurité
if (empty($niveau) || empty($serieOrDomaine)) {
    die("<h1>Erreur : Données incomplètes</h1><a href='test.php'>Retour au test</a>");
}

foreach ($reponses as $key => $value) {
    if (empty($value)) {
        die("<h1>Erreur : Question $key non répondue</h1><a href='test.php'>Retour au test</a>");
    }
}

// ============================================
// SYSTÈME DE SCORING AMÉLIORÉ ET ÉQUILIBRÉ
// ============================================

$scores = [
    'logique' => 0,
    'creativite' => 0,
    'communication' => 0,
    'analyse' => 0,
    'leadership' => 0
];

// ==========================================
// SCORING POUR ÉLÈVES (Terminale)
// ==========================================

if ($user_type === 'eleve' || $user_type === 'parent') {

    // BASE selon la série
    if ($serieOrDomaine === 'C') {
        $scores['logique'] += 15; $scores['analyse'] += 12;
    } elseif ($serieOrDomaine === 'D') {
        $scores['analyse'] += 15; $scores['logique'] += 10;
    } elseif ($serieOrDomaine === 'A') {
        $scores['communication'] += 15; $scores['creativite'] += 12;
    } elseif ($serieOrDomaine === 'G') {
        $scores['leadership'] += 15; $scores['communication'] += 10;
    }

    // Q1 - Matières préférées (choix multiples)
    $q1_mapping = [
        'maths'   => ['logique' => 8, 'analyse' => 4],
        'lettres' => ['communication' => 8, 'creativite' => 4],
        'eco'     => ['leadership' => 8, 'analyse' => 4],
        'histoire'=> ['analyse' => 6, 'communication' => 5]
    ];
    foreach (explode(',', $reponses['q1']) as $val) {
        $val = trim($val);
        if (isset($q1_mapping[$val])) {
            foreach ($q1_mapping[$val] as $comp => $pts) { $scores[$comp] += $pts; }
        }
    }

    // Q2 - Activités extra-scolaires (choix multiples)
    $q2_mapping = [
        'techno'  => ['logique' => 6, 'creativite' => 3],
        'culture' => ['creativite' => 6, 'communication' => 3],
        'sport'   => ['leadership' => 5, 'communication' => 3],
        'social'  => ['communication' => 6, 'leadership' => 3]
    ];
    foreach (explode(',', $reponses['q2']) as $val) {
        $val = trim($val);
        if (isset($q2_mapping[$val])) {
            foreach ($q2_mapping[$val] as $comp => $pts) { $scores[$comp] += $pts; }
        }
    }

    // Q3 - Secteur futur
    $q3_mapping = [
        'tech'          => ['logique' => 12, 'creativite' => 6],
        'sante'         => ['analyse' => 12, 'communication' => 6],
        'communication' => ['communication' => 12, 'creativite' => 6],
        'business'      => ['leadership' => 12, 'communication' => 6]
    ];
    if (isset($q3_mapping[$reponses['q3']])) {
        foreach ($q3_mapping[$reponses['q3']] as $comp => $pts) { $scores[$comp] += $pts; }
    }

    // Q4 - Mode de travail
    $q4_mapping = [
        'seul'   => ['logique' => 8, 'analyse' => 6],
        'equipe' => ['communication' => 9, 'leadership' => 5],
        'leader' => ['leadership' => 12, 'communication' => 6],
        'mixte'  => ['communication' => 6, 'logique' => 5, 'leadership' => 5]
    ];
    if (isset($q4_mapping[$reponses['q4']])) {
        foreach ($q4_mapping[$reponses['q4']] as $comp => $pts) { $scores[$comp] += $pts; }
    }

    // Q5 - Motivation principale
    $q5_mapping = [
        'innovation' => ['creativite' => 10, 'logique' => 5],
        'aider'      => ['communication' => 10, 'leadership' => 5],
        'comprendre' => ['analyse' => 10, 'logique' => 5],
        'reussir'    => ['leadership' => 10, 'analyse' => 5]
    ];
    if (isset($q5_mapping[$reponses['q5']])) {
        foreach ($q5_mapping[$reponses['q5']] as $comp => $pts) { $scores[$comp] += $pts; }
    }

    // Q6 - Durée des études
    $q6_mapping = [
        'court'     => ['logique' => 6, 'communication' => 4],
        'moyen'     => ['leadership' => 5, 'communication' => 4],
        'long'      => ['analyse' => 7, 'logique' => 4],
        'tres_long' => ['analyse' => 8, 'logique' => 5]
    ];
    if (isset($q6_mapping[$reponses['q6']])) {
        foreach ($q6_mapping[$reponses['q6']] as $comp => $pts) { $scores[$comp] += $pts; }
    }
}

// ==========================================
// SCORING POUR ÉTUDIANTS
// ==========================================

else {

    // BASE selon le domaine
    if ($serieOrDomaine === 'Sciences') {
        $scores['logique'] += 15; $scores['analyse'] += 12;
    } elseif ($serieOrDomaine === 'Sante') {
        $scores['analyse'] += 15; $scores['communication'] += 10;
    } elseif ($serieOrDomaine === 'Gestion') {
        $scores['leadership'] += 15; $scores['communication'] += 10;
    } elseif ($serieOrDomaine === 'Lettres') {
        $scores['communication'] += 15; $scores['creativite'] += 12;
    }

    // Q1 - Objectif professionnel
    $q1_mapping = [
        'carriere'     => ['leadership' => 10, 'communication' => 6],
        'entrepreneur' => ['leadership' => 12, 'creativite' => 7],
        'recherche'    => ['analyse' => 12, 'logique' => 7],
        'expert'       => ['analyse' => 10, 'communication' => 6]
    ];
    if (isset($q1_mapping[$reponses['q1']])) {
        foreach ($q1_mapping[$reponses['q1']] as $comp => $pts) { $scores[$comp] += $pts; }
    }

    // Q2 - Compétences (choix multiples)
    $q2_mapping = [
        'technique'      => ['logique' => 10, 'analyse' => 6],
        'relationnelles' => ['communication' => 10, 'leadership' => 5],
        'gestion'        => ['leadership' => 10, 'communication' => 5],
        'creative'       => ['creativite' => 10, 'communication' => 5]
    ];
    foreach (explode(',', $reponses['q2']) as $val) {
        $val = trim($val);
        if (isset($q2_mapping[$val])) {
            foreach ($q2_mapping[$val] as $comp => $pts) { $scores[$comp] += $pts; }
        }
    }

    // Q3 - Environnement de travail
    $q3_mapping = [
        'startup'     => ['creativite' => 10, 'leadership' => 6],
        'grande'      => ['communication' => 9, 'leadership' => 6],
        'academique'  => ['analyse' => 10, 'logique' => 7],
        'independant' => ['creativite' => 9, 'logique' => 6]
    ];
    if (isset($q3_mapping[$reponses['q3']])) {
        foreach ($q3_mapping[$reponses['q3']] as $comp => $pts) { $scores[$comp] += $pts; }
    }

    // Q4 - Valeurs professionnelles
    $q4_mapping = [
        'impact'         => ['communication' => 10, 'analyse' => 5],
        'innovation'     => ['creativite' => 12, 'logique' => 6],
        'stabilite'      => ['logique' => 9, 'analyse' => 6],
        'reconnaissance' => ['leadership' => 10, 'analyse' => 6]
    ];
    if (isset($q4_mapping[$reponses['q4']])) {
        foreach ($q4_mapping[$reponses['q4']] as $comp => $pts) { $scores[$comp] += $pts; }
    }

    // Q5 - Secteur d'activité
    $q5_mapping = [
        'tech'    => ['logique' => 12, 'creativite' => 6],
        'finance' => ['analyse' => 12, 'leadership' => 6],
        'sante'   => ['analyse' => 12, 'communication' => 6],
        'conseil' => ['communication' => 10, 'leadership' => 7]
    ];
    if (isset($q5_mapping[$reponses['q5']])) {
        foreach ($q5_mapping[$reponses['q5']] as $comp => $pts) { $scores[$comp] += $pts; }
    }

    // Q6 - Mobilité professionnelle
    $q6_mapping = [
        'local'         => ['analyse' => 6, 'communication' => 4],
        'national'      => ['leadership' => 7, 'communication' => 6],
        'international' => ['leadership' => 10, 'communication' => 7],
        'remote'        => ['logique' => 9, 'creativite' => 6]
    ];
    if (isset($q6_mapping[$reponses['q6']])) {
        foreach ($q6_mapping[$reponses['q6']] as $comp => $pts) { $scores[$comp] += $pts; }
    }
}

// Normalisation : Cap à 95 max pour éviter les scores irréalistes
foreach ($scores as $key => $value) {
    $scores[$key] = min(95, $value);
}

// Calculer le score global (moyenne pondérée)
$score_global = round(array_sum($scores) / count($scores), 1);

// ============================================
// ENREGISTREMENT EN BASE DE DONNÉES
// ============================================

try {
    $stmt = $pdo->prepare("INSERT INTO test_orientation (id_utilisateur, niveau, serie, domaine, statut, score_global, date_fin) VALUES (?, ?, ?, ?, 'termine', ?, NOW())");
    $stmt->execute([$user_id, $niveau, $serie, $domaine, $score_global]);
    $id_test = $pdo->lastInsertId();
    
    $stmt = $pdo->prepare("INSERT INTO resultat_test (id_test, score_global, score_logique, score_creativite, score_communication, score_analyse, score_leadership) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $id_test,
        $score_global,
        $scores['logique'],
        $scores['creativite'],
        $scores['communication'],
        $scores['analyse'],
        $scores['leadership']
    ]);
    $id_resultat = $pdo->lastInsertId();
    
} catch (PDOException $e) {
    die("Erreur BDD : " . $e->getMessage());
}

// ============================================
// RECOMMANDATIONS DE FILIÈRES (DYNAMIQUES)
// ============================================

// Profils de compétences requises par filière (importance de chaque compétence sur 100)
$filiere_profiles = [
    1  => ['logique' => 90, 'analyse' => 70, 'creativite' => 60, 'communication' => 30, 'leadership' => 40], // Informatique
    2  => ['logique' => 70, 'analyse' => 90, 'creativite' => 40, 'communication' => 80, 'leadership' => 60], // Médecine
    3  => ['logique' => 50, 'analyse' => 80, 'creativite' => 60, 'communication' => 90, 'leadership' => 70], // Droit
    4  => ['logique' => 50, 'analyse' => 70, 'creativite' => 50, 'communication' => 80, 'leadership' => 90], // Gestion
    5  => ['logique' => 80, 'analyse' => 80, 'creativite' => 60, 'communication' => 40, 'leadership' => 60], // Génie Civil
    6  => ['logique' => 30, 'analyse' => 50, 'creativite' => 80, 'communication' => 90, 'leadership' => 70], // Communication
    7  => ['logique' => 80, 'analyse' => 90, 'creativite' => 40, 'communication' => 70, 'leadership' => 50], // Pharmacie
    8  => ['logique' => 40, 'analyse' => 60, 'creativite' => 80, 'communication' => 85, 'leadership' => 75], // Marketing
    9  => ['logique' => 50, 'analyse' => 80, 'creativite' => 60, 'communication' => 90, 'leadership' => 60], // Psychologie
    10 => ['logique' => 70, 'analyse' => 80, 'creativite' => 60, 'communication' => 50, 'leadership' => 50], // Agronomie
    11 => ['logique' => 90, 'analyse' => 90, 'creativite' => 40, 'communication' => 50, 'leadership' => 70], // Finance
    12 => ['logique' => 70, 'analyse' => 60, 'creativite' => 95, 'communication' => 60, 'leadership' => 50], // Architecture
    13 => ['logique' => 80, 'analyse' => 90, 'creativite' => 50, 'communication' => 50, 'leadership' => 40], // Biologie
    14 => ['logique' => 30, 'analyse' => 70, 'creativite' => 80, 'communication' => 90, 'leadership' => 40], // Lettres Modernes
    15 => ['logique' => 90, 'analyse' => 80, 'creativite' => 50, 'communication' => 30, 'leadership' => 50], // Génie Électrique
    16 => ['logique' => 85, 'analyse' => 85, 'creativite' => 30, 'communication' => 50, 'leadership' => 60], // Comptabilité
    17 => ['logique' => 40, 'analyse' => 60, 'creativite' => 50, 'communication' => 90, 'leadership' => 85], // Ressources Humaines
    18 => ['logique' => 40, 'analyse' => 70, 'creativite' => 80, 'communication' => 90, 'leadership' => 60], // Journalisme
    19 => ['logique' => 50, 'analyse' => 60, 'creativite' => 70, 'communication' => 90, 'leadership' => 60], // Sciences de l'Éducation
    20 => ['logique' => 85, 'analyse' => 75, 'creativite' => 60, 'communication' => 50, 'leadership' => 50], // Télécommunications
    21 => ['logique' => 95, 'analyse' => 80, 'creativite' => 70, 'communication' => 40, 'leadership' => 50], // Génie Logiciel
    22 => ['logique' => 50, 'analyse' => 80, 'creativite' => 60, 'communication' => 80, 'leadership' => 85], // Sciences Politiques
    23 => ['logique' => 60, 'analyse' => 85, 'creativite' => 75, 'communication' => 80, 'leadership' => 40], // Philosophie
    24 => ['logique' => 40, 'analyse' => 80, 'creativite' => 60, 'communication' => 85, 'leadership' => 60], // Sociologie
    25 => ['logique' => 85, 'analyse' => 90, 'creativite' => 70, 'communication' => 50, 'leadership' => 50], // Biotechnologie
    26 => ['logique' => 75, 'analyse' => 80, 'creativite' => 50, 'communication' => 80, 'leadership' => 60], // Odontologie
    27 => ['logique' => 85, 'analyse' => 80, 'creativite' => 60, 'communication' => 40, 'leadership' => 50], // Génie Mécanique
    28 => ['logique' => 95, 'analyse' => 90, 'creativite' => 50, 'communication' => 30, 'leadership' => 30], // Mathématiques
    29 => ['logique' => 90, 'analyse' => 90, 'creativite' => 60, 'communication' => 30, 'leadership' => 30], // Physique
    30 => ['logique' => 85, 'analyse' => 90, 'creativite' => 40, 'communication' => 40, 'leadership' => 50], // Statistiques
    31 => ['logique' => 85, 'analyse' => 90, 'creativite' => 50, 'communication' => 60, 'leadership' => 40], // Biochimie
    32 => ['logique' => 70, 'analyse' => 80, 'creativite' => 70, 'communication' => 70, 'leadership' => 50], // Écologie
    33 => ['logique' => 70, 'analyse' => 80, 'creativite' => 60, 'communication' => 70, 'leadership' => 60], // Sciences de l'Environnement
    34 => ['logique' => 50, 'analyse' => 70, 'creativite' => 60, 'communication' => 85, 'leadership' => 85], // Commerce International
    35 => ['logique' => 50, 'analyse' => 70, 'creativite' => 60, 'communication' => 80, 'leadership' => 90], // Management
    36 => ['logique' => 60, 'analyse' => 75, 'creativite' => 50, 'communication' => 70, 'leadership' => 85], // Gestion de Projet
    37 => ['logique' => 80, 'analyse' => 90, 'creativite' => 40, 'communication' => 60, 'leadership' => 70], // Audit
    38 => ['logique' => 55, 'analyse' => 70, 'creativite' => 40, 'communication' => 80, 'leadership' => 85], // Administration des Affaires
];

// Récupérer toutes les filières actives
$stmt_all = $pdo->query("SELECT * FROM filiere WHERE actif = 1");
$all_filieres = $stmt_all->fetchAll(PDO::FETCH_ASSOC);

// Calculer le score de correspondance pour chaque filière selon les scores réels de l'utilisateur
$scored_filieres = [];
foreach ($all_filieres as $filiere) {
    $id = $filiere['id_filiere'];
    $profile = $filiere_profiles[$id] ?? null;

    if ($profile) {
        $numerator = 0;
        $denominator = 0;
        foreach ($profile as $comp => $weight) {
            $user_score = $scores[$comp] ?? 0;
            $numerator   += $weight * $user_score;
            $denominator += $weight * 95; // 95 = score maximum possible par compétence
        }
        $match = $denominator > 0 ? round($numerator / $denominator * 100) : 50;
    } else {
        $match = 50;
    }

    $scored_filieres[] = array_merge($filiere, ['match_score' => $match]);
}

// Trier les filières par score de correspondance décroissant
usort($scored_filieres, fn($a, $b) => $b['match_score'] <=> $a['match_score']);

// Prendre les 3 meilleures filières
$formations = array_slice($scored_filieres, 0, 3);

// Enregistrer les recommandations avec les vrais pourcentages calculés
$rang = 1;
foreach ($formations as $formation) {
    try {
        $stmt = $pdo->prepare("INSERT INTO recommandation (id_resultat, id_filiere, pourcentage_match, rang) VALUES (?, ?, ?, ?)");
        $stmt->execute([$id_resultat, $formation['id_filiere'], $formation['match_score'], $rang]);
    } catch (PDOException $e) {
        // Ignorer doublons
    }
    $rang++;
}


$page_title = "Résultats du Test";
$page_css = "resultats";
include 'includes/header.php';
?>

<div class="page-indicator">
    <div class="dot"></div> 
    Page : Résultats (resultats.php)
</div>

<div class="result-hero">
    <div class="result-badge"> Test Terminé !</div>
    <h1>Vos résultats sont <span>prêts</span></h1>
    <p>Recommandations personnalisées basées sur vos réponses.</p>
</div>



<div class="main-content">
    <div>
        <div class="section-title"> Filières Recommandées</div>
        
        <?php foreach ($formations as $filiere):
            $match = $filiere['match_score'];
        ?>
        <div class="filiere-card" style="cursor:pointer; transition: all 0.3s;" 
             onclick="window.location.href='detail_filiere.php?id=<?php echo $filiere['id_filiere']; ?>'"
             onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.12)'"
             onmouseout="this.style.transform=''; this.style.boxShadow=''">
            <div class="filiere-header">
                <?php if (isEmoji($filiere['icone'])): ?>
                    <div class="filiere-icon"><?php echo $filiere['icone']; ?></div>
                <?php endif; ?>
                <div class="filiere-info">
                    <h4><?php echo htmlspecialchars($filiere['nom_filiere']); ?></h4>
                    <p><?php echo htmlspecialchars($filiere['description']); ?></p>
                </div>
                <div class="filiere-match"><?php echo round($match); ?>% <span>match</span></div>
            </div>
            <div class="filiere-details">
                <div class="filiere-detail-item"><strong>Durée :</strong> <?php echo $filiere['duree_annees']; ?> an(s)</div>
                <div class="filiere-detail-item"><strong>Coût :</strong> <?php echo number_format($filiere['cout_moyen'], 0, ',', ' '); ?> FCFA</div>
                <div class="filiere-detail-item"><strong>Débouchés :</strong> <?php echo htmlspecialchars($filiere['debouches']); ?></div>
            </div>
            <div style="margin-top:16px; padding-top:16px; border-top:2px solid #f3f4f6; text-align:center;">
                <span style="color:#4f86f7; font-weight:700; font-size:14px;">
                     Cliquez pour voir plus de détails
                </span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div>
        <div class="card-box">
            <div class="section-title"> Vos Compétences</div>
            
            <div class="skill-row">
                <span class="skill-label">Logique</span>
                <div class="skill-bar-bg">
                    <div class="skill-bar green" style="width:<?php echo round($scores['logique']); ?>%"></div>
                </div>
                <span class="skill-pct"><?php echo round($scores['logique']); ?>%</span>
            </div>

            <div class="skill-row">
                <span class="skill-label">Créativité</span>
                <div class="skill-bar-bg">
                    <div class="skill-bar orange" style="width:<?php echo round($scores['creativite']); ?>%"></div>
                </div>
                <span class="skill-pct"><?php echo round($scores['creativite']); ?>%</span>
            </div>

            <div class="skill-row">
                <span class="skill-label">Communication</span>
                <div class="skill-bar-bg">
                    <div class="skill-bar blue" style="width:<?php echo round($scores['communication']); ?>%"></div>
                </div>
                <span class="skill-pct"><?php echo round($scores['communication']); ?>%</span>
            </div>

            <div class="skill-row">
                <span class="skill-label">Analyse</span>
                <div class="skill-bar-bg">
                    <div class="skill-bar purple" style="width:<?php echo round($scores['analyse']); ?>%"></div>
                </div>
                <span class="skill-pct"><?php echo round($scores['analyse']); ?>%</span>
            </div>

            <div class="skill-row">
                <span class="skill-label">Leadership</span>
                <div class="skill-bar-bg">
                    <div class="skill-bar green" style="width:<?php echo round($scores['leadership']); ?>%"></div>
                </div>
                <span class="skill-pct"><?php echo round($scores['leadership']); ?>%</span>
            </div>
        </div>

        <div class="card-box">
            <div class="section-title"> Actions</div>
            <div class="action-btns">
                <button class="btn-action-primary" onclick="window.print()">
                     Télécharger PDF
                </button>
                <a href="<?php echo $base_path; ?>/formations.php" class="btn-action">
                     Explorer Filières
                </a>
                <a href="<?php echo $base_path; ?>/test.php" class="btn-action">
                     Refaire Test
                </a>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>