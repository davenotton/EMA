<?php
define('ISITSAFETORUN', TRUE);
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Etc/UTC');
//$databasename ='demo.sqlite';
$stylesheet = 'b_.css';
$javascript ='';
$mycss='';
$pagetitle = 'Select the SQLite Database';

require 'sformdata.php';

if (!empty($webdata['db']))
{
	$databasename = "{$webdata['db']}";
	echo "<p>Opening database {$databasename} </p>";
	require 'opendatabase.php';
	echo "<p>Opening database {$databasename} </p>";

//if (!$db) die ($error);

$sql = "SELECT name FROM sqlite_master WHERE type='table'"; /*sqlite_master is part of the structure of any sqlite database that contains the details of how that database is organised. A query is first created to read the data about the database.*/
	$result = $db->query($sql) or die('Query failed');  
	
	$mycss = "<style>
.showhide { /*button style */
display: inline-block;
background: darkorange; 
}
";

	   

while ($row = $result->fetchArray())
{
	$tablename = $row['name'];





//$result = sqlite_query($db, $query, SQLITE_NUM); /*This query is then executed.*/


$mycss = $mycss ."#" . $tablename ."section {
display: none;
}" .  "#section" . $tablename . ":checked + #". $tablename. "section {
display: block;
}
";

}
$mycss =  $mycss . "</style>\n\n";

	
	
	
	
	
	
}





require 'html5head.php';

echo "<h1>$pagetitle</h1>";
?>



<main>
<?php
$directory = '.';
$dbfound = FALSE;
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
while($it->valid()) {
    if (!$it->isDot()) {
		$myfilename = $it->getSubPathName();
		if ( strpos( $myfilename , ".sqlite" ))
		{
        echo '<p><a href="'.htmlspecialchars($_SERVER["PHP_SELF"]).'?db=' . $myfilename . '">' . $myfilename . '</a></p>';
        $dbfound= TRUE;
		}
    } 
    $it->next();
   
	
}
if (!$dbfound){
	echo '<p>There is no sqlite database in this folder. Have you created one?</p>';
}
?>
</main>
<?php


if (empty($webdata['db']))
    { echo 'No database selected';
		die('select a database');
	}

$databasename = $webdata['db'];

$stylesheet = '';

$javascript ='';

$pagetitle = 'Examine Database';

if (strpos($webdata['db'], '.sqlite') == false) {
	echo "<h2>No database selected</h2><p>Have you created the database?</p>";
    //require 'showsqlitedb.php';
    exit;
}
$databasename = $webdata['db'];

//require 'html5head.php';





?>
<h2>Listing all tables in the database, and their contents</h2>

<p>This is an aid to development. We can use it to view and to edit the contents of any SQLite3 database. It is not intended for handling a lot of data.</p>

<p>It can read our table names and column names from the database. 
<p>When a row is selcted for editing it will appear in the frame at the bottom of the page</p>

<?php

if (!$db) die ($error);

$tsql = "SELECT name, sql FROM sqlite_master WHERE type='table'"; /*sqlite_master is part of the structure of any sqlite database that contains the details of how that database is organised. A query is first created to read the data about the database.*/

$tresult = $db->query($tsql) or die('Query failed');     

while ($trow = $tresult->fetchArray())
{

/*rows of results are collected one row at a time.*/


?>
<br /><br /><label for="section<?php echo $trow['name']; ?>" class="showhide">Show Hide: <h2><?php echo $trow['name']; ?></h2></label>
<input type="checkbox" id="section<?php echo $trow['name']; ?>" value="button" style="display:none;" />
<section id="<?php echo $trow['name']; ?>section"  >
<?php
echo "table: $trow[0], tsql: $trow[1]"; /*and the data from each item in the row is printed. The first item identifies each table name in the database.*/

echo "<table style='font-size:12;font-family:verdana'>";

echo "<thead><tr><th>id</th>";

$sql =  "PRAGMA table_info($trow[0])";
$hresult = $db->query($sql) or die('Query failed');     
$count=1;
while ($hrow = $hresult->fetchArray())
{
	$count++;
echo "<th>$hrow[1]</th>";
}
echo "<th>Edit</th><th>Delete</th></tr></thead>";

$sql = "SELECT rowid, * FROM $trow[0]"; /*Now the script uses each table name to select the rowid and then all remaining columns for each row in that table.*/
echo "<p>$sql</p>";
$result = $db->query($sql) or die('Query failed');     

while ($row = $result->fetchArray())
{echo "<tr>";
	for ($x = 0; $x < $count; $x++) {
echo "<td>". htmlspecialchars($row[$x])."</td>";
}
echo '<td><a href=" editdb.php?db='.$webdata['db'].'&table='.$trow[0].'&rowid='.$row[0].'" target="editable" >Edit: '.$trow[0].$row[0] .'</a></td><td><a href="editdb.php?db='.$webdata['db'].'&table='.$trow[0].'&rowid='.$row[0].'&delete=delete" target="editable" >Delete  ; '.$trow[0].$row[0] .'</a></td></tr>'; /*Each row in the table is then ended with code to identify that row to be edited or to be deleted.*/

// echo "</tr>";
}
echo "</table>";
echo '<td><a href=" editdb.php?db='.$webdata['db'].'&table='.$trow[0].'&newrow=newrow" target="editable" >New row</a>';
echo "</section>";

}

?>



<iframe  width= "100%" height="800" id="editable" NAME="editable" src=""  ></iframe>

<p>This iframe is the area where any row you select to be edited will be displayed.</p>



<p>Author Peter Thomson 2016</p>

<?php 

require 'html5tail.php';

?>
