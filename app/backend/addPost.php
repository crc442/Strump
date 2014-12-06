<?php
$data = json_decode(file_get_contents("php://input"););
$concert_id= $data->concertId;
$user_Id=$data->userIdl;
$post = $data->commentData;
$con = mysql_connect('localhost', 'root', '');
mysql_select_db('STRUMP', $con);
$query1 = 'insert into post (concert_id,post,post_date,post_id,user_id)
	values("'.$concert_id.'","'.$post.'",now(),null,"'.$user_Id.'")';
	$qry_res1 = mysql_query($query1);
	if ($qry_res1) {
		$arr = array('msg' => "comment posted successfully!!!", 'error' => '');
		$jsn = json_encode($arr);
		print_r($jsn);
	} else {
		$arr = array('msg' => "", 'error' => 'Error in posting comment');
		$jsn = json_encode($arr);
		print_r($jsn);
	}
?>