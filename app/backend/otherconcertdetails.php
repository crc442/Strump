<?php
$data = json_decode(file_get_contents("php://input"));

$con = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('STRUMP', $con);

$c_id= $data->concertId;

$query='
  select c.genre_name, d.artist_name,a.other_concert_artist_id,
a.other_concert_name,a.other_concert_time,b.venue_name,
b.venue_city,b.venue_country,b.venue_state,
b.venue_street,b.venue_zip from otherconcerts a , venue b, genre c,
artists d where c.genre_id=a.other_concert_type and a.other_concert_artist_id=d.artist_id
and a.other_concert_venue_id=b.venue_id and a.other_concert_id="'.$c_id.'"';
$sth = mysql_query($query);
$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $rows[] = $r;
}

print_r(json_encode($rows));

?>
