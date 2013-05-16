<?php
if (!defined("WIKINI_VERSION"))
{
        die ("acc&egrave;s direct interdit");
}


//parametres wikini
$dossier = $this->GetParameter('dossier');
if (empty($dossier))
{
        die ("Param&ecirc;tre \"dossier\" obligatoire");
}

echo '
<div id="gallerie_'.str_replace('/','',$dossier).'"> 
    <ul class="diaporama"> 
';
$folder = opendir($dossier);
$pic_types = array("jpg", "jpeg", "gif", "png");
$index = array();
while ($file = readdir ($folder)) {
  if(in_array(substr(strtolower($file), strrpos($file,".") + 1),$pic_types))
	{
		echo '<li><img src="'.$dossier.DIRECTORY_SEPARATOR.$file.'" alt="'.$file.'" title="'.$file.'"/></li>'."\n";
	}
}
closedir($folder);

echo '    </ul> 
</div> ';
?>
