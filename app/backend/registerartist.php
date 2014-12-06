<?php
$data = json_decode(file_get_contents("php://input"););

$name = $data->artistusername;
$password = $data->password;
$web = $data->website;
$musiccategory = $data->selectedCat;
$company = $data->artistcompany;
$artistname = $data->artistname;
//Connect to the database.
$con = mysql_connect('localhost', 'root', '');
mysql_select_db('STRUMP', $con);


See if the user exists?
$qry_em = 'select count(*) as cnt from artists where artistid ="' . $name . '"';
$qry_res = mysql_query($qry_em);
$res = mysql_fetch_assoc($qry_res);


Execute accordingly
if ($res['cnt'] == 0) {
    $qry = 'INSERT INTO artists (artist_id,artist_name,artist_registration_date,
    	artist_status,artist_verifying_company_id,artist_website,isloggedin,password) 
		values ("' . $name . '","' . $artistname . '",'now()','Active',"'.$company.'","'.$web.'","'Y'","'.$password.'")';
    $qry_res = mysql_query($qry);
    if ($qry_res) {
        $arr = array('msg' => "Artist Created Successfully!!!", 'error' => '');
        $jsn = json_encode($arr);
        print_r($jsn);
    } else {
        $arr = array('msg' => "", 'error' => 'Error In inserting record');
        $jsn = json_encode($arr);
        print_r($jsn);
    }
} else {
    $arr = array('msg' => "", 'error' => 'Artist with same username already exists');
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
