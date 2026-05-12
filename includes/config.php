<?php
/**
 * BoussoleScolaire - Configuration
 * Fichier: includes/config.php
 */

// Détection automatique du chemin de base (fonctionne local ET hébergé)
$base_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

define('SITE_NAME', 'BoussoleScolaire');
define('SITE_URL', 'http://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . $base_path);

// Retourner la configuration (optionnel)
return [
    'base_path' => $base_path,
    'site_name' => SITE_NAME,
    'site_url' => SITE_URL
];
?>
 