<?php
$data = json_decode(file_get_contents("php://input"));

$name = $data->artistusername;
$password = $data->password;
$web = $data->website;
// $musiccategory = $data->selectedCat;
$company = $data->company;
$artistname = $data->artistname;
$musicCat = array();
$musicCat = $data->musiccat;
//Connect to the database.
$con = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('STRUMP', $con);

function split_insert(&$item, $key, $param)
{
    $cat = explode("-", $item);
    $qcat = "INSERT INTO artistmusic( artist_id, genre_id, sub_genre_id) VALUES('$param', '$cat[0]', '$cat[1]')";
    mysql_query($qcat);
}
// See if the user exists?
$qry_em = 'select count(*) as cnt from artists where artist_id ="' . $name . '"';
$qry_res = mysql_query($qry_em);
$res = mysql_fetch_assoc($qry_res);


// Execute accordingly
if ($res['cnt'] == 0) {
    $qry = 'INSERT INTO artists (artist_id,artist_name,artist_registration_date,
    	artist_status,artist_verifying_company_id,artist_website,isloggedin,password)
		values ("' . $name . '","' . $artistname . '",now(),"Active","'.$company.'","'.$web.'","Y","'.$password.'")';
    $qry_res = mysql_query($qry);
    if ($qry_res) {
        array_walk($musicCat, 'split_insert', $name);
        $seractEntry='insert into searchEvent(category,keyword,concert_id)
                      values("artist","'.$name.'",null)';
        mysql_query($seractEntry);
        $arr = array('msg' => "Artist Created Successfully!!!", 'error' => '', 'valid' => true);
        $jsn = json_encode($arr);
        print_r($jsn);
    } else {
        $arr = array('msg' => "", 'error' => 'Error In inserting record', 'valid' => false);
        $jsn = json_encode($arr);
        print_r($jsn);
    }
} else {
    $arr = array('msg' => "", 'error' => 'Artist with same username already exists', 'valid' => false);
    $jsn = json_encode($arr);
    print_r($jsn);
}


// $sth = mysqli_query("SELECT ...");
// $rows = array();
// while($r = mysqli_fetch_assoc($sth)) {
//     $rows[] = $r;
// }

// print_r((json_encode($rows));


?>
