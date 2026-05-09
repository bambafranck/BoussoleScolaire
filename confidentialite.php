<?php
/**
 * BoussoleScolaire - Politique de Confidentialité
 * Fichier: confidentialite.php
 */

session_start();

$base_path = '/BoursoleScolaire';
$page_title = "Politique de Confidentialité";
$page_css = "index";

include 'includes/header.php';
?>

<div class="page-indicator">
    <div class="dot"></div> 
    Page : Confidentialité (confidentialite.php)
</div>

<!-- Hero -->
<div style="background:linear-gradient(135deg,#1a1a2e,#16213e); padding:100px 60px 60px; text-align:center;">
    <div style="max-width:800px; margin:0 auto;">
        <div style="width:80px; height:80px; background:linear-gradient(135deg,rgba(0,200,120,0.2),rgba(255,140,58,0.2)); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 24px;">
            <svg width="40" height="40" fill="#00c878" viewBox="0 0 16 16">
                <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>
                <path d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
            </svg>
        </div>
        <h1 style="font-family:'Poppins',sans-serif; font-size:42px; font-weight:800; color:#fff; margin-bottom:16px;">
            Politique de <span style="background:linear-gradient(135deg,#00c878,#ff8c3a);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Confidentialité</span>
        </h1>
        <p style="color:rgba(255,255,255,0.7); font-size:15px;">
            Dernière mise à jour : <?php echo date('d/m/Y'); ?>
        </p>
    </div>
</div>

<div style="background:#fff; padding:80px 60px;">
    <div style="max-width:900px; margin:0 auto;">
        
        <!-- Introduction -->
        <div style="background:linear-gradient(135deg,rgba(0,200,120,0.05),rgba(255,140,58,0.02)); border-left:4px solid #00c878; padding:24px; border-radius:8px; margin-bottom:40px;">
            <p style="color:#374151; line-height:1.8; margin:0;">
                Chez <strong>BoussoleScolaire</strong>, nous accordons une grande importance à la protection de vos données personnelles. Cette politique de confidentialité explique comment nous collectons, utilisons et protégeons vos informations.
            </p>
        </div>
        
        <!-- Section 1 -->
        <div style="margin-bottom:40px;">
            <h2 style="font-family:'Poppins',sans-serif; font-size:26px; font-weight:700; color:#1a1a2e; margin-bottom:16px; display:flex; align-items:center; gap:12px;">
                <span style="display:flex; align-items:center; justify-content:center; width:36px; height:36px; background:linear-gradient(135deg,#00c878,#ff8c3a); color:#fff; border-radius:8px; font-size:18px;">1</span>
                Informations que nous collectons
            </h2>
            <div style="color:#6b7280; line-height:1.8; padding-left:48px;">
                <p style="margin-bottom:16px;">Nous collectons les informations suivantes lorsque vous utilisez BoussoleScolaire :</p>
                <ul style="margin:0; padding-left:24px; line-height:2;">
                    <li><strong>Informations d'identification :</strong> nom, prénom, adresse email</li>
                    <li><strong>Informations de profil :</strong> type d'utilisateur (élève, étudiant, parent), niveau scolaire, série</li>
                    <li><strong>Données de test :</strong> réponses au test d'orientation, résultats, scores de compétences</li>
                    <li><strong>Données de navigation :</strong> pages consultées, durée de visite, adresse IP</li>
                    <li><strong>Préférences :</strong> formations sauvegardées, filières favorites</li>
                </ul>
            </div>
        </div>
        
        <!-- Section 2 -->
        <div style="margin-bottom:40px;">
            <h2 style="font-family:'Poppins',sans-serif; font-size:26px; font-weight:700; color:#1a1a2e; margin-bottom:16px; display:flex; align-items:center; gap:12px;">
                <span style="display:flex; align-items:center; justify-content:center; width:36px; height:36px; background:linear-gradient(135deg,#00c878,#ff8c3a); color:#fff; border-radius:8px; font-size:18px;">2</span>
                Comment nous utilisons vos informations
            </h2>
            <div style="color:#6b7280; line-height:1.8; padding-left:48px;">
                <p style="margin-bottom:16px;">Vos données sont utilisées pour :</p>
                <ul style="margin:0; padding-left:24px; line-height:2;">
                    <li>Créer et gérer votre compte utilisateur</li>
                    <li>Fournir des recommandations d'orientation personnalisées</li>
                    <li>Sauvegarder vos résultats de test et vos préférences</li>
                    <li>Améliorer nos services et développer de nouvelles fonctionnalités</li>
                    <li>Vous envoyer des notifications importantes concernant votre compte</li>
                    <li>Analyser l'utilisation de la plateforme pour optimiser l'expérience utilisateur</li>
                </ul>
            </div>
        </div>
        
        <!-- Section 3 -->
        <div style="margin-bottom:40px;">
            <h2 style="font-family:'Poppins',sans-serif; font-size:26px; font-weight:700; color:#1a1a2e; margin-bottom:16px; display:flex; align-items:center; gap:12px;">
                <span style="display:flex; align-items:center; justify-content:center; width:36px; height:36px; background:linear-gradient(135deg,#00c878,#ff8c3a); color:#fff; border-radius:8px; font-size:18px;">3</span>
                Partage de vos données
            </h2>
            <div style="color:#6b7280; line-height:1.8; padding-left:48px;">
                <p style="margin-bottom:16px;"><strong>Nous ne vendons jamais vos données personnelles.</strong></p>
                <p style="margin-bottom:16px;">Vos informations peuvent être partagées uniquement dans les cas suivants :</p>
                <ul style="margin:0; padding-left:24px; line-height:2;">
                    <li><strong>Avec votre consentement explicite</strong> pour des partenariats éducatifs</li>
                    <li><strong>Pour des raisons légales</strong> si requis par la loi ou pour protéger nos droits</li>
                    <li><strong>Données anonymisées</strong> à des fins statistiques et de recherche</li>
                </ul>
            </div>
        </div>
        
        <!-- Section 4 -->
        <div style="margin-bottom:40px;">
            <h2 style="font-family:'Poppins',sans-serif; font-size:26px; font-weight:700; color:#1a1a2e; margin-bottom:16px; display:flex; align-items:center; gap:12px;">
                <span style="display:flex; align-items:center; justify-content:center; width:36px; height:36px; background:linear-gradient(135deg,#00c878,#ff8c3a); color:#fff; border-radius:8px; font-size:18px;">4</span>
                Sécurité de vos données
            </h2>
            <div style="color:#6b7280; line-height:1.8; padding-left:48px;">
                <p style="margin-bottom:16px;">Nous mettons en œuvre des mesures de sécurité pour protéger vos données :</p>
                <ul style="margin:0; padding-left:24px; line-height:2;">
                    <li><strong>Cryptage :</strong> Toutes les données sensibles sont cryptées (SSL/TLS)</li>
                    <li><strong>Mots de passe :</strong> Hashage sécurisé des mots de passe</li>
                    <li><strong>Accès restreint :</strong> Seuls les administrateurs autorisés peuvent accéder aux données</li>
                    <li><strong>Sauvegardes régulières :</strong> Pour prévenir toute perte de données</li>
                    <li><strong>Surveillance :</strong> Détection et prévention des accès non autorisés</li>
                </ul>
            </div>
        </div>
        
        <!-- Section 5 -->
        <div style="margin-bottom:40px;">
            <h2 style="font-family:'Poppins',sans-serif; font-size:26px; font-weight:700; color:#1a1a2e; margin-bottom:16px; display:flex; align-items:center; gap:12px;">
                <span style="display:flex; align-items:center; justify-content:center; width:36px; height:36px; background:linear-gradient(135deg,#00c878,#ff8c3a); color:#fff; border-radius:8px; font-size:18px;">5</span>
                Vos droits
            </h2>
            <div style="color:#6b7280; line-height:1.8; padding-left:48px;">
                <p style="margin-bottom:16px;">Vous disposez des droits suivants concernant vos données personnelles :</p>
                <ul style="margin:0; padding-left:24px; line-height:2;">
                    <li><strong>Droit d'accès :</strong> Consulter toutes vos données personnelles</li>
                    <li><strong>Droit de rectification :</strong> Modifier vos informations</li>
                    <li><strong>Droit à l'effacement :</strong> Supprimer votre compte et vos données</li>
                    <li><strong>Droit d'opposition :</strong> Refuser certains traitements de données</li>
                    <li><strong>Droit à la portabilité :</strong> Récupérer vos données dans un format lisible</li>
                </ul>
                <p style="margin-top:16px;">
                    Pour exercer ces droits, contactez-nous à <a href="mailto:privacy@boussolescolaire.com" style="color:#00c878; font-weight:600;">privacy@boussolescolaire.com</a>
                </p>
            </div>
        </div>
        
        <!-- Section 6 -->
        <div style="margin-bottom:40px;">
            <h2 style="font-family:'Poppins',sans-serif; font-size:26px; font-weight:700; color:#1a1a2e; margin-bottom:16px; display:flex; align-items:center; gap:12px;">
                <span style="display:flex; align-items:center; justify-content:center; width:36px; height:36px; background:linear-gradient(135deg,#00c878,#ff8c3a); color:#fff; border-radius:8px; font-size:18px;">6</span>
                Cookies et technologies similaires
            </h2>
            <div style="color:#6b7280; line-height:1.8; padding-left:48px;">
                <p style="margin-bottom:16px;">Nous utilisons des cookies pour :</p>
                <ul style="margin:0; padding-left:24px; line-height:2;">
                    <li><strong>Cookies essentiels :</strong> Pour le fonctionnement de la plateforme (session, authentification)</li>
                    <li><strong>Cookies analytiques :</strong> Pour comprendre comment vous utilisez le site</li>
                    <li><strong>Cookies de préférences :</strong> Pour mémoriser vos choix (langue, paramètres)</li>
                </ul>
                <p style="margin-top:16px;">
                    Vous pouvez gérer vos préférences de cookies dans les paramètres de votre navigateur.
                </p>
            </div>
        </div>
        
        <!-- Section 7 -->
        <div style="margin-bottom:40px;">
            <h2 style="font-family:'Poppins',sans-serif; font-size:26px; font-weight:700; color:#1a1a2e; margin-bottom:16px; display:flex; align-items:center; gap:12px;">
                <span style="display:flex; align-items:center; justify-content:center; width:36px; height:36px; background:linear-gradient(135deg,#00c878,#ff8c3a); color:#fff; border-radius:8px; font-size:18px;">7</span>
                Conservation des données
            </h2>
            <div style="color:#6b7280; line-height:1.8; padding-left:48px;">
                <p style="margin-bottom:16px;">Nous conservons vos données personnelles :</p>
                <ul style="margin:0; padding-left:24px; line-height:2;">
                    <li><strong>Données de compte :</strong> Tant que votre compte est actif</li>
                    <li><strong>Données de test :</strong> 5 ans après le dernier test</li>
                    <li><strong>Logs de connexion :</strong> 1 an maximum</li>
                </ul>
                <p style="margin-top:16px;">
                    Vous pouvez demander la suppression de vos données à tout moment.
                </p>
            </div>
        </div>
        
        <!-- Section 8 -->
        <div style="margin-bottom:40px;">
            <h2 style="font-family:'Poppins',sans-serif; font-size:26px; font-weight:700; color:#1a1a2e; margin-bottom:16px; display:flex; align-items:center; gap:12px;">
                <span style="display:flex; align-items:center; justify-content:center; width:36px; height:36px; background:linear-gradient(135deg,#00c878,#ff8c3a); color:#fff; border-radius:8px; font-size:18px;">8</span>
                Modifications de cette politique
            </h2>
            <div style="color:#6b7280; line-height:1.8; padding-left:48px;">
                <p>
                    Nous pouvons mettre à jour cette politique de confidentialité occasionnellement. Nous vous informerons de tout changement significatif par email ou via une notification sur la plateforme. La date de la dernière mise à jour est indiquée en haut de cette page.
                </p>
            </div>
        </div>
        
        <!-- Contact -->
        <div style="background:linear-gradient(135deg,rgba(0,200,120,0.1),rgba(255,140,58,0.05)); border-radius:16px; padding:32px; margin-top:48px;">
            <h3 style="font-family:'Poppins',sans-serif; font-size:22px; font-weight:700; color:#1a1a2e; margin-bottom:12px;">
                Des questions sur vos données ?
            </h3>
            <p style="color:#6b7280; margin-bottom:20px;">
                Pour toute question concernant cette politique de confidentialité ou vos données personnelles, contactez notre équipe :
            </p>
            <div style="display:flex; gap:24px; flex-wrap:wrap;">
                <div>
                    <div style="font-size:13px; color:#9ca3af; margin-bottom:4px;">Email</div>
                    <a href="mailto:privacy@boussolescolaire.com" style="color:#00c878; font-weight:600; text-decoration:none;">privacy@boussolescolaire.com</a>
                </div>
                <div>
                    <div style="font-size:13px; color:#9ca3af; margin-bottom:4px;">Téléphone</div>
                    <a href="tel:+2250799138637" style="color:#ff8c3a; font-weight:600; text-decoration:none;">+225 07 99 13 86 37</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>