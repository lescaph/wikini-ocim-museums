<?php
/**
* bazarliste : programme affichant les fiches du bazar sous forme de liste accordeon
*
*
*@package Bazar
//Auteur original :
*@author        Florian SCHMITT <florian@outils-reseaux.org>
*@version       $Revision: 1.5 $ $Date: 2010/03/04 14:19:03 $
// +------------------------------------------------------------------------------------------------------+
*/


// +------------------------------------------------------------------------------------------------------+
// |                                            ENTETE du PROGRAMME                                       |
// +------------------------------------------------------------------------------------------------------+

//récupération des paramètres wikini
$categorie_nature = $this->GetParameter("categorienature");
if (empty($categorie_nature)) {	
	$categorie_nature = 'toutes';
}

$id_typeannonce = $this->GetParameter("idtypeannonce");
if (empty($id_typeannonce)) {
	$id_typeannonce = 'toutes';
}

$ordre = $this->GetParameter("ordre");
if (empty($ordre)) {
	$ordre = 'alphabetique';
}

//on récupère les paramètres pour une requête spécifique
$query = $this->GetParameter("query");
if (!empty($query)) {
	$tabquery = array();
	$tableau = array();
	$tab = explode('|', $query);
	foreach ($tab as $req)
	{
		$tabdecoup = explode('=', $req, 2);
		$tableau[$tabdecoup[0]] = trim($tabdecoup[1]);
	}
	$tabquery = array_merge($tabquery, $tableau);
}
else
{
	$tabquery = '';
}
$tableau_resultat = baz_requete_recherche_fiches($tabquery, $ordre, $id_typeannonce, $categorie_nature);

$res = '';
foreach ($tableau_resultat as $fiche) {
	$chaine = baz_valeurs_fiche($fiche[0]);
	
	$res .= '<h2 class="titre_accordeon">'.$chaine['bf_titre'].'</h2>'."\n".
			'<div class="pane">'."\n".
			baz_voir_fiche(0, $fiche[0])."\n"
			.'</div>'."\n";
}

//on ajoute le javascript de l'accordeon, s'il y a des résultats
if ($res!='') {
	echo '<div class="accordion">'.$res.'</div>';
}

?>
