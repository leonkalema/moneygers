<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();

//Chose a new start date basing on the chosen assignment
$d_query = mysql_query("SELECT startdate,enddate FROM assignments WHERE callsign = '".$_GET['c']."'") or die("Invalide Query:<br>".mysql_error());

$n_date = mysql_fetch_assoc($d_query);

//Print the new date
echo $n_date['startdate']."GET = ".$_GET['c'];
?>