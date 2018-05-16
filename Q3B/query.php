
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

//if(isset($_POST['search'])){
  $webdata['query'] = $_POST['search-term'];

  echo "<p>Searching...</p>";

$sql = 'SELECT name FROM walk WHERE name LIKE :query';

$stmt = $db->prepare($sql);
$stmt->bindValue(":query" , '%'.$webdata['query'].'%',SQLITE3_TEXT);
$result = $stmt->execute();

if ($row = $result->fetchArray()){
  echo '<p>' . htmlspecialchars($row['name']) . '</p>';
  //echo"<input type='checkbox' name='select-result'>"."Select to edit.";
}

else {
  echo "<p>No data copuld be found - Please enter new search.</p>";
}

?>
</body>
</html>
