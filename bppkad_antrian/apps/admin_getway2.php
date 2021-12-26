<?php
include "mysql_connect.php";
$counter = $_POST["counter"];
$loket = $_POST["loket"];
$results = $mysqli->query('UPDATE data_antrian SET counter='.$loket.', status=2 WHERE id='.$counter.'');

$selanjutnya = $mysqli->query("SELECT Min(id) as id FROM data_antrian WHERE counter=$loket AND status = 4");
$row = $selanjutnya->fetch_array();
$data['next'] = $row['id'];
echo json_encode($data);
include 'mysql_close.php';