<?php
$data = json_decode(file_get_contents("php://input"));

//Connecting to the database
$con = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('STRUMP', $con);

$username = $data->username;

//Get system concerts
//$scquery ="select system_concert_id,'system' as type from myconcertlist where user_id='".$username."' and system_concert_id is not null";
$scquery ="select m.system_concert_id as id,'system' as type,s.concert_name as name from myconcertlist m,systemconcerts s where m.user_id='".$username."' and m.system_concert_id is not null and s.concert_id=m.system_concert_id";
$sth = mysql_query($scquery);
$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $rows[] = $r;
}


$ocquery ="select m.other_concert_id as id,'other' as type,s.other_concert_name  as name from myconcertlist m,otherconcerts s where m.user_id='".$username."' and m.other_concert_id is not null and m.other_concert_id= s.other_concert_id";
$sth1 = mysql_query($ocquery);
while($s = mysql_fetch_assoc($sth1)) {
    $rows[] = $s;
}


print_r(json_encode($rows));

?>
