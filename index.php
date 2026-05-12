<?php
/**
 * BoussoleScolaire - Page d'Accueil
 * Fichier: index.php
 */

session_start();

$page_title = "Accueil";
$page_css   = "index";

include 'includes/header.php';
// Note: header.php charge déjà Lucide et appelle lucide.createIcons()
// Si ce n'est pas encore le cas, le script est chargé ici en fallback.
?>

<div class="page-indicator">
    <i data-lucide="radio" style="width:14px;height:14px;vertical-align:middle;margin-right:6px;"></i>
    Page : Accueil (index.php)
</div>

<!-- HERO -->
<section class="hero">
    <div class="hero-blob1"></div>
    <div class="hero-blob2"></div>
    <div class="hero-content">
        <div class="hero-text">
            <div class="hero-badge">
                <div class="dot"></div> Orientez-vous avec confiance
            </div>
            <h1>Découvrez votre<br><span class="highlight">meilleure direction</span><br>scolaire</h1>
            <p>BoussoleScolaire vous aide à choisir la bonne filière et la meilleure formation grâce à un test d'orientation personnel et des recommandations adaptées à votre profil.</p>
            <div class="hero-btns">
                <a href="<?php echo $base_path; ?>/test.php" class="btn-primary">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right:6px;">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    Faire le Test
                </a>
                <a href="<?php echo $base_path; ?>/filieres.php" class="btn-secondary">Explorer les Filières</a>
            </div>
        </div>
        <div class="hero-visual">
            <div class="compass-card">
                <div class="compass-icon">
                    <svg width="64" height="64" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16.016a7.5 7.5 0 0 0 1.962-14.74A1 1 0 0 0 9 0H7a1 1 0 0 0-.962 1.276A7.5 7.5 0 0 0 8 16.016zm6.5-7.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                        <path d="m6.94 7.44 4.95-2.83-2.83 4.95-4.949 2.83 2.828-4.95z"/>
                    </svg>
                </div>
                <h3>Votre Orientation</h3>
                <p>Résultat basé sur votre profil unique</p>
            </div>
            <div class="floating-tag tag1">
                <span class="tag-icon">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                    </svg>
                </span> +500 Filières
            </div>
            <div class="floating-tag tag2">
                <span class="tag-icon">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
                        <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/>
                    </svg>
                </span> 200+ Établissements
            </div>
            <div class="floating-tag tag3">
                <span class="tag-icon">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                </span> 98% Satisfaits
            </div>
        </div>
    </div>
</section>

<!-- STATS -->
<div class="stats">
    <div class="stat-item">
        <div class="stat-number">5000+</div>
        <div class="stat-label">Élèves orientés</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">500+</div>
        <div class="stat-label">Filières disponibles</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">200+</div>
        <div class="stat-label">Établissements partenaires</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">98%</div>
        <div class="stat-label">Taux de satisfaction</div>
    </div>
</div>

<!-- COMMENT ÇA MARCHE -->
<section class="section section-alt">
    <div class="section-label">
        <i data-lucide="map-pin" style="width:15px;height:15px;vertical-align:middle;margin-right:5px;"></i>
        Comment ça marche
    </div>
    <h2 class="section-title">En 3 étapes simples</h2>
    <p class="section-sub">Un processus rapide et simple pour vous orienter vers la meilleure direction.</p>
    <div class="steps">
        <div class="step-card">
            <div class="step-number">1</div>
            <div class="icon">
                <svg width="40" height="40" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
            </div>
            <h4>Créer un Compte</h4>
            <p>Inscrivez-vous gratuitement et créez votre profil en quelques secondes.</p>
        </div>
        <div class="step-card">
            <div class="step-number">2</div>
            <div class="icon">
                <svg width="40" height="40" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
                </svg>
            </div>
            <h4>Faire le Test</h4>
            <p>Répondez à notre test d'orientation pour révéler vos forces et intérêts.</p>
        </div>
        <div class="step-card">
            <div class="step-number">3</div>
            <div class="icon">
                <svg width="40" height="40" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16.016a7.5 7.5 0 0 0 1.962-14.74A1 1 0 0 0 9 0H7a1 1 0 0 0-.962 1.276A7.5 7.5 0 0 0 8 16.016zm6.5-7.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                    <path d="m6.94 7.44 4.95-2.83-2.83 4.95-4.949 2.83 2.828-4.95z"/>
                </svg>
            </div>
            <h4>Obtenir les Résultats</h4>
            <p>Recevez des recommandations personnalisées de filières et formations.</p>
        </div>
    </div>
</section>

<!-- SERVICES -->
<section class="section">
    <div class="section-label">
        <i data-lucide="sparkles" style="width:15px;height:15px;vertical-align:middle;margin-right:5px;"></i>
        Nos Services
    </div>
    <h2 class="section-title">Ce que nous vous offrons</h2>
    <p class="section-sub">Des outils puissants pour vous aider à prendre les meilleures décisions.</p>
    <div class="features">
        <div class="feature-card green">
            <div class="feature-icon">
                <svg width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16.016a7.5 7.5 0 0 0 1.962-14.74A1 1 0 0 0 9 0H7a1 1 0 0 0-.962 1.276A7.5 7.5 0 0 0 8 16.016zm6.5-7.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                    <path d="m6.94 7.44 4.95-2.83-2.83 4.95-4.949 2.83 2.828-4.95z"/>
                </svg>
            </div>
            <h4>Test d'Orientation</h4>
            <p>Un test personnel basé sur vos intérêts, vos compétences et vos objectifs pour vous guider vers la meilleure filière.</p>
        </div>
        <div class="feature-card orange">
            <div class="feature-icon">
                <svg width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"/>
                </svg>
            </div>
            <h4>Comparer les Formations</h4>
            <p>Comparez plusieurs formations côte à côte pour faire un choix éclairé et adapté à vos besoins.</p>
        </div>
        <div class="feature-card dark-card">
            <div class="feature-icon" style="display:flex;align-items:center;gap:10px;">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/>
                    <polyline points="7 3 7 8 15 8"/>
                </svg>
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="7 10 12 15 17 10"/>
                    <line x1="12" y1="15" x2="12" y2="3"/>
                </svg>
            </div>
            <h4>Sauvegarder &amp; Télécharger</h4>
            <p>Sauvegardez vos formations préférées et téléchargez vos résultats au format PDF pour les consulter.</p>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <h2>Prêt à trouver votre <span>direction ?</span></h2>
    <p>Commencez dès aujourd'hui et découvrez les meilleures opportunités pour votre avenir.</p>
    <a href="<?php echo isset($_SESSION['user_id']) ? $base_path . '/test.php' : $base_path . '/login.php'; ?>" class="btn-primary">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right:6px;">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
        </svg>
        Commencer Gratuitement
    </a>
</section>

<?php include 'includes/footer.php'; ?>