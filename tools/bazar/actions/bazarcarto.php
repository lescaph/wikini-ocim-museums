<?php
/**
* bazarcarto : programme affichant les fiches du bazar sous forme de Cartographie Google
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
$tab_points_carto = array();

foreach ($tableau_resultat as $fiche)
{
	$chaine = baz_valeurs_fiche($fiche[0]);
	$tab=explode('|', $chaine['carte_google']);
	if (count($tab)>1 && $tab[0]!='' && $tab[1]!='') {
		$tab_points_carto[]= '{
				"title": "'.addslashes($chaine['bf_titre']).'",
				"description": \'<div class="BAZ_cadre_map">'.
				preg_replace("(\r\n|\n|\r|)", '', addslashes('<ul class="css-tabs"></ul>'.baz_voir_fiche(0, $fiche[0]))).'\',
				"lat": '.$tab[0].',
				"lng": '.$tab[1].'
		}';
	}
	
}
$points_carto = implode(',',$tab_points_carto);

echo '<div id="map" style="width: '.BAZ_GOOGLE_IMAGE_LARGEUR.'; height: '.BAZ_GOOGLE_IMAGE_HAUTEUR.'"></div>'."\n".'<ul id="markers"></ul>'."\n";
echo '<script type="text/javascript">
	//variable pour la carte google
	var map;
	
	//tableau des marqueurs google
	var arrMarkers = [];
	
	//tableau des infobox google
	var arrInfoWindows = [];
	
	//image du marqueur
	var image = new google.maps.MarkerImage(\''.BAZ_IMAGE_MARQUEUR.'\',		
	//taille, point d\'origine, point d\'arrivee de l\'image
	new google.maps.Size('.BAZ_DIMENSIONS_IMAGE_MARQUEUR.'),
	new google.maps.Point('.BAZ_COORD_ORIGINE_IMAGE_MARQUEUR.'),
	new google.maps.Point('.BAZ_COORD_ARRIVEE_IMAGE_MARQUEUR.'));
	
	//ombre du marqueur
	var shadow = new google.maps.MarkerImage(\''.BAZ_IMAGE_OMBRE_MARQUEUR.'\',
	// taille, point d\'origine, point d\'arrivee de l\'image de l\'ombre
	new google.maps.Size('.BAZ_DIMENSIONS_IMAGE_OMBRE_MARQUEUR.'),
	new google.maps.Point('.BAZ_COORD_ORIGINE_IMAGE_OMBRE_MARQUEUR.'),
	new google.maps.Point('.BAZ_COORD_ARRIVEE_IMAGE_OMBRE_MARQUEUR.'));
	
	//initialise la carte google
	function initialize(){
		var myLatlng = new google.maps.LatLng('.BAZ_GOOGLE_CENTRE_LAT.', '.BAZ_GOOGLE_CENTRE_LON.');
		var myOptions = {
		  zoom: '.BAZ_GOOGLE_ALTITUDE.',
		  center: myLatlng,
		  mapTypeId: google.maps.MapTypeId.'.BAZ_TYPE_CARTO.',
		  navigationControl: '.BAZ_AFFICHER_NAVIGATION.',
		  navigationControlOptions: {style: google.maps.NavigationControlStyle.'.BAZ_STYLE_NAVIGATION.'},
		  mapTypeControl: '.BAZ_AFFICHER_CHOIX_CARTE.',
		  mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.'.BAZ_STYLE_CHOIX_CARTE.'},  	  
		  scaleControl: '.BAZ_AFFICHER_ECHELLE.',
		  scrollwheel: '.BAZ_PERMETTRE_ZOOM_MOLETTE.'  
		}
		map = new google.maps.Map(document.getElementById("map"), myOptions);
		
		if($("#markers li") != undefined) { 
			//tableau des points des fiches bazar
			var places = [
				'.$points_carto.'
			];
			$.each(places, function(i, item){
				$("#markers").append(\'<li><a href="#" rel="\' + i + \'">&nbsp;\' + (i+1) + \'&nbsp;-&nbsp;\' +item.title + \'</a></li>\');
				var marker = new google.maps.Marker({
					position: new google.maps.LatLng(item.lat, item.lng),
					map: map,
					icon: image,
					shadow: shadow,
					title: item.title
				});
				arrMarkers[i] = marker;
				var infowindow = new google.maps.InfoWindow({
					content: item.description
				});
				arrInfoWindows[i] = infowindow;
				google.maps.event.addListener(marker, \'click\', function() {
					infowindow.open(map, marker);
					$("ul.css-tabs li").remove();
					$("fieldset.tab").each(function(i) {
									$(this).parent(\'div.BAZ_cadre_fiche\').prev(\'ul.css-tabs\').append("<li class=\'liste" + i + "\'><a href=\"#\">"+$(this).find("legend:first").hide().html()+"</a></li>");
					});
					$("ul.css-tabs").tabs("fieldset.tab", { onClick: function(){} } );
				});
			});
		}
		';
		
	if ( defined('BAZ_JS_INIT_MAP') && BAZ_JS_INIT_MAP != '' && file_exists(BAZ_JS_INIT_MAP) ) {
		$handle = fopen(BAZ_JS_INIT_MAP, "r");
		echo fread($handle, filesize(BAZ_JS_INIT_MAP));
		fclose($handle);
		echo 'var poly = createPolygon( Coords, "#002F0F");
		poly.setMap(map);
		
		';
	};		
		
	echo '}
</script>';




?>
