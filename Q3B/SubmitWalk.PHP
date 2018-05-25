<?php

require("validateData.php");
if($valid == TRUE)
{

$pageTitle = "Walk Submitted";

require("header.php");
require("footer.php");

$databasename ='walkingclub.sqlite';
$db = new SQLite3($databasename);

if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


///Asign to var
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

###Prepared statements ####
$sql = "INSERT INTO walk (name, walk_date, start_time, leader, meeting_point, meeting_latlong, distance, route, notes, status)
VALUES (:name, :walk_date, :start_time, :leader, :meeting_point, :meeting_latlong, :distance, :route, :notes, :status)";

$stmt = $db->prepare($sql);

$stmt->bindValue(':name', $name);
$stmt->bindValue(':walk_date', $walk_date);
$stmt->bindValue(':start_time', $start_time);
$stmt->bindValue(':leader', $leader);
$stmt->bindValue(':meeting_point', $meeting_point);
$stmt->bindValue(':meeting_latlong', $meeting_point_latlong);
$stmt->bindValue(':distance', $distance);
$stmt->bindValue(':route', $route);
$stmt->bindValue(':notes', $notes);
$stmt->bindValue(':status', $status);

$stmt->execute();

?>
<p></p>
<p id='data-sent'>Data recived - proposed walk is saved to server.</p>
<?php
}
else{
  $pageTitle = "Walk Submission Failed";
  require("header.php");
  require("footer.php");
  ?> <p id='data-sent'></p>
  <p align='center'id='data-sent'>Submission failed - please try again.</p>
  <div align='center'><p><?php echo $formerror;?></p></div>
  <?php
}
?>

<div id="ok-div">

  <a href="WalkSubmitForm.html"><button id="ok-button">OK</button></a>

</div>
