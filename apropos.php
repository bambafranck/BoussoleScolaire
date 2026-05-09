<?php
/**
 * BoussoleScolaire - Page À Propos
 * Fichier: apropos.php
 */

session_start();

$page_title = "À Propos";
$page_css = "index";
$base_path = '/BoursoleScolaire';

include 'includes/header.php';
?>

<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

<div class="page-indicator">
    <i data-lucide="radio" style="width:14px;height:14px;vertical-align:middle;margin-right:6px;"></i>
    Page : À Propos (apropos.php)
</div>

<!-- Hero À Propos -->
<div style="background:linear-gradient(135deg,#1a1a2e,#16213e); padding:120px 60px 80px; text-align:center; position:relative; overflow:hidden;">
    <div style="position:absolute; width:500px; height:500px; background:radial-gradient(circle,rgba(0,200,120,0.15) 0%,transparent 70%); top:-200px; left:-100px; border-radius:50%;"></div>
    <div style="position:absolute; width:400px; height:400px; background:radial-gradient(circle,rgba(255,140,58,0.12) 0%,transparent 70%); bottom:-150px; right:-80px; border-radius:50%;"></div>
    
    <div style="position:relative; z-index:2; max-width:800px; margin:0 auto;">
        <div style="display:inline-flex; align-items:center; gap:8px; background:rgba(0,200,120,0.12); border:1px solid rgba(0,200,120,0.3); padding:6px 16px; border-radius:30px; color:#00c878; font-size:13px; font-weight:700; margin-bottom:24px;">
            <div style="width:8px; height:8px; border-radius:50%; background:#00c878;"></div>
            À Propos de Nous
        </div>
        
        <h1 style="font-family:'Poppins',sans-serif; font-size:48px; font-weight:800; color:#fff; margin-bottom:20px;">
            Votre <span style="background:linear-gradient(135deg,#00c878,#ff8c3a);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Boussole</span> pour l'Avenir
        </h1>
        
        <p style="color:rgba(255,255,255,0.7); font-size:18px; line-height:1.7; max-width:600px; margin:0 auto;">
            BoussoleScolaire est une plateforme d'orientation scolaire conçue pour aider les élèves et étudiants à trouver leur voie.
        </p>
    </div>
</div>

<!-- Mission -->
<div style="background:#fff; padding:80px 60px;">
    <div style="max-width:1100px; margin:0 auto;">
        <div style="text-align:center; margin-bottom:50px;">
            <div style="display:inline-flex; align-items:center; gap:8px; color:#00c878; font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:2px; margin-bottom:12px;">
                <i data-lucide="target" style="width:16px;height:16px;"></i>
                Notre Mission
            </div>
            <h2 style="font-family:'Poppins',sans-serif; font-size:36px; font-weight:800; color:#1a1a2e; margin-bottom:16px;">
                Guider chaque étudiant vers sa <span style="background:linear-gradient(135deg,#00c878,#ff8c3a);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">meilleure direction</span>
            </h2>
        </div>
        
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(300px,1fr)); gap:32px;">
            <div style="text-align:center; padding:32px;">
                <div style="width:80px; height:80px; background:linear-gradient(135deg,rgba(0,200,120,0.15),rgba(0,200,120,0.05)); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 20px;">
                    <i data-lucide="compass" style="width:36px;height:36px;color:#00c878;stroke-width:1.5;"></i>
                </div>
                <h3 style="font-family:'Poppins',sans-serif; font-size:20px; font-weight:700; color:#1a1a2e; margin-bottom:12px;">
                    Orientation Personnalisée
                </h3>
                <p style="color:#6b7280; font-size:15px; line-height:1.6;">
                    Des tests d'orientation adaptés à chaque profil pour révéler les talents et passions de chacun.
                </p>
            </div>
            
            <div style="text-align:center; padding:32px;">
                <div style="width:80px; height:80px; background:linear-gradient(135deg,rgba(255,140,58,0.15),rgba(255,140,58,0.05)); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 20px;">
                    <i data-lucide="library" style="width:36px;height:36px;color:#ff8c3a;stroke-width:1.5;"></i>
                </div>
                <h3 style="font-family:'Poppins',sans-serif; font-size:20px; font-weight:700; color:#1a1a2e; margin-bottom:12px;">
                    Catalogue Complet
                </h3>
                <p style="color:#6b7280; font-size:15px; line-height:1.6;">
                    Accès à plus de 500 filières et 200 établissements pour faire le meilleur choix.
                </p>
            </div>
            
            <div style="text-align:center; padding:32px;">
                <div style="width:80px; height:80px; background:linear-gradient(135deg,rgba(0,200,120,0.15),rgba(255,140,58,0.15)); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 20px;">
                    <i data-lucide="lightbulb" style="width:36px;height:36px;color:#00c878;stroke-width:1.5;"></i>
                </div>
                <h3 style="font-family:'Poppins',sans-serif; font-size:20px; font-weight:700; color:#1a1a2e; margin-bottom:12px;">
                    Recommandations Précises
                </h3>
                <p style="color:#6b7280; font-size:15px; line-height:1.6;">
                    Des algorithmes intelligents pour des recommandations basées sur vos compétences et objectifs.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Équipe -->
<div style="background:#f9fafb; padding:80px 60px;">
    <div style="max-width:1100px; margin:0 auto;">
        <div style="text-align:center; margin-bottom:50px;">
            <div style="display:inline-flex; align-items:center; gap:8px; color:#ff8c3a; font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:2px; margin-bottom:12px;">
                <i data-lucide="users" style="width:16px;height:16px;"></i>
                Notre Équipe
            </div>
            <h2 style="font-family:'Poppins',sans-serif; font-size:36px; font-weight:800; color:#1a1a2e;">
                Développé avec <span style="background:linear-gradient(135deg,#00c878,#ff8c3a);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">passion</span>
            </h2>
        </div>
        
        <div style="max-width:600px; margin:0 auto; background:#fff; border-radius:20px; padding:40px; text-align:center; box-shadow:0 4px 20px rgba(0,0,0,0.06);">
            <div style="width:100px; height:100px; background:linear-gradient(135deg,#00c878,#ff8c3a); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:36px; font-weight:800; font-family:'Poppins',sans-serif; color:#fff; margin:0 auto 24px;">
                BF
            </div>
            <h3 style="font-family:'Poppins',sans-serif; font-size:24px; font-weight:700; color:#1a1a2e; margin-bottom:8px;">
                Bamba Franck Abdoul Karim
            </h3>
            <p style="color:#00c878; font-weight:600; font-size:14px; margin-bottom:16px;">
                Développeur &amp; Créateur
            </p>
            <p style="color:#6b7280; font-size:15px; line-height:1.7;">
                Passionné par l'éducation et la technologie, j'ai créé BoussoleScolaire pour aider les jeunes de Côte d'Ivoire à trouver leur voie.
            </p>
        </div>
    </div>
</div>

<!-- Stats -->
<div style="background:#1a1a2e; padding:60px;">
    <div style="max-width:1100px; margin:0 auto; display:flex; justify-content:space-around; gap:40px; flex-wrap:wrap;">
        <div style="text-align:center;">
            <div style="display:flex; justify-content:center; margin-bottom:12px;">
                <i data-lucide="graduation-cap" style="width:28px;height:28px;color:#00c878;"></i>
            </div>
            <div style="font-family:'Poppins',sans-serif; font-size:48px; font-weight:800; background:linear-gradient(135deg,#00c878,#ff8c3a);-webkit-background-clip:text;-webkit-text-fill-color:transparent; margin-bottom:8px;">
                5000+
            </div>
            <div style="color:rgba(255,255,255,0.6); font-size:14px;">Élèves orientés</div>
        </div>
        <div style="text-align:center;">
            <div style="display:flex; justify-content:center; margin-bottom:12px;">
                <i data-lucide="book-open" style="width:28px;height:28px;color:#00c878;"></i>
            </div>
            <div style="font-family:'Poppins',sans-serif; font-size:48px; font-weight:800; background:linear-gradient(135deg,#00c878,#ff8c3a);-webkit-background-clip:text;-webkit-text-fill-color:transparent; margin-bottom:8px;">
                500+
            </div>
            <div style="color:rgba(255,255,255,0.6); font-size:14px;">Filières disponibles</div>
        </div>
        <div style="text-align:center;">
            <div style="display:flex; justify-content:center; margin-bottom:12px;">
                <i data-lucide="star" style="width:28px;height:28px;color:#00c878;"></i>
            </div>
            <div style="font-family:'Poppins',sans-serif; font-size:48px; font-weight:800; background:linear-gradient(135deg,#00c878,#ff8c3a);-webkit-background-clip:text;-webkit-text-fill-color:transparent; margin-bottom:8px;">
                98%
            </div>
            <div style="color:rgba(255,255,255,0.6); font-size:14px;">Taux de satisfaction</div>
        </div>
    </div>
</div>

<!-- Contact -->
<div style="background:#fff; padding:80px 60px;">
    <div style="max-width:800px; margin:0 auto; text-align:center;">
        <h2 style="font-family:'Poppins',sans-serif; font-size:36px; font-weight:800; color:#1a1a2e; margin-bottom:16px;">
            Une question ?
        </h2>
        <p style="color:#6b7280; font-size:16px; margin-bottom:32px;">
            N'hésitez pas à nous contacter pour toute information.
        </p>
        <div style="display:flex; justify-content:center; gap:32px; flex-wrap:wrap;">
            <div>
                <div style="display:flex; align-items:center; justify-content:center; gap:6px; color:#9ca3af; font-size:13px; margin-bottom:4px;">
                    <i data-lucide="mail" style="width:14px;height:14px;"></i> Email
                </div>
                <a href="mailto:info@boussolescolaire.com" style="color:#00c878; font-weight:600; text-decoration:none;">
                    info@boussolescolaire.com
                </a>
            </div>
            <div>
                <div style="display:flex; align-items:center; justify-content:center; gap:6px; color:#9ca3af; font-size:13px; margin-bottom:4px;">
                    <i data-lucide="phone" style="width:14px;height:14px;"></i> Téléphone
                </div>
                <a href="tel:+2250799138637" style="color:#00c878; font-weight:600; text-decoration:none;">
                    +225 0799138637
                </a>
            </div>
            <div>
                <div style="display:flex; align-items:center; justify-content:center; gap:6px; color:#9ca3af; font-size:13px; margin-bottom:4px;">
                    <i data-lucide="map-pin" style="width:14px;height:14px;"></i> Localisation
                </div>
                <div style="color:#374151; font-weight:600;">Abidjan, Côte d'Ivoire</div>
            </div>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
</script>

<?php include 'includes/footer.php'; ?>