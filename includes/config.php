<?php
/**
 * BoussoleScolaire - Configuration
 * Fichier: includes/config.php
 */

// Chemin de base du projet
$base_path = '/BoursoleScolaire';  // CHANGEZ selon votre dossier

// Autres configurations si nécessaire
define('SITE_NAME', 'BoussoleScolaire');
define('SITE_URL', 'http://localhost' . $base_path);

// Retourner la configuration (optionnel)
return [
    'base_path' => $base_path,
    'site_name' => SITE_NAME,
    'site_url' => SITE_URL
];
?>
 