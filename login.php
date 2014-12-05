<?php
$data = json_decode(file_get_contents("php://input");

$name = mysql_real_escape_string($data->name);
$password = mysql_real_escape_string($data->password);
$type = mysql_real_escape_string($data->type);

var_dump($name);

//Connect to the database.
$con = mysql_connect('localhost', 'root', '');
mysql_select_db('STRUMP', $con);


$qry_em = 'select count(*) as cnt from users where username ="' . $name . '" and password = "'.$password.'"';
$qry_res = mysql_query($qry_em);
$res = mysql_fetch_assoc($qry_res);


if ($res['cnt'] == 0) {
        $arr = array('msg' => "invalid credentials", 'error' => '');
        $jsn = json_encode($arr);
        print_r($jsn);
    }
} else {
    $arr = array('msg' => "loggedin", 'error' => 'User Already exists with same email');
    $jsn = json_encode($arr);
    print_r($jsn);
  }


// $sth = mysqli_query("SELECT ");
// $rows = array();
// while($r = mysqli_fetch_assoc($sth)) {
//     $rows[] = $r;
// }

// print_r((json_encode($rows));


?>
