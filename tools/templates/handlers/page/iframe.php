<?php
/*
*/

// Vérification de sécurité
if (!defined("WIKINI_VERSION"))
{
	die ("acc&egrave;s direct interdit");
}

ob_start();

//javascript pour gerer les liens (ouvrir vers l'extérieur) dans les iframes
$scripts_iframe = '<script type="text/javascript">
		$(document).ready(function () {
			$("body").css(\'background-color\', \'transparent\').css(\'background-image\', \'none\').css(\'text-align\',\'left\');
			$("a[href^=\'http://\']:not(a[href$=\'/slide_show\'])").click(function() {
				if (top === self)  
				{
				}
				else 
				{
					window.open($(this).attr("href"));return false;
				}
			});			
		});
		</script>
</head>

<body';

$head = explode('<body',$this->Header());

$head = str_replace('</head>',$scripts_iframe, $head[0]);
echo $head;

echo '<div class="page"';
echo (($user = $this->GetUser()) && ($user['doubleclickedit'] == 'N') || !$this->HasAccess('write')) ? '' : ' ondblclick="doubleClickEdit(event);"';
echo ' style="text-align:left;">'."\n";
if (!empty($_SESSION['redirects']))
{
	$trace = $_SESSION['redirects'];
	$tag = $trace[count($trace) - 1];
	$prevpage = $this->LoadPage($tag);
	echo '<div class="redirectfrom"><em>(Redirig&eacute; depuis ', $this->Link($prevpage['tag'], 'edit'), ")</em></div>\n";
}

if ($HasAccessRead=$this->HasAccess("read"))
{
	if (!$this->page)
	{
		echo "Cette page n'existe pas encore, voulez vous la <a href=\"".$this->href("edit")."\">cr&eacute;er</a> ?" ;
	}
	else
	{
		// comment header?
		if ($this->page["comment_on"])
		{
			echo "<div class=\"commentinfo\">Ceci est un commentaire sur ",$this->ComposeLinkToPage($this->page["comment_on"], "", "", 0),", post&eacute; par ",$this->Format($this->page["user"])," &agrave; ",$this->page["time"],"</div>";
		}

		if ($this->page["latest"] == "N")
		{
			echo "<div class=\"revisioninfo\">Ceci est une version archiv&eacute;e de <a href=\"",$this->href(),"\">",$this->GetPageTag(),"</a> &agrave; ",$this->page["time"],".</div>";
		}


		// display page
		$this->RegisterInclusion($this->GetPageTag());
		echo $this->Format($this->page["body"], "wakka");
		$this->UnregisterLastInclusion();

		// if this is an old revision, display some buttons
		if (($this->page["latest"] == "N") && $this->HasAccess("write"))
		{
			$latest = $this->LoadPage($this->tag);
			?>
			<br />
			<?php echo  $this->FormOpen("edit") ?>
			<input type="hidden" name="previous" value="<?php echo  $latest["id"] ?>" />
			<input type="hidden" name="body" value="<?php echo  htmlspecialchars($this->page["body"]) ?>" />
			<input type="submit" value="R&eacute;&eacute;diter cette version archiv&eacute;e" />
			<?php echo  $this->FormClose(); ?>
			<?php
		}
	}
}
else
{
	echo "<i>Vous n'&ecirc;tes pas autoris&eacute; &agrave; lire cette page</i>" ;
}

echo '</div>'."\n";

$content = ob_get_clean();

echo $content;

echo '</body>
</html>';

?>
