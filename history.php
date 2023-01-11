<?php
/**
 * displays history from shoutcast admin.cgi
 * version 1.0
 */
date_default_timezone_set("America/Chicago");
require_once('include/config.inc.php');

$json   = file_get_contents(SHOUTCAST_HOST."/played?sid=1&pass=".SHOUTCAST_ADMIN_PASS."&type=json");
$obj    = json_decode($json);
unset($obj[0]);

$out    = [];

foreach($obj as $row){
    if( stripos($row->title, 'hawkwynd radio') !== 0 ) array_push($out,  date('h:i', $row->playedat ) . " " . $row->title);
}

echo json_encode($out);
exit;