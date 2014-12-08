
<?php
session_start();
$data = json_decode(file_get_contents("php://input"));
$concert_id= $data->concertId;
$user_id=$_SESSION['username'];

$con = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('STRUMP', $con);

$qury='select count(*) as result from myconcertlist where system_concert_id="'.$concert_id.'" and user_id="'.$user_id.'"';
$qry_res = mysql_query($qury);
$res = mysql_fetch_assoc($qry_res);
if($res['result']==0){
	$query='insert into myconcertlist(user_id,system_concert_id,other_concert_id)
	values("'.$user_id.'","'.$concert_id.'",null)';
  var_dump($query);
	$qry_res1 = mysql_query($query);
	if ($qry_res1) {
	$arr = array('msg' => "Concert added successfully to mylist", 'error' => '');
	$jsn = json_encode($arr);
	print_r($jsn);
} else {
	$arr = array('msg' => "", 'error' => 'Error in inserting record');
	$jsn = json_encode($arr);
	print_r($jsn);
}
}
else{
	$arr = array('msg' => "", 'error' => 'Concert is already in your wishlist');
}
?>
