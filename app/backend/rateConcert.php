<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

$concert_id= $data->concertId;
$user_id=$_SESSION['username'];

$rate = $data->rate;

//Database connection
$con = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('STRUMP', $con);


$query = 'select count(*) as result from attendancelog where
concert_id="'.$concert_id.'" and user_id="'.$user_id.'"';
$qry_res = mysql_query($query);
$res = mysql_fetch_assoc($qry_res);
if($res['result']==0){
	#insert data in table
	$query1 = 'insert into attendancelog (attended,concert_id,rate_logtime,rating,rsvp_logtime,user_id)
	values("N","'.$concert_id.'",now(),"'.$rate.'",now(),"'.$user_id.'")';
	$qry_res1 = mysql_query($query1);
	if ($qry_res1) {
		$arr = array('msg' => "User Created Successfully!!!", 'error' => '');
		$jsn = json_encode($arr);
		print_r($jsn);
	} else {
		$arr = array('msg' => "", 'error' => 'Error In inserting record');
		$jsn = json_encode($arr);
		print_r($jsn);
	}
}
else{
	 $query1='update attendancelog set rating="'.$rate.'",rate_logtime=now()
	 where concert_id="'.$concert_id.'" and user_id="'.$user_id.'"';

	 $qry_res1 = mysql_query($query1);
	if ($qry_res1) {
		$arr = array('msg' => "Concert Rated Successfully!!", 'error' => '');
		$jsn = json_encode($arr);
		print_r($jsn);
	} else {
		$arr = array('msg' => "", 'error' => 'Error in rating concert, please try again');
		$jsn = json_encode($arr);
		print_r($jsn);
	}
}
?>
