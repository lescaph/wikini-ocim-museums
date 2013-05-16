<?php
/*
*/
if (!defined("WIKINI_VERSION"))
{
            die ("acc&egrave;s direct interdit");
}

echo $this->Header();
echo "<h2>Widget : intégrer le contenu de cette page ailleurs</h2>";
echo "<div style=\"font-family: 'Courier New'; border:1px solid #ddd; text-align:left; background:#fff; padding:5px; margin:10px 0; \">\n";
echo htmlentities('<iframe class="wikiframe" width="500" height="300" frameborder="0" src="'.$this->Href('iframe').'"></iframe>')."\n";
echo '</div>'."\n";
echo "Copier-collez ce code dans n'importe quelle page HTML pour intégrer le contenu de la page Wikini ci dessous.<br />"."\n";
echo '<iframe class="wikiframe" width="500" height="300" frameborder="0" src="'.$this->Href('iframe').'"></iframe>';
echo $this->Footer();

?>
