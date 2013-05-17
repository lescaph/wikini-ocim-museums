<?php
// wakka.config.php cr&eacute;&eacute;e Mon Jan 31 16:48:41 2011
// ne changez pas la wikini_version manuellement!

$wakkaConfig = array (
  'wakka_version' => '0.1.1',
  'wikini_version' => '0.5.0',
  'debug' => 'no',
  'mysql_host' => 'localhost',
  'mysql_database' => 'observatoire_inventaire_museums',
  'mysql_user' => 'obs_museums',
  'mysql_password' => 'obs',
  'table_prefix' => 'wikini_',
  'root_page' => 'AccueiL',
  'wakka_name' => 'Inventaire Museums',
  'base_url' => 'http://dev.vbox-ocim-ub.local/inventaire-museums/wakka.php?wiki=',
  'rewrite_mode' => '0',
  'meta_keywords' => 'ocim, inventaire, museums, culture, scientifique, patrimoine',
  'meta_description' => 'Inventaire de la Culture, de la Culture scientifique et du Patrimoine dans les museums',
  'action_path' => 'actions',
  'handler_path' => 'handlers',
  'header_action' => 'header',
  'footer_action' => 'footer',
  'navigation_links' => 'DerniersChangements :: DerniersCommentaires :: ParametresUtilisateur',
  'referrers_purge_time' => 24,
  'pages_purge_time' => 90,
  'default_write_acl' => '@admins',
  'default_read_acl' => '+',
  'default_comment_acl' => '@admins',
  'preview_before_save' => '0',
  'allow_raw_html' => '1',
  'favorite_theme' => 'sobre',
  'favorite_squelette' => 'defaultdroite.tpl.html',
  'favorite_style' => 'rouge.css',
  'hide_action_config' => '1'
);
?>
