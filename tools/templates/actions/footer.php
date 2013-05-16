<?php
if (!defined("WIKINI_VERSION"))
{
        die ("acc&egrave;s direct interdit");
}
//On recupere la partie bas  du template et on execute les actions wikini
$template_decoupe = explode("{WIKINI_PAGE}", file_get_contents('tools/templates/themes/'.$this->config['favorite_theme'].'/squelettes/'.$this->config['favorite_squelette']));
$template_footer = $template_decoupe[1];
if ($act=preg_match_all ("/".'(\\{\\{)'.'(.*?)'.'(\\}\\})'."/is", $template_footer, $matches)) {
	$i = 0; $j = 0;
	foreach($matches as $valeur) {
		foreach($valeur as $val) {
			if (isset($matches[2][$j]) && $matches[2][$j]!='') {
				$action= $matches[2][$j];
				$template_footer=str_replace('{{'.$action.'}}', $this->Format('{{'.$action.'}}'), $template_footer);
			}
			$j++;
		}
		$i++;
	}
}

echo $template_footer;
?>
