<?php
include("header.php");
error_reporting(0);
if(isset($_POST[submit]))
{
	if(isset($_GET[editid])) //if block to update the record
	{
		//Update statement starts here
		$sql ="UPDATE  location SET location='$_POST[location]',status='$_POST[status]' WHERE locationid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert('location record updated successfully...');</SCRIPT>";
		}
		//Update statement ends here
	}//if block to update the record ends here
	else //else block to insert the record
	{
	//Insert statement starts here
    $sql = "INSERT INTO location(location,status) VALUES ('$_POST[location]','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	   {
		 echo "<SCRIPT>alert('location record inserted successfully...');</SCRIPT>";
	   }
	}
}
//This code is to select data while updating
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM location WHERE locationid='$_GET[editid]'";
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
							<h5>location form</h5> 
							<div class="login-agileits-top"> 	
								<form  action="" method="post" name="frmlocation" onsubmit="return validateform()"> 
								<p>location</p>
									<input type="text" class="name" name="location" value='<?php echo $rsedit[location]; ?>' /> 
									<em id="idlocation" style="color:red;" class="ms-error"></em>
									<p>Status </p>
									<select name="status" class="form-control">
										<option value=''>Select</option>
										<option value='Active'>Active</option>
										<option value='Inactive'>Inactive</option>
									</select> 
                                  <em id="idstatus" style="color:red;" class="ms-error"></em>
									<input type="submit" name="submit" value="Submit">
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
	 var alpha = /^[a-zA-Z\s]+$/;
	var i =0;
	if(document.frmlocation.location.value == "" )
	{
		document.getElementById("idlocation").innerHTML="Kindly enter the location..";		
		i=1;
	}
	if(document.frmlocation.location.value !="" && !document.frmlocation.location.value.match(alpha))
	{
		document.getElementById("idlocation").innerHTML="location name should contain only  alphabets..";		
		i=1;
	}
   if(document.frmlocation.status.value == "" )
	{
		document.getElementById("idstatus").innerHTML="Kindly select the status..";		
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