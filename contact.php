<?php
/**
 * BoussoleScolaire - Page Contact
 * Fichier: contact.php
 */

session_start();

$page_title = "Contact";
$page_css = "index";

// Traitement du formulaire
$message_envoye = false;
$erreur = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'config/database.php';
    
    $nom = securiser($_POST['nom']);
    $email = securiser($_POST['email']);
    $sujet = securiser($_POST['sujet']);
    $message = securiser($_POST['message']);
    
    if (empty($nom) || empty($email) || empty($sujet) || empty($message)) {
        $erreur = "Veuillez remplir tous les champs.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = "Email invalide.";
    } else {
        // Enregistrer dans la BDD (table messages_contact à créer)
        // Pour l'instant, juste simuler l'envoi
        $message_envoye = true;
    }
}

include 'includes/header.php';
?>

<div class="page-indicator">
    <div class="dot"></div> 
    Page : Contact (contact.php)
</div>

<!-- Hero Contact -->
<div style="background:linear-gradient(135deg,#1a1a2e,#16213e); padding:100px 60px 60px; text-align:center;">
    <h1 style="font-family:'Poppins',sans-serif; font-size:42px; font-weight:800; color:#fff; margin-bottom:16px;">
        Contactez-<span style="background:linear-gradient(135deg,#00c878,#ff8c3a);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">nous</span>
    </h1>
    <p style="color:rgba(255,255,255,0.7); font-size:17px; max-width:600px; margin:0 auto;">
        Une question, une suggestion ? Notre équipe est là pour vous aider.
    </p>
</div>

<!-- Formulaire et infos -->
<div style="background:#f9fafb; padding:80px 60px;">
    <div style="max-width:1100px; margin:0 auto; display:grid; grid-template-columns:1fr 1fr; gap:60px;">
        
        <!-- Formulaire -->
        <div style="background:#fff; padding:40px; border-radius:20px; box-shadow:0 4px 20px rgba(0,0,0,0.06);">
            <h2 style="font-family:'Poppins',sans-serif; font-size:28px; font-weight:700; color:#1a1a2e; margin-bottom:8px;">
                Envoyez-nous un message
            </h2>
            <p style="color:#6b7280; font-size:14px; margin-bottom:30px;">
                Nous vous répondrons dans les plus brefs délais
            </p>
            
            <?php if ($message_envoye): ?>
            <div style="background:#d1fae5; border:1px solid #10b981; color:#065f46; padding:16px; border-radius:12px; margin-bottom:20px;">
                 <strong>Message envoyé !</strong> Nous vous répondrons bientôt.
            </div>
            <?php endif; ?>
            
            <?php if ($erreur): ?>
            <div style="background:#fee2e2; border:1px solid #ef4444; color:#991b1b; padding:16px; border-radius:12px; margin-bottom:20px;">
                 <?php echo $erreur; ?>
            </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div style="margin-bottom:20px;">
                    <label style="display:block; font-weight:600; font-size:14px; color:#374151; margin-bottom:8px;">
                        Nom complet *
                    </label>
                    <input type="text" name="nom" required 
                           style="width:100%; padding:12px 16px; border:2px solid #e5e7eb; border-radius:10px; font-size:14px; font-family:'Nunito',sans-serif; transition:0.3s;"
                           onfocus="this.style.borderColor='#00c878'; this.style.boxShadow='0 0 0 3px rgba(0,200,120,0.1)'"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">
                </div>
                
                <div style="margin-bottom:20px;">
                    <label style="display:block; font-weight:600; font-size:14px; color:#374151; margin-bottom:8px;">
                        Email *
                    </label>
                    <input type="email" name="email" required 
                           style="width:100%; padding:12px 16px; border:2px solid #e5e7eb; border-radius:10px; font-size:14px; font-family:'Nunito',sans-serif; transition:0.3s;"
                           onfocus="this.style.borderColor='#00c878'; this.style.boxShadow='0 0 0 3px rgba(0,200,120,0.1)'"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">
                </div>
                
                <div style="margin-bottom:20px;">
                    <label style="display:block; font-weight:600; font-size:14px; color:#374151; margin-bottom:8px;">
                        Sujet *
                    </label>
                    <select name="sujet" required 
                            style="width:100%; padding:12px 16px; border:2px solid #e5e7eb; border-radius:10px; font-size:14px; font-family:'Nunito',sans-serif;">
                        <option value="">Sélectionner un sujet</option>
                        <option value="Question générale">Question générale</option>
                        <option value="Problème technique">Problème technique</option>
                        <option value="Suggestion">Suggestion</option>
                        <option value="Partenariat">Partenariat</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>
                
                <div style="margin-bottom:24px;">
                    <label style="display:block; font-weight:600; font-size:14px; color:#374151; margin-bottom:8px;">
                        Message *
                    </label>
                    <textarea name="message" rows="6" required 
                              style="width:100%; padding:12px 16px; border:2px solid #e5e7eb; border-radius:10px; font-size:14px; font-family:'Nunito',sans-serif; resize:vertical; transition:0.3s;"
                              onfocus="this.style.borderColor='#00c878'; this.style.boxShadow='0 0 0 3px rgba(0,200,120,0.1)'"
                              onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"></textarea>
                </div>
                
                <button type="submit" 
                        style="width:100%; padding:14px; background:linear-gradient(135deg,#00c878,#00e88a); border:none; border-radius:12px; color:#fff; font-weight:700; font-size:16px; cursor:pointer; box-shadow:0 4px 15px rgba(0,200,120,0.3); transition:0.3s;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(0,200,120,0.4)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,200,120,0.3)'">
                      Envoyer le message
                </button>
            </form>
        </div>
        
        <!-- Informations de contact -->
        <div>
            <div style="background:#fff; padding:30px; border-radius:20px; box-shadow:0 4px 20px rgba(0,0,0,0.06); margin-bottom:24px;">
                <div style="width:50px; height:50px; background:linear-gradient(135deg,rgba(0,200,120,0.15),rgba(0,200,120,0.05)); border-radius:12px; display:flex; align-items:center; justify-content:center; margin-bottom:16px;">
                    <svg width="24" height="24" fill="#00c878" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                    </svg>
                </div>
                <h3 style="font-family:'Poppins',sans-serif; font-size:18px; font-weight:700; color:#1a1a2e; margin-bottom:8px;">
                    Email
                </h3>
                <p style="color:#6b7280; font-size:14px; margin-bottom:8px;">
                    Envoyez-nous un email, nous répondons sous 24h
                </p>
                <a href="mailto:info@boussolescolaire.com" style="color:#00c878; font-weight:600; text-decoration:none; font-size:15px;">
                    info@boussolescolaire.com
                </a>
            </div>
            
            <div style="background:#fff; padding:30px; border-radius:20px; box-shadow:0 4px 20px rgba(0,0,0,0.06); margin-bottom:24px;">
                <div style="width:50px; height:50px; background:linear-gradient(135deg,rgba(255,140,58,0.15),rgba(255,140,58,0.05)); border-radius:12px; display:flex; align-items:center; justify-content:center; margin-bottom:16px;">
                    <svg width="24" height="24" fill="#ff8c3a" viewBox="0 0 16 16">
                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                    </svg>
                </div>
                <h3 style="font-family:'Poppins',sans-serif; font-size:18px; font-weight:700; color:#1a1a2e; margin-bottom:8px;">
                    Téléphone
                </h3>
                <p style="color:#6b7280; font-size:14px; margin-bottom:8px;">
                    Appelez-nous du lundi au vendredi, 8h-18h
                </p>
                <a href="tel:+2250799138637" style="color:#ff8c3a; font-weight:600; text-decoration:none; font-size:15px;">
                    +225 07 99 13 86 37
                </a>
            </div>
            
            <div style="background:#fff; padding:30px; border-radius:20px; box-shadow:0 4px 20px rgba(0,0,0,0.06);">
                <div style="width:50px; height:50px; background:linear-gradient(135deg,rgba(0,200,120,0.15),rgba(255,140,58,0.15)); border-radius:12px; display:flex; align-items:center; justify-content:center; margin-bottom:16px;">
                    <svg width="24" height="24" fill="#00c878" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                    </svg>
                </div>
                <h3 style="font-family:'Poppins',sans-serif; font-size:18px; font-weight:700; color:#1a1a2e; margin-bottom:8px;">
                    Adresse
                </h3>
                <p style="color:#6b7280; font-size:14px; margin-bottom:8px;">
                    Venez nous rendre visite
                </p>
                <p style="color:#374151; font-weight:600; font-size:15px;">
                    Cocody, Abidjan<br>
                    Côte d'Ivoire
                </p>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Rapide -->
<div style="background:#fff; padding:80px 60px;">
    <div style="max-width:800px; margin:0 auto; text-align:center;">
        <h2 style="font-family:'Poppins',sans-serif; font-size:32px; font-weight:800; color:#1a1a2e; margin-bottom:16px;">
            Questions fréquentes
        </h2>
        <p style="color:#6b7280; font-size:16px; margin-bottom:40px;">
            Vous ne trouvez pas de réponse ? Consultez notre <a href="<?php echo $base_path; ?>/faq.php" style="color:#00c878; font-weight:600; text-decoration:none;">FAQ complète</a>
        </p>
        
        <div style="text-align:left;">
            <details style="background:#f9fafb; padding:20px; border-radius:12px; margin-bottom:16px; cursor:pointer;">
                <summary style="font-weight:700; color:#1a1a2e; font-size:16px;">
                    Comment fonctionne le test d'orientation ?
                </summary>
                <p style="color:#6b7280; font-size:14px; margin-top:12px; line-height:1.6;">
                    Notre test analyse vos réponses selon votre série scolaire et vos intérêts pour vous recommander les filières les plus adaptées à votre profil.
                </p>
            </details>
            
            <details style="background:#f9fafb; padding:20px; border-radius:12px; margin-bottom:16px; cursor:pointer;">
                <summary style="font-weight:700; color:#1a1a2e; font-size:16px;">
                    Le service est-il gratuit ?
                </summary>
                <p style="color:#6b7280; font-size:14px; margin-top:12px; line-height:1.6;">
                    Oui, BoussoleScolaire est entièrement gratuit pour tous les élèves et étudiants.
                </p>
            </details>
            
            <details style="background:#f9fafb; padding:20px; border-radius:12px; cursor:pointer;">
                <summary style="font-weight:700; color:#1a1a2e; font-size:16px;">
                    Puis-je refaire le test ?
                </summary>
                <p style="color:#6b7280; font-size:14px; margin-top:12px; line-height:1.6;">
                    Oui, vous pouvez refaire le test autant de fois que vous le souhaitez pour affiner vos résultats.
                </p>
            </details>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>