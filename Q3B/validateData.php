<?php

$formerror = '';

$valid = TRUE ; // set a variable to true at the start. If we find and error change it to false. At the end if there are any error messages, return the form and data and messages, but don't save.
//$firstname = $webdata['firstname'];
if (isset($_POST['name'])) {
if (!preg_match("/[^[(){};<>]+/",$_POST['name'])) {
  $formerror = '<span class="warn" >Name: Not valid on server: Symbols: () {} <> Not allowed. - Only letters and digits allowed.  </span>';
  //echo "Only letters and white space allowed";
  $valid = FALSE ;
}}
if (isset($_POST['walk_date'])) {
if (!preg_match("/[^[(){};<>]+/",$_POST['walk_date'])) {
  $formerror = '<span class="warn" >Walk-date: Not valid on server: Symbols: () {} <> Not allowed. - Only letters and digits allowed. </span>';
  //echo "Only letters and white space allowed";
  $valid = FALSE ;
}}
if (isset($_POST['start_time'])) {
if (!preg_match("/[^[(){};<>]+/",$_POST['start_time'])) {
  $formerror = '<span class="warn" >Start-time: Not valid on server: Symbols: () {} <> Not allowed. - Only letters and digits allowed. </span>';
  //echo "Only letters and white space allowed";
  $valid = FALSE ;
}}
if (isset($_POST['leader'])) {
if (!preg_match("/[^[(){};<>]+/",$_POST['leader'])) {
  $formerror = '<span class="warn" >Leader: Not valid on server: Symbols: () {} <> Not allowed. - Only letters and digits allowed. </span>';
  //echo "Only letters and white space allowed";
  $valid = FALSE ;
}}
if (isset($_POST['meeting_point'])) {
if (!preg_match("/[^[(){};<>]+/",$_POST['meeting_point'])) {
  $formerror = '<span class="warn" >Meeting-point: Not valid on server: Symbols: ( ) { } < > Not allowed. - Only letters and digits allowed. </span>';
  //echo "Only letters and white space allowed";
  $valid = FALSE ;
}}
if (isset($_POST['meeting_point_lat'])) {
if (!preg_match("/[^[(){};<>]+/",$_POST['meeting_point_lat'])) {
  $formerror = '<span class="warn" >Latitude: Not valid on server: Symbols: ( ) { } < > Not allowed. - Only letters and digits allowed. </span>';
  //echo "Only letters and white space allowed";
  $valid = FALSE ;
}}
if (isset($_POST['meeting_point_long'])) {
if (!preg_match("/[^[(){};<>]+/",$_POST['meeting_point_long'])) {
  $formerror = '<span class="warn" >Longitude: Not valid on server: Symbols: ( ) { } < > Not allowed. - Only letters and digits allowed. </span>';
  //echo "Only letters and white space allowed";
  $valid = FALSE ;
}}
if (isset($_POST['distance'])) {
if (!preg_match("/[^[(){};<>]+/",$_POST['distance'])) {
  $formerror = '<span class="warn" >Distance: Not valid on server: Symbols: ( ) { } < > Not allowed. - Only letters and digits allowed. </span>';
  //echo "Only letters and white space allowed";
  $valid = FALSE ;
}}
if (isset($_POST['route'])) {
if (!preg_match("/[^[(){};<>]+/",$_POST['route'])) {
  $formerror = '<span class="warn" >Route: Not valid on server: Symbols: ( ) { } < > Not allowed. - Only letters and digits allowed. </span>';
  //echo "Only letters and white space allowed";
  $valid = FALSE ;
}}
if (isset($_POST['notes'])) {
if (!preg_match("/[^[(){};<>]+/",$_POST['notes'])) {
  $formerror = '<span class="warn" >Notes: Not valid on server: Symbols: ( ) { } < > Not allowed. - Only letters and digits allowed. </span>';
  //echo "Only letters and white space allowed";
  $valid = FALSE ;
}}

function validateDate($date, $format = 'Y-m-d H:i:s')
{
   $d = DateTime::createFromFormat($format, $date);
   return $d && $d->format($format) == $date;
   $valid = FALSE;
}//http://php.net/manual/en/function.checkdate.php
//validateDate('2012-02-28', 'Y-m-d')
//validateDate('2012-02-28 12:12:12')
//validateDate('2012-02-28T12:12:12+02:00', 'Y-m-d\TH:i:sP')

?>
