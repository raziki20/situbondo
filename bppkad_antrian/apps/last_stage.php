<?php
$loket = $_POST['loket'];
if(false){
	$db = new SQLite3('/situbondo/bppkad_antrian/db/bppkad_antrian.db');
	$date = date("Y-m-d");
	$results = $db->query('SELECT Max(id) as id FROM data_antrian WHERE counter='.$loket.'');
	$row = $results->fetchArray();
	if ($row['id'] == NULL) {
    	$data = array('next' => 0);
	} else {
    	$data = array('next' => $row['id']);
	}
    echo json_encode($data);
}else if(isset($_POST['panggilan'])){
	include "mysql_connect.php";
	$date = date("Y-m-d");
	$results = $mysqli->query("SELECT Min(id) as id FROM data_antrian WHERE counter=$loket AND status = 4");
	$row = $results->fetch_array();
	if ($row['id'] == NULL) {
    	$data = array('next' => 0);
	} else {
    	$data = array('next' => $row['id']);
	}
    echo json_encode($data);
	include 'mysql_close.php';
}else{
	include "mysql_connect.php";
	$date = date("Y-m-d");
	$results = $mysqli->query('SELECT Max(id) as id FROM data_antrian WHERE counter='.$loket.'');
	$row = $results->fetch_array();
	if ($row['id'] == NULL) {
    	$data = array('next' => 0);
	} else {
    	$data = array('next' => $row['id']);
	}
    echo json_encode($data);
	include 'mysql_close.php';
}
?>