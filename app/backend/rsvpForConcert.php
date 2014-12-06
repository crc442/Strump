<?php
$data = json_decode(file_get_contents("php://input"););
$concert_id= $data->concertId;
$user_Id=$data->userIdl;

$query = 'select count(*) as result from attendancelog where 
concert_id="'.$concert_id.'" and user_id="'.$user_id.'"';
$qry_res = mysql_query($qry_em);
$res = mysql_fetch_assoc($qry_res);
if($res['result']==0){
	#insert data in table
	$query = 'insert into attendancelog (attended,concert_id,rate_logtime,rating,rsvp_logtime,user_id)
	values("N","'.$concert_id.'","null",0,now(),"'.$user_id.'")';
	$qry_res = mysql_query($query);
	if ($qry_res) {
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
	 $arr = array('msg' => "You have already RSVPd for this concert!", 'error' => '');
        $jsn = json_encode($arr);
        print_r($jsn);
}
?>