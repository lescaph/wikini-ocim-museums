<?php
	
/*
Handler "slide_show" pour WikiNi version WikiNi 0.4.1 et supérieurs.
Développé par Charles Népote.
Version 0.1 du 09/01/2005.
Licence GPL.

Par défaut il utilise les classes de style suivantes :
.slide { font-size: 160%; margin: 5%; background-color: #FFFFFF; padding: 30px; border: 1px inset; line-height: 1.5; }
.slide UL, LI { font-size: 100%; }
.slide LI LI { font-size: 90% }
.sl_nav p { text-decoration: none; text-align: right; font-size: 80%; line-height: 0.4; }
.sl_nav A { text-decoration: none; }
.sl_nav a:hover { color: #CF8888 }
.sum { font-size: 8px; }

Pour modifier ces styles il faut créer un fichier "slideshow.css" contenant les styles modifiés.
Le fichier "slideshow.css" sera reconnu automatiquement.

*/

// Vérification de sécurité
if (!defined("WIKINI_VERSION"))
{
	die ("acc&egrave;s direct interdit");
}

// On teste si l'utilisateur peut lire la page
if (!$this->HasAccess("read"))
{
	return;
}
else
{
	// On teste si la page existe
	if (!$this->page)
	{
		return;
	}
	else
	{
		/*
		Exemple de page :
		
		(1) Présentation xxxxxxxxxxxxxx
		
		===== (2) Titre =====
		Diapo 2.
		
		===== (3) Titre =====
		Diapo 3.
		
		===== (4) Titre =====
		Diapo 4.
		
		===== (5) Titre =====
		Diapo 5.
		
		===== (6) Titre =====
		Diapo 6.
		
		===== (7) Titre =====
		Diapo 7.
		
		Autre exemple :
		
		===== (1) Titre =====
		Diapo 1.
		
		===== (2) Titre =====
		Diapo 2.
		
		===== (3) Titre =====
		Diapo 3.
		
		===== (4) Titre =====
		Diapo 4.
		
		===== (5) Titre =====
		Diapo 5.
		
		===== (6) Titre =====
		Diapo 6.
		
		===== (7) Titre =====
		Diapo 7.
		
		*/

		//
		// découpe la page
		$this->RegisterInclusion($this->GetPageTag());
		$body_f = $this->format($this->page["body"]);
		$this->UnregisterLastInclusion();
		$body = preg_split('/(.*<h2>.*<\/h2>)/',$body_f,-1,PREG_SPLIT_DELIM_CAPTURE);      

		if (!$body)
		{
			return;
		}
		else
		{

			// En-tête du fichier HTML
			echo
			"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
			echo
			"<html>\n\n\n",
			"<head>\n",
			"<title>", $this->GetWakkaName(), ":", $this->GetPageTag(), "</title>\n",
			"<meta name=\"version\" content=\"S5 1.0\" />",
			"<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\n",
			"<link rel=\"stylesheet\" href=\"tools/templates/libs/s5/ui/default/slides.css\" type=\"text/css\" media=\"projection\" id=\"slideProj\" />",
			"<link rel=\"stylesheet\" href=\"tools/templates/libs/s5/ui/default/outline.css\" type=\"text/css\" media=\"screen\" id=\"outlineStyle\" />",
			"<link rel=\"stylesheet\" href=\"tools/templates/libs/s5/ui/default/print.css\" type=\"text/css\" media=\"print\" id=\"slidePrint\" />",
			"<link rel=\"stylesheet\" href=\"tools/templates/libs/s5/ui/default/opera.css\" type=\"text/css\" media=\"projection\" id=\"operaFix\" />",
			"<script src=\"tools/templates/libs/s5/ui/default/slides.js\" type=\"text/javascript\"></script>";

			echo
			"</head>\n\n\n";
			
			// Affiche le corps de la page
			echo "<body>\n";
			echo '<div class="layout">',
					'<div id="controls"><!-- DO NOT EDIT --></div>',
					'<div id="currentSlide"><!-- DO NOT EDIT --></div>',
					'<div id="header"></div>',
					'<div id="footer">',
					'<h1><a href="'.$this->config['base_url'].'">'.$this->GetWakkaName().'</a></h1>',
					'</div>',
					'</div>',
					'<div class="presentation">';

/*
			// -- Affichage du menu de navigation --------------
			echo
			"<div class=\"sl_nav\">\n",
			"<p>";
			// Si ce n'est pas la première diapositive, on affiche les liens "<< précédent"
			// et "[Début]"
			if ($slide !== "1")
			echo
			"<a href=\"",$this->href(),"/slide_show&slide=",$_REQUEST['slide']-1,"\"><< précédent</a>",
			" :: <a href=\"",$this->href(),"/slide_show&slide=1\">[début]</a>\n";
			echo " :: ";
			// Si ce n'est pas la dernière diapositive, on affiche le lien "suivant >>"
			if (isset($body[($slide)*2-($major*2)+2]) or $slide == "1")
			echo "<a href=\"",$this->href(),"/slide_show&slide=",$slide+1,"\">suivant >></a>\n";
			echo
			"</p>\n";
			// Quelquesoit la diapositive, on affiche les liens "Éditer" et "[]->" (pour quitter)
			echo "<p><a href=\"",$this->href(),"/edit\">Éditer </a> :: <a href=\"",$this->href(),"\">[]-></a></p>\n";
			echo
			"</div>\n\n";
*/

			// -- Affichage du contenu -------------------------
			$titre="";

			foreach($body as $slide)
			{
				//si c'est juste un titre, on le sauve
				if (preg_match('/^<h2>.*<\/h2>/', $slide)) 
				{
					$titre=str_replace('h2', 'h1', $slide);
				}
				//sinon, on affiche
				else 
				{
					echo "<div class=\"slide\">\n".$titre.$slide."</div>\n";
					$titre="";
				}
			}

			echo
			"</body>\n",
			"</html>";
		}
	}
}
?>
