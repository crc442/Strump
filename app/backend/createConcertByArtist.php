<?php
$data = json_decode(file_get_contents("php://input"););

$concertName= $data->concertName;
$concertVenue = $data->venueId;
$concertDate= $data->date;
$concertArtist= $data->artist;
$concerttype= $data->catType;
$ticketPrice= $data->price;
$capacity = $data->capacity;
$ticketLink= $data->tlink;
$con = mysql_connect('localhost', 'root', '');
mysql_select_db('STRUMP', $con);

$query= "insert into systemconcerts(concerttype,concert_artist,
		 concert_capacity, concert_id,concert_name,concert_organizing_company,
		 concert_posted_date,concert_time,ticket_availability,ticket_hyperlink,ticket_price,venue_id)
		 values('$concerttype','$concertArtist','$capacity',null,'$concertName',null,now(),
		 '$concertDate','$capacity','$ticketLink','$concertVenue')";

$qry_res = mysql_query($query);
    if ($qry_res) {
        $arr = array('msg' => "Concert Created Successfully!!!", 'error' => '');
        $jsn = json_encode($arr);
        print_r($jsn);
    } else {
        $arr = array('msg' => "", 'error' => 'Error In creating concert');
        $jsn = json_encode($arr);
        print_r($jsn);
    }

?>
