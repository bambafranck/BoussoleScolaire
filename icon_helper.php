<?php
/**
 * BoussoleScolaire - Système de mapping icônes
 * Fichier: includes/icon_helper.php
 * Convertit les noms d'icônes en vraies icônes Lucide
 */

/**
 * Mapping complet des icônes
 * Nom BDD → Nom icône Lucide
 */
function getIconMapping() {
    return [
        // Icônes courantes
        'bi-bar-chart' => 'bar-chart',
        'bi-bar-chart-line' => 'trending-up',
        'computer' => 'laptop',
        'medical-services' => 'stethoscope',
        'briefcase' => 'briefcase',
        'palette' => 'palette',
        'scale' => 'scale',
        'microscope' => 'microscope',
        'calculator' => 'calculator',
        'book' => 'book-open',
        'graduation-cap' => 'graduation-cap',
        'users' => 'users',
        'heart' => 'heart',
        'building' => 'building-2',
        'code' => 'code',
        'camera' => 'camera',
        'shield' => 'shield',
        'globe' => 'globe',
        'cpu' => 'cpu',
        'rocket' => 'rocket',
        'star' => 'star',
        'award' => 'award',
        'target' => 'target',
        'trending-up' => 'trending-up',
        'pie-chart' => 'pie-chart',
        'activity' => 'activity',
        'anchor' => 'anchor',
        'aperture' => 'aperture',
        'archive' => 'archive',
        'atom' => 'atom',
        
        // Fallback par défaut
        'default' => 'circle'
    ];
}

/**
 * Récupère le nom d'icône Lucide à partir du nom BDD
 */
function getLucideIcon($iconName) {
    $mapping = getIconMapping();
    
    // Si c'est déjà un nom Lucide valide, retourner tel quel
    if (isset($mapping[$iconName])) {
        return $mapping[$iconName];
    }
    
    // Sinon, retourner l'icône par défaut
    return $mapping['default'];
}

/**
 * Affiche une icône Lucide
 * Usage: <?php echo displayIcon('computer', 'color:#4f86f7; width:24px; height:24px'); ?>
 */
function displayIcon($iconName, $style = '') {
    $lucideIcon = getLucideIcon($iconName);
    return '<i data-lucide="' . htmlspecialchars($lucideIcon) . '" style="' . htmlspecialchars($style) . '"></i>';
}

/**
 * Affiche une icône dans un cercle coloré
 */
function displayIconCircle($iconName, $size = 64, $color = '#4f86f7') {
    $lucideIcon = getLucideIcon($iconName);
    $iconSize = $size * 0.5; // L'icône fait 50% de la taille du cercle
    
    return '
    <div style="
        width: ' . $size . 'px; 
        height: ' . $size . 'px; 
        background: linear-gradient(135deg, rgba(79, 134, 247, 0.1), rgba(0, 200, 120, 0.1)); 
        border-radius: 50%; 
        display: flex; 
        align-items: center; 
        justify-content: center;
    ">
        <i data-lucide="' . htmlspecialchars($lucideIcon) . '" style="width:' . $iconSize . 'px; height:' . $iconSize . 'px; color:' . htmlspecialchars($color) . ';"></i>
    </div>';
}
?>