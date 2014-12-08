<?php
session_start();

// $slangs = array('You should too.', '', 'What are you waiting for?', 'Check it out!');

$userID = $_SESSION['username'];
$data = json_decode(file_get_contents("php://input"));

//Connecting to the database
$con = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('STRUMP', $con);

$query1 = 'select follow_artist, follower, UNIX_TIMESTAMP(follow_date) as follow_date from followartist where follower IN (select follow_user from followuser where follower="'.$userID.'")';

$sth = mysql_query($query1);
$rows = array();
if($sth){
  while($r = mysql_fetch_assoc($sth)) {
    // $r[] = array_rand($slangs, 1);
    // var_dump($r);
    $s = array_merge($r, array('type' => 'artist'));
    $rows[] = $s;
}
}


$query2 = 'select follow_user, follower, UNIX_TIMESTAMP(follow_date) as follow_date from followuser where follower IN (select follow_user from followuser where follower="'.$userID.'")';

$sth1 = mysql_query($query2);
if($sth1){
  while($r1 = mysql_fetch_assoc($sth1)) {
    // $r[] = array_rand($slangs, 1);
    // var_dump($r);
    $s1 = array_merge($r1, array('type' => 'user'));
    $rows[] = $s1;
}
}



print_r(json_encode($rows));

?>
