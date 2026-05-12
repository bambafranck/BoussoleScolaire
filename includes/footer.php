<?php
/**
 * BoussoleScolaire - Footer
 * Fichier: includes/footer.php
 */

if (!isset($base_path)) {
    $base_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
}
?>

<!-- FOOTER -->
<footer style="background:#1a1a2e; color:#fff; padding:60px 40px 30px; margin-top:80px;">
    <div style="max-width:1200px; margin:0 auto;">
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap:40px; margin-bottom:40px;">
            
            <!-- À propos -->
            <div>
                <div style="display:flex; align-items:center; gap:8px; margin-bottom:20px;">
                    <i data-lucide="compass" style="width:24px;height:24px;color:#00c878;"></i>
                    <h3 style="font-family:'Poppins',sans-serif; font-size:20px; font-weight:700; margin:0;">
                        Boussole<span style="color:#00c878;">Scolaire</span>
                    </h3>
                </div>
                <p style="color:rgba(255,255,255,0.7); font-size:14px; line-height:1.6;">
                    Votre plateforme d'orientation scolaire pour trouver la meilleure direction vers votre avenir.
                </p>
            </div>

            <!-- Navigation -->
            <div>
                <h4 style="font-family:'Poppins',sans-serif; font-size:16px; font-weight:700; margin-bottom:16px;">Navigation</h4>
                <ul style="list-style:none; padding:0; margin:0;">
                    <li style="margin-bottom:10px;">
                        <a href="<?php echo $base_path; ?>/index.php" style="color:rgba(255,255,255,0.7); text-decoration:none; font-size:14px; transition:0.3s;" onmouseover="this.style.color='#00c878'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
                            Accueil
                        </a>
                    </li>
                    <li style="margin-bottom:10px;">
                        <a href="<?php echo $base_path; ?>/test.php" style="color:rgba(255,255,255,0.7); text-decoration:none; font-size:14px; transition:0.3s;" onmouseover="this.style.color='#00c878'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
                            Test d'Orientation
                        </a>
                    </li>
                    <li style="margin-bottom:10px;">
                        <a href="<?php echo $base_path; ?>/filieres.php" style="color:rgba(255,255,255,0.7); text-decoration:none; font-size:14px; transition:0.3s;" onmouseover="this.style.color='#00c878'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
                            Filières
                        </a>
                    </li>
                    <li style="margin-bottom:10px;">
                        <a href="<?php echo $base_path; ?>/formations.php" style="color:rgba(255,255,255,0.7); text-decoration:none; font-size:14px; transition:0.3s;" onmouseover="this.style.color='#00c878'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
                            Formations
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Informations -->
            <div>
                <h4 style="font-family:'Poppins',sans-serif; font-size:16px; font-weight:700; margin-bottom:16px;">Informations</h4>
                <ul style="list-style:none; padding:0; margin:0;">
                    <li style="margin-bottom:10px;">
                        <a href="<?php echo $base_path; ?>/apropos.php" style="color:rgba(255,255,255,0.7); text-decoration:none; font-size:14px; transition:0.3s;" onmouseover="this.style.color='#00c878'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
                            À propos
                        </a>
                    </li>
                    <li style="margin-bottom:10px;">
                        <a href="<?php echo $base_path; ?>/faq.php" style="color:rgba(255,255,255,0.7); text-decoration:none; font-size:14px; transition:0.3s;" onmouseover="this.style.color='#00c878'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
                            FAQ
                        </a>
                    </li>
                    <li style="margin-bottom:10px;">
                        <a href="<?php echo $base_path; ?>/contact.php" style="color:rgba(255,255,255,0.7); text-decoration:none; font-size:14px; transition:0.3s;" onmouseover="this.style.color='#00c878'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
                            Contact
                        </a>
                    </li>
                    <li style="margin-bottom:10px;">
                        <a href="<?php echo $base_path; ?>/confidentialite.php" style="color:rgba(255,255,255,0.7); text-decoration:none; font-size:14px; transition:0.3s;" onmouseover="this.style.color='#00c878'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
                            Confidentialité
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 style="font-family:'Poppins',sans-serif; font-size:16px; font-weight:700; margin-bottom:16px;">Contact</h4>
                <ul style="list-style:none; padding:0; margin:0;">
                    <li style="display:flex; align-items:center; gap:8px; margin-bottom:10px; color:rgba(255,255,255,0.7); font-size:14px;">
                        <i data-lucide="mail" style="width:16px;height:16px;color:#00c878;"></i>
                        <a href="mailto:info@boussolescolaire.com" style="color:rgba(255,255,255,0.7); text-decoration:none;">
                            info@boussolescolaire.com
                        </a>
                    </li>
                    <li style="display:flex; align-items:center; gap:8px; margin-bottom:10px; color:rgba(255,255,255,0.7); font-size:14px;">
                        <i data-lucide="phone" style="width:16px;height:16px;color:#00c878;"></i>
                        <a href="tel:+2250799138637" style="color:rgba(255,255,255,0.7); text-decoration:none;">
                            +225 07 99 13 86 37
                        </a>
                    </li>
                    <li style="display:flex; align-items:center; gap:8px; color:rgba(255,255,255,0.7); font-size:14px;">
                        <i data-lucide="map-pin" style="width:16px;height:16px;color:#00c878;"></i>
                        Abidjan, Côte d'Ivoire
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div style="border-top:1px solid rgba(255,255,255,0.1); padding-top:30px; text-align:center;">
            <p style="color:rgba(255,255,255,0.5); font-size:14px; margin:0;">
                © <?php echo date('Y'); ?> BoussoleScolaire. Tous droits réservés. 
                Développé avec <span style="color:#ff8c3a;">♥</span> par Bamba Franck Abdoul Karim
            </p>
        </div>
    </div>
</footer>

<script>
// Initialiser les icônes Lucide à la fin
if (typeof lucide !== 'undefined') {
    lucide.createIcons();
}
</script>

</body>
</html>