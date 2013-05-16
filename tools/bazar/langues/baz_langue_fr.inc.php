<?php
/*vim: set expandtab tabstop=4 shiftwidth=4: */
// +------------------------------------------------------------------------------------------------------+
// | PHP version 4.1                                                                                      |
// +------------------------------------------------------------------------------------------------------+
// | Copyright (C) 2004 Tela Botanica (accueil@tela-botanica.org)                                         |
// +------------------------------------------------------------------------------------------------------+
// | This library is free software; you can redistribute it and/or                                        |
// | modify it under the terms of the GNU Lesser General Public                                           |
// | License as published by the Free Software Foundation; either                                         |
// | version 2.1 of the License, or (at your option) any later version.                                   |
// |                                                                                                      |
// | This library is distributed in the hope that it will be useful,                                      |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of                                       |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU                                    |
// | Lesser General Public License for more details.                                                      |
// |                                                                                                      |
// | You should have received a copy of the GNU Lesser General Public                                     |
// | License along with this library; if not, write to the Free Software                                  |
// | Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA                            |
// +------------------------------------------------------------------------------------------------------+
// CVS : $Id: baz_langue_fr.inc.php,v 1.6 2010/03/04 14:19:04 mrflos Exp $
/**
* Fichier de traduction en francais de l'application Bazar
*
*@package bazar
//Auteur original :
*@author        Alexandre GRANIER <alexandre@tela-botanica.org>
*@author        Florian Schmitt <florian@ecole-et-nature.org>
//Autres auteurs :
*@author        Aucun
*@copyright     Tela-Botanica 2000-2004
*@version       $Revision: 1.6 $ $Date: 2010/03/04 14:19:04 $
// +------------------------------------------------------------------------------------------------------+
*/

define ('BAZ_FORMULAIRE', 'Formulaires');
define ('BAZ_LISTES', 'Listes');
define ('BAZ_NOM_LISTE', 'Nom de la liste');
define ('BAZ_VALEURS_LISTE', 'Valeurs de la liste');
define ('BAZ_AJOUTER_LABEL_LISTE', 'Ajouter une nouvelle valeur &agrave; la liste');
define ('BAZ_AJOUTER_CHAMPS_FORMULAIRE', 'Ajouter un nouveau champs au formulaire');
define ('BAZ_MODIFIER_FORMULAIRES', 'Gestion des formulaires');
define ('BAZ_MODIFIER_LISTES', 'Gestion des listes');
define ('BAZ_INTRO_MODIFIER_FORMULAIRE', 'Pour &eacute;diter un formulaire, cliquez sur son nom ou sur l\'icone avec le crayon.<br />Pour supprimer un formulaire, cliquez sur l\'icone de la corbeille.<br /> Pour cr&eacute;er un nouveau formulaire, cliquez sur le lien en dessous de cette liste.');
define ('BAZ_INTRO_MODIFIER_LISTE',  'Pour &eacute;diter une liste, cliquez sur son nom ou sur l\'icone avec le crayon.<br />Pour supprimer une liste, cliquez sur l\'icone de la corbeille.<br /> Pour cr&eacute;er une nouvelle liste, cliquez sur le lien avec un signe plus en bas de page.');
define ('BAZ_CONFIRM_SUPPRIMER_FORMULAIRE', 'Attention! Toutes les donn&eacute;es enregistr&eacute;es seront perdues.. Etes-vous s&ucirc;rs de vouloir supprimer ce type de formulaire et toutes ses fiches associ&eacute;es');
define ('BAZ_CONFIRM_SUPPRIMER_LISTE', 'Attention! Toutes les donn&eacute;es enregistr&eacute;es seront perdues.. Etes-vous s&ucirc;rs de vouloir supprimer cette liste et toutes ses donn&eacute;es associ&eacute;es');
define ('BAZ_NOUVEAU_FORMULAIRE', 'Saisir un nouveau type de questionnaire');
define ('BAZ_NOUVELLE_LISTE', 'Saisir une nouvelle liste');
define ('BAZ_FORMULAIRE_ET_FICHES_SUPPRIMES', 'Le type de formulaire et ses fiches associ&eacute;es ont bien &eacute;t&eacute; supprim&eacute;s.');
define ('BAZ_LISTES_SUPPRIMEES', 'La liste &agrave; bien &eacute;t&eacute; supprim&eacute;e.');
define ('BAZ_NOM_FORMULAIRE', 'Nom du formulaire');
define ('BAZ_EFFACER', 'Effacer');
define ('BAZ_TEMPLATE','Template');
define ('BAZ_CONDITION','Conditions de saisie');
define ('BAZ_AUTORISER_COMMENTAIRE','Autoriser les commentaires sur les fiches');
define ('BAZ_AUTORISER_APPROPRIATION','Autoriser l\'appropriation des fiches');
define ('BAZ_NOM_CLASSE_CSS','Nom de la classe CSS');
define ('BAZ_CATEGORIE_FORMULAIRE', 'Cat&eacute;gorie du formulaire');
define ('BAZ_NOUVEAU_FORMULAIRE_ENREGISTRE', 'Le nouveau formulaire a bien &eacute;t&eacute; enregistr&eacute;.');
define ('BAZ_NOUVELLE_LISTE_ENREGISTREE', 'La nouvelle liste a bien &eacute;t&eacute; enregistr&eacute;e.');
define ('BAZ_FORMULAIRE_MODIFIE', 'Le formulaire a bien &eacute;t&eacute; modifi&eacute;.');
define ('BAZ_LISTE_MODIFIEE', 'La liste a bien &eacute;t&eacute; modifi&eacute;e.');
define ('BAZ_CONFIRM_SUPPRIMER_FICHE', 'Etes vous sûr de vouloir supprimer la fiche ?');
define ('BAZ_FICHE_SUPPRIMEE', 'La fiche a bien &eacute;t&eacute; supprim&eacute;e.');
define ('BAZ_FICHE_MODIFIEE', 'La fiche a bien &eacute;t&eacute; modifi&eacute;e.');
define ('BAZ_FICHE_VALIDEE', 'La fiche a bien &eacute;t&eacute; valid&eacute;e.');
define ('BAZ_FICHE_PAS_VALIDEE', 'La fiche a bien &eacute;t&eacute; invalid&eacute;e.');
define ('BAZ_FICHE_ENREGISTREE', 'La fiche a bien &eacute;t&eacute; enregistr&eacute;e.');
define ('BAZ_RECHERCHE_AVANCEE', 'Recherche avanc&eacute;e');
define ('BAZ_RECHERCHER_2POINTS', 'Rechercher : ');
define ('BAZ_TOUS_TYPES_FICHES', 'Tous types de fiches');
//define ('BAZ_TOUS_LES_EMETTEURS', 'Tous les emetteurs');
//define ('BAZ_ENTRER_VOS_CRITERES_DE_RECHERCHE','Pr&eacute;cisez vos crit&egrave;res de recherche et appuyez sur le bouton "Rechercher" pour consulter les fiches.');
//define ('BAZ_MODIFIE_RSS','Modifi&eacute;: ' );
define ('BAZ_FLUX_RSS_GENERAL', 'Flux RSS de toutes les fiches');
//define ('BAZ_NOM', 'Nom') ;
//define ('BAZ_PRENOM', 'Pr&eacute;nom') ;
//define ('BAZ_TOUS', 'Tous');
//define ('BAZ_TOUTES', 'Toutes');
define ('BAZ_MOT_CLE', 'mots clés (facultatif)');
//define ('BAZ_EMETTEUR', '&Eacute;metteur');
//define ('BAZ_NATURE', 'Nature de la fiche' );
//define ('BAZ_STATUT', 'Statut' );
define ('BAZ_DATE_CREATION', 'Date de cr&eacute;ation' );
define ('BAZ_DATE_MAJ', 'Date de mise &agrave; jour' );
//define ('BAZ_URL_IMAGE', 'Image' );
//define ('BAZ_LANGUES_PARLES', 'Langues parl&eacute;s :') ;
//define ('BAZ_EMAIL', 'E-mail :') ;
//define ('BAZ_MOT_DE_PASSE', 'Mot de passe') ;
define ('BAZ_TITREANNONCE', 'Titre de la fiche') ;
define ('BAZ_TYPE_FICHE', 'Type de fiche') ;
define ('BAZ_TYPEANNONCE', 'Type de fiche');
define ('BAZ_FICHIER_CSV_A_IMPORTER', 'Entrez le fichier CSV &agrave; importer');
define ('BAZ_EXEMPLE_FICHIER_CSV', 'Exemple de structuration du fichier CSV pour les fiches de type : ');
define ('BAZ_VISUALISATION_FICHIER_CSV_A_IMPORTER', 'Visualisation du fichier CSV pour l\'export des fiches de type : ');
define ('BAZ_TOTAL_FICHES', 'Total des fiches');
define ('BAZ_ENCODAGE_CSV', 'Le fichier CSV doit être encod&eacute; en UTF-8, avec des virgules (,) comme séparateurs et des doubles guillemets (") pour les diff&eacute;rentes valeurs.<br />Les champs avec une étoile (*) sont obligatoires et doivent contenir des données.');
//define ('BAZ_IMPORTER_CE_FICHIER', 'Importer ce fichier');
//define ('BAZ_ANNONCEUR', 'Annonceur') ;
//define ('BAZ_REPETE_MOT_DE_PASSE', 'R&eacute;p&eacute;ter le mot de passe :') ;
//define ('BAZ_OUI', 'Oui') ;
define ('BAZ_TOUTES_LES_ANNONCES', 'Consulter les fiches');
define ('BAZ_VOIR_VOS_ANNONCES', 'Mes fiches');
define ('BAZ_VOS_ANNONCES', 'Vos fiches');
define ('BAZ_CHOIX_TYPEANNONCE', 'Choix du type de fiche');
define ('BAZ_NON', 'Non') ;
define ('BAZ_ANNULER', 'Annuler') ;
define ('BAZ_TOUTES_LES_ANNONCES_DE_TYPE', 'Toutes les fiches de type') ;
//define ('BAZ_RETABLIR', 'R&eacute;tablir') ;
define ('BAZ_VALIDER', 'Valider') ;
//define ('BAZ_PUBLIER', 'Valider la publication') ;
define ('BAZ_ETATPUBLICATION', 'Etat de publication') ;
//define ('BAZ_ENCOURSDEVALIDATION', 'En attente de validation');
//define ('BAZ_REJETEE', 'Rejet&eacute;e');
define ('BAZ_PUBLIEE', 'Publi&eacute;e') ;
define ('BAZ_PAS_DE_FICHE', 'Vous n\'avez pas encore saisi de fiches.') ;
//define ('BAZ_PAS_DE_FICHE_A_VALIDER', 'Pas de fiche &agrave; valider pour l\'instant.');
define ('BAZ_VOS_FICHES', 'Mes fiches saisies') ;
//define ('BAZ_ANNONCES_A_ADMINISTRER', 'Les fiches &agrave; valider') ;
//define ('BAZ_MOTS_DE_PASSE_DIFFERENTS', 'Les mots de passe sont diff&eacute;rents !') ;
//define ('BAZ_EMAIL_REQUIS', 'Vous devez saisir un email.') ;
//define ('BAZ_MOT_DE_PASSE_REQUIS', 'Vous devez saisir un mot de passe.') ;
//define ('BAZ_MAIL_INCORRECT', 'L\'email doit avoir une forme correcte, utilisateur@domaine.ext') ;
//define ('BAZ_MAIL_DOUBLE', 'Cet email est d&eacute;j&agrave utilis&eacute; par quelqu\'un d\'autre') ;
//define ('BAZ_NOTE_REQUIS', 'Indique les champs requis') ;
define ('BAZ_ERREUR_SAISIE', 'Erreur de saisie ') ;
define ('BAZ_VEUILLEZ_CORRIGER', 'Veuillez corriger') ;
define ('BAZ_MODIFIER', 'Modifier') ;
define ('BAZ_MODIFIER_LA_FICHE', 'Modifier la fiche') ;
define ('BAZ_SUPPRIMER', 'Supprimer') ;
define ('BAZ_SUPPRIMER_IMAGE', 'Supprimer l\'image') ;
//define ('BAZ_SELECTION', '--S&eacute;lectionnez ici--');
//define ('BAZ_DROITS_PAR_TYPE', 'Droits par type de fiches:');
define ('BAZ_TITRE_SAISIE_FICHE', 'Saisir une fiche : ');
define ('BAZ_TITRE_SAISIE_ANNONCE', 'Saisir une fiche : ');
//define ('BAZ_ACCUEIL','Accueil');
//define ('BAZ_SORTIRDELAPPLI','Quittez l\'application Bazar');
//define ('BAZ_DEPOSE_UNE_NOUVELLE_ANNONCE', 'Saisir une fiche') ;
define ('BAZ_CHOIX_TYPE_FICHE', 'Choisissez le type de fiche que vous souhaitez d&eacute;poser:') ;
//define ('BAZ_GESTION_DES_DROITS', 'Gestion des droits');
//define ('BAZ_DESCRIPTION_GESTION_DES_DROITS', 'Veuillez choisir un utilisateur dans la liste d&eacute;roulante ci-dessous pour administrer ses droits.');
//define ('BAZ_LABEL_CHOIX_PERSONNE', 'Choix de la personne dans l\'annuaire: ');
define ('BAZ_CONFIRMATION_SUPPRESSION', 'Etes-vous s&ucirc;r de vouloir supprimer cette fiche ?') ;
//define ('BAZ_NON_VALIDE', 'Non valide') ;
//define ('BAZ_VALIDE', 'Valide') ;
define ('BAZ_VALIDER_LA_FICHE', 'Valider la fiche') ;
define ('BAZ_PRECEDENT', 'Pr&eacute;c&eacute;dent') ;
define ('BAZ_SUIVANT', 'Suivant') ;
//define ('BAZ_PAS_DE_FICHE_CRIT', 'Pas de fiche correspondant &agrave; vos crit&egrave;res.') ;
//define ('BAZ_TEXTE_IMG_ALTERNATIF', 'Image de la fiche');
//define ('BAZ_NUM_FICHE', 'Num&eacute;ro de fiche');
//define ('BAZ_ADMIN_ANNONCES', 'Modifier les types de fiches');
//define ('BAZ_RECHERCHER_DES_ANNONCES', 'Rechercher des fiches');
//define ('BAZ_RECHERCHE_DE_BASE','<< Recherche simple');
//define ('BAZ_DESCRIPTION_RECHERCHE', 'En pr&eacute;cisant, ci dessus, le type de fiche cherch&eacute;, vous pourrez obtenir des fonctions de recherche avanc&eacute;.');
define ('BAZ_PAS_DE_FICHES', 'Pas de fiches trouv&eacute;es.');
define ('BAZ_S_ABONNER_AUX_FICHES', 'S\'abonner &agrave; un type de fiche');
//define ('BAZ_ABONNE', 'Abonn&eacute;');
//define ('BAZ_PAS_ABONNE', 'Pas abonn&eacute;');
define ('BAZ_S_ABONNER', 'S\'abonner');
//define ('BAZ_LAIUS_S_ABONNER', 'Il y a deux mani&egrave;res de s\'abonner:<br />- soit en s\'abonnant pour recevoir les fiches par mails<br />- soit par flux RSS');
//define ('BAZ_SE_DESABONNER', 'Se d&eacute;sabonner');
define ('BAZ_RSS', 'Flux RSS');
define ('BAZ_DERNIERE_ACTU', 'Derni&egrave;res actualit&eacute;s');
define ('BAZ_DERNIERES_FICHES', 'Les derni&egrave;res fiches saisies');
//define ('BAZ_A_MODERER',' &agrave; mod&eacute;rer');
define ('BAZ_CONSULTER','Rechercher');
define ('BAZ_SAISIR','Saisir');
//define ('BAZ_ADMINISTRER','Administrer');
//define ('BAZ_FICHE_ECRITE','Fiche &eacute;crite par : ');
define ('BAZ_NB_VUS',', consult&eacute;e ');
define ('BAZ_FOIS', ' fois depuis sa cr&eacute;ation.');
//define ('BAZ_LES_COMMENTAIRES', 'Les commentaires sur cette fiche');
//define ('BAZ_PAS_DE_COMMENTAIRES', 'Pas de commentaires post&eacute;s pour l\'instant.');
define ('BAZ_IL_Y_A', 'Il y a ');
//define ('BAZ_COMMENTAIRE', 'commentaire : ');
//define ('BAZ_COMMENTAIRES', 'commentaires : ');
//define ('BAZ_ENTREZ_VOTRE_NOM', 'Entrez votre nom : ');
//define ('BAZ_ENTREZ_VOTRE_COMMENTAIRE', 'Entrez votre commentaire : ');
//define ('BAZ_ENVOYER','Envoyer');
//define ('BAZ_NOM_REQUIS', 'Le champs nom ne doit pas rester vide');
//define ('BAZ_COMMENTAIRE_REQUIS', 'Le champs commentaire ne doit pas rester vide');
//define ('BAZ_LES_STRUCTURES_POSSEDANT_UNE_RESSOURCE', 'Les structures possï¿½dant cette ressource');
//define ('BAZ_FICHES_PAS_VALIDEES','Seulement les fiches pas valid&eacute;es');
//define ('BAZ_FICHES_VALIDEES','Seulement les fiches valid&eacute;es');
//define ('BAZ_LES_DEUX','Fiches valid&eacute;es et non valid&eacute;es');
//define ('BAZ_FICHES_PERIMEES','Seulement les fiches p&eacute;rim&eacute;es');
//define ('BAZ_FICHES_PAS_PERIMEES','Seulement les fiches non p&eacute;rim&eacute;es');
//define ('BAZ_TOUTES_LES_DATES','Les fiches p&eacute;rim&eacute;es et non p&eacute;rim&eacute;es');
//define ('BAZ_DATE','Dates des fiches');
define ('BAZ_VOIR_VOS_FICHES', 'Mes fiches');
define ('BAZ_RECHERCHER','Rechercher');
define ('BAZ_SAISIR_UNE_NOUVELLE_FICHE','Saisir une nouvelle fiche');
define ('BAZ_MODIFIER_IMAGE', ', ou modifier l\'image');
define ('BAZ_FICHIER', 'Le fichier ');
//define ('BAZ_A_ETE_EFFACE', ' a &eacute;t&eacute; effac&eacute;.');
define ('BAZ_FICHIER_IMAGE_INEXISTANT', ' inexistant sur le serveur, la base de donn&eacute;es va être actualis&eacute;. Veuillez actualiser votre navigateur.');
//define ('BAZ_CONFIRMATION_SUPPRESSION_LIEN', 'Etes-vous s&ucirc;r de vouloir supprimer ce lien ?') ;
define ('BAZ_CONFIRMATION_SUPPRESSION_FICHIER', 'Etes-vous s&ucirc;r de vouloir supprimer ce fichier ?') ;
//define ('BAZ_CONFIRMATION_SUPPRESSION_IMAGE', 'Etes-vous s&ucirc;r de vouloir supprimer cette image ?') ;
//define ('BAZ_VALIDER_PUBLICATION', 'Valider la publication');
//define ('BAZ_ENTRER_PROJET', 'ENTRER SUR L\'ESPACE DU PROJET');
//define ('BAZ_GOOGLE_MSG', '<br />Si l\'&eacute;v&egrave;nement est bien situ&eacute; vous pouvez valider la fiche<br />');
define ('BAZ_SUPPRIMER_LA_FICHE', 'Supprimer la fiche');
define ('BAZ_INVALIDER_LA_FICHE', 'Invalider la fiche');
//define ('BAZ_TOUTES_LES_FICHES', 'Toutes les fiches');
//define ('BAZ_PAS_DROIT_SUPPRIMER', 'Vous n\'avez pas les droits pour supprimer cette fiche');
define ('BAZ_LATITUDE', 'Latitude');
define ('BAZ_LONGITUDE', 'Longitude');
define ('BAZ_VERIFIER_MON_ADRESSE', 'V&eacute;rifier mon adresse avec la carte');
define ('BAZ_PAS_DE_FORMULAIRES_TROUVES', 'Pas de formulaires trouvés');
define ('BAZ_CHAMPS_REQUIS', 'champs requis');
//define ('BAZ_PAR', 'par');
//define ('BAZ_ECRIT_LE',', &eacute;crit le ');
define ('BAZ_FICHES_CORRESPONDANTES', 'fiches correspondantes &agrave; votre recherche') ;
define ('BAZ_FICHE_CORRESPONDANTE', 'fiche correspondante &agrave; votre recherche') ;
//
////================Le formulaire ================================================
//define ('BAZ_AJOUTER_CHAMPS_DE_BASE', 'Ajouter les informations de base pour la fiche');
//define ('BAZ_PAYS', 'Pays');
//define ('BAZ_PAYS_REQUIS', 'Le champs pays est requis!');
//define ('BAZ_ORGANISME', 'Organisme');
//define ('BAZ_CONTACT', 'Contact');
//define ('BAZ_REGION', 'R&eacute;gion');
//define ('BAZ_REGION_REQUIS', 'Le champs r&eacute;gion est requis!');
//define ('BAZ_DEPARTEMENT', 'D&eacute;partement') ;
//define ('BAZ_DEPARTEMENT_REQUIS', 'Le champs d&eacute;partement est requis!');
//define ('BAZ_LICENCE', 'Type de licence') ;
//define ('BAZ_LICENCE_REQUIS', 'Le type de licence est requis!') ;
//define ('BAZ_TITRE', 'Titre') ;
//define ('BAZ_TITRE_REQUIS', 'Un titre de fiche est requis!') ;
define ('BAZ_DESCRIPTION', 'Description') ;
//define ('BAZ_DESCRIPTION_REQUIS', 'Une description de la fiche est requise!!') ;
//define ('BAZ_DATEDEBVALID', 'D&eacute;but de parution' );
//define ('BAZ_DATEDEBVALID_REQUIS', 'La date de d&eacute;but de parution est requise!!') ;
//define ('BAZ_DATEFINVALID', 'Fin de parution' );
//define ('BAZ_DATEFINVALID_REQUIS', 'La date de fin de parution est requise!!') ;
//define ('BAZ_DU', 'du') ;
//define ('BAZ_AU', 'au') ;
//define ('BAZ_LE', 'Le') ;
//define ('BAZ_DATE_DEBUT_EVENEMENT', 'D&eacute;but de l\'&eacute;venement' );
//define ('BAZ_DATE_DEBUT_EVENEMENT_REQUIS', 'La date de d&eacute;but de l\'&eacute;venement est requise!!') ;
//define ('BAZ_DATE_FIN_EVENEMENT', 'Fin de l\'&eacute;venement' );
//define ('BAZ_DATE_FIN_EVENEMENT_REQUIS', 'La date de fin de l\'&eacute;venement est requise!!') ;
//define ('BAZ_LIEU_EVENEMENT', 'Lieu de l\'&eacute;venement' );
//define ('BAZ_LIEU_EVENEMENT_REQUIS', 'Le lieu de l\'&eacute;venement est requis!!') ;
//define ('BAZ_PAS_UNE_IMAGE', 'Ce fichier n\'est pas une image.' );
//define ('BAZ_AJOUTER_IMAGE', 'Pour l\'instant, pas d\'image associ&eacute;e &agrave; la fiche, vous pouvez en ajouter une ci-dessous.' );
//define ('BAZ_IMAGE', 'Image pour la fiche (facultatif)' );
//define ('BAZ_IMAGE_VALIDE_REQUIS', 'Le fichier image n\'est pas valide.') ;
//
//define ('BAZ_LIEN', 'Lien' );
//define ('BAZ_LIEN_INTERNET', 'Liens Internet' );
//define ('BAZ_URL_LIEN', 'Adresse du lien (URL)' );
//define ('BAZ_URL_LIEN_REQUIS', 'L\'adresse  du lien (URL) est requise!!') ;
//define ('BAZ_URL_TEXTE', 'Texte du lien' );
//define ('BAZ_URL_TEXTE_REQUIS', 'Le texte du lien est requis!!') ;
//define ('BAZ_AJOUTER_FICHIER_JOINT','Ajouter un fichier joint &agrave la fiche');
//define ('BAZ_FICHIER_JOINT', 'Fichier joint' );
//define ('BAZ_LISTE_FICHIERS_JOINTS', 'Fichiers associ&eacute;s &agrave; la fiche ');
//define ('BAZ_PAS_DE_FICHIERS_JOINTS', 'Pour l\'instant, pas de fichier associ&eacute; &agrave; la fiche, vous pouvez en ajouter ci-dessous.');
//define ('BAZ_FICHIER_JOINT_REQUIS', 'Le fichier joint est requis!!') ;
//define ('BAZ_FICHIER_DESCRIPTION', 'Description du fichier' );
//define ('BAZ_FICHIER_TEXTE_REQUIS', 'Le texte du fichier est requis!!') ;
//define ('BAZ_FICHIER_LABEL', 'Label du fichier') ;
//define ('BAZ_FICHIER_LABEL_REQUIS', 'Le label du fichier est requis!!') ;
//define ('BAZ_FICHIER_EXISTANT', 'Il existe d&eacute;j&agrave; un fichier du m&ecirc;me nom sur le site.<br />Votre fiche a &eacute;t&eacute; associ&eacute;e avec le fichier existant d&eacute;j&agrave;.');
//define ('BAZ_ACCEPTE_CONDITIONS', 'J\'accepte les conditions de saisie de la fiche');
//define ('BAZ_ACCEPTE_CONDITIONS_REQUIS', 'Vous devez accepter les conditions de saisie de la fiche');
//
define ('BAZ_CHOISIR', 'Choisir...');
define ('CHOISIR', 'Choisir...');
define ('BAZ_CHOISIR_OBLIGATOIRE', 'Il faut choisir une option dans la liste ');
define ('BAZ_INDIFFERENT','Indiff&eacute;rent');
define ('INDIFFERENT','Indiff&eacute;rent');
//
//define ('BAZ_COORDONNEES','Coordonn&eacute;es');
//define ('BAZ_ANNEE_PARUTION','Ann&eacute;e de parution');
//define ('BAZ_LANGUE','Langue');
//define ('BAZ_THEMES','Th&ecirc;mes');
//define ('BAZ_PAS_D_APPROPRIATION','Aucune structure ne s\'est appropri&eacute; cette ressource pour l\'instant.');
//define ('BAZ_STRUCTURE_POSSEDANT', 'structure poss&eacute;dant cette ressource.');
//define ('BAZ_STRUCTURES_POSSEDANT', 'structures poss&eacute;dant cette ressource.');
//define ('BAZ_SI_POSSEDE_RESSOURCE', 'Si vous poss&egrave;dez cette ressource dans votre structure:');
//define ('BAZ_POSSEDE_DEJA_RESSOURCE', 'Vous poss&egrave;dez cette ressource.');
//define ('BAZ_CLIQUER_POUR_VOUS_ENLEVER', 'cliquez ici pour vous enlever de la liste.');
//define ('BAZ_IL_FAUT_ETRE_STRUCTURE', 'Seules les structures identifi&eacute;es peuvent s\'approprier cette ressource.');
//define ('BAZ_IL_FAUT_ETRE_IDENTIFIE_STRUCTURE', 'En vous identifiant ou ou vous inscrivant en tant que structure, vous pouvez vous associer cette ressource.');
//define ('BAZ_CLIQUER_POUR_APPARAITRE', 'cliquez ici pour appaitre dans la liste.');
//define ('BAZ_NON_PRECISE','Non pr&eacute;cis&eacute;');
//
//
//define ('BAZ_IDENTIFIEZ_VOUS_POUR_SAISIR', 'Pour saisir des fiches, voir vos fiches ou s\'abonner:<br /> veuillez vous identifier ou vous inscrire.');
define ('BAZ_IDENTIFIEZ_VOUS_POUR_VOIR_VOS_FICHES', 'Pour voir vos fiches, veuillez vous identifier.');
//define ('BAZ_EST_SUPERADMINISTRATEUR', 'Cette personne est un super-administrateur.<br />Il peut modifier le droits des utilisateurs et administrer toutes les rubriques de fiches.');
//define ('BAZ_CHANGER_SUPERADMINISTRATEUR', 'Changer ses droits de super-administrateur pour en faire un utilisateur sans pouvoir');
//define ('BAZ_AUCUN_DROIT', 'utilisateur sans pouvoir');
//define ('BAZ_LABEL_REDACTEUR', 'r&eacute;dacteur');
//define ('BAZ_DROIT_ADMIN', 'administrateur');
//define ('BAZ_PASSER_SUPERADMINISTRATEUR', 'Passer la personne en super administrateur');
//define ('BAZ_ENLEVER_DROIT', 'Passer en utilisateur sans pouvoir');
//define ('BAZ_TYPE_ANNONCES', 'Types de fiche');
//define ('BAZ_DROITS_ACTUELS', 'Droits actuels');
//define ('BAZ_PASSER_EN', 'Passer en');
//define ('BAZ_OU_PASSER_EN', 'ou passer en');
//
//
//define ('BAZ_CHECKBOX_SUPERADMIN', 'Super administrateur : ');
//define ('BAZ_RADIO_AUCUN', 'aucun &nbsp;');
//define ('BAZ_RADIO_REDACTEUR', 'r&eacute;dacteur &nbsp;');
//define ('BAZ_RADIO_ADMINISTRATEUR', 'administrateur &nbsp;');
//
//
//define ('LIEN', 'Lien');
//define ('SUPPRIMER', 'Supprimer');
//define ('CONFIRMATION_SUPPRESSION_LIEN', 'Voulez-vous vraiment supprimer ce lien?');
//define ('URL_LIEN', 'Adresse du lien');
//define ('URL_LIEN_REQUIS', 'Adresse du lien requis');
//define ('URL_TEXTE', 'Texte du lien');
//define ('URL_TEXTE_REQUIS', 'Texte du lien requis');
//define ('CHOISIR', 'Choisir...');
//define ('IMAGE', 'Image');
//define ('IMAGE_VALIDE_REQUIS', 'Image valide requise');
define ('METTRE_POINT','Mettre le point automatiquement sur la carte en fonction de :'); 
define ('VERIFIER_MON_ADRESSE', 'l\'adresse saisie dans ce formulaire');
define ('VERIFIER_MON_ADRESSE_CLIENT','votre accès Internet (imprécis)');
define ('TEXTE_POINT_DEPLACABLE', 'Si ce point ne correspond pas &agrave; votre adresse, vous pouvez le d&eacute;placer en cliquant gauche dessus et en laissant appuy&eacute;, afin de le faire correspondre parfaitement &agrave; votre adresse.');
define ('LATITUDE', 'Lat');
define ('LONGITUDE', 'Lon');
//define ('BAZ_AJOUTER_NOUVELLE_FICHE', 'Ajouter une nouvelle fiche');
//define ('NON_RENSEIGNE', 'Non renseign&eacute;');
//define ('BAZ_CLIC_POUR_AGRANDIR', 'Cliquer sur l\'image pour l\'agrandir');
//
define ('BAZ_FICHE_NUMERO', 'Identifiant fiche : ');
define ('BAZ_ECRITE', '&nbsp;&eacute;crite par&nbsp;');
//
////================ Administration de Bazar ================================
//define ('BAZ_CONFIG', 'Configuration du bazar');
//define ('BAZ_ENREGISTRER_ET_QUITTER', 'Enregistrer et quitter');
//
////================ Calendrier Bazar =======================================
//define ('BAZ_AFFICHE_TITRES_COMPLETS', 'Afficher les titres complets des &eacute;v&eacute;nements');
//define ('BAZ_TRONQUER_TITRES', 'Tronquer les titres des &eacute;v&eacute;nements');
//define ('BAZ_CALENDRIER','Calendrier');
//define ('BAZ_LUNDI','Lundi');
//define ('BAZ_MARDI','Mardi');
//define ('BAZ_MERCREDI','Mercredi');
//define ('BAZ_JEUDI','Jeudi');
//define ('BAZ_VENDREDI','Vendredi');
//define ('BAZ_SAMEDI','Samedi');
//define ('BAZ_DIMANCHE','Dimanche');
//
//define ('BAZ_LUNDI_COURT','Lun');
//define ('BAZ_MARDI_COURT','Mar');
//define ('BAZ_MERCREDI_COURT','Mer');
//define ('BAZ_JEUDI_COURT','Jeu');
//define ('BAZ_VENDREDI_COURT','Ven');
//define ('BAZ_SAMEDI_COURT','Sam');
//define ('BAZ_DIMANCHE_COURT','Dim');
//
//define ('BAZ_JANVIER','Janvier');
//define ('BAZ_FEVRIER','F&eacute;vrier');
//define ('BAZ_MARS','Mars');
//define ('BAZ_AVRIL','Avril');
//define ('BAZ_MAI','Mai');
//define ('BAZ_JUIN','Juin');
//define ('BAZ_JUILLET','Juillet');
//define ('BAZ_AOUT','Ao&uacute;t');
//define ('BAZ_SEPTEMBRE','Septembre');
//define ('BAZ_OCTOBRE','Octobre');
//define ('BAZ_NOVEMBRE','Novembre');
//define ('BAZ_DECEMBRE','D&eacute;cembre');

define ('BAZ_TELECHARGER_FICHIER_EXPORT_CSV', 'Télécharger le fichier d\'export au format csv');
define ('BAZ_FICHIER_CSV_A_IMPORTER', 'Entrez le fichier CSV &agrave; importer');
define ('BAZ_EXEMPLE_FICHIER_CSV', 'Exemple de structuration du fichier CSV pour les fiches de type : ');
define ('BAZ_VISUALISATION_FICHIER_CSV_A_EXPORTER', 'Visualisation du fichier CSV pour l\'export des fiches de type : ');
define ('BAZ_TOTAL_FICHES', 'Total des fiches');
define ('BAZ_ENCODAGE_CSV', 'Le fichier CSV doit être encod&eacute; en UTF-8, avec des virgules (,) comme séparateurs et des doubles guillemets (") pour les diff&eacute;rentes valeurs.<br />Les champs avec une étoile (*) sont obligatoires et doivent contenir des données.');
define ('BAZ_IMPORTER_CE_FICHIER', 'Importer ce fichier');
define ('BAZ_IMPORTER', 'Importer');
define ('BAZ_EXPORTER', 'Exporter');


/* +--Fin du code ----------------------------------------------------------------------------------------+
*
* $Log: baz_langue_fr.inc.php,v $
* Revision 1.6  2010/03/04 14:19:04  mrflos
* nouvelle version bazar
*
* Revision 1.5  2009/08/01 17:01:58  mrflos
* nouvelle action bazarcalendrier, correction bug typeannonce, validite html amelioree
*
* Revision 1.4  2008/08/27 17:19:40  mrflos
* correction bug moteur de recherche, ajout des flux rss
*
* Revision 1.3  2008/08/27 13:18:57  mrflos
* maj generale
*
* Revision 1.2  2008/07/29 17:32:25  mrflos
* maj generale
*
* Revision 1.1  2008/07/07 18:00:47  mrflos
* maj carto plus calendrier
*
*
* +-- Fin du code ----------------------------------------------------------------------------------------+
*/
?>
