<?php
$data = json_decode(file_get_contents("php://input"));

// Database connection
$con = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('STRUMP', $con);

$key = $data->keyword;

$searchQuery="select category, concert_id, keyword from searchEvent where keyword like '%".$key."%'";
$sth = mysql_query($searchQuery);
$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $rows[] = $r;
}

print_r(json_encode($rows));
?>
