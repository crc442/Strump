<?php
$data = json_decode(file_get_contents("php://input"));

//Connecting to the database
$con = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('STRUMP', $con);

$c_id= $data->concertId;

$query='select concert_id, post, date_format(post_date,"%b %d, %Y") as d1, user_id from post where concert_id = "'.$c_id.'" ORDER BY post_date desc';

$sth = mysql_query($query);
$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $rows[] = $r;
}

print_r(json_encode($rows));

?>
