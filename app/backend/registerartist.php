<?php
$data = json_decode(file_get_contents("php://input"););

$name = mysql_real_escape_string($data->name);
$password = mysql_real_escape_string($data->password);
$type = mysql_real_escape_string($data->type);

//Connect to the database.
$con = mysql_connect('localhost', 'root', '');
mysql_select_db('STRUMP', $con);


// See if the user exists?
// $qry_em = 'select count(*) as cnt from users where email ="' . $uemail . '"';
// $qry_res = mysql_query($qry_em);
// $res = mysql_fetch_assoc($qry_res);


// Execute accordingly
// if ($res['cnt'] == 0) {
//     $qry = 'INSERT INTO users (name,pass,email) values ("' . $usrname . '","' . $upswd . '","' . $uemail . '")';
//     $qry_res = mysql_query($qry);
//     if ($qry_res) {
//         $arr = array('msg' => "User Created Successfully!!!", 'error' => '');
//         $jsn = json_encode($arr);
//         print_r($jsn);
//     } else {
//         $arr = array('msg' => "", 'error' => 'Error In inserting record');
//         $jsn = json_encode($arr);
//         print_r($jsn);
//     }
// } else {
//     $arr = array('msg' => "", 'error' => 'User Already exists with same email');
//     $jsn = json_encode($arr);
//     print_r($jsn);



$sth = mysqli_query("SELECT ...");
$rows = array();
while($r = mysqli_fetch_assoc($sth)) {
    $rows[] = $r;
}

print_r((json_encode($rows));


?>
