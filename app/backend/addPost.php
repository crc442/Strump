<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

$concert_id= $data->concertId;
$user_Id = $_SESSION['username'];
$post = $data->commentData;


//Connecting to the database
$con = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('STRUMP', $con);


$query1 = 'insert into post (concert_id,post,post_date,post_id,user_id)
  values("'.$concert_id.'","'.$post.'",now(),null,"'.$user_Id.'")';
  $qry_res1 = mysql_query($query1);
  if ($qry_res1) {
    $queryRep = 'update users set reputation = reputation+1 where user_id="'.$user_id.'"';
    $arr = array('msg' => "comment posted successfully!!!", 'error' => 0, 'type' => $_SESSION['type']);
    $jsn = json_encode($arr);
    print_r($jsn);
  } else {
    $arr = array('msg' => "", 'error' => 'Error in posting comment');
    $jsn = json_encode($arr);
    print_r($jsn);
  }
?>
