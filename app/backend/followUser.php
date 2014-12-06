<?php
$data = json_decode(file_get_contents("php://input"););
$follower_id= $data->MyId;
$follow_user_Id=$data->otherUserId;

$con = mysql_connect('localhost', 'root', '');
mysql_select_db('STRUMP', $con);

$query='Select count(*) as result from followuser where follower="'.$follower_id.'" and follow_user="'.$follow_user_Id.'"';
$qry_res = mysql_query($query);
$res = mysql_fetch_assoc($qry_res);
if($res['result']==0){
#insert data
	$query1='insert into followuser (follower, follow_user, follow_date) values("'.$follower_id.'","'.$follow_user_Id.'",now())';
	$query_result= mysql_query($query1);
	if($query_result){
		$arr = array('msg' => "User Followed successfully!!!", 'error' => '');
        $jsn = json_encode($arr);
        print_r($jsn);
    } else {
        $arr = array('msg' => "", 'error' => 'Error following user');
        $jsn = json_encode($arr);
        print_r($jsn);

	}
}
else {
    $arr = array('msg' => "", 'error' => 'User is already followed');
    $jsn = json_encode($arr);
    print_r($jsn);
}
?>