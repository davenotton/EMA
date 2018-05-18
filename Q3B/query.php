
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Search results</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">

   </head>
   <body>

<?php

$databasename ='walkingclub.sqlite';
$db = new SQLite3($databasename);

if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

if(isset($_POST['search-term']) && $_POST['search-term'] != ""){

$webdata['query'] = $_POST['search-term'];

//$str = "17";
$num =(int)7;
echo $num;

echo "<p>Searching...</p>";
$sql = "SELECT name, walk_date FROM walk WHERE walk_date > (SELECT DATETIME('now','$num days'))";
//$sql = "SELECT name, walk_date FROM walk WHERE walk_date > (SELECT STRFTIME) ";
//$sql = "SELECT name, walk_date FROM walk WHERE walk_date > (SELECT DATETIME('now', '-7day'))";
//$sql = "SELECT name, walk_date FROM walk WHERE walk_date BETWEEN :query AND 2018-05-17";
//$sql = "SELECT name, walk_date FROM walk WHERE walk_date LIKE :query";

$stmt = $db->prepare($sql);
$stmt->bindValue(":query" , '%'.$webdata['query'].'%',SQLITE3_TEXT);
$result = $stmt->execute();

$currentDate = date("Y-m-d"); /// date test
echo "<p>$currentDate</p>";
///$currentDate .= +1 d;
echo "<p>$currentDate</p>";

while ($row = $result->fetchArray()){
  //for($currentDate)
  echo '<p>' . "Name: " . htmlspecialchars($row['name']) . " | Walk-date: " . htmlspecialchars($row['walk_date']) . '</p>';
  //echo"<input type='checkbox' name='select-result'>"."Select to edit.";
}

if(!$row = $result->fetchArray()) {
  echo "<p>No data could be found - Please enter new search.</p>";
}
}
else{
  echo '<p>Please enter a search query.</p>';
}

?>
</body>
</html>
