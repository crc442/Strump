<?php

session_start();

$data = json_decode(file_get_contents("php://input"));

$user_Id=$_SESSION['username'];
$concert_artist=$data->artistId;
$concert_name=$data->concertName;
$concert_time=$data->date;
$concertt=$data->catType;
$con_venue= $data->venueId;

$concertt1 = explode("-", $concertt);
$con_type = $concertt1[0];

// Database Connection
$con = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('STRUMP', $con);

$query='select count(*) as result from otherconcerts where
other_concert_name="'.$concert_name.'" and other_concert_artist_id="'.$concert_artist.'" and other_concert_time="'.$concert_time.'" and other_concert_venue_id="'.$con_venue.'"';
$qry_res = mysql_query($query);
// $res = mysql_fetch_assoc($qry_res);

// if($res['result']==0){
if($qry_res){
	$query1='insert into otherconcerts(other_concert_artist_id,other_concert_id,other_concert_name,other_concert_submission_date,other_concert_submited_by,other_concert_time,other_concert_type,other_concert_venue_id)
	values("'.$concert_artist.'",null,"'.$concert_name.'",now(),"'.$user_Id.'","'.$concert_time.'","'.$con_type.'","'.$con_venue.'")';
	$qry_res1 = mysql_query($query1);
	if ($qry_res1) {
    $getId=mysql_insert_id();
    $seractEntry='insert into searchEvent(category,keyword,concert_id)
                  values("other","'.$concert_name.'","'.$getId.'")';
    mysql_query($seractEntry);

    $seractEntry1='insert into myconcertlist(user_id,system_concert_id,other_concert_id)
                  values("'.$user_Id.'",null,"'.$getId.'")';
    mysql_query($seractEntry1);

		$arr = array('msg' => "Other concert added successfully to mylist", 'error' => '', 'valid' => true, 'username' => $user_Id);
		$jsn = json_encode($arr);
		print_r($jsn);
	} else {
		$arr = array('msg' => "", 'error' => 'Error in inserting record', 'valid' => false);
		$jsn = json_encode($arr);
		print_r($jsn);
	}
}
else{
	$arr = array('msg' => "", 'error' => 'Concert is already present', 'valid' => false);
}


?>
