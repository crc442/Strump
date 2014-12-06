<?php
$data = json_decode(file_get_contents("php://input"));

$username = $data->username;

//Connect to the database.
$con = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('STRUMP', $con);


$qry_em = 'select * from users where username ="'.$username.'"';
$sth = mysql_query($qry_em);
$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $rows[] = $r;
}

print_r(json_encode($rows));


?>
