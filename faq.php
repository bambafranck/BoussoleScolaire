<?php
/**
 * BoussoleScolaire - Page FAQ
 * Fichier: faq.php
 */

session_start();

$base_path = '/BoursoleScolaire';
$page_title = "FAQ - Questions Fréquentes";
$page_css = "index";

include 'includes/header.php';
?>

<div class="page-indicator">
    <div class="dot"></div> 
    Page : FAQ (faq.php)
</div>

<!-- Hero FAQ -->
<div style="background:linear-gradient(135deg,#1a1a2e,#16213e); padding:100px 60px 60px; text-align:center;">
    <div style="max-width:800px; margin:0 auto;">
        <div style="width:80px; height:80px; background:linear-gradient(135deg,rgba(0,200,120,0.2),rgba(255,140,58,0.2)); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 24px;">
            <svg width="40" height="40" fill="#00c878" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
            </svg>
        </div>
        <h1 style="font-family:'Poppins',sans-serif; font-size:42px; font-weight:800; color:#fff; margin-bottom:16px;">
            Questions <span style="background:linear-gradient(135deg,#00c878,#ff8c3a);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Fréquentes</span>
        </h1>
        <p style="color:rgba(255,255,255,0.7); font-size:17px;">
            Trouvez rapidement les réponses à vos questions sur BoussoleScolaire
        </p>
    </div>
</div>

<div style="background:#fff; padding:80px 60px;">
    <div style="max-width:900px; margin:0 auto;">
        
        <!-- Catégorie : Général -->
        <div style="margin-bottom:48px;">
            <h2 style="font-family:'Poppins',sans-serif; font-size:28px; font-weight:700; color:#1a1a2e; margin-bottom:24px; display:flex; align-items:center; gap:12px;">
                <span style="width:8px; height:32px; background:linear-gradient(135deg,#00c878,#ff8c3a); border-radius:4px;"></span>
                Général
            </h2>
            
            <div style="display:flex; flex-direction:column; gap:16px;">
                <!-- Question 1 -->
                <details style="background:#f9fafb; border:2px solid #e5e7eb; border-radius:12px; padding:20px; cursor:pointer; transition:0.3s;" 
                         onmouseover="this.style.borderColor='#00c878';" 
                         onmouseout="this.style.borderColor='#e5e7eb';">
                    <summary style="font-weight:700; color:#1a1a2e; font-size:17px; list-style:none; display:flex; justify-content:space-between; align-items:center;">
                        <span>Qu'est-ce que BoussoleScolaire ?</span>
                        <span style="color:#00c878; font-size:24px;">+</span>
                    </summary>
                    <div style="margin-top:16px; padding-top:16px; border-top:1px solid #e5e7eb; color:#6b7280; line-height:1.7;">
                        BoussoleScolaire est une plateforme d'orientation scolaire en ligne qui aide les élèves et étudiants de Côte d'Ivoire à choisir la meilleure filière selon leur profil, leurs compétences et leurs aspirations. Nous proposons des tests d'orientation personnalisés et des recommandations basées sur votre série scolaire.
                    </div>
                </details>
                
                <!-- Question 2 -->
                <details style="background:#f9fafb; border:2px solid #e5e7eb; border-radius:12px; padding:20px; cursor:pointer; transition:0.3s;" 
                         onmouseover="this.style.borderColor='#00c878';" 
                         onmouseout="this.style.borderColor='#e5e7eb';">
                    <summary style="font-weight:700; color:#1a1a2e; font-size:17px; list-style:none; display:flex; justify-content:space-between; align-items:center;">
                        <span>Est-ce que le service est gratuit ?</span>
                        <span style="color:#00c878; font-size:24px;">+</span>
                    </summary>
                    <div style="margin-top:16px; padding-top:16px; border-top:1px solid #e5e7eb; color:#6b7280; line-height:1.7;">
                        Oui ! BoussoleScolaire est entièrement gratuit. Vous pouvez créer un compte, passer le test d'orientation, consulter vos résultats et explorer les filières sans aucun frais.
                    </div>
                </details>
                
                <!-- Question 3 -->
                <details style="background:#f9fafb; border:2px solid #e5e7eb; border-radius:12px; padding:20px; cursor:pointer; transition:0.3s;" 
                         onmouseover="this.style.borderColor='#00c878';" 
                         onmouseout="this.style.borderColor='#e5e7eb';">
                    <summary style="font-weight:700; color:#1a1a2e; font-size:17px; list-style:none; display:flex; justify-content:space-between; align-items:center;">
                        <span>Qui peut utiliser BoussoleScolaire ?</span>
                        <span style="color:#00c878; font-size:24px;">+</span>
                    </summary>
                    <div style="margin-top:16px; padding-top:16px; border-top:1px solid #e5e7eb; color:#6b7280; line-height:1.7;">
                        BoussoleScolaire est destiné aux élèves (niveau lycée), aux étudiants et aux parents qui souhaitent aider leurs enfants dans leur choix d'orientation. Que vous soyez en série A, C, D ou G, notre plateforme s'adapte à votre profil.
                    </div>
                </details>
            </div>
        </div>
        
        <!-- Catégorie : Test d'Orientation -->
        <div style="margin-bottom:48px;">
            <h2 style="font-family:'Poppins',sans-serif; font-size:28px; font-weight:700; color:#1a1a2e; margin-bottom:24px; display:flex; align-items:center; gap:12px;">
                <span style="width:8px; height:32px; background:linear-gradient(135deg,#00c878,#ff8c3a); border-radius:4px;"></span>
                Test d'Orientation
            </h2>
            
            <div style="display:flex; flex-direction:column; gap:16px;">
                <!-- Question 4 -->
                <details style="background:#f9fafb; border:2px solid #e5e7eb; border-radius:12px; padding:20px; cursor:pointer; transition:0.3s;" 
                         onmouseover="this.style.borderColor='#00c878';" 
                         onmouseout="this.style.borderColor='#e5e7eb';">
                    <summary style="font-weight:700; color:#1a1a2e; font-size:17px; list-style:none; display:flex; justify-content:space-between; align-items:center;">
                        <span>Comment fonctionne le test d'orientation ?</span>
                        <span style="color:#00c878; font-size:24px;">+</span>
                    </summary>
                    <div style="margin-top:16px; padding-top:16px; border-top:1px solid #e5e7eb; color:#6b7280; line-height:1.7;">
                        Le test se déroule en 2 étapes : <br>
                        <strong>1. Choix de votre série</strong> (A, C, D ou G)<br>
                        <strong>2. Réponses aux questions</strong> adaptées à votre série<br><br>
                        Selon vos réponses, nous calculons vos scores de compétences (logique, créativité, communication, analyse, leadership) et vous recommandons les filières les plus adaptées à votre profil.
                    </div>
                </details>
                
                <!-- Question 5 -->
                <details style="background:#f9fafb; border:2px solid #e5e7eb; border-radius:12px; padding:20px; cursor:pointer; transition:0.3s;" 
                         onmouseover="this.style.borderColor='#00c878';" 
                         onmouseout="this.style.borderColor='#e5e7eb';">
                    <summary style="font-weight:700; color:#1a1a2e; font-size:17px; list-style:none; display:flex; justify-content:space-between; align-items:center;">
                        <span>Combien de temps dure le test ?</span>
                        <span style="color:#00c878; font-size:24px;">+</span>
                    </summary>
                    <div style="margin-top:16px; padding-top:16px; border-top:1px solid #e5e7eb; color:#6b7280; line-height:1.7;">
                        Le test dure environ <strong>5 à 10 minutes</strong>. Il comporte une sélection de série et 3 questions principales. Prenez le temps de réfléchir à vos réponses pour obtenir des recommandations précises.
                    </div>
                </details>
                
                <!-- Question 6 -->
                <details style="background:#f9fafb; border:2px solid #e5e7eb; border-radius:12px; padding:20px; cursor:pointer; transition:0.3s;" 
                         onmouseover="this.style.borderColor='#00c878';" 
                         onmouseout="this.style.borderColor='#e5e7eb';">
                    <summary style="font-weight:700; color:#1a1a2e; font-size:17px; list-style:none; display:flex; justify-content:space-between; align-items:center;">
                        <span>Puis-je refaire le test plusieurs fois ?</span>
                        <span style="color:#00c878; font-size:24px;">+</span>
                    </summary>
                    <div style="margin-top:16px; padding-top:16px; border-top:1px solid #e5e7eb; color:#6b7280; line-height:1.7;">
                        Oui ! Vous pouvez refaire le test autant de fois que vous le souhaitez. Chaque test est sauvegardé dans votre historique, vous pouvez donc comparer vos résultats au fil du temps.
                    </div>
                </details>
                
                <!-- Question 7 -->
                <details style="background:#f9fafb; border:2px solid #e5e7eb; border-radius:12px; padding:20px; cursor:pointer; transition:0.3s;" 
                         onmouseover="this.style.borderColor='#00c878';" 
                         onmouseout="this.style.borderColor='#e5e7eb';">
                    <summary style="font-weight:700; color:#1a1a2e; font-size:17px; list-style:none; display:flex; justify-content:space-between; align-items:center;">
                        <span>Les résultats sont-ils fiables ?</span>
                        <span style="color:#00c878; font-size:24px;">+</span>
                    </summary>
                    <div style="margin-top:16px; padding-top:16px; border-top:1px solid #e5e7eb; color:#6b7280; line-height:1.7;">
                        Nos recommandations sont basées sur vos réponses et votre série scolaire. Elles constituent un <strong>guide précieux</strong> mais ne remplacent pas un entretien avec un conseiller d'orientation. Nous vous encourageons à explorer les filières recommandées et à discuter avec des professionnels du domaine.
                    </div>
                </details>
            </div>
        </div>
        
        <!-- Catégorie : Compte et Données -->
        <div style="margin-bottom:48px;">
            <h2 style="font-family:'Poppins',sans-serif; font-size:28px; font-weight:700; color:#1a1a2e; margin-bottom:24px; display:flex; align-items:center; gap:12px;">
                <span style="width:8px; height:32px; background:linear-gradient(135deg,#00c878,#ff8c3a); border-radius:4px;"></span>
                Compte et Données
            </h2>
            
            <div style="display:flex; flex-direction:column; gap:16px;">
                <!-- Question 8 -->
                <details style="background:#f9fafb; border:2px solid #e5e7eb; border-radius:12px; padding:20px; cursor:pointer; transition:0.3s;" 
                         onmouseover="this.style.borderColor='#00c878';" 
                         onmouseout="this.style.borderColor='#e5e7eb';">
                    <summary style="font-weight:700; color:#1a1a2e; font-size:17px; list-style:none; display:flex; justify-content:space-between; align-items:center;">
                        <span>Dois-je créer un compte pour passer le test ?</span>
                        <span style="color:#00c878; font-size:24px;">+</span>
                    </summary>
                    <div style="margin-top:16px; padding-top:16px; border-top:1px solid #e5e7eb; color:#6b7280; line-height:1.7;">
                        Oui, un compte est nécessaire pour passer le test et sauvegarder vos résultats. L'inscription est rapide et gratuite, il vous suffit de fournir votre nom, prénom, email et mot de passe.
                    </div>
                </details>
                
                <!-- Question 9 -->
                <details style="background:#f9fafb; border:2px solid #e5e7eb; border-radius:12px; padding:20px; cursor:pointer; transition:0.3s;" 
                         onmouseover="this.style.borderColor='#00c878';" 
                         onmouseout="this.style.borderColor='#e5e7eb';">
                    <summary style="font-weight:700; color:#1a1a2e; font-size:17px; list-style:none; display:flex; justify-content:space-between; align-items:center;">
                        <span>Mes données sont-elles sécurisées ?</span>
                        <span style="color:#00c878; font-size:24px;">+</span>
                    </summary>
                    <div style="margin-top:16px; padding-top:16px; border-top:1px solid #e5e7eb; color:#6b7280; line-height:1.7;">
                        Absolument ! Nous prenons la sécurité de vos données très au sérieux. Vos informations personnelles sont cryptées et ne sont jamais partagées avec des tiers. Consultez notre <a href="<?php echo $base_path; ?>/confidentialite.php" style="color:#00c878; font-weight:600;">politique de confidentialité</a> pour plus de détails.
                    </div>
                </details>
                
                <!-- Question 10 -->
                <details style="background:#f9fafb; border:2px solid #e5e7eb; border-radius:12px; padding:20px; cursor:pointer; transition:0.3s;" 
                         onmouseover="this.style.borderColor='#00c878';" 
                         onmouseout="this.style.borderColor='#e5e7eb';">
                    <summary style="font-weight:700; color:#1a1a2e; font-size:17px; list-style:none; display:flex; justify-content:space-between; align-items:center;">
                        <span>Comment puis-je télécharger mes résultats ?</span>
                        <span style="color:#00c878; font-size:24px;">+</span>
                    </summary>
                    <div style="margin-top:16px; padding-top:16px; border-top:1px solid #e5e7eb; color:#6b7280; line-height:1.7;">
                        Sur la page de résultats, cliquez sur le bouton <strong>"Télécharger Résultats (PDF)"</strong>. Un fichier PDF contenant votre score, vos compétences et les filières recommandées sera généré automatiquement.
                    </div>
                </details>
            </div>
        </div>
        
        <!-- Catégorie : Filières et Formations -->
        <div style="margin-bottom:48px;">
            <h2 style="font-family:'Poppins',sans-serif; font-size:28px; font-weight:700; color:#1a1a2e; margin-bottom:24px; display:flex; align-items:center; gap:12px;">
                <span style="width:8px; height:32px; background:linear-gradient(135deg,#00c878,#ff8c3a); border-radius:4px;"></span>
                Filières et Formations
            </h2>
            
            <div style="display:flex; flex-direction:column; gap:16px;">
                <!-- Question 11 -->
                <details style="background:#f9fafb; border:2px solid #e5e7eb; border-radius:12px; padding:20px; cursor:pointer; transition:0.3s;" 
                         onmouseover="this.style.borderColor='#00c878';" 
                         onmouseout="this.style.borderColor='#e5e7eb';">
                    <summary style="font-weight:700; color:#1a1a2e; font-size:17px; list-style:none; display:flex; justify-content:space-between; align-items:center;">
                        <span>Combien de filières sont disponibles ?</span>
                        <span style="color:#00c878; font-size:24px;">+</span>
                    </summary>
                    <div style="margin-top:16px; padding-top:16px; border-top:1px solid #e5e7eb; color:#6b7280; line-height:1.7;">
                        Nous proposons plus de <strong>500 filières</strong> dans tous les domaines : informatique, médecine, droit, gestion, ingénierie, arts, sciences sociales, et bien plus encore.
                    </div>
                </details>
                
                <!-- Question 12 -->
                <details style="background:#f9fafb; border:2px solid #e5e7eb; border-radius:12px; padding:20px; cursor:pointer; transition:0.3s;" 
                         onmouseover="this.style.borderColor='#00c878';" 
                         onmouseout="this.style.borderColor='#e5e7eb';">
                    <summary style="font-weight:700; color:#1a1a2e; font-size:17px; list-style:none; display:flex; justify-content:space-between; align-items:center;">
                        <span>Puis-je voir les établissements qui proposent une filière ?</span>
                        <span style="color:#00c878; font-size:24px;">+</span>
                    </summary>
                    <div style="margin-top:16px; padding-top:16px; border-top:1px solid #e5e7eb; color:#6b7280; line-height:1.7;">
                        Oui ! Sur la page <a href="<?php echo $base_path; ?>/formations.php" style="color:#00c878; font-weight:600;">Formations</a>, vous pouvez voir quels établissements proposent chaque filière, avec les informations sur les coûts, la durée et les places disponibles.
                    </div>
                </details>
            </div>
        </div>
        
        <!-- Section : Vous n'avez pas trouvé votre réponse ? -->
        <div style="background:linear-gradient(135deg,rgba(0,200,120,0.1),rgba(255,140,58,0.05)); border-radius:16px; padding:40px; text-align:center; margin-top:48px;">
            <h3 style="font-family:'Poppins',sans-serif; font-size:24px; font-weight:700; color:#1a1a2e; margin-bottom:12px;">
                Vous n'avez pas trouvé votre réponse ?
            </h3>
            <p style="color:#6b7280; margin-bottom:24px;">
                Notre équipe est là pour vous aider ! Contactez-nous et nous vous répondrons rapidement.
            </p>
            <a href="<?php echo $base_path; ?>/contact.php" 
               style="display:inline-block; padding:14px 32px; background:linear-gradient(135deg,#00c878,#00e88a); color:#fff; text-decoration:none; border-radius:12px; font-weight:700; font-size:16px; box-shadow:0 4px 18px rgba(0,200,120,0.3); transition:0.3s;"
               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 24px rgba(0,200,120,0.4)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 18px rgba(0,200,120,0.3)';">
                Nous contacter
            </a>
        </div>
    </div>
</div>

<script>
// Animation des details
document.querySelectorAll('details').forEach(detail => {
    detail.addEventListener('toggle', function() {
        const summary = this.querySelector('summary span:last-child');
        if (this.open) {
            summary.textContent = '−';
        } else {
            summary.textContent = '+';
        }
    });
});
</script>

<?php include 'includes/footer.php'; ?>