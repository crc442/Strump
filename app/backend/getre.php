<?php
session_start();

 $data = json_decode(file_get_contents("php://input"));

 //Connecting to the database
 $con = mysql_connect('127.0.0.1', 'root', '');
 mysql_select_db('STRUMP', $con);

 $username = $_SESSION['username'];


 $rows = array();
 //Get system concerts
 //$scquery ="select system_concert_id,'system' as type from myconcertlist where user_id='".$username."' and system_concert_id is not null";
 $query1 ="select distinct system_concert_id as id,'system' as type,concert_name as name from myconcertlist , systemconcerts
where user_id in (select  follow_user from followuser where follower ='".$username."') and system_concert_id is not null and system_concert_id not in (select system_concert_id from myconcertlist where user_id='".$username."' and system_concert_id is not null)";
 $sth1 = mysql_query($query1);
if($sth1)
{
  while($r1 = mysql_fetch_assoc($sth1)) {
     $rows[] = $r1;
 }
}



 $query2 ="select distinct a.other_concert_id as id, 'other' as type,b.other_concert_name as name from myconcertlist a, otherconcerts b
where a.user_id in (select  follow_user from followuser where follower ='".$username."') and a.other_concert_id is not null and a.other_concert_id not in (select other_concert_id from myconcertlist where user_id='".$username."' and other_concert_id is not null)";
 $sth2 = mysql_query($query2);
 if($sth2){
 while($r2 = mysql_fetch_assoc($sth2)) {
     $rows[] = $r2;
 }
}

 $query3 ="select distinct concert_id as id,'system' as type,concert_name as name from systemconcerts
where (concert_artist in (select follow_artist from followartist where follower='".$username."')
or concerttype in (select distinct genre_id from usermusic where user_id='".$username."'))
 and concert_id not in(select system_concert_id from myconcertlist where user_id='".$username."' and system_concert_id is not null)";
 $sth3 = mysql_query($query3);
 if($sth3)
 {
 while($r3 = mysql_fetch_assoc($sth3)) {
     $rows[] = $r3;
 }
}
 $query4 ="select distinct concert_id as id,'other' as type,other_concert_name as name from otherconcerts
where (concert_artist in (select follow_artist from followartist where follower='".$username."')
or concerttype in (select distinct genre_id from usermusic where user_id='".$username."'))
 and concert_id not in(select other_concert_id from myconcertlist where user_id='".$username."' and other_concert_id is not null)";
 $sth4 = mysql_query($query4);
 if($sth4)
 {
 while($r4 = mysql_fetch_assoc($sth4)) {
     $rows[] = $r4;
 }
}

 // var_dump(array_unique($rows));
 print_r(json_encode($rows));

 ?>
