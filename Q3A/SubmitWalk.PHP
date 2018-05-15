<?php

$databasename ='walkingclub.sqlite';
$db = new SQLite3($databasename);

$name = $_POST['name'];
$walk_date = $_POST['walk_date'];
$start_time = $_POST['start_time'];
$leader = $_POST['leader'];
$meeting_point = $_POST['meeting_point'];
$meeting_point_latlong = $_POST['meeting_point_lat'] . ',' . $_POST['meeting_point_long'];
$distance = $_POST['distance'];
$route = $_POST['route'];
$notes = $_POST['notes'];
$status = $_POST['status'];

$sql = "INSERT INTO walk (name, walk_date, start_time, leader, meeting_point, meeting_latlong, distance, route, notes, status) VALUES ('$name', '$walk_date','$start_time', '$leader', '$meeting_point', '$meeting_point_latlong', '$distance', '$route', '$notes', '$status')";
$db->exec($sql)or die('Could not save data');



?>
