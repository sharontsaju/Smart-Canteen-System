<?php

$conn = mysqli_connect('localhost','root','','canteenmgmt');

if(!$conn)
{
	die('Sorry! Unable to connect to the database.');
}
