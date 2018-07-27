<?php
include_once "../class/class.guard.php";
include_once "../class/class.person.php";
include_once "../class/class.place.php";
session_start();

$guard = new Guard;
$persondetails = new Person;
$personaladdress = new Place;
$homeaddress = new Place;
$id = $_GET['id'];
$guard->get($id);
$persondetails->get($guard->getPersonId());
#delete the guard's address
$personaladdress->delete($persondetails->getAddressId());
$homeaddress->delete($persondetails->getHomeId());
#delete the guard's personal details
$persondetails->delete($guard->getPersonId());

#delete the guard
$guard->delete($id);
forwardToPage('../hr/manageguards.php');
?>
