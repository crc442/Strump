<?php
$data = json_decode(file_get_contents("php://input"));

$username = $data->username;

//Connect to the database.
$con = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('STRUMP', $con);


$qry_em = 'select * from artists where artist_id ="'.$username.'"';
$sth = mysql_query($qry_em);
$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $rows[] = $r;
}

$query2 = 'select * from followartist where follow_artist="'.$username.'"';
$qry_res2 = mysql_query($query2);
if($qry_res2)
{
 $res2 = mysql_fetch_assoc($qry_res2);
 $q2cnt = mysql_num_rows($qry_res2);
}
else
{
  $q2cnt = 0;
}

$rows[] = array('followers' => $q2cnt);

print_r(json_encode($rows));


?>
