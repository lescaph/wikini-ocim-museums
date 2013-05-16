<?php
/*
bazarframe.php

Copyright 2009  Florian SCHMITT
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

// Vérification de sécurité
if (!defined("WIKINI_VERSION"))
{
	die ("acc&egrave;s direct interdit");
}

header('Content-type: text/html; charset=UTF-8');

if ($HasAccessRead=$this->HasAccess("read"))
{
	if ($this->page)
	{
		// display page
		echo utf8_encode($this->Format('{{bazar vue="saisir" voirmenu="0" id_typeannonce="'.$_GET['id_typeannonce'].'"}}') );
	}
}
?>
