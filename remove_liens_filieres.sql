-- Script pour supprimer la colonne lien_externe de la table filiere
-- À exécuter dans phpMyAdmin

ALTER TABLE `filiere` DROP COLUMN `lien_externe`;
