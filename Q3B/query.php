
<?php
///display html menu.
$pageTitle = "Search Results";
require ("header.php");
//require "validateData.php";

$databasename ='walkingclub.sqlite';
$db = new SQLite3($databasename);            ///connect to database.

if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

if(isset($_POST['search-term']) && $_POST['search-term'] != ""){ /// check search input is nopt empty.

$webdata = $_POST['search-term']; /// assingn variable.
echo "<p id='searching'>Searching...</p>";

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

  echo
  "<table id='results' >
  <tr>
  <th>Name: </th>
  <th>Walk-date: </th>
  <th>Start-time: </th>
  <th>Leader: </th>
  <th>Meeting-point: </th>
  <th>meeting_point Lat & Long: </th>
  <th>Distance: </th>
  <th>Route: </th>
  <th>Notes: </th>
  <th>Status: </th>
  </tr>
  <tr>
  <td>" . htmlspecialchars($row['name']) . "</td>
  <td>" . htmlspecialchars($row['walk_date']) ."</td>
  <td>" . htmlspecialchars($row['start_time']) . "</td>
  <td>" . htmlspecialchars($row['leader']) . "</td>
  <td>" . htmlspecialchars($row['meeting_point']) . "</td>
  <td>" . htmlspecialchars($row['meeting_latlong']) . "</td>
  <td>" . htmlspecialchars($row['distance']) . "</td>
  <td>" . htmlspecialchars($row['route']) . "</td>
  <td>" . htmlspecialchars($row['notes']) . "</td>
  <td>" . htmlspecialchars($row['status']) ."</td>
  </tr>
  </table>";

echo "<br>";
}

if(!$row = $result->fetchArray()) { /// query data dose not exist.
  echo "<p>No data could be found - Please enter new search.</p>";
}
}
else{ ///incorrect search term entered.
  echo '<p>Please enter a search query.</p>';
}
?>
