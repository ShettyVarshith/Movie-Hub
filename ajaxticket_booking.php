<?php
session_start();
error_reporting(0);
include("dbconnection.php");
$bookingfee=30;
$taxpercentage=18;
$sqlticketbooking = "SELECT * FROM ticket_booking where customerid='$_SESSION[customerid]' and  showtimingid='$_GET[showtimingsid]'  and seatid='$_GET[seatid]'";
$qsqlticketbooking = mysqli_query($con,$sqlticketbooking);
if(mysqli_num_rows($qsqlticketbooking) == 0)	
{
	$sql = "INSERT INTO ticket_booking(customerid,showtimingid,seatid,seatrow,seatno,cost,status,handlingcharge,tax) VALUES('$_SESSION[customerid]','$_GET[showtimingsid]','$_GET[seatid]','$_GET[rowno]','$_GET[seatno]','$_GET[cost]','Pending','$bookingfee','$taxpercentage')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
}
else
{
	$sql="DELETE FROM ticket_booking where customerid='$_SESSION[customerid]' and  showtimingid='$_GET[showtimingsid]'  and seatid='$_GET[seatid]'";
	$qsql=mysqli_query($con,$sql);
	echo mysqli_error($con);
}	
/*
if(isset($_GET[editid])) //if block to update the record
	{
		//Update statement starts here
		$sql ="UPDATE ticket_booking SET billingid='$_POST[billingid]',customerid='$_POST[customerid]',theatreid='$_POST[theatreid]',seatid='$_POST[seatid]',date='$_POST[date]',time='$_POST[time]',cost='$_POST[cost]',status='$_POST[status]' WHERE ticket_bookid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert('ticket_booking record updated successfully...');</SCRIPT>";
		}
		//Update statement ends here
	}//if block to update the record ends here	
*/
?>
<?php
$sqlbookingrs ="SELECT * FROM ticket_booking where ticket_booking.customerid='$_SESSION[customerid]' and  ticket_booking.showtimingid='$_GET[showtimingsid]' AND ticket_booking.status='Pending' order by seatrow ";
$qsqlticketbookingrs = mysqli_query($con,$sqlbookingrs);
while($rsbookingrs = mysqli_fetch_array($qsqlticketbookingrs))
{	
	if($rsbookingrs[seatrow] != $bookingrow )
	{
		echo "<hr>";
		echo "<b>Cost : </b> ₹$rsbookingrs[cost]";
		echo "<br><b>Row : </b> $rsbookingrs[seatrow] <br>";
		echo "<b>Seat No. </b> $rsbookingrs[seatno]";
		$seatnos="Row : $rsbookingrs[seatrow] \n Seat No. $rsbookingrs[seatno]";
	}
	else
	{
		echo ", $rsbookingrs[seatno]";
		$seatnos = $seatnos .", $rsbookingrs[seatno]";
	}
	if($rsbookingrs[seatrow] != $bookingrow )
	{
		$bookingrow = $rsbookingrs[seatrow];
	}
	$cost = $cost + $rsbookingrs[cost];
}
?>
<?php
if(isset($_SESSION[customerid]))
{
?>
	<input type="submit" class="form-control" value="Confirm to Book" onclick="window.location='billing.php'" >
<?php
}
else
{
?>
	<a href="#" data-toggle="modal" class="form-control" data-target="#myModal"> Login</a>
<?php
}
?>