<?php
/*
recentcommentsrss.php

Copyright 2003		David DELON
Copyright 2004		MattRixx
Copyright 2005-2007	Didier LOISEAU
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

if ($this->GetMethod() != 'xml')
{
	echo 'Pour obtenir le fil RSS des derniers commentaires, utilisez l\'adresse suivante: ';
	echo $this->Link($this->Href('xml'));
	return;
}

if ($user = $this->GetUser())
{
	$max = $user["changescount"];
}
else
{
	$max = 50;
}

if ($comments = $this->LoadRecentComments($max))
{
	if (!($link = $this->GetParameter("link"))) $link=$this->GetConfigValue("root_page");
	$output = '<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">' . "\n";
	$output .= "<channel>\n";
	$output .= "<title>Derniers commentaires sur ". $this->GetConfigValue("wakka_name")  . "</title>\n";
	$output .= "<link>" . $this->Href('', $link) . "</link>\n";
	$output .= "<description> Derniers commentaires sur " . $this->GetConfigValue("wakka_name") . " </description>\n";
	$output .= "<language>fr</language>\n";
	$output .= '<generator>WikiNi ' . WIKINI_VERSION . "</generator>\n";
	foreach ($comments as $comment)
	{
		$output .= "<item>\n";
		$output .= "<title>" . htmlspecialchars($comment['comment_on'] . ' -- ' . $comment["user"]) . "</title>\n";
		$output .= '<dc:creator>' . htmlspecialchars($comment["user"]) . "</dc:creator>\n";
		$output .= '<pubDate>' . gmdate('D, d M Y H:i:s \G\M\T', strtotime($comment['time'])) . "</pubDate>\n";
		$output .= "<description>" . htmlspecialchars('<h3>Commentaire sur ' . $this->ComposeLinkToPage($comment["comment_on"]) . '</h3>');
		$output .= htmlspecialchars('<pre>' . htmlspecialchars($comment['body']) . '</pre>') . "</description>\n"; // notice for later: before introducing Format()ed comments, think to spam and recursive calls to {{recentcommentsrss}} (RegisterInclusion() etc.)
		$itemurl = $this->Href('', $comment['comment_on'], 'show_comments=1') . '#' . htmlspecialchars(rawurlencode($comment["tag"]));
		$output .= "<link>" . $itemurl . "</link>\n";
		$permalink = $this->href(false, $comment["tag"], "time=" . htmlspecialchars(rawurlencode($comment["time"])));
		$output .= '<guid>' . $permalink . "</guid>\n";
		$output .= "</item>\n";
	}
	$output .= "</channel>\n";
	$output .= "</rss>\n";
	echo $output ;
}

