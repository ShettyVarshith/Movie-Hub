<?php
include("header.php");
error_reporting(0);
if(isset($_POST[submit]))
{
	if(isset($_GET[editid])) //if block to update the record
	{
		//Update statement starts here
		$sql ="UPDATE foodorder SET customerid='$_POST[customerid]',snacksid='$_POST[snacksid]',ticket_bookid='$_POST[ticket_bookid]',cost='$_POST[cost]',status='$_POST[status]' WHERE orderid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert('foodorder record updated successfully...');</SCRIPT>";
		}
		//Update statement ends here
	}//if block to update the record ends here
	else //else block to insert the record
	{
		//Insert statement starts here
	$sql = "INSERT INTO foodorder(customerid,snacksid,ticket_bookid,cost,status) VALUES ('$_POST[customerid]','$_POST[snacksid]','$_POST[ticket_bookid]','$_POST[cost]','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	  {
		echo "<SCRIPT>alert('snacks order record inserted successfully...');</SCRIPT>";
	 }
	}
}
//This code is to select data while updating
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM foodorder WHERE orderid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//This code is to select data while updating ends here
?>
	<!-- features -->
	<div id="features" class="features">
		<div class="container"> 
			<div class="w3layouts_skills_grids w3layouts-features-agileinfo">

				<div class="col-md-9 w3features-left">				

					<div id="register" class="login-form "> 
						<div class="agile-row">
							<h5>Snacks order Form</h5> 
							<div class="login-agileits-top"> 	
								<form  action="" method="post"> 
									<p>Customer Name</p>
<select name="customerid" class="form-control" value='<?php echo $rsedit[customerid]; ?>'>
<option value=''>select</option>
<?php
$sqlcustomer="SELECT * FROM customer where status='active'";
$qsqlcustomer=mysqli_query($con,$sqlcustomer);
echo mysqli_error($con);
while($rscustomer = mysqli_fetch_array($qsqlcustomer))
{
	echo "<option value='$rscustomer[customerid]'>$rscustomer[customername]</option>";
}
?>
</select>
										
										<p>snacks name</p>
<select name="snacksid" class="form-control" value='<?php echo $rsedit[snacksid]; ?>'>
<option value=''>select</option>
<?php
$sqlsnacks="SELECT * FROM snacks where status='active'";
$qsqlsnacks=mysqli_query($con,$sqlsnacks);
echo mysqli_error($con);
while($rssnacks = mysqli_fetch_array($qsqlsnacks))
{
	echo "<option value='$rssnacks[snacksid]'>$rssnacks[itemname]</option>";
}
?>
									
										</select>  
										<p>Date of Booking</p>
<select name="ticket_bookid" class="form-control" value='<?php echo $rsedit[ticket_bookid]; ?>'>
<option value=''>Select</option>
<?php
$sqlticket_booking = "SELECT * FROM ticket_booking WHERE status='Active'";
$qsqlticket_booking = mysqli_query($con,$sqlticket_booking);
echo mysqli_error($con);
while($rsticket_booking = mysqli_fetch_array($qsqlticket_booking))
{
	echo "<option value='$rsticket_booking[ticket_bookid]'>$rsticket_booking[date]</option>";
}
?>
										</select> 
									<p>Cost</p>
									<input type="text" class="name" name="cost" value='<?php echo $rsedit[cost]; ?>' />
									<p>Status</p>
									<select name="status" class="form-control">
										<option value=''>Select</option>
										<option value='Active'>Active</option>
										<option value='Inactive'>Inactive</option>
									</select>  
									<input type="submit" name="submit" value="Register">
								</form> 	
							</div>  
						</div>  
					</div>  
					
					
				</div> 
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //features --> 
	<?php
include("footer.php");
?>