<?php
$data = json_decode(file_get_contents("php://input"));

$name = $data->userNameid;
$fname= $data->fNameId;
$lname = $data->lNameId;
$userCity = $data->userCity;
$emailID= $data->inputEmailID;
$password = $data->password;


$musicCat = array();
$musicCat = $data->musiccat;


//Connect to the database.
$con = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('STRUMP', $con);


function split_insert(&$item, $key, $param)
{
    $cat = explode("-", $item);
    $qcat = "INSERT INTO usermusic( user_id, genre_id, sub_genre_id) VALUES('$param', '$cat[0]', '$cat[1]')";
    mysql_query($qcat);
}


// See if the user exists?
$qry_em = 'select count(*) as cnt from users where user_id ="' . $name . '"';
$qry_res = mysql_query($qry_em);
$res = mysql_fetch_assoc($qry_res);


// Execute accordingly
if ($res['cnt'] == 0) {
  $query = "insert into users (user_id ,user_first_name,user_last_name,email_id,
    user_city,reputation,last_accessed_date,registration_date,
    password,status,isLoggedin) values
('$name','$fname','$lname','$emailID','$userCity',0,now(),now(),
  '$password','ACTIVE','Y')";
/*$qry = 'INSERT INTO users (name,pass,email) values ("' . $usrname . '","' . $upswd . '","' . $uemail . '")';*/
$qry_res = mysql_query($query);
if ($qry_res) {
  array_walk($musicCat, 'split_insert', $name);

        $seractEntry='insert into searchEvent(category,keyword,concert_id)
                      values("user","'.$name.'",null)';
        mysql_query($seractEntry);
  $arr = array('msg' => "User Created Successfully!!!", 'error' => '', 'valid' => true);
  $jsn = json_encode($arr);
  print_r($jsn);

} else {
  $arr = array('msg' => "", 'error' => 'Error In inserting record', 'valid' => false);
  $jsn = json_encode($arr);
  print_r($jsn);
}
} else {
  $arr = array('msg' => "", 'error' => 'User Already exists with same username', 'valid' => false);
}
//     $jsn = json_encode($arr);
//     print_r($jsn);



/*$sth = mysqli_query("SELECT ...");
$rows = array();
while($r = mysqli_fetch_assoc($sth)) {
    $rows[] = $r;
}*/

// print_r(json_encode($rows));


?>
