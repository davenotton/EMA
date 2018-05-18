
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Search results</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="styles.css">

   </head>
   <body>

<?php

$databasename ='walkingclub.sqlite';
$db = new SQLite3($databasename);            ///connect to database.

if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

if(isset($_POST['search-term']) && $_POST['search-term'] != ""){ /// check search input is nopt empty.

$webdata = $_POST['search-term']; /// assingn variable.
echo "<p>Searching...</p>";

/// prepare statement.

if ($webdata < 0){ ///number is negative.
$sql = "SELECT name, walk_date,start_time, leader, meeting_point, meeting_latlong, distance, route, notes, status
FROM walk WHERE walk_date BETWEEN DATETIME('now','$webdata days','-1 days') AND DATETIME('now')";
}
else { ///number is negative.
  $sql = "SELECT name, walk_date, start_time, leader, meeting_point, meeting_latlong, distance, route, notes, status
   FROM walk WHERE walk_date BETWEEN DATETIME('now') AND DATETIME('now', '$webdata days')";
}

$stmt = $db->prepare($sql);
/// bind statement.
$stmt->bindValue(":query" , '%'.$webdata.'%',SQLITE3_TEXT);
/// execute statement.
$result = $stmt->execute();

/// display query data to user.
while ($row = $result->fetchArray()){
  echo '<p>' . "Name: " . htmlspecialchars($row['name']) . " | Walk-date: " . htmlspecialchars($row['walk_date']) . " | Start-time: " . htmlspecialchars($row['start_time']) .
   " | Leader: " . htmlspecialchars($row['leader']) . " | Meeting-point: " . htmlspecialchars($row['meeting_point']) . " | Meeting-point Lat & Long: " . htmlspecialchars($row['meeting_latlong']) .
   " | Distance: " . htmlspecialchars($row['distance']) . " | Route: " . htmlspecialchars($row['route']) . " | Notes: " . htmlspecialchars($row['notes']) . " | Status: " . htmlspecialchars($row['status']) .'</p>';
}

if(!$row = $result->fetchArray()) { /// query data dose not exist.
  echo "<p>No data could be found - Please enter new search.</p>";
}
}
else{ ///incorrect search term entered.
  echo '<p>Please enter a search query.</p>';
}
?>

</body>
</html>
