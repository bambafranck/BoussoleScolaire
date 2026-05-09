<?php
/**
 * BoussoleScolaire - Inscription SANS Niveau
 * Fichier: login.php
 * VERSION SIMPLIFIÉE
 */
session_start();
require_once 'config/database.php';

if (isLoggedIn()) {
    if (isAdmin()) {
        redirect('admin.php');
    } else {
        redirect('index.php');
    }
}

$erreur = '';
$succes = '';

// TRAITEMENT CONNEXION
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['connexion'])) {
    $email = securiser($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $erreur = "Veuillez remplir tous les champs.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM administrateur WHERE email = ?");
        $stmt->execute([$email]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['mot_de_passe'])) {
            $_SESSION['user_id']     = $admin['id_admin'];
            $_SESSION['user_nom']    = $admin['nom'];
            $_SESSION['user_prenom'] = $admin['prenom'];
            $_SESSION['user_email']  = $admin['email'];
            $_SESSION['is_admin']    = true;
            $_SESSION['user_role']   = 'admin';
            redirect('admin.php');
        } else {
            $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['mot_de_passe'])) {
                $_SESSION['user_id']     = $user['id_utilisateur'];
                $_SESSION['user_nom']    = $user['nom'];
                $_SESSION['user_prenom'] = $user['prenom'];
                $_SESSION['user_email']  = $user['email'];
                $_SESSION['user_type']   = $user['type_utilisateur'];
                $_SESSION['is_admin']    = false;

                $stmt = $pdo->prepare("UPDATE utilisateur SET derniere_connexion = NOW() WHERE id_utilisateur = ?");
                $stmt->execute([$user['id_utilisateur']]);
                
                redirect('test.php');
            } else {
                $erreur = "Email ou mot de passe incorrect.";
            }
        }
    }
}

// TRAITEMENT INSCRIPTION
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inscription'])) {
    $nom              = securiser($_POST['nom']);
    $prenom           = securiser($_POST['prenom']);
    $email            = securiser($_POST['email']);
    $password         = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $type_utilisateur = securiser($_POST['type_utilisateur']);

    if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($type_utilisateur)) {
        $erreur = "Veuillez remplir tous les champs obligatoires.";
    } elseif ($password !== $password_confirm) {
        $erreur = "Les mots de passe ne correspondent pas.";
    } elseif (strlen($password) < 6) {
        $erreur = "Le mot de passe doit contenir au moins 6 caractères.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = "Email invalide.";
    } else {
        $stmt = $pdo->prepare("SELECT id_utilisateur FROM utilisateur WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $erreur = "Cet email est déjà utilisé.";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO utilisateur (nom, prenom, email, mot_de_passe, type_utilisateur, role) VALUES (?, ?, ?, ?, ?, 'user')");
            
            if ($stmt->execute([$nom, $prenom, $email, $password_hash, $type_utilisateur])) {
                $succes = "Compte créé avec succès ! Vous pouvez maintenant vous connecter.";
            } else {
                $erreur = "Erreur lors de la création du compte.";
            }
        }
    }
}

$page_title = "Connexion";
$page_css   = "login";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - BoussoleScolaire</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/<?php echo $page_css; ?>.css">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <style>
        .input-icon { display:flex; align-items:center; justify-content:center; }
        .input-icon .lucide { width:17px; height:17px; color:#9ca3af; }
        .benefit-icon .lucide { width:20px; height:20px; }
    </style>
</head>
<body>

<div class="page-indicator">
    <i data-lucide="radio" style="width:14px;height:14px;vertical-align:middle;margin-right:6px;"></i>
    Page : Connexion / Inscription (login.php)
</div>

<!-- LEFT PANEL -->
<div class="left-panel">
    <div class="left-content">
        <div class="left-logo">
            <div class="left-logo-icon">
                <i data-lucide="compass" style="width:28px;height:28px;stroke:#fff;stroke-width:2;"></i>
            </div>
            <div class="left-logo-text">Boussole<span>Scolaire</span></div>
        </div>

        <h2>Bienvenue sur<br><span class="grad">votre boussole</span></h2>
        <p>Rejoignez des milliers d'élèves et d'étudiants qui ont déjà trouvé leur meilleure direction.</p>

        <ul class="benefits">
            <li>
                <div class="benefit-icon g">
                    <i data-lucide="target"></i>
                </div>
                <div>
                    <h5>Test Personnalisé</h5>
                    <p>Un test unique adapté à votre profil</p>
                </div>
            </li>
            <li>
                <div class="benefit-icon o">
                    <i data-lucide="bar-chart-2"></i>
                </div>
                <div>
                    <h5>Résultats Détaillés</h5>
                    <p>Des recommandations précises et fiables</p>
                </div>
            </li>
            <li>
                <div class="benefit-icon w">
                    <i data-lucide="save"></i>
                </div>
                <div>
                    <h5>Sauvegarde Automatique</h5>
                    <p>Accédez à vos données n'importe où</p>
                </div>
            </li>
        </ul>
    </div>
</div>

<!-- RIGHT PANEL -->
<div class="right-panel">
    <div class="form-container">

        <?php if ($erreur): ?>
        <div style="display:flex;align-items:center;gap:8px;background:#fee;border:1px solid #fcc;color:#c33;padding:12px;border-radius:8px;margin-bottom:20px;font-size:14px;">
            <i data-lucide="alert-triangle" style="width:16px;height:16px;flex-shrink:0;"></i>
            <?php echo $erreur; ?>
        </div>
        <?php endif; ?>

        <?php if ($succes): ?>
        <div style="display:flex;align-items:center;gap:8px;background:#efe;border:1px solid #cfc;color:#3c3;padding:12px;border-radius:8px;margin-bottom:20px;font-size:14px;">
            <i data-lucide="check-circle" style="width:16px;height:16px;flex-shrink:0;"></i>
            <?php echo $succes; ?>
        </div>
        <?php endif; ?>

        <!-- TABS -->
        <div class="tabs">
            <button class="tab active" id="tab-connexion" onclick="switchTab('connexion')">Connexion</button>
            <button class="tab" id="tab-inscription" onclick="switchTab('inscription')">Inscription</button>
        </div>

        <!-- FORMULAIRE CONNEXION -->
        <form method="POST" id="form-connexion" style="display:block;">
            <h3 class="form-title">Bon retour !</h3>
            <p class="form-sub">Connectez-vous à votre compte</p>

            <div class="input-group">
                <label>Email</label>
                <div class="input-wrap">
                    <span class="input-icon"><i data-lucide="mail"></i></span>
                    <input type="email" name="email" placeholder="votre@email.com" required>
                </div>
            </div>

            <div class="input-group">
                <label>Mot de passe</label>
                <div class="input-wrap">
                    <span class="input-icon"><i data-lucide="lock"></i></span>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <div class="remember-row">
                <label>
                    <input type="checkbox" name="remember"> Se souvenir de moi
                </label>
                <a href="#">Mot de passe oublié ?</a>
            </div>

            <button type="submit" name="connexion" class="btn-form">Se Connecter</button>

            <p class="form-footer">
                Pas de compte ? <a href="#" onclick="switchTab('inscription'); return false;">Créer un compte</a>
            </p>
        </form>

        <!-- FORMULAIRE INSCRIPTION -->
        <form method="POST" id="form-inscription" style="display:none;">
            <h3 class="form-title">Créer un compte</h3>
            <p class="form-sub">Commencez votre aventure</p>

            <div class="input-row">
                <div class="input-group">
                    <label>Prénom</label>
                    <div class="input-wrap">
                        <span class="input-icon"><i data-lucide="user"></i></span>
                        <input type="text" name="prenom" placeholder="Prénom" required>
                    </div>
                </div>
                <div class="input-group">
                    <label>Nom</label>
                    <div class="input-wrap">
                        <span class="input-icon"><i data-lucide="user"></i></span>
                        <input type="text" name="nom" placeholder="Nom" required>
                    </div>
                </div>
            </div>

            <div class="input-group">
                <label>Email</label>
                <div class="input-wrap">
                    <span class="input-icon"><i data-lucide="mail"></i></span>
                    <input type="email" name="email" placeholder="votre@email.com" required>
                </div>
            </div>

            <div class="input-group">
                <label>Je suis...</label>
                <div class="input-wrap">
                    <span class="input-icon"><i data-lucide="users"></i></span>
                    <select name="type_utilisateur" required style="width:100%; padding:13px 16px 13px 42px; border:2px solid #e5e7eb; border-radius:12px; font-size:14px; font-family:'Nunito',sans-serif; background:#fafafa;">
                        <option value="">Sélectionner...</option>
                        <option value="eleve">Élève (Collège/Lycée)</option>
                        <option value="etudiant">Étudiant (Université)</option>
                        <option value="parent">Parent</option>
                    </select>
                </div>
            </div>

            <div class="input-group">
                <label>Mot de passe</label>
                <div class="input-wrap">
                    <span class="input-icon"><i data-lucide="lock"></i></span>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <div class="input-group">
                <label>Confirmer le mot de passe</label>
                <div class="input-wrap">
                    <span class="input-icon"><i data-lucide="lock-keyhole"></i></span>
                    <input type="password" name="password_confirm" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" name="inscription" class="btn-form">Créer mon compte</button>

            <p class="form-footer">
                Déjà un compte ? <a href="#" onclick="switchTab('connexion'); return false;">Se connecter</a>
            </p>
        </form>

    </div>
</div>

<script>
    lucide.createIcons();

    function switchTab(tab) {
        document.getElementById('tab-connexion').classList.remove('active');
        document.getElementById('tab-inscription').classList.remove('active');
        document.getElementById('tab-' + tab).classList.add('active');
        if (tab === 'connexion') {
            document.getElementById('form-connexion').style.display = 'block';
            document.getElementById('form-inscription').style.display = 'none';
        } else {
            document.getElementById('form-connexion').style.display = 'none';
            document.getElementById('form-inscription').style.display = 'block';
        }
    }

    window.onload = function() {
        <?php if (isset($_GET['action']) && $_GET['action'] === 'inscription'): ?>
        switchTab('inscription');
        <?php else: ?>
        switchTab('connexion');
        <?php endif; ?>
    };
</script>
</body>
</html>