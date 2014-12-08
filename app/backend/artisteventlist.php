<?php

$data = json_decode(file_get_contents("php://input"));
$con = mysql_connect('127.0.0.1', 'root', '');

//Connecting to the database
mysql_select_db('STRUMP', $con);
$artist_id= $data->artistId;

$qry_em = "select a.concert_id,a.concert_name, year(a.concert_time) as cyear,substr(MONTHNAME(a.concert_time),1,3) as cmonth,day(a.concert_time) as cday,b.venue_city,b.venue_country,b.venue_name,b.venue_state,b.venue_street,b.venue_zip,a.ticket_hyperlink,a.ticket_price from systemconcerts a, venue b where a.concert_artist='$artist_id' and a.venue_id=b.venue_id";
$sth = mysql_query($qry_em);
$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $rows[] = $r;
}

// $reslt = mysql_fetch_assoc($sth)
print_r(json_encode($rows));
?>
