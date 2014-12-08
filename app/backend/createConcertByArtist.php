<?php

session_start();
$data = json_decode(file_get_contents("php://input"));

$concertName= $data->concertName;
$concertVenue = $data->venueId;
$concertDate= $data->date;
$concertArtist= $_SESSION['username'];
$concertt= $data->catType;
$ticketPrice= $data->price;
$capacity = $data->capacity;
$ticketLink= $data->tlink;

$concertt1 = explode("-", $concertt);
$concerttype = $concertt1[0];


// Database connection
$con = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('STRUMP', $con);

$query= "insert into systemconcerts(concerttype,concert_artist,
		 concert_capacity, concert_id,concert_name,concert_organizing_company,
		 concert_posted_date,concert_time,ticket_availability,ticket_hyperlink,ticket_price,venue_id)
		 values('$concerttype','$concertArtist','$capacity',null,'$concertName',null,now(),
		 '$concertDate','$capacity','$ticketLink','$ticketPrice','$concertVenue')";

$qry_res = mysql_query($query);
    if ($qry_res) {
        $getId=mysql_insert_id();
        $seractEntry='insert into searchEvent(category,keyword,concert_id)
                      values("system","'.$concertName.'","'.$getId.'")';
        mysql_query($seractEntry);
        $arr = array('msg' => "Concert Created Successfully!!!", 'error' => '', 'username' => $concertArtist, 'valid' => true);
        $jsn = json_encode($arr);
        print_r($jsn);
    } else {
        $arr = array('msg' => "", 'error' => 'Error In creating concert', 'valid' => false);
        $jsn = json_encode($arr);
        print_r($jsn);
    }

?>
