<?php

$data = json_decode(file_get_contents("php://input"));

//Connecting the database
$con = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('STRUMP', $con);


$query="select venue_id,venue_name from venue";
$sth = mysql_query($query);
$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $rows[] = $r;
}

print_r(json_encode($rows));

?>
