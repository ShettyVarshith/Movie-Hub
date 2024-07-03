<?php
include("header.php");
error_reporting(0);
if(isset($_POST[submit]))
{	
	if(isset($_SESSION[customerid])) //if block to update the record
	{
		//Update statement starts here
		$sql ="UPDATE customer SET customername='$_POST[customername]',contactno='$_POST[contactno]',emailid='$_POST[emailid]' WHERE customerid='$_SESSION[customerid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert('customer profile updated successfully...');</SCRIPT>";
		}
		//Update statement ends here
	}//if block to update the record ends here
}
//This code is to select data while updating
if(isset($_SESSION[customerid]))
{
	$sqledit = "SELECT * FROM customer WHERE customerid='$_SESSION[customerid]'";
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
							<h5>Customer Profile</h5> 
							<div class="login-agileits-top"> 	
								<form  action="" method="post" name="signupcust" onsubmit="return validateform()" > 
									<p>customer name </p>
									<input type="text" class="name" name="customername" value='<?php echo $rsedit[customername]; ?>' />
										 <em id="idcustomer" style="color:red;" class="ms-error"></em>
									</select>  
									<p>Contact no</p>
									<input type="text" class="name" maxlength="10" name="contactno" value='<?php echo $rsedit[contactno]; ?>' />
									  <em id="idcontactno" style="color:red;" class="ms-error"></em>
									<p>Email ID</p>
									<input type="text" class="name" name="emailid" value='<?php echo $rsedit[emailid]; ?>' />
									<em id="idemailidid" style="color:red;" class="ms-error"></em>
								   
									<input type="submit" name="submit" value="Update Profile">
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
	spans.text(''); // clear the text
	var expemail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var phone = /^[789]\d{9}$/;
	var alpha = /^[a-zA-Z\s]+$/;
	var num = /^[0-9]*$/;
	var i =0;
	if(document.signupcust.customername.value == "" )
	{
		document.getElementById("idcustomer").innerHTML="Kindly enter name..";		
		i=1;
	}
	if(document.signupcust.customername.value != "" && !document.signupcust.customername.value.match(alpha))
	{
		document.getElementById("idcustomer").innerHTML="name should   contain only alphabets.";		
		i=1;
	}
	if(document.signupcust.contactno.value == "" )
	{
		document.getElementById("idcontactno").innerHTML="contact number should not be blank..";		
		i=1;
	}
	if(document.signupcust.contactno.value != "" && !document.signupcust.contactno.value.match(phone))
	{
		document.getElementById("idcontactno").innerHTML="contact number is not valid.";		
		i=1;
	}
	
     if(!document.signupcust.emailid.value.match(expemail))
	{
		document.getElementById("idemailidid").innerHTML="Email ID is not valid..";		
		i=1;		
	}
	if(document.signupcust.emailid.value == "" )
	{
		document.getElementById("idemailidid").innerHTML="Email ID should not be empty..";
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
