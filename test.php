<?php
/**
 * BoussoleScolaire - Test d'Orientation
 * 6 questions ciblées — version allégée
 */

session_start();
require_once 'config/database.php';

if (!isLoggedIn() || isAdmin()) {
    header('Location: login.php');
    exit();
}

$user_id   = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'] ?? 'etudiant';
$base_path = '/BoussoleScolaire';

$page_title = "Test d'Orientation";
$page_css   = "test";
include 'includes/header.php';
?>

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

<style>
    .option-icon .lucide { width:26px; height:26px; }

    .question-section {
        margin-bottom: 28px;
        padding: 20px 24px;
        background: #fafafa;
        border-radius: 12px;
        border-left: 4px solid #4f86f7;
    }

    .question-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px; height: 30px;
        background: #4f86f7;
        color: white;
        border-radius: 50%;
        font-weight: 700;
        margin-right: 10px;
        flex-shrink: 0;
    }

    .question-title {
        font-size: 15px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
    }

    .custom-project-input {
        width: 100%;
        padding: 10px 14px;
        border: 2px solid #ffd4a3;
        border-radius: 6px;
        font-size: 14px;
        outline: none;
        transition: border-color 0.3s;
    }
    .custom-project-input:focus { border-color: #ff8c3a; }

    .custom-project-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #ff8c3a;
        margin-bottom: 8px;
    }

    .option-checkbox {
        width: 20px; height: 20px;
        border: 2px solid #d1d5db;
        border-radius: 4px;
        margin-right: 16px;
        flex-shrink: 0;
        position: relative;
        transition: all 0.3s ease;
    }
    .option.selected .option-checkbox {
        background: linear-gradient(135deg, #4f86f7 0%, #3b82f6 100%);
        border-color: #4f86f7;
    }
    .option.selected .option-checkbox::after {
        content: '';
        position: absolute;
        left: 6px; top: 2px;
        width: 5px; height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }
</style>

<div class="page-indicator">
    <i data-lucide="radio" style="width:14px;height:14px;vertical-align:middle;margin-right:6px;"></i>
    Test d'Orientation — <?php echo ucfirst($user_type); ?>
</div>

<div class="progress-header">
    <div class="progress-top">
        <span class="progress-title">
            <i data-lucide="flask-conical"></i>
            Test d'Orientation — <?php echo $user_type === 'eleve' ? 'Lycéen' : 'Universitaire'; ?>
        </span>
        <span class="progress-count">Étape <span id="current-step">1</span> / <?php echo ($user_type === 'eleve' || $user_type === 'parent') ? '2' : '3'; ?></span>
    </div>
    <div class="progress-bar-bg">
        <div class="progress-bar-fill" id="progress-bar" style="width:<?php echo ($user_type === 'eleve' || $user_type === 'parent') ? '50%' : '33%'; ?>"></div>
    </div>
</div>

<main style="min-height:80vh; padding:100px 60px 60px;">
    <form method="POST" action="resultats.php" id="test-form">

    <?php if ($user_type === 'eleve' || $user_type === 'parent'): ?>

        <!-- ÉLÈVES : Étape 1 — Série -->
        <div class="question-card" id="step-2">
            <div class="question-badge">
                <i data-lucide="bookmark"></i> Série Académique
            </div>
            <h2>Quelle est ta série ?</h2>
            <p class="question-hint">Choisis selon tes forces et tes intérêts</p>

            <div class="options">
                <div class="option" onclick="selectSerie('A', this)">
                    <div class="option-radio"></div>
                    <div class="option-icon"><i data-lucide="book-open" style="color:#4f86f7;"></i></div>
                    <div>
                        <div class="option-text">Série A — Littéraire</div>
                        <div style="font-size:12px;color:#9ca3af;margin-top:4px;">Lettres, Philosophie, Langues, Histoire-Géo</div>
                    </div>
                </div>
                <div class="option" onclick="selectSerie('C', this)">
                    <div class="option-radio"></div>
                    <div class="option-icon"><i data-lucide="sigma" style="color:#00c878;"></i></div>
                    <div>
                        <div class="option-text">Série C — Mathématiques</div>
                        <div style="font-size:12px;color:#9ca3af;margin-top:4px;">Maths, Physique-Chimie, Sciences</div>
                    </div>
                </div>
                <div class="option" onclick="selectSerie('D', this)">
                    <div class="option-radio"></div>
                    <div class="option-icon"><i data-lucide="dna" style="color:#f43f5e;"></i></div>
                    <div>
                        <div class="option-text">Série D — Sciences de la Vie</div>
                        <div style="font-size:12px;color:#9ca3af;margin-top:4px;">SVT, Biologie, Chimie, Physique</div>
                    </div>
                </div>
                <div class="option" onclick="selectSerie('G', this)">
                    <div class="option-radio"></div>
                    <div class="option-icon"><i data-lucide="briefcase" style="color:#ff8c3a;"></i></div>
                    <div>
                        <div class="option-text">Série G — Économie et Gestion</div>
                        <div style="font-size:12px;color:#9ca3af;margin-top:4px;">Comptabilité, Économie, Gestion</div>
                    </div>
                </div>
            </div>

            <div class="question-nav">
                <div></div>
                <button type="button" class="btn-next" onclick="goToStep3()">Suivante</button>
            </div>
        </div>

        <!-- ÉLÈVES : Étape 2 — 6 questions -->
        <div class="question-card" id="step-3" style="display:none;">
            <div class="question-badge">
                <i data-lucide="help-circle"></i> 6 Questions — Profil
            </div>
            <h2>Découvrons ton profil</h2>
            <p class="question-hint">6 questions pour une orientation précise</p>

            <!-- Q1 -->
            <div class="question-section">
                <div class="question-title">
                    <span class="question-number">1</span>
                    Quelles matières trouves-tu les plus faciles et agréables ?
                    <span style="font-size:12px;font-weight:500;color:#ff8c3a;margin-left:10px;background:#fff5eb;padding:4px 10px;border-radius:12px;">Choix multiples</span>
                </div>
                <div class="options">
                    <div class="option" onclick="toggleMultipleAnswer('q1','maths',this)">
                        <div class="option-checkbox"></div>
                        <div class="option-icon"><i data-lucide="calculator" style="color:#00c878;"></i></div>
                        <div class="option-text">Mathématiques et Sciences</div>
                    </div>
                    <div class="option" onclick="toggleMultipleAnswer('q1','lettres',this)">
                        <div class="option-checkbox"></div>
                        <div class="option-icon"><i data-lucide="book-open" style="color:#4f86f7;"></i></div>
                        <div class="option-text">Français, Littérature, Langues, Philo</div>
                    </div>
                    <div class="option" onclick="toggleMultipleAnswer('q1','eco',this)">
                        <div class="option-checkbox"></div>
                        <div class="option-icon"><i data-lucide="trending-up" style="color:#ff8c3a;"></i></div>
                        <div class="option-text">Économie, Gestion, Comptabilité</div>
                    </div>
                    <div class="option" onclick="toggleMultipleAnswer('q1','histoire',this)">
                        <div class="option-checkbox"></div>
                        <div class="option-icon"><i data-lucide="map" style="color:#a855f7;"></i></div>
                        <div class="option-text">Histoire-Géographie, Sciences sociales</div>
                    </div>
                </div>
            </div>

            <!-- Q2 -->
            <div class="question-section">
                <div class="question-title">
                    <span class="question-number">2</span>
                    Quelles activités préfères-tu en dehors de l'école ?
                    <span style="font-size:12px;font-weight:500;color:#ff8c3a;margin-left:10px;background:#fff5eb;padding:4px 10px;border-radius:12px;">Choix multiples</span>
                </div>
                <div class="options">
                    <div class="option" onclick="toggleMultipleAnswer('q2','techno',this)">
                        <div class="option-checkbox"></div>
                        <div class="option-icon"><i data-lucide="laptop" style="color:#4f86f7;"></i></div>
                        <div class="option-text">Informatique, nouvelles technologies</div>
                    </div>
                    <div class="option" onclick="toggleMultipleAnswer('q2','culture',this)">
                        <div class="option-checkbox"></div>
                        <div class="option-icon"><i data-lucide="music" style="color:#f43f5e;"></i></div>
                        <div class="option-text">Lecture, écriture, arts, musique</div>
                    </div>
                    <div class="option" onclick="toggleMultipleAnswer('q2','sport',this)">
                        <div class="option-checkbox"></div>
                        <div class="option-icon"><i data-lucide="heart-pulse" style="color:#00c878;"></i></div>
                        <div class="option-text">Sport, activités physiques</div>
                    </div>
                    <div class="option" onclick="toggleMultipleAnswer('q2','social',this)">
                        <div class="option-checkbox"></div>
                        <div class="option-icon"><i data-lucide="users" style="color:#ff8c3a;"></i></div>
                        <div class="option-text">Bénévolat, débats, activités sociales</div>
                    </div>
                </div>
            </div>

            <!-- Q3 — Projet pro + champ libre -->
            <div class="question-section">
                <div class="question-title">
                    <span class="question-number">3</span>
                    Plus tard, tu te vois dans quel secteur ?
                </div>
                <div class="options">
                    <div class="option" onclick="selectAnswer('q3','tech',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="cpu" style="color:#00c878;"></i></div>
                        <div class="option-text">Technologie, ingénierie, innovation</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q3','sante',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="stethoscope" style="color:#f43f5e;"></i></div>
                        <div class="option-text">Santé, médecine, sciences de la vie</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q3','communication',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="megaphone" style="color:#4f86f7;"></i></div>
                        <div class="option-text">Communication, enseignement, écriture</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q3','business',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="briefcase" style="color:#ff8c3a;"></i></div>
                        <div class="option-text">Business, commerce, management</div>
                    </div>
                </div>
                <div style="margin-top:16px; padding:14px; background:#fff5eb; border-radius:8px; border-left:3px solid #ff8c3a;">
                    <label class="custom-project-label">
                        <i data-lucide="lightbulb" style="width:13px;height:13px;vertical-align:middle;margin-right:5px;"></i>
                        Ou décris ton projet si tu ne le trouves pas ci-dessus
                    </label>
                    <input type="text" id="custom-project-eleve" class="custom-project-input"
                        placeholder="Ex: Pilote d'avion, ONG internationale, Mode..."
                        onkeyup="handleCustomProject(this.value)">
                </div>
            </div>

            <!-- Q4 -->
            <div class="question-section">
                <div class="question-title">
                    <span class="question-number">4</span>
                    Comment préfères-tu travailler ?
                </div>
                <div class="options">
                    <div class="option" onclick="selectAnswer('q4','seul',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="user" style="color:#4f86f7;"></i></div>
                        <div class="option-text">Seul, de façon autonome</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q4','equipe',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="users" style="color:#00c878;"></i></div>
                        <div class="option-text">En équipe, en collaborant</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q4','leader',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="crown" style="color:#ff8c3a;"></i></div>
                        <div class="option-text">En dirigeant un groupe</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q4','mixte',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="shuffle" style="color:#a855f7;"></i></div>
                        <div class="option-text">Ça dépend du contexte</div>
                    </div>
                </div>
            </div>

            <!-- Q5 -->
            <div class="question-section">
                <div class="question-title">
                    <span class="question-number">5</span>
                    Qu'est-ce qui te motive le plus dans un métier ?
                </div>
                <div class="options">
                    <div class="option" onclick="selectAnswer('q5','innovation',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="rocket" style="color:#ff8c3a;"></i></div>
                        <div class="option-text">Innover, créer de nouvelles solutions</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q5','aider',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="heart" style="color:#f43f5e;"></i></div>
                        <div class="option-text">Aider les autres, avoir un impact</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q5','comprendre',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="brain" style="color:#a855f7;"></i></div>
                        <div class="option-text">Comprendre, analyser, résoudre</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q5','reussir',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="trophy" style="color:#00c878;"></i></div>
                        <div class="option-text">Réussir et bien gagner ma vie</div>
                    </div>
                </div>
            </div>

            <!-- Q6 -->
            <div class="question-section">
                <div class="question-title">
                    <span class="question-number">6</span>
                    Combien d'années d'études après le Bac envisages-tu ?
                </div>
                <div class="options">
                    <div class="option" onclick="selectAnswer('q6','court',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="zap" style="color:#ff8c3a;"></i></div>
                        <div class="option-text">2-3 ans — BTS, DUT, Licence pro</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q6','moyen',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="graduation-cap" style="color:#4f86f7;"></i></div>
                        <div class="option-text">3-5 ans — Licence, Master</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q6','long',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="book-open" style="color:#00c878;"></i></div>
                        <div class="option-text">5-7 ans — Master spécialisé, Ingénieur</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q6','tres_long',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="award" style="color:#a855f7;"></i></div>
                        <div class="option-text">8+ ans — Médecine, Doctorat</div>
                    </div>
                </div>
            </div>

            <div class="question-nav" style="margin-top:24px;">
                <button type="button" class="btn-prev" onclick="goToStep2()">Précédente</button>
                <button type="button" class="btn-next" onclick="submitForm()">Voir mes résultats</button>
            </div>
        </div>

    <?php else: // ÉTUDIANTS ?>

        <!-- ÉTUDIANTS : Étape 1 — Niveau -->
        <div class="question-card" id="step-1">
            <div class="question-badge">
                <i data-lucide="graduation-cap"></i> Niveau Universitaire
            </div>
            <h2>Quel est ton niveau d'études actuel ?</h2>
            <p class="question-hint">Sélectionne ton cycle universitaire</p>

            <div class="options">
                <div class="option" onclick="selectNiveau('L3',this)">
                    <div class="option-radio"></div>
                    <div class="option-icon"><i data-lucide="award" style="color:#00c878;"></i></div>
                    <div>
                        <div class="option-text">Licence 3 (L3)</div>
                        <div style="font-size:12px;color:#9ca3af;margin-top:4px;">Dernière année de licence</div>
                    </div>
                </div>
                <div class="option" onclick="selectNiveau('M2',this)">
                    <div class="option-radio"></div>
                    <div class="option-icon"><i data-lucide="trophy" style="color:#ff8c3a;"></i></div>
                    <div>
                        <div class="option-text">Master 2 (M2)</div>
                        <div style="font-size:12px;color:#9ca3af;margin-top:4px;">Dernière année de master</div>
                    </div>
                </div>
                <div class="option" onclick="selectNiveau('Doctorat',this)">
                    <div class="option-radio"></div>
                    <div class="option-icon"><i data-lucide="graduation-cap" style="color:#a855f7;"></i></div>
                    <div>
                        <div class="option-text">Doctorat</div>
                        <div style="font-size:12px;color:#9ca3af;margin-top:4px;">Études doctorales</div>
                    </div>
                </div>
                <div class="option" onclick="selectNiveau('BTS',this)">
                    <div class="option-radio"></div>
                    <div class="option-icon"><i data-lucide="briefcase" style="color:#4f86f7;"></i></div>
                    <div>
                        <div class="option-text">BTS / DUT</div>
                        <div style="font-size:12px;color:#9ca3af;margin-top:4px;">Formation professionnelle courte</div>
                    </div>
                </div>
            </div>

            <div class="question-nav">
                <div></div>
                <button type="button" class="btn-next" onclick="goToStep2()">Suivante</button>
            </div>
        </div>

        <!-- ÉTUDIANTS : Étape 2 — Domaine -->
        <div class="question-card" id="step-2" style="display:none;">
            <div class="question-badge">
                <i data-lucide="compass"></i> Domaine d'Études
            </div>
            <h2>Dans quel domaine étudies-tu ?</h2>
            <p class="question-hint">Choisis le domaine le plus proche de ta formation</p>

            <div class="options">
                <div class="option" onclick="selectDomaine('Sciences',this)">
                    <div class="option-radio"></div>
                    <div class="option-icon"><i data-lucide="atom" style="color:#4f86f7;"></i></div>
                    <div>
                        <div class="option-text">Sciences & Technologies</div>
                        <div style="font-size:12px;color:#9ca3af;margin-top:4px;">Informatique, Ingénierie, Maths, Physique</div>
                    </div>
                </div>
                <div class="option" onclick="selectDomaine('Sante',this)">
                    <div class="option-radio"></div>
                    <div class="option-icon"><i data-lucide="heart-pulse" style="color:#f43f5e;"></i></div>
                    <div>
                        <div class="option-text">Santé & Sciences de la Vie</div>
                        <div style="font-size:12px;color:#9ca3af;margin-top:4px;">Médecine, Pharmacie, Biologie</div>
                    </div>
                </div>
                <div class="option" onclick="selectDomaine('Gestion',this)">
                    <div class="option-radio"></div>
                    <div class="option-icon"><i data-lucide="trending-up" style="color:#00c878;"></i></div>
                    <div>
                        <div class="option-text">Gestion & Commerce</div>
                        <div style="font-size:12px;color:#9ca3af;margin-top:4px;">Management, Finance, Marketing</div>
                    </div>
                </div>
                <div class="option" onclick="selectDomaine('Lettres',this)">
                    <div class="option-radio"></div>
                    <div class="option-icon"><i data-lucide="book-open" style="color:#a855f7;"></i></div>
                    <div>
                        <div class="option-text">Lettres & Sciences Humaines</div>
                        <div style="font-size:12px;color:#9ca3af;margin-top:4px;">Droit, Communication, Langues, Psychologie</div>
                    </div>
                </div>
            </div>

            <div class="question-nav">
                <button type="button" class="btn-prev" onclick="goToStep1()">Précédente</button>
                <button type="button" class="btn-next" onclick="goToStep3()">Suivante</button>
            </div>
        </div>

        <!-- ÉTUDIANTS : Étape 3 — 6 questions -->
        <div class="question-card" id="step-3" style="display:none;">
            <div class="question-badge">
                <i data-lucide="target"></i> 6 Questions — Profil
            </div>
            <h2>Affine ton projet professionnel</h2>
            <p class="question-hint">6 questions pour des recommandations précises</p>

            <!-- Q1 — Objectif + champ libre -->
            <div class="question-section">
                <div class="question-title">
                    <span class="question-number">1</span>
                    Quel est ton objectif principal après tes études ?
                </div>
                <div class="options">
                    <div class="option" onclick="selectAnswer('q1','carriere',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="building" style="color:#4f86f7;"></i></div>
                        <div class="option-text">Intégrer une grande entreprise</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q1','entrepreneur',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="rocket" style="color:#ff8c3a;"></i></div>
                        <div class="option-text">Créer ma propre entreprise / Startup</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q1','recherche',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="microscope" style="color:#a855f7;"></i></div>
                        <div class="option-text">Recherche académique / Enseigner</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q1','expert',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="award" style="color:#00c878;"></i></div>
                        <div class="option-text">Devenir expert / Consultant</div>
                    </div>
                </div>
                <div style="margin-top:16px; padding:14px; background:#eff6ff; border-radius:8px; border-left:3px solid #4f86f7;">
                    <label class="custom-project-label" style="color:#4f86f7;">
                        <i data-lucide="target" style="width:13px;height:13px;vertical-align:middle;margin-right:5px;"></i>
                        Ou décris ton objectif si tu ne le trouves pas ci-dessus
                    </label>
                    <input type="text" id="custom-project-etudiant" class="custom-project-input"
                        placeholder="Ex: ONG internationale, analyste financier, fintech..."
                        style="border-color:#bfdbfe;"
                        onkeyup="handleCustomProject(this.value)">
                </div>
            </div>

            <!-- Q2 — Compétences (choix multiples) -->
            <div class="question-section">
                <div class="question-title">
                    <span class="question-number">2</span>
                    Dans quelles compétences excelles-tu ?
                    <span style="font-size:12px;font-weight:500;color:#ff8c3a;margin-left:10px;background:#fff5eb;padding:4px 10px;border-radius:12px;">
                        Choix multiples
                    </span>
                </div>
                <div class="options" id="q2-options">
                    <div class="option" onclick="toggleMultipleAnswer('q2','technique',this)">
                        <div class="option-checkbox"></div>
                        <div class="option-icon"><i data-lucide="code" style="color:#00c878;"></i></div>
                        <div class="option-text">Compétences techniques (programmation, calcul, analyse)</div>
                    </div>
                    <div class="option" onclick="toggleMultipleAnswer('q2','relationnelles',this)">
                        <div class="option-checkbox"></div>
                        <div class="option-icon"><i data-lucide="handshake" style="color:#4f86f7;"></i></div>
                        <div class="option-text">Compétences relationnelles (communication, négociation)</div>
                    </div>
                    <div class="option" onclick="toggleMultipleAnswer('q2','gestion',this)">
                        <div class="option-checkbox"></div>
                        <div class="option-icon"><i data-lucide="layout-dashboard" style="color:#ff8c3a;"></i></div>
                        <div class="option-text">Gestion de projet (organisation, planification)</div>
                    </div>
                    <div class="option" onclick="toggleMultipleAnswer('q2','creative',this)">
                        <div class="option-checkbox"></div>
                        <div class="option-icon"><i data-lucide="palette" style="color:#a855f7;"></i></div>
                        <div class="option-text">Créativité (design, innovation, stratégie)</div>
                    </div>
                </div>
            </div>

            <!-- Q3 -->
            <div class="question-section">
                <div class="question-title">
                    <span class="question-number">3</span>
                    Quel environnement de travail te correspond ?
                </div>
                <div class="options">
                    <div class="option" onclick="selectAnswer('q3','startup',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="zap" style="color:#ff8c3a;"></i></div>
                        <div class="option-text">Startup / PME innovante</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q3','grande',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="building-2" style="color:#4f86f7;"></i></div>
                        <div class="option-text">Grande entreprise / Multinationale</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q3','academique',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="school" style="color:#a855f7;"></i></div>
                        <div class="option-text">Université / Laboratoire de recherche</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q3','independant',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="user" style="color:#00c878;"></i></div>
                        <div class="option-text">Freelance / Indépendant</div>
                    </div>
                </div>
            </div>

            <!-- Q4 -->
            <div class="question-section">
                <div class="question-title">
                    <span class="question-number">4</span>
                    Qu'est-ce qui est le plus important pour toi dans ton travail ?
                </div>
                <div class="options">
                    <div class="option" onclick="selectAnswer('q4','impact',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="heart" style="color:#f43f5e;"></i></div>
                        <div class="option-text">Avoir un impact positif sur la société</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q4','innovation',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="lightbulb" style="color:#ff8c3a;"></i></div>
                        <div class="option-text">Innover et créer de nouvelles solutions</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q4','stabilite',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="shield" style="color:#4f86f7;"></i></div>
                        <div class="option-text">Sécurité de l'emploi et stabilité</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q4','reconnaissance',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="star" style="color:#00c878;"></i></div>
                        <div class="option-text">Reconnaissance et expertise professionnelle</div>
                    </div>
                </div>
            </div>

            <!-- Q5 -->
            <div class="question-section">
                <div class="question-title">
                    <span class="question-number">5</span>
                    Quel secteur t'attire le plus ?
                </div>
                <div class="options">
                    <div class="option" onclick="selectAnswer('q5','tech',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="cpu" style="color:#4f86f7;"></i></div>
                        <div class="option-text">Tech / Digital / Innovation</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q5','finance',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="trending-up" style="color:#00c878;"></i></div>
                        <div class="option-text">Finance / Banque / Assurance</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q5','sante',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="heart-pulse" style="color:#f43f5e;"></i></div>
                        <div class="option-text">Santé / Médical / Recherche</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q5','conseil',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="briefcase" style="color:#ff8c3a;"></i></div>
                        <div class="option-text">Conseil / Audit / Stratégie</div>
                    </div>
                </div>
            </div>

            <!-- Q6 -->
            <div class="question-section">
                <div class="question-title">
                    <span class="question-number">6</span>
                    Quelle mobilité professionnelle envisages-tu ?
                </div>
                <div class="options">
                    <div class="option" onclick="selectAnswer('q6','local',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="home" style="color:#4f86f7;"></i></div>
                        <div class="option-text">Rester dans ma région</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q6','national',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="map" style="color:#00c878;"></i></div>
                        <div class="option-text">Mobilité nationale</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q6','international',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="globe" style="color:#ff8c3a;"></i></div>
                        <div class="option-text">Mobilité internationale</div>
                    </div>
                    <div class="option" onclick="selectAnswer('q6','remote',this)">
                        <div class="option-radio"></div>
                        <div class="option-icon"><i data-lucide="laptop" style="color:#a855f7;"></i></div>
                        <div class="option-text">Full remote (travail à distance)</div>
                    </div>
                </div>
            </div>

            <div class="question-nav" style="margin-top:24px;">
                <button type="button" class="btn-prev" onclick="goToStep2()">Précédente</button>
                <button type="button" class="btn-next" onclick="submitForm()">Voir mes résultats</button>
            </div>
        </div>

    <?php endif; ?>

        <!-- Champs cachés -->
        <input type="hidden" name="user_type"     value="<?php echo htmlspecialchars($user_type); ?>">
        <input type="hidden" name="niveau"         id="niveau-input" value="<?php echo ($user_type === 'eleve' || $user_type === 'parent') ? 'Terminale' : ''; ?>">
        <input type="hidden" name="serie"          id="serie-input" value="">
        <input type="hidden" name="domaine"        id="domaine-input" value="">
        <input type="hidden" name="q1"             id="q1-input" value="">
        <input type="hidden" name="q2"             id="q2-input" value="">
        <input type="hidden" name="q3"             id="q3-input" value="">
        <input type="hidden" name="q4"             id="q4-input" value="">
        <input type="hidden" name="q5"             id="q5-input" value="">
        <input type="hidden" name="q6"             id="q6-input" value="">
        <input type="hidden" name="custom_project" id="custom-project-input" value="">
    </form>
</main>

<script>
    lucide.createIcons();

    const isEleve = <?php echo ($user_type === 'eleve' || $user_type === 'parent') ? 'true' : 'false'; ?>;
    let niveau = isEleve ? 'Terminale' : '';
    let serieOrDomaine = '';
    let answers = { q1:'', q2:'', q3:'', q4:'', q5:'', q6:'' };
    let customProject = '';
    let multipleAnswers = isEleve ? { q1: [], q2: [] } : { q2: [] };

    function selectNiveau(val, el) {
        document.querySelectorAll('#step-1 .option').forEach(o => o.classList.remove('selected'));
        el.classList.add('selected');
        niveau = val;
        document.getElementById('niveau-input').value = val;
    }

    function selectSerie(val, el) {
        document.querySelectorAll('#step-2 .option').forEach(o => o.classList.remove('selected'));
        el.classList.add('selected');
        serieOrDomaine = val;
        document.getElementById('serie-input').value = val;
        document.getElementById('domaine-input').value = '';
    }

    function selectDomaine(val, el) {
        document.querySelectorAll('#step-2 .option').forEach(o => o.classList.remove('selected'));
        el.classList.add('selected');
        serieOrDomaine = val;
        document.getElementById('domaine-input').value = val;
        document.getElementById('serie-input').value = '';
    }

    function selectAnswer(question, val, el) {
        el.closest('.options').querySelectorAll('.option').forEach(o => o.classList.remove('selected'));
        el.classList.add('selected');
        answers[question] = val;
        document.getElementById(question + '-input').value = val;
    }

    function toggleMultipleAnswer(question, val, el) {
        el.classList.toggle('selected');
        const idx = multipleAnswers[question].indexOf(val);
        if (idx > -1) multipleAnswers[question].splice(idx, 1);
        else multipleAnswers[question].push(val);
        const joined = multipleAnswers[question].join(',');
        answers[question] = joined;
        document.getElementById(question + '-input').value = joined;
    }

    function handleCustomProject(value) {
        customProject = value.trim();
        document.getElementById('custom-project-input').value = customProject;
    }

    function goToStep1() {
        document.getElementById('step-1').style.display = 'block';
        document.getElementById('step-2').style.display = 'none';
        if (document.getElementById('step-3')) document.getElementById('step-3').style.display = 'none';
        document.getElementById('current-step').textContent = '1';
        document.getElementById('progress-bar').style.width = '33%';
        window.scrollTo(0, 0);
        lucide.createIcons();
    }

    function goToStep2() {
        if (!isEleve && !niveau) { alert('Sélectionne ton niveau'); return; }
        if (document.getElementById('step-1')) document.getElementById('step-1').style.display = 'none';
        document.getElementById('step-2').style.display = 'block';
        if (document.getElementById('step-3')) document.getElementById('step-3').style.display = 'none';
        document.getElementById('current-step').textContent = isEleve ? '1' : '2';
        document.getElementById('progress-bar').style.width = isEleve ? '50%' : '66%';
        window.scrollTo(0, 0);
        lucide.createIcons();
    }

    function goToStep3() {
        if (!serieOrDomaine) { alert('Fais une sélection'); return; }
        if (document.getElementById('step-1')) document.getElementById('step-1').style.display = 'none';
        document.getElementById('step-2').style.display = 'none';
        document.getElementById('step-3').style.display = 'block';
        document.getElementById('current-step').textContent = isEleve ? '2' : '3';
        document.getElementById('progress-bar').style.width = '100%';
        window.scrollTo(0, 0);
        lucide.createIcons();
    }

    function submitForm() {
        const isEtudiant = !isEleve;

        for (let i = 1; i <= 6; i++) {
            const q = 'q' + i;
            const isMultiple = multipleAnswers.hasOwnProperty(q);
            if (isMultiple) {
                if (multipleAnswers[q].length === 0) {
                    alert('Question ' + i + ' : sélectionne au moins une option !');
                    return;
                }
            } else if (!answers[q]) {
                alert('Question ' + i + ' non répondue !');
                return;
            }
        }

        if (!niveau || !serieOrDomaine) { alert('Données manquantes'); return; }
        document.getElementById('test-form').submit();
    }
</script>

<?php include 'includes/footer.php'; ?>
