<?php

if (!defined("WIKINI_VERSION"))
{
            die ("acc&egrave;s direct interdit");
}



if ( $this->GetMethod()=="show") {
	$plugin_output_new=str_replace("<div class=\"page\" ondblclick=\"doubleClickEdit(event);\">", "", $plugin_output_new);
}