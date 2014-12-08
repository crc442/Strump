<?php
$data = json_decode(file_get_contents("php://input"));

$username = $data->username;

//Connect to the database.
$con = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('STRUMP', $con);

// All user attribrutes
$qry_em = 'select * from users where user_id ="'.$username.'"';
$sth = mysql_query($qry_em);
$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $rows[] = $r;
}


// User's following count
$query1 = 'select * from followuser where follow_user="'.$username.'"';
$qry_res1 = mysql_query($query1);
if($qry_res1)
{
 $res1 = mysql_fetch_assoc($qry_res1);
 $q1cnt = mysql_num_rows($qry_res1);
}
else
{
  $q1cnt = 0;
}

$query2 = 'select * from followartist where follow_artist="'.$username.'"';
$qry_res2 = mysql_query($query2);
if($qry_res2)
{
 $res2 = mysql_fetch_assoc($qry_res2);
 $q2cnt = mysql_num_rows($qry_res2);
}
else
{
  $q2cnt = 0;
}
$followingcount =  $q1cnt + $q2cnt;


// User's followers count
$fquery1 = 'select * from followuser where follower="'.$username.'"';
$fqry_res1 = mysql_query($fquery1);
if($fqry_res1)
{
 $fres1 = mysql_fetch_assoc($fqry_res1);
 $fq1cnt = mysql_num_rows($fqry_res1);
}
else
{
  $fq1cnt = 0;
}

$fquery2 = 'select * from followartist where follower="'.$username.'"';
$fqry_res2 = mysql_query($fquery2);
if($fqry_res2)
{
 $fres2 = mysql_fetch_assoc($fqry_res2);
 $fq2cnt = mysql_num_rows($fqry_res2);
}
else
{
  $fq2cnt = 0;
}

$followerscount =  $fq1cnt + $fq2cnt;


$rows[]= array('followers' => $followingcount, 'following' => $followerscount);

print_r(json_encode($rows));


?>
