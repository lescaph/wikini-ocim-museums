<?php
/*
*/
if (!defined("WIKINI_VERSION"))
{
            die ("acc&egrave;s direct interdit");
}

//on enleve l'action template
$plugin_output_new=preg_replace ("/".'(\\{\\{template)'.'(.*?)'.'(\\}\\})'."/is", '', $plugin_output_new);

if (!isset($this->config['hide_action_template']) or (isset($this->config['hide_action_template']) && !$this->config['hide_action_template'])) { // TODO : utiliser ACL

	if ($this->HasAccess("write") && $this->HasAccess("read")) {
		// Edition
	
		if (!isset($_POST["submit"]) or (isset($_POST["submit"]) && $_POST["submit"] != html_entity_decode('Aper&ccedil;u') && $_POST["submit"] != 'Sauver')) {
			$selecteur = 'Th&egrave;me: <select name="theme" onchange="changeVal(this.value)">'."\n";
		    foreach(array_keys($this->config['templates']) as $key => $value) {
		            if($value !== $this->config['favorite_theme']) {
		                    $selecteur .= '<option value="'.$value.'">'.$value.'</option>'."\n";
		            }
		            else {
		                    $selecteur .= '<option value="'.$value.'" selected="selected">'.$value.'</option>'."\n";
		            }
		    }
		    $selecteur .= '</select>'."\n";
			
			$selecteur .= 'Squelette: <select name="squelette">'."\n";
			ksort($this->config['templates'][$this->config['favorite_theme']]['squelette']);
		    foreach($this->config['templates'][$this->config['favorite_theme']]['squelette'] as $key => $value) {
		            if($value !== $this->config['favorite_squelette']) {
		                    $selecteur .= '<option value="'.$key.'">'.$value.'</option>'."\n";
		            }
		            else {
		                    $selecteur .= '<option value="'.$this->config['favorite_squelette'].'" selected="selected">'.$value.'</option>'."\n";
		            }
		    }
		    $selecteur .= '</select>'."\n";
	
			ksort($this->config['templates'][$this->config['favorite_theme']]['style']);	
			$selecteur .= 'Style: <select name="style">'."\n";
		    foreach($this->config['templates'][$this->config['favorite_theme']]['style'] as $key => $value) {
		            if($value !== $this->config['favorite_style']) {
		                    $selecteur .= '<option value="'.$key.'">'.$value.'</option>'."\n";
		            }
		            else {	            		
		                    $selecteur .= '<option value="'.$this->config['favorite_style'].'" selected="selected">'.$value.'</option>'."\n";
		            }
		    }
		    $selecteur .= '</select>'."\n".'<br />'."\n";
			//on ajoute la selection des styles
			$plugin_output_new=preg_replace ('/\<input name=\"submit\" type=\"submit\" value=\"Sauver\"/',
			$selecteur.'<input name="submit" type="submit" value="Sauver"', $plugin_output_new);
			
			//AJOUT DU JAVASCRIPT QUI PERMET DE CHANGER DYNAMIQUEMENT DE TEMPLATES			
			$javascript = '<script type="text/javascript"><!--
			var tab1 = new Array();
			var tab2 = new Array();'."\n";
			foreach(array_keys($this->config['templates']) as $key => $value) {
		            $javascript .= '		tab1["'.$value.'"] = new Array(';
		            $nbocc=0;	           
		            foreach($this->config['templates'][$value]["squelette"] as $key2 => $value2) {
		            	if ($nbocc==0) $javascript .= '\''.$value2.'\'';
		            	else $javascript .= ',\''.$value2.'\'';
		            	$nbocc++;
		            }
		            $javascript .= ');'."\n";
		            
		            $javascript .= '		tab2["'.$value.'"] = new Array(';
		            $nbocc=0;
		            foreach($this->config['templates'][$value]["style"] as $key3 => $value3) {
		            	if ($nbocc==0) $javascript .= '\''.$value3.'\'';
		            	else $javascript .= ',\''.$value3.'\'';
		            	$nbocc++;
		            }
		            $javascript .= ');'."\n";	      
		    }
					
			$javascript .= '		function changeVal(val){
				
				// pour vider la liste
				document.ACEditor.squelette.options.length=0
				for (var i=0; i<tab1[val].length; i++){
					
					  o=new Option(tab1[val][i],tab1[val][i]);
					 document.ACEditor.squelette.options[document.ACEditor.squelette.options.length]=o;
					
								
				}
				document.ACEditor.style.options.length=0
				for (var i=0; i<tab2[val].length; i++){
					  o=new Option(tab2[val][i],tab2[val][i]);
					 document.ACEditor.style.options[document.ACEditor.style.options.length]=o;
								
				}					
			}
			//--></script>';
			$plugin_output_new=preg_replace ('/\<input type="button" value="Annulation"/',
			$javascript.'<input type="button" value="Annulation"',
			$plugin_output_new);
		}
	}
}

?>
