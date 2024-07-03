<?php
$con = mysqli_connect("localhost","root","","movietime");
if(mysqli_connect_errno($con))
{
	echo "Failed to connect mysql server" . mysqli_connect_error();
}
?>