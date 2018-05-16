
<?php

$databasename ='test.sqlite';
$db = new SQLite3($databasename);


if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$f_name = $_POST['fname'];
$l_name = $_POST['lname'];



$sql = "INSERT INTO test (fname, lname) VALUES(:fname, :lname)";
$stmt = $db->prepare($sql);
$stmt->bindValue(':fname', $f_name);
$stmt->bindValue(':lname',$l_name);
$stmt->execute();
?>