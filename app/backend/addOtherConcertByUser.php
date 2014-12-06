<?php
$data = json_decode(file_get_contents("php://input"););
$concert_id= $data->concertId;
$user_Id=$data->userId;
$concert_artist=$data->oartist;
$concert_name=$data->oconcertName;
$concert_time=$data->odatetime;
$con_type=$data->concertType;
$con_venue= $data->conVenue;

$con = mysql_connect('localhost', 'root', '');
mysql_select_db('STRUMP', $con);
$query='select count(*) as result from otherconcerts where 
other_concert_name="'.$concert_name.'" and other_concert_artist_id="'.$concert_artist.'" and other_concert_time="'.$concert_time.'" and other_concert_venue_id="'.$con_venue.'"';
$qry_res = mysql_query($qury);
$res = mysql_fetch_assoc($qry_res);
if($res['result']==0){
	$query='insert into otherconcerts(other_concert_artist_id,other_concert_id,other_concert_name,other_concert_submission_date,other_concert_submitted_by,other_concert_time,other_concert_type,other_concert_venue_id) 
	values("'.$concert_artist.'",null,"'.$concert_name.'",now(),"'.$user_Id.'","'.$concert_time.'","'.$con_type.'","'.$con_venue.'")';
	$qry_res1 = mysql_query($query);
	if ($qry_res1) {
		$arr = array('msg' => "Other concert added successfully to mylist", 'error' => '');
		$jsn = json_encode($arr);
		print_r($jsn);
	} else {
		$arr = array('msg' => "", 'error' => 'Error in inserting record');
		$jsn = json_encode($arr);
		print_r($jsn);
	}
}
else{
	$arr = array('msg' => "", 'error' => 'Concert is already present');
}
?>