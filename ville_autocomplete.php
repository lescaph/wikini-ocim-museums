<?php

if ( !isset($_REQUEST['term']) )
    exit('Vous ne pouvez pas acc&eacute;der &agrave; cette page directement');

include_once 'wakka.config.php';

$dblink = mysql_connect($wakkaConfig['mysql_host'], $wakkaConfig['mysql_user'], $wakkaConfig['mysql_password']) or die( mysql_error() );
mysql_select_db($wakkaConfig['mysql_database']);

$rs = mysql_query('select nom_commune, cp_commune from autocomplete where nom_commune like "'. mysql_real_escape_string($_REQUEST['term']) .'%" order by nom_commune asc limit 0,10', $dblink);

$data = array();
if ( $rs && mysql_num_rows($rs) )
{
    while( $row = mysql_fetch_array($rs, MYSQL_ASSOC) )
    {
        $data[] = array(
            'label' => utf8_encode($row['nom_commune']) .', '. $row['cp_commune'] ,
            'value' => utf8_encode($row['nom_commune']),
            'cp' => $row['cp_commune']
        );
    }
}

echo json_encode($data);
flush();
?>
