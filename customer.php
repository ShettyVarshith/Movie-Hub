<?php
include("header.php");
error_reporting(0);
if(isset($_POST[submit]))
{	
	if(isset($_GET[editid])) //if block to update the record
	{
		//Update statement starts here
		$sql ="UPDATE customer SET customername='$_POST[customername]',contactno='$_POST[contactno]',emailid='$_POST[emailid]',password='$_POST[password]',status='$_POST[status]' WHERE customerid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert('customer record updated successfully...');</SCRIPT>";
		}
		//Update statement ends here
	}//if block to update the record ends here
	else //else block to insert the record
	{
		//Insert statement starts here
		$sql = "INSERT INTO customer (customername,contactno,emailid,password,status) VALUES ('$_POST[customername]','$_POST[contactno]','$_POST[emailid]','$_POST[password]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert('customer record inserted successfully...');</SCRIPT>";
		}
		//Insert statement endss here
	} //else block to insert the record ends here
}
//This code is to select data while updating
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM customer WHERE customerid='$_GET[editid]'";
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
							<h5>Customer Form</h5> 
							<div class="login-agileits-top"> 	
								<form  action="" method="post" name="frmcustomer" onsubmit="return validateform()"> 
									<p>customer name </p>
									<input type="text" class="name" name="customername" value='<?php echo $rsedit[customername]; ?>' />
										<em id="idcustomername" style="color:red;" class="ms-error"></em>
									<p>Contact no</p>
									<input type="text" class="name" name="contactno"  maxlength="10" value='<?php echo $rsedit[contactno]; ?>' />
								
									<p>Email ID</p>
									<input type="text" class="name" name="emailid" value='<?php echo $rsedit[emailid]; ?>' />
									
									<p>Password</p>
									<input type="password" class="password" name="password" value='<?php echo $rsedit[password]; ?>' /> 
								
								   <p>Status</p>
									<select name="status" class="form-control">
										<option value=''>Select</option>
										<option value='Active'>Active</option>
										<option value='Inactive'>Inactive</option>
									</select> 
									<em id="idstatus" style="color:red;" class="ms-error"></em>
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
<script>
function validateform()  
{
	var spans = $('.ms-error');
	var expemail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	spans.text(''); // clear the text

	var i =0;
	
	if(document.frmcustomer.customername.value == "" )
	{
		document.getElementById("idcustomername").innerHTML="Kindly enter your name..";		
		i=1;
	}
	if(!document.frmcustomer.emailid.value.match(expemail))
	{
		document.getElementById("idemailid").innerHTML="Email ID is not valid....";
		i=1;
	}
     if(document.theatreform.emailid.value=="")
	 {
		 document.getElementById("idemailid").innerHTML="Email ID Should not be empty...."
		 i=1;
	 }
   if(document.frmcustomer.status.value == "" )
	{
		document.getElementById("idstatus").innerHTML="Kindly enter the status..";		
		i=1;
	}
	
	
	
	
	
	if(i == 0)
	{
		return true;
	}
	if(i = 1)
	{
		return false;
	}
}
</script>