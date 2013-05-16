<?php

// Partie publique

if (!defined("WIKINI_VERSION"))
{
	die ("acc&egrave;s direct interdit");
}

// Desactivation de l'extension template si l'extension navigation est presente et active. 
if (isset($plugins_list['navigation'])) 
{
	unset($k);	
	return;
}

// Dans Wakka.config.php, on peut preciser : favorite_theme, favorite_style, favorite_squelette,  hide_action_template 
// Sinon, on prend les parametres ci dessous :

// Configuration du fonctionnement des templates : faut il laisser le choix autre que par d�faut 
define('FORCER_TEMPLATE_PAR_DEFAUT', (isset($wakkaConfig['hide_action_template'])) ? $wakkaConfig['hide_action_template'] : false);

//Theme par d�faut
define ('THEME_PAR_DEFAUT', (isset($wakkaConfig['favorite_theme'])) ? $wakkaConfig['favorite_theme'] : 'generique');

//Style par d�faut
define ('CSS_PAR_DEFAUT', (isset($wakkaConfig['favorite_style'])) ? $wakkaConfig['favorite_style'] : 'generique.css');

//squelette par d�faut
define ('SQUELETTE_PAR_DEFAUT', (isset($wakkaConfig['favorite_squelette'])) ? $wakkaConfig['favorite_squelette'] : 'colonnegauche.tpl.html');

//on cherche tous les dossiers du repertoire themes et des sous dossier styles et squelettes, et on les range dans le tableau $wakkaConfig['templates']
$repertoire = 'tools'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'themes';
$wakkaConfig['templates'] = array();
$dir = opendir($repertoire);
while (false !== ($file = readdir($dir))) {    	
	if  ($file!='.' && $file!='..' && $file!='CVS' && is_dir($repertoire.DIRECTORY_SEPARATOR.$file)) {
		$dir2 = opendir($repertoire.DIRECTORY_SEPARATOR.$file.DIRECTORY_SEPARATOR.'styles');
	    while (false !== ($file2 = readdir($dir2))) {
	    	if (substr($file2, -4, 4)=='.css') $wakkaConfig['templates'][$file]["style"][$file2]=$file2;
	    }
	    closedir($dir2);
	    if (is_array($wakkaConfig['templates'][$file]["style"])) ksort($wakkaConfig['templates'][$file]["style"]);
	    $dir3 = opendir($repertoire.DIRECTORY_SEPARATOR.$file.DIRECTORY_SEPARATOR.'squelettes');
	    while (false !== ($file3 = readdir($dir3))) {
	    	if (substr($file3, -9, 9)=='.tpl.html') $wakkaConfig['templates'][$file]["squelette"][$file3]=$file3;	    
	    }	    	
	    closedir($dir3);
	    if (is_array($wakkaConfig['templates'][$file]["squelette"])) ksort($wakkaConfig['templates'][$file]["squelette"]);
    }
}
closedir($dir);
if (is_array($wakkaConfig)) ksort($wakkaConfig['templates']);

//si POST
//=======Changer de theme=================================================================================================
if (isset($_POST['theme'])  && array_key_exists($_POST['theme'], $wakkaConfig['templates'])) {
	$wakkaConfig['favorite_theme'] = $_POST['theme'];
}
else {
	$wakkaConfig['favorite_theme'] = THEME_PAR_DEFAUT;
}

//=======Changer de style=====================================================================================================
$styles['none']='pas de style';
if (isset($_POST['style']) && array_key_exists($_POST['style'], $wakkaConfig['templates'][$wakkaConfig['favorite_theme']]['style'])) {
	$wakkaConfig['favorite_style'] = $_POST['style'];
}
else {
	$wakkaConfig['favorite_style'] = CSS_PAR_DEFAUT;
}

//=======Changer de squelette=================================================================================================    
if(isset($_POST['squelette']) && array_key_exists($_POST['squelette'], $wakkaConfig['templates'][$wakkaConfig['favorite_theme']]['squelette'])) {
	$wakkaConfig['favorite_squelette'] = $_POST['squelette'];
}
else {
	$wakkaConfig['favorite_squelette'] = SQUELETTE_PAR_DEFAUT;
}


if (!isset($wakkaConfig['hide_action_template'])) {
	$wakkaConfig['hide_action_template'] = FORCER_TEMPLATE_PAR_DEFAUT;
} 

if (!isset($wakkaConfig['favorite_theme'])) {
	$wakkaConfig['favorite_theme'] = THEME_PAR_DEFAUT;
}

if (!isset($wakkaConfig['favorite_style'])) {
	$wakkaConfig['favorite_style'] = CSS_PAR_DEFAUT;
}

if (!isset($wakkaConfig['favorite_squelette'])) {
	$wakkaConfig['favorite_squelette'] = SQUELETTE_PAR_DEFAUT;
} 


// Surcharge  fonction  LoadRecentlyChanged : suppression remplissage cache car affecte le rendu du template.
$wikiClasses [] = 'Template';


$wikiClassesContent [] = ' 
	function LoadRecentlyChanged($limit=50)
        {
                $limit= (int) $limit;
                if ($pages = $this->LoadAll("select id, tag, time, user, owner from ".$this->config["table_prefix"]."pages where latest = \'Y\' and comment_on =  \'\' order by time desc limit $limit"))
                {
                        return $pages;
                }
        }	
    function GetMethod() {
	  	if ($this->method==\'iframe\')
	  	{
			return \'show\';
	    } 
	    else
	    {
			return Wiki::GetMethod();
		}
    }	
';	


//on cherche l'action template dans la page, qui definit le graphisme a utiliser
if (isset($_POST["submit"]) && $_POST["submit"] == html_entity_decode('Aper&ccedil;u')) 
{
	$contenu["body"] = $_POST["body"].'{{template theme="'.$_POST["theme"].'" squelette="'.$_POST["squelette"].'" style="'.$_POST["style"].'"}}';	
	$_POST["body"] = $_POST["body"].'{{template theme="'.$_POST["theme"].'" squelette="'.$_POST["squelette"].'" style="'.$_POST["style"].'"}}';
} 

else 
{
	$contenu=$wiki->LoadPage($page);
}


//on r�cup�re les valeurs du template associ�es � la page
if (!$wakkaConfig['hide_action_template'] && $act=preg_match_all ("/".'(\\{\\{template)'.'(.*?)'.'(\\}\\})'."/is", $contenu["body"], $matches)) {
     $i = 0; $j = 0;
     foreach($matches as $valeur) {
       foreach($valeur as $val) {
       	
         if (isset($matches[2][$j]) && $matches[2][$j]!='') {
           $action= $matches[2][$j];
           if (preg_match_all("/([a-zA-Z0-9]*)=\"(.*)\"/U", $action, $params))
			{
				for ($a = 0; $a < count($params[1]); $a++)
				{
					$vars[$params[1][$a]] = $params[2][$a];
				}
			}
         }
         $j++;
       }
       $i++;
     }
   }
if (isset($vars["theme"]) && $vars["theme"]!="") {
	 $wakkaConfig['favorite_theme'] = $vars["theme"]; 
}
if (isset($vars["style"]) && $vars["style"]!="") {
 	$wakkaConfig['favorite_style'] = $vars["style"];
}
if  (isset($vars["squelette"]) && $vars["squelette"]!="") {
	$wakkaConfig['favorite_squelette'] = $vars["squelette"];
}

//=======Test existence du template, on utilise le template par defaut sinon=======================================================
if (!file_exists('tools/templates/themes/'.$wakkaConfig['favorite_theme'].'/squelettes/'.$wakkaConfig['favorite_squelette'])
	|| !file_exists('tools/templates/themes/'.$wakkaConfig['favorite_theme'].'/styles/'.$wakkaConfig['favorite_style'])) {
	if (file_exists('tools/templates/themes/default/squelettes/default.tpl.html')
		&& file_exists('tools/templates/themes/default/styles/default.css')) {
		$wakkaConfig['favorite_theme']='default';
		$wakkaConfig['favorite_style']='default.css';
		$wakkaConfig['favorite_squelette']='default.tpl.html';
		echo 'Certains (ou tous les) fichiers du template '.$wakkaConfig['favorite_theme'].' ont disparus (tools/templates/themes/'.$wakkaConfig['favorite_theme'].'/squelettes/'.$wakkaConfig['favorite_squelette'].' et/ou tools/templates/themes/'.$wakkaConfig['favorite_theme'].'/styles/'.$wakkaConfig['favorite_style'].').<br />Le template par d&eacute;faut est donc utilis&eacute;.';
} else {
		exit('Les fichiers du template par d&eacute;faut ont disparus, l\'utilisation des templates est impossible.<br />Veuillez r&eacute;installer le tools template ou contacter l\'administrateur du site.');
	}
}

?>
