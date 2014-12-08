<?php
$data = json_decode(file_get_contents("php://input"));

$con = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('STRUMP', $con);

$c_id= $data->concertId;

$query='select c.genre_name, d.artist_name,a.concert_capacity,a.concert_name,a.concert_time,a.ticket_availability,a.ticket_hyperlink,a.ticket_price,b.venue_name,b.venue_city,b.venue_country,b.venue_state,b.venue_street,b.venue_zip from systemconcerts a , venue b, genre c, artists d where c.genre_id=a.concerttype and a.concert_artist=d.artist_id and a.venue_id=b.venue_id and a.concert_id="'.$c_id.'"';
$sth = mysql_query($query);
$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $rows[] = $r;
}

print_r(json_encode($rows));

?>
