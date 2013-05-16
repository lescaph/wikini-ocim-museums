<?php

if (!defined("WIKINI_VERSION"))
{
            die ("acc&egrave;s direct interdit");
}

if (!empty($dblclic) && $dblclic=="1" && $this->HasAccess("write", $incPageName)) {
	$actiondblclic = ' ondblclick="document.location=\''.$this->Href("edit", $incPageName).'\';"';
}
else $actiondblclic = '';

//remplace juste la premiere occurence d'une chaine de caracteres
if (!function_exists('str_replace_once')) 
{
	function str_replace_once($from, $to, $str) {
	    if(!$newStr = strstr($str, $from)) {
	        return $str;
	    }
	    $iNewStrLength = strlen($newStr);
	    $iFirstPartlength = strlen($str) - $iNewStrLength;
	    return substr($str, 0, $iFirstPartlength).$to.substr($newStr, strlen($from), $iNewStrLength);
	}
} 

//fonction recursive pour detecter un nomwiki deja present 
if (!function_exists('nomwikidouble')) 
{
	function nomwikidouble($nomwiki, $nomswiki) 
	{
		if (in_array($nomwiki, $nomswiki)) 
		{
			return nomwikidouble($nomwiki.'bis', $nomswiki);
		} else
		{
			return $nomwiki;
		}
	}
}

if (isset($this->config['hide_action_template']) && !$this->config['hide_action_template']) 
{ 		
	$pattern = '/<span class="missingpage">(.*)<\/span><a href="'.str_replace(array('/','?'), array('\/','\?'),$this->config['base_url']).'(.*)\/edit">\?<\/a>/U';
	preg_match_all($pattern, $plugin_output_new, $matches, PREG_SET_ORDER);
	$nomswiki = array();
	foreach ($matches as $values) 
	{
		$valuedep=$values[2];
		$values[2] = nomwikidouble($values[2], $nomswiki); 
		$nomswiki[] = $values[2];		
		$replacement = '<span class="missingpage">'.$values[1].'</span><form name="'.$pageincluded.'editform'.$values[2].'" action="'.$this->href("edit",$valuedep).'" method="post" style="display:inline;margin-left:-5px;">
		<a href="javascript:document.'.$pageincluded.'editform'.$values[2].'.submit();" title="Editer cette nouvelle page Wikini">?</a>';
		
		//si le lien de provenance n'est pas un NomWiki, on l'utilise comme titre de la nouvelle page
		if (!$this->IsWikiName($values[1])) {
			$replacement .= '<input type="hidden" name="body" value="====='.$values[1].'=====" />';
		}
		
		//on cache les valeurs du template de provenance, pour avoir le meme graphisme dans la page creee
		$replacement .= '<input type="hidden" name="theme" value="'.$this->config['favorite_theme'].'" />		
		<input type="hidden" name="squelette" value="'.$this->config['favorite_squelette'].'" />
		<input type="hidden" name="style" value="'.$this->config['favorite_style'].'" />
		</form>'."\n";
		$plugin_output_new = str_replace_once( $values[0], $replacement, $plugin_output_new );
	}
	
}

if (!empty($clear) && $clear=='non') $texteclear='';
else $texteclear = '<div style="clear:both;display:block;"></div>'."\n";

$plugin_output_new = '<div class="div_include"'.$actiondblclic.'>'."\n".$plugin_output_new."\n".$texteclear
.'</div>'."\n";

?>
