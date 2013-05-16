<?php
if (!defined("WIKINI_VERSION"))
{
        die ("acc&egrave;s direct interdit");
}
//feuilles de styles
$wikini_styles_css = '';
if ($this->config['favorite_style']!='none') $wikini_styles_css .= '<link rel="stylesheet" type="text/css" href="tools/templates/themes/'.$this->config['favorite_theme'].'/styles/'.$this->config['favorite_style'].'" media="screen" title="'.$this->config['favorite_style'].'" />';
//foreach($this->config['templates'][$this->config['favorite_theme']]['style'] as $key => $value) {
//  if($key !== $this->config['favorite_style'] && $key !== 'none') {
//    $wikini_styles_css .= "\n".'<link rel="alternate stylesheet" type="text/css" href="tools/templates/themes/'.$this->config['favorite_theme'].'/styles/'.$key.'" media="screen" title="'.$value.'" />';
//  }
//}
echo $wikini_styles_css;
?>