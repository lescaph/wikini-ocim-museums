<?php
/*
usersettings.php
Copyright (c) 2002, Hendrik Mans <hendrik@mans.de>
Copyright 2002, 2008 David DELON
Copyright 2002, 2003 Charles NEPOTE
Copyright 2002  Patrick PAUL
All rights reserved.
Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions
are met:
1. Redistributions of source code must retain the above copyright
notice, this list of conditions and the following disclaimer.
2. Redistributions in binary form must reproduce the above copyright
notice, this list of conditions and the following disclaimer in the
documentation and/or other materials provided with the distribution.
3. The name of the author may not be used to endorse or promote products
derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR
IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES
OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT,
INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT
NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF
THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

//Lecture des parametres de l'action
$titre = $this->GetParameter("titre");
if (empty($titre)) {
	$titre='Identifiez-vous ici :';
}
$bienvenue = $this->GetParameter("bienvenue");
if (empty($bienvenue)) {
	$bienvenue='Bonjour ';
}

$urllogin = $this->GetParameter("url");
if (empty($urllogin)) {
	$urllogin=$this->href("", "ParametresUtilisateur", "");
}

$pageacceuil = $this->GetParameter("pageaccueil");
if (empty($pageacceuil)) {
	//$urllogin=$this->href("", "ParametresUtilisateur", "");
	$pageacceuil=$this->href("");
}

if (!isset($_REQUEST["action"])) $_REQUEST["action"] = '';
if ($_REQUEST["action"] == "logout")
{
	$this->LogoutUser();
	$this->SetMessage("Vous &ecirc;tes maintenant d&eacute;connect&eacute; !");
	$this->Redirect($this->href());
}

if ($_REQUEST["action"] == "login")
{
	// if user name already exists, check password
	if ($existingUser = $this->LoadUser($_POST["name"]))
	{
		// check password
		if ($existingUser["password"] == md5($_POST["password"]))
		{
			$this->SetUser($existingUser, $_POST["remember"]);
			$this->Redirect($pageacceuil);
			//$this->Redirect($this->href('', '', 'action=checklogged', false));
		}
		else
		{
			$error = "Mauvais mot de passe&nbsp;!";
		}
	}
}

if ($user = $this->GetUser())
{
	// user is logged in; display config form
	include_once('tools/login/libs/squelettephp.class.php');
	$template_formulaire = $this->GetParameter("templateiden");
	if (empty($template_formulaire) || !file_exists('tools/login/presentation/'.$template_formulaire) ) $template_formulaire="iden_default.tpl.html";
	$squel = new SquelettePhp('tools/login/presentation/'.$template_formulaire);
	if ($this->LoadPage("PageMenuUser")!=null) { $PageMenuUser=$this->Format("{{include page=\"PageMenuUser\"}}");} else $PageMenuUser = '';
	$squel->set(array("bienvenue"=>$bienvenue.$this->Link($user["name"]), "urldepart"=>$this->href(), "urllogin"=>$urllogin,  "PageMenuUser"=>$PageMenuUser));
	echo $squel->analyser();
}
else
{
	// user is not logged in
	
	// is user trying to log in or register?
	if ($_REQUEST["action"] == "login")
	{
		// if user name already exists, check password
		if ($existingUser = $this->LoadUser($_POST["name"]))
		{
			// check password
			if ($existingUser["password"] == md5($_POST["password"]))
			{
				$this->SetUser($existingUser, 0);
				SetCookie("name", $existingUser["name"],0, $this->CookiePath);
				SetCookie("password", $existingUser["password"],0, $this->CookiePath);
				if (!empty($pageacceuil)&&$pageacceuil=='utilisateur') {
					$this->Redirect($this->href("", $_POST["name"], ""));					
				}
				else {
					$this->Redirect($_POST['urldepart']);
				}
				
			}
			else
			{
				$error = "Mauvais mot de passe&nbsp;!";
			}
		}
	}
	elseif ($_REQUEST['action'] == 'checklogged')
	{
		$error = 'Vous devez accepter les cookies pour pouvoir vous connecter.';
	}

	include_once('tools/login/libs/squelettephp.class.php');
	$template_formulaire = $this->GetParameter("templateform");
	if (empty($template_formulaire) || !file_exists('tools/login/presentation/'.$template_formulaire) ) $template_formulaire="form_default.tpl.html";
	$squel = new SquelettePhp('tools/login/presentation/'.$template_formulaire);
	$squel->set(array("error"=>isset($error)?$error:'', "urllogin"=>$urllogin, "urldepart"=>$this->href(), "name"=>isset($_POST["name"])?$_POST["name"]:''));
	echo $squel->analyser();
}
?>