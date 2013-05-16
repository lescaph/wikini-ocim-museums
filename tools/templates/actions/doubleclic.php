<?php
if (!defined("WIKINI_VERSION"))
{
        die ("acc&egrave;s direct interdit");
}
if ( $this->GetMethod() != 'edit' && $this->HasAccess("write") ) {
	//javascript du double clic (on peux passer en parametre une page wiki au editer en doublecliquant)  
	$page = $this->GetParameter('page');
	if (!empty($page)) {
		echo "ondblclick=\"document.location='".$this->href("edit",$page)."';\" ";
	} else echo "ondblclick=\"document.location='".$this->href("edit")."';\" ";
} 
?>