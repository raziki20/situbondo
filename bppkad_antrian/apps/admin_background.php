<?php
    // set done
    $id = $_POST['id'];
    if(false){
		$db = new SQLite3('/situbondo/bppkad_antrian/db/bppkad_antrian.db');
		$result = $db->query('UPDATE data_antrian SET status=2 WHERE status=1'); // wait
		if (!$result) {
			echo json_encode(array('status'=>0));
		}else{
			echo json_encode(array('status'=>1));
		}
	}else{
		include "mysql_connect.php";
		$result = $mysqli->query('UPDATE data_antrian SET status=2 WHERE status=1'); // wait
		if (!$result) {
			echo json_encode(array('status'=>0));
		}else{
			echo json_encode(array('status'=>1));
		}
		include 'mysql_close.php';
	}
