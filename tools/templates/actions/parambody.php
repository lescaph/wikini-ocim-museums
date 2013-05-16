<?php
if (!defined("WIKINI_VERSION"))
{
        die ("acc&egrave;s direct interdit");
}
//attributs du body
$body_attr = ($message = $this->GetMessage()) ? "onload=\"alert('".addslashes($message)."');\" " : "";
//$wikini_body = isset($_SESSION["message"])&&$_SESSION["message"]!='' ? "onLoad=\"alert('".$_SESSION["message"]."');\" " : "";
echo $body_attr;
?>
