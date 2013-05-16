<?
//on inclue Magpie le parser RSS
define('MAGPIE_OUTPUT_ENCODING', 'UTF-8');
define('MAGPIE_DIR', 'tools/syndication/libs/');
require_once(MAGPIE_DIR.'rss_fetch.inc');

//pour cacher les erreurs Warning de Magpie
error_reporting(E_ERROR);

//on vérifie si il existe un dossier pour le cache et si on a les droits d'écriture dessus
if (file_exists('cache')) {
	if (!is_writable('cache')) {
		echo '<p class="erreur">Le r&eacute;pertoire "cache" n\'a pas les droits d\'acc&egrave;s en &eacute;criture.</p>'."\n";
	}
} else {
	echo '<p class="erreur">Il faut cr&eacute;er un r&eacute;pertoire "cache" dans le r&eacute;pertoire principal du wikini.</p>'."\n";
}

//récuperation des parametres
$titre = $this->GetParameter("titre");

$nb = $this->GetParameter("nb");

$nouvellefenetre = $this->GetParameter("nouvellefenetre");

$formatdate = $this->GetParameter("formatdate");

$template = $this->GetParameter("template");
if (empty($template)) {
	$template = 'tools/syndication/templates/liste.tpl.html';
} else {
	$template = 'tools/syndication/templates/'.$this->GetParameter("template");
	if (!file_exists($template)) {
			echo 'Le fichier template: "'.$template.'" n\'existe pas, on utilise le template par d&eacute;faut.';
			$template = 'tools/syndication/templates/liste.tpl.html';
	}
}

//recuperation du parametre obligatoire des urls
$urls = $this->GetParameter("url");
if (!empty($urls)) {
	$tab_url = array_map('trim', explode(',', $urls));	
    foreach ($tab_url as $cle => $url) {    		
			if ($url != '') {								
				// On parse l'url avec magpierss
				$feed = fetch_rss( $url );
				if ($feed) {									
					// Gestion du nombre de pages syndiquees
					$i = 0;
				    $nb_item = count($feed->items);
					foreach ($feed->items as $item) {					
						if ($nb != 0 && $nb_item >= $nb && $i >= $nb) {
							break;
						}						
						$i++;
						$aso_page = array();
						// Gestion du titre
						if ( $titre == '' ) {
							$aso_page['titre_site'] = htmlentities($feed->channel['title'], ENT_QUOTES, 'UTF-8');
						} else {
							$aso_page['titre_site'] = $titre;
						}
						// Gestion de l'url du site
						$aso_page['url_site'] = htmlentities($feed->channel['link'], ENT_QUOTES, 'UTF-8');
						// Ouverture du lien dans une nouvelle fenetre
						$aso_page['ext'] = $nouvellefenetre;
						//url de l'article	
						$aso_page['url'] = htmlentities($item['link'], ENT_QUOTES, 'UTF-8');
						//titre de l'article						
						$aso_page['titre'] = html_entity_decode(htmlentities($item['title'], ENT_QUOTES, 'UTF-8'), ENT_QUOTES);
						//description de l'article
						$aso_page['description'] = html_entity_decode(htmlentities($item['description'], ENT_QUOTES, 'UTF-8'), ENT_QUOTES);					
						//gestion de la date de publication, selon le flux, elle se trouve parsee à des endroits differents 
						if ($item['pubdate']) {
							$aso_page['datestamp'] = strtotime($item['pubdate']);
						} elseif ($item['dc']['date']) {							
							//en php5 on peut convertir les formats de dates exotiques plus facilement
							if (PHP_VERSION>=5) {
								$aso_page['datestamp'] = strtotime($item['dc']['date']);
							} else {
								$aso_page['datestamp'] = parse_w3cdtf($item['dc']['date']);
							}
						} elseif ($item['issued']) {
							//en php5 on peut convertir les formats de dates exotiques plus facilement
							if (PHP_VERSION>=5) {
								$aso_page['datestamp'] = strtotime($item['issued']);
							} else {
								$aso_page['datestamp'] = parse_w3cdtf($item['issued']);
							}							
						} else {
							$aso_page['datestamp'] = time();
						}							
						if ($formatdate!='') {
							switch ($formatdate) {							
								case 'jm' :
									$aso_page['date'] = strftime('%d.%m', $aso_page['datestamp']);
									break;
								case 'jma' :
									$aso_page['date'] = strftime('%d.%m.%Y', $aso_page['datestamp']);
									break;
								case 'jmh' :
									$aso_page['date'] = strftime('%d.%m %H:%M', $aso_page['datestamp']);
									break;
								case 'jmah' :
									$aso_page['date'] = strftime('%d.%m.%Y %H:%M', $aso_page['datestamp']);
									break;
								default :
									$aso_page['date'] = '';
							}
						}												
						$syndication['pages'][$aso_page['datestamp']] = $aso_page;
					}
				} else {
					echo '<p class="erreur">Erreur '.magpie_error().'</p>'."\n";        			    
				}			
			}
        }    
	// Trie des pages par date
	krsort($syndication['pages']);

	if (count($tab_url)==1 || $titre!='') echo '<h2 class="rss_site_titre"><a href="'.$syndication['pages'][key($syndication['pages'])]['url_site'].'">'.$syndication['pages'][key($syndication['pages'])]['titre_site'].'</a></h2>'."\n";
	// Gestion des squelettes
	include($template);
} else {
	echo 'Il faut entrer obligatoirement le param&ecirc;tre de l\'url pour syndiquer un flux RSS.';
}
?>