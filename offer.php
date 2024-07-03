<?php
include("header.php");
error_reporting(0);
if(isset($_POST[submit]))
{
	if(isset($_GET[editid])) //if block to update the record
	{
		//Update statement starts here
		$sql ="UPDATE offer SET offercode='$_POST[offercode]',startdate='$_POST[startdate]',enddate='$_POST[enddate]',offeramt='$_POST[offeramt]',status='$_POST[status]' WHERE offerid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert('offer record updated successfully...');</SCRIPT>";
		}
		//Update statement ends here
	}//if block to update the record ends here
	else //else block to insert the record
	{
		//Insert statement starts here
	$sql = "INSERT INTO offer (offercode,startdate,enddate,offeramt,status) VALUES ('$_POST[offercode]','$_POST[startdate]','$_POST[enddate]','$_POST[offeramt]','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	   {
	 	 echo "<SCRIPT>alert('offer record inserted successfully...');</SCRIPT>";
	   }
	}
}
//This code is to select data while updating
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM offer WHERE offerid='$_GET[editid]'";
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
							<h5>offer form</h5> 
							<div class="login-agileits-top"> 	
								<form  action="" method="post" name="frmoffer" onsubmit="return validateform()"> 
									<p>offer code</p>
									<input type="text" class="name" name="offercode" value='<?php echo $rsedit[offercode]; ?>' /> 
									<em id="idoffercode" style="color:red;" class="ms-error"></em>
									<p>start date</p>
									<input type="date" class="form-control" min="2022-05-01" max="2022-12-31" name="startdate" value='<?php echo $rsedit[startdate]; ?>' /> 
									<em id="idstartdate" style="color:red;" class="ms-error"></em>
									<p>end date</p>
									<input type="date" class="form-control" min="2022-05-01" max="2022-12-31" name="enddate" value='<?php echo $rsedit[enddate]; ?>' /> 
									<em id="idenddate" style="color:red;" class="ms-error"></em>
									<p>offer amount</p>
									<input type="text" class="name" name="offeramt" value='<?php echo $rsedit[offeramt]; ?>'  /> 
									<em id="idofferamt" style="color:red;" class="ms-error"></em>
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
	spans.text(''); // clear the textvar
	var num = /^[0-9]*$/;
	var price=/^([0-9]{0,2}((.)[0-9]{0,2}))$/;
	i =0;
	if(document.frmoffer.offercode.value == "" )
	{
		document.getElementById("idoffercode").innerHTML="Kindly  enter offercode..";		
		i=1;
	}
     if(document.frmoffer.offercode.value!="" && !document.frmoffer.offercode.value.match(num) )
	{
		document.getElementById("idoffercode").innerHTML="offercode should contain numeric values..";		
		i=1;
	}
	if(document.frmoffer.startdate.value == "" )
	{
		document.getElementById("idstartdate").innerHTML="Kindly enter the starting date..";		
		i=1;
	}
	if(document.frmoffer.enddate.value == "" )
	{
		document.getElementById("idenddate").innerHTML="Kindly enter the end date..";		
		i=1;
	}
	if(document.frmoffer.offeramt.value == "" )
	{
		document.getElementById("idofferamt").innerHTML="Kindly enter the amount..";		
		i=1;
	}
	if(document.frmoffer.offeramt.value != "" && !document.frmoffer.offeramt.value.match(price))
	{
		document.getElementById("idofferamt").innerHTML="amount should contain numeric values..";		
		i=1;
	}
	if(document.frmoffer.status.value == "" )
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