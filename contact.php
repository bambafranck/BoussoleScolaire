<?php
/**
 * BoussoleScolaire - Page Contact
 * Fichier: contact.php
 */

session_start();
require_once 'config/database.php';

$page_title = "Contact";
$page_css = "contact";

// Traitement du formulaire
$message_envoye = false;
$erreur = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérification du jeton CSRF
    if (!isset($_POST['csrf_token']) || !verifyCSRFToken($_POST['csrf_token'])) {
        $erreur = "Erreur de sécurité. Veuillez réessayer.";
        logError("Tentative CSRF détectée sur le formulaire de contact", ['ip' => $_SERVER['REMOTE_ADDR']]);
    } else {
        $nom = securiser($_POST['nom']);
        $email = securiser($_POST['email']);
        $sujet = securiser($_POST['sujet']);
        $message = securiser($_POST['message']);

        // Validation des champs vides
        if (empty($nom) || empty($email) || empty($sujet) || empty($message)) {
            $erreur = "Veuillez remplir tous les champs.";
        }
        // Validation de l'email
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreur = "Email invalide.";
        }
        // Validation des longueurs
        elseif ($error = validateLength($nom, 2, 100, 'Le nom')) {
            $erreur = $error;
        }
        elseif ($error = validateLength($email, 5, 255, 'L\'email')) {
            $erreur = $error;
        }
        elseif ($error = validateLength($sujet, 3, 200, 'Le sujet')) {
            $erreur = $error;
        }
        elseif ($error = validateLength($message, 10, 2000, 'Le message')) {
            $erreur = $error;
        }
        else {
            // Enregistrement dans la base de données
            try {
                $stmt = $pdo->prepare("
                    INSERT INTO contact_messages
                    (nom, email, sujet, message, date_envoi, lu, repondu)
                    VALUES (?, ?, ?, ?, NOW(), 0, 0)
                ");

                $stmt->execute([$nom, $email, $sujet, $message]);

                $message_envoye = true;
                logError("Message de contact enregistré avec succès", [
                    'id' => $pdo->lastInsertId(),
                    'email' => $email,
                    'sujet' => $sujet
                ]);

                // Réinitialiser les champs après succès
                $_POST = [];

            } catch (PDOException $e) {
                $erreur = "Une erreur est survenue lors de l'envoi de votre message. Veuillez réessayer.";
                logError("Erreur lors de l'enregistrement du message de contact: " . $e->getMessage(), [
                    'email' => $email,
                    'sujet' => $sujet
                ]);
            }
        }
    }
}

include 'includes/header.php';
?>

<div class="page-indicator">
    <div class="dot"></div> 
    Page : Contact (contact.php)
</div>

<!-- Hero Contact -->
<div class="contact-hero">
    <h1>
        Contactez-<span class="gradient-text">nous</span>
    </h1>
    <p>
        Une question, une suggestion ? Notre équipe est là pour vous aider.
    </p>
</div>

<!-- Formulaire et infos -->
<div class="contact-section">
    <div class="contact-grid">

        <!-- Formulaire -->
        <div class="contact-form-card">
            <h2>
                Envoyez-nous un message
            </h2>
            <p>
                Nous vous répondrons dans les plus brefs délais
            </p>

            <?php if ($message_envoye): ?>
            <div class="alert alert-success">
                 <strong>Message envoyé !</strong> Nous vous répondrons bientôt.
            </div>
            <?php endif; ?>

            <?php if ($erreur): ?>
            <div class="alert alert-error">
                 <?php echo $erreur; ?>
            </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <?php echo csrfField(); ?>
                <div class="form-group">
                    <label class="form-label">
                        Nom complet *
                    </label>
                    <input type="text" name="nom" class="form-input" maxlength="100" required>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Email *
                    </label>
                    <input type="email" name="email" class="form-input" maxlength="255" required>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Sujet *
                    </label>
                    <select name="sujet" class="form-select" required>
                        <option value="">Sélectionner un sujet</option>
                        <option value="Question générale">Question générale</option>
                        <option value="Problème technique">Problème technique</option>
                        <option value="Suggestion">Suggestion</option>
                        <option value="Partenariat">Partenariat</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Message *
                    </label>
                    <textarea name="message" rows="6" class="form-textarea" maxlength="2000" required></textarea>
                </div>

                <button type="submit" class="btn-submit">
                      Envoyer le message
                </button>
            </form>
        </div>
        
        <!-- Informations de contact -->
        <div>
            <div class="contact-info-card">
                <div class="contact-icon email">
                    <svg width="24" height="24" fill="#00c878" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                    </svg>
                </div>
                <h3>Email</h3>
                <p>Envoyez-nous un email, nous répondons sous 24h</p>
                <a href="mailto:info@boussolescolaire.com" class="contact-link email">
                    info@boussolescolaire.com
                </a>
            </div>

            <div class="contact-info-card">
                <div class="contact-icon phone">
                    <svg width="24" height="24" fill="#ff8c3a" viewBox="0 0 16 16">
                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                    </svg>
                </div>
                <h3>Téléphone</h3>
                <p>Appelez-nous du lundi au vendredi, 8h-18h</p>
                <a href="tel:+2250799138637" class="contact-link phone">
                    +225 07 99 13 86 37
                </a>
            </div>

            <div class="contact-info-card">
                <div class="contact-icon location">
                    <svg width="24" height="24" fill="#00c878" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                    </svg>
                </div>
                <h3>Adresse</h3>
                <p>Venez nous rendre visite</p>
                <p class="contact-address">
                    Cocody, Abidjan<br>
                    Côte d'Ivoire
                </p>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Rapide -->
<div class="faq-section">
    <div class="faq-container">
        <h2>Questions fréquentes</h2>
        <p>
            Vous ne trouvez pas de réponse ? Consultez notre <a href="<?php echo $base_path; ?>/faq.php" class="faq-link">FAQ complète</a>
        </p>

        <div class="faq-list">
            <details class="faq-item">
                <summary>Comment fonctionne le test d'orientation ?</summary>
                <p>
                    Notre test analyse vos réponses selon votre série scolaire et vos intérêts pour vous recommander les filières les plus adaptées à votre profil.
                </p>
            </details>

            <details class="faq-item">
                <summary>Le service est-il gratuit ?</summary>
                <p>
                    Oui, BoussoleScolaire est entièrement gratuit pour tous les élèves et étudiants.
                </p>
            </details>

            <details class="faq-item">
                <summary>Puis-je refaire le test ?</summary>
                <p>
                    Oui, vous pouvez refaire le test autant de fois que vous le souhaitez pour affiner vos résultats.
                </p>
            </details>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>