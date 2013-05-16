<?php
/*vim: set expandtab tabstop=4 shiftwidth=4: */
// +------------------------------------------------------------------------------------------------------+
// | PHP version 5.1                                                                                      |
// +------------------------------------------------------------------------------------------------------+
// | Copyright (C) 1999-2006 Kaleidos-coop.org                                                            |
// +------------------------------------------------------------------------------------------------------+
// | This file is part of wkbazar.                                                                     |
// |                                                                                                      |
// | Foobar is free software; you can redistribute it and/or modify                                       |
// | it under the terms of the GNU General Public License as published by                                 |
// | the Free Software Foundation; either version 2 of the License, or                                    |
// | (at your option) any later version.                                                                  |
// |                                                                                                      |
// | Foobar is distributed in the hope that it will be useful,                                            |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of                                       |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                                        |
// | GNU General Public License for more details.                                                         |
// |                                                                                                      |
// | You should have received a copy of the GNU General Public License                                    |
// | along with Foobar; if not, write to the Free Software                                                |
// | Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA                            |
// +------------------------------------------------------------------------------------------------------+
// CVS : $Id: wiki.php,v 1.5 2010/03/04 14:19:04 mrflos Exp $
/**
* wiki.php
*
* Description : fichier de configuration de bazar
*
*@package wkbazar
//Auteur original :
*@author        Florian SCHMITT <florian.schmitt@laposte.net>
//Autres auteurs :
*@copyright     outils-reseaux-coop.org 2008
*@version       $Revision: 1.5 $ $Date: 2010/03/04 14:19:04 $
// +------------------------------------------------------------------------------------------------------+
*/

// +------------------------------------------------------------------------------------------------------+
// |                                            ENTETE du PROGRAMME                                       |
// +------------------------------------------------------------------------------------------------------+
//error_reporting(E_ALL);
//chemin relatif d'acces au bazar
define ('BAZ_CHEMIN', 'tools'.DIRECTORY_SEPARATOR.'bazar'.DIRECTORY_SEPARATOR);
//chemin upload
define ('BAZ_CHEMIN_UPLOAD', 'tools'.DIRECTORY_SEPARATOR.'bazar'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR);
define ('BAZ_PREFIXE', 'bazar_');
//bouh! c'est pas propre! c'est a cause de PEAR et de ses includes
set_include_path(BAZ_CHEMIN.'libs'.DIRECTORY_SEPARATOR.PATH_SEPARATOR.get_include_path());

//librairies PEAR
require_once BAZ_CHEMIN.'libs'.DIRECTORY_SEPARATOR.'DB.php' ;
require_once BAZ_CHEMIN.'libs'.DIRECTORY_SEPARATOR.'Net'.DIRECTORY_SEPARATOR.'URL.php' ;

//principales fonctions de bazar
require_once BAZ_CHEMIN.'libs'.DIRECTORY_SEPARATOR.'bazar.fonct.php';

// +------------------------------------------------------------------------------------------------------+
// |                                            CORPS du PROGRAMME                                        |
// +------------------------------------------------------------------------------------------------------+

$GLOBALS['_BAZAR_']['wiki'] = new Wiki($wakkaConfig);

$wikireq = $_REQUEST['wiki'];
// remove leading slash
$wikireq = preg_replace("/^\//", "", $wikireq);
// split into page/method, checking wiki name & method name (XSS proof)
if (preg_match('`^' . '(' . "[A-Za-z0-9]+" . ')/(' . "[A-Za-z0-9_-]" . '*)' . '$`', $wikireq, $matches))
{
	list(, $page, $method) = $matches;
}
elseif (preg_match('`^' . "[A-Za-z0-9]+" . '$`', $wikireq))
{
	$page = $wikireq;
}

// Variable d'url
$GLOBALS['_BAZAR_']['url'] = new Net_URL($wakkaConfig['base_url'].$page);

// Connection a la base de donnee
$dsn='mysql://'.$wakkaConfig['mysql_user'].':'.$wakkaConfig['mysql_password'].'@'.$wakkaConfig['mysql_host'].'/'.$wakkaConfig['mysql_database'];
$GLOBALS['_BAZAR_']['db'] =& DB::connect($dsn) ;
if (DB::isError($GLOBALS['_BAZAR_']['db'])) {
	echo $GLOBALS['_BAZAR_']['db']->getMessage();
}
//test de l'existance des tables de bazar
$req = "SHOW TABLES FROM ".$wakkaConfig['mysql_database']." LIKE 'bazar_%'";
$resultat = $GLOBALS['_BAZAR_']['db']->query ($req);
if ($resultat->numRows() == 0) {
	$fichier_sql = 'tools/bazar/install/bazar.sql';
	if (file_exists($fichier_sql)) {
            // Des champs textes sont multilignes, d'ou la boucle sur INSERT, marqueur de fin de la requete precedente.
            if ($lines = file($fichier_sql))  {
                $i=0;
                $ligne_courante=$lines[$i];
                if (($i+1)>=count($lines)) {
                    $ligne_suivante='FIN';
                } else {
                    $ligne_suivante=$lines[$i+1];
                }
                while ($i<count($lines)) {
                    $line_in=$ligne_courante;
                    while (($i < count($lines)) && ((substr($ligne_suivante, 0, 6) != 'INSERT') && (substr($ligne_suivante, 0, 6) != 'CREATE') ) && ($ligne_suivante != 'FIN')) {
                        $line_in.=$ligne_suivante;
                        $i++;
                        $ligne_courante=$lines[$i];
                        if (($i+1)>=count($lines))  {
                            $ligne_suivante='FIN';
                        } else {
                        $ligne_suivante=$lines[$i+1];
                        }
                    }

                    $requete = $line_in;

                    //requete sql
                    $result = $GLOBALS['_BAZAR_']['db']->query ($requete);

                    $i++;
                    $ligne_courante=$lines[$i];
                    if (($i+1)>=count($lines))  {
                        $ligne_suivante='FIN';
                    } else {
                        $ligne_suivante=$lines[$i+1];
                    }

                    //if ($i == (int)$this->test) {
                    //    break;
                    //}
                }
            }
            exit('La base de donn&eacute;es bazar vient d\'&eacirc;tre ajout&eacute;e, veuillez r&eacute;-actualiser la page pour continuer');
        } else {
            echo 'Fichier sql introuvable'."\n";
        }

}


// +------------------------------------------------------------------------------------------------------+
// |                             LES CONSTANTES DES ACTIONS DE BAZAR                                      |
// +------------------------------------------------------------------------------------------------------+
define ('BAZ_MOTEUR_RECHERCHE', 'recherche') ;
define ('BAZ_ACTION_VOIR_VOS_ANNONCES', 'vos_fiches');
define ('BAZ_DEPOSER_ANNONCE', 'choisir_type_fiche') ;
define ('BAZ_ANNONCES_A_VALIDER', 'voir_validation') ;
define ('BAZ_GERER_DROITS', 'droits') ;
define ('BAZ_ADMINISTRER_ANNONCES', 'voir_admin_fiches') ;
define ('BAZ_MODIFIER_FICHE', 'modif_fiches') ;
define ('BAZ_VOIR_FICHE', 'voir_fiche') ;
define ('BAZ_ACTION_NOUVEAU', 'saisir_fiche') ;
define ('BAZ_ACTION_NOUVEAU_V', 'sauver_fiche') ;
define ('BAZ_ACTION_MODIFIER', 'modif_fiche') ;
define ('BAZ_ACTION_MODIFIER_V', 'modif_sauver_fiche') ;
define ('BAZ_ACTION_SUPPRESSION', 'supprimer') ;
define ('BAZ_ACTION_PUBLIER', 'publier') ;
define ('BAZ_ACTION_PAS_PUBLIER', 'pas_publier') ;
define ('BAZ_LISTE_RSS', 'rss');
define ('BAZ_VOIR_FLUX_RSS', 'affiche_rss');
define ('BAZ_VOIR_PDF', 'export_pdf');

// Constante des noms des variables
define ('BAZ_VARIABLE_VOIR', 'vue');
define ('BAZ_VARIABLE_ACTION', 'action');

// Indique les onglets de vues a afficher.
define ('BAZ_VOIR_AFFICHER', 'mes_fiches,consulter,rss,saisir,formulaire,administrer,droits');

// Permet d'indiquer la vue par defaut si la variable vue n'est pas defini
define ('BAZ_VOIR_DEFAUT', 'consulter');
define ('BAZ_VOIR_CONSULTER', 'consulter');
define ('BAZ_VOIR_MES_FICHES', 'mes_fiches');
define ('BAZ_VOIR_S_ABONNER', 'rss');
define ('BAZ_VOIR_SAISIR', 'saisir');
define ('BAZ_VOIR_FORMULAIRE', 'formulaire');
define ('BAZ_VOIR_ADMIN', 'administrer');
define ('BAZ_VOIR_GESTION_DROITS', 'droits');

// Constante pour se passer d'identification
define ('BAZ_SANS_AUTH', true);

// Constante pour l'envoi automatique de mail aux admins
define ('BAZ_ENVOI_MAIL_ADMIN', true);
define ('BAZ_ADRESSE_MAIL_ADMIN', 'observatoire.ocim@u-bourgogne.fr');


//==================================== LES FLUX RSS==================================
// Constantes liees aux flux RSS
//==================================================================================
define('BAZ_RSS_NOMSITE', $wakkaConfig['wakka_name']);    //Nom du site indique dans les flux rss
define('BAZ_RSS_ADRESSESITE', $wakkaConfig['base_url']);   //Adresse Internet du site indique dans les flux rss
define('BAZ_RSS_DESCRIPTIONSITE', $wakkaConfig['meta_description']);    //Description du site indiquee dans les flux rss
define('BAZ_RSS_LOGOSITE','http://outils-reseaux.org/tools/templates/themes/outils-reseaux/images/Puce-titre.gif');     //Logo du site indique dans les flux rss
define('BAZ_RSS_MANAGINGEDITOR', 'accueil@outils-reseaux.org (association Outils-Reseaux)') ;     //Managing editor du site
define('BAZ_RSS_WEBMASTER', 'observatoire.ocim@u-bourgogne.fr') ;     //Mail Webmaster du site
define('BAZ_RSS_CATEGORIE', 'Patrimoine, culture scientifique et technique'); //categorie du flux RSS


//==================================== PARAMETRAGE =================================
// Pour regler certaines fonctionnalites de l'application
//==================================================================================

//Valeur par defaut d'etat de la fiche annonce apres saisie
//Mettre 0 pour 'en attente de validation d'un administrateur'
//Mettre 1 pour 'directement validee en ligne'
define ('BAZ_ETAT_VALIDATION', 1);

//Valeur maximale en octets pour la taille d'un fichier joint a telecharger
define ('BAZ_TAILLE_MAX_FICHIER', 10000*1024);

//Type d'affichage des dates dans la liste
//Mettre jma pour jour mois annee, ou jm, ou jmah
define ('BAZ_TYPE_AFFICHAGE_LISTE', 'jma');

/** Reglage des droits pour deposer des annonces */
// Mettre a true pour limiter le depot aux redacteurs
define ('BAZ_RESTREINDRE_DEPOT', false) ;

/** Reglage de l'affichage de la liste deroulante pour la saisie des dates */
// Mettre a true pour afficher une liste deroulante vide pour la saisie des dates
define ('BAZ_DATE_VIDE', false);

// Mettre a true pour faire apparaitre un champs texte deroulant dans le formulaire
// de recherche des fiches, pour choisir les emetteurs
define ('BAZ_RECHERCHE_PAR_EMETTEUR', false) ;

/**Choix de l'affichage (true) ou pas (false) de l'email du redacteur dans la fiche.*/
define('BAZ_FICHE_REDACTEUR_MAIL', true);// true ou false

//==================================== LES LANGUES ==================================
// Constantes liees a l'utilisation des langues
//==================================================================================
$GLOBALS['_BAZAR_']['langue'] = 'fr-FR';
define ('BAZ_LANGUE_PAR_DEFAUT', 'fr') ; //Indique un code langue par defaut
define ('BAZ_VAR_URL_LANGUE', 'lang') ; //Nom de la variable GET qui sera passee dans l'URL (Laisser vide pour les sites monolingues)
//code pour l'inclusion des langues NE PAS MODIFIER
if (BAZ_VAR_URL_LANGUE != '' && isset (${BAZ_VAR_URL_LANGUE})) {
    include_once BAZ_CHEMIN.'langues/baz_langue_'.${BAZ_VAR_URL_LANGUE}.'.inc.php';
} else {
    include_once BAZ_CHEMIN.'langues/baz_langue_'.BAZ_LANGUE_PAR_DEFAUT.'.inc.php';
}

// Option concernant la division des resultats en pages
define ('BAZ_NOMBRE_RES_PAR_PAGE', 30);
define ('BAZ_MODE_DIVISION', 'Jumping'); 	// 'Jumping' ou 'Sliding' voir http://pear.php.net/manual/fr/package.html.pager.compare.php
define ('BAZ_DELTA', 12);		// Le nombre de page a afficher avant le 'next';

/** Reglage de l'affichage du formulaire de recherche avancee */
// Mettre a true pour afficher automatiquement le formulaire de recherche avancee
// Mettre a false pour avoir un lien afficher la recherche avancee
define ('BAZ_MOTEUR_RECHERCHE_AVANCEE', true);

/** Reglage de l'utilisation ou non des templates */
// Mettre a true pour afficher les pages incluses dans la base bazar_template, a false sinon
define ('BAZ_UTILISE_TEMPLATE', false);

/** Mettre a 0 pour le pas proposer de filtre dans le moteur de recherche */
define ('BAZ_AFFICHER_FILTRE_MOTEUR', true);

// Mettre ici le type d'annonce qui va s'afficher dans les calendriers.
// Il est possible d'indiquer plusieurs identifiant de nature de fiche  (bn_id_nature) en s�parant les nombre par des
// virgules : '1,2,3'
define ('BAZ_NUM_ANNONCE_CALENDRIER', 3);
define ('BAZ_SQUELETTE_DEFAUT', 'baz_cal.tpl.html');


//=========================== PARAMETRAGE GOOGLE MAP API ===========================
// parametres pour la carto google
//==================================================================================

// coordonnees du centre de la carte
define ('BAZ_GOOGLE_CENTRE_LAT', '46.81726017727322');
define ('BAZ_GOOGLE_CENTRE_LON', '1.6699257578125115');

// niveau de zoom
define ('BAZ_GOOGLE_ALTITUDE', '6'); // de 1 (plus eloigne) a 15 (plus proche)

// type de carto google
define ('BAZ_TYPE_CARTO', 'TERRAIN'); //ROADMAP ou SATELLITE ou HYBRID ou TERRAIN

// taille de la carte a l'ecran
define ('BAZ_GOOGLE_IMAGE_LARGEUR', '100%');  // valeur de l'attribut css width de la carte
define ('BAZ_GOOGLE_IMAGE_HAUTEUR', '600px');  // valeur de l'attribut css height de la carte

// image marqueur
define ('BAZ_IMAGE_MARQUEUR','tools/bazar/presentation/images/marker.png');
define ('BAZ_DIMENSIONS_IMAGE_MARQUEUR','12, 20');
define ('BAZ_COORD_ORIGINE_IMAGE_MARQUEUR','0,0');
define ('BAZ_COORD_ARRIVEE_IMAGE_MARQUEUR','0,20');

// image ombre marqueur
define ('BAZ_IMAGE_OMBRE_MARQUEUR','tools/bazar/presentation/images/marker_shadow.png');
define ('BAZ_DIMENSIONS_IMAGE_OMBRE_MARQUEUR','22, 20');
define ('BAZ_COORD_ORIGINE_IMAGE_OMBRE_MARQUEUR','0,0');
define ('BAZ_COORD_ARRIVEE_IMAGE_OMBRE_MARQUEUR','0,20');

// Controles carte
define ('BAZ_AFFICHER_NAVIGATION','true'); // true ou false
define ('BAZ_AFFICHER_CHOIX_CARTE','true'); // true ou false
define ('BAZ_AFFICHER_ECHELLE','false'); // true ou false
define ('BAZ_PERMETTRE_ZOOM_MOLETTE','false');
define ('BAZ_STYLE_NAVIGATION','ZOOM_PAN'); // SMALL ou ZOOM_PAN ou ANDROID ou DEFAULT
define ('BAZ_STYLE_CHOIX_CARTE','DROPDOWN_MENU'); // HORIZONTAL_BAR ou DROPDOWN_MENU ou DEFAULT

// inclure l'url d'un fichier kml (carte google creee precedemment) a afficher sur la carte
define ('BAZ_GOOGLE_FOND_KML', '');

//inclure un fichier js spécifique, pour ajouter des polygones à la carte par exemple
define('BAZ_JS_INIT_MAP', '')

?>
