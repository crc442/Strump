<?php
session_start();

$data = json_decode(file_get_contents("php://input"));

$follower_id= $_SESSION['username'];
$follow_artist_Id=$data->otherUserId;

$con = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('STRUMP', $con);

$query='Select count(*) as result from followartist where follower="'.$follower_id.'" and follow_artist="'.$follow_artist_Id.'"';
$qry_res = mysql_query($query);
$res = mysql_fetch_assoc($qry_res);
if($res['result']==0){
#insert data
	$query1='insert into followartist (follower, follow_artist, follow_date) values("'.$follower_id.'","'.$follow_artist_Id.'",now())';
	$query_result= mysql_query($query1);
	if($query_result){
		$arr = array('msg' => "Artist Followed successfully!!!", 'error' => '');
        $jsn = json_encode($arr);
        print_r($jsn);
    } else {
        $arr = array('msg' => "", 'error' => 'Error following user');
        $jsn = json_encode($arr);
        print_r($jsn);

	}
}
else {
    $arr = array('msg' => "", 'error' => 'Artist is already followed');
    $jsn = json_encode($arr);
    print_r($jsn);
}
?>
