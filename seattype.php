<?php
include("header.php");
error_reporting(0);
if(isset($_POST[submit]))
{
	if(isset($_GET[editid])) //if block to update the record
	{
		//Update statement starts here
		$sql ="UPDATE seattype SET theatreid='$_POST[theatreid]',screenno='$_POST[screenno]',seattype='$_POST[seattype]',cost='$_POST[cost]',status='$_POST[status]' WHERE seattypeid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert('seattype record updated successfully...');</SCRIPT>";
		}
		//Update statement ends here
	}//if block to update the record ends here
	else //else block to insert the record
	{
		//Insert statement starts here
	$sql = "INSERT INTO seattype (theatreid,screenno,seattype,cost,status) VALUES ('$_POST[theatreid]','$_POST[screenno]','$_POST[seattype]','$_POST[cost]','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	  {
		 echo "<SCRIPT>alert('Seat type record inserted successfully...');</SCRIPT>";
	  }
	}
}
//This code is to select data while updating
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM seattype WHERE seattypeid='$_GET[editid]'";
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
							<h5>Seat type</h5> 
							<div class="login-agileits-top"> 	
								<form  action="" method="post" name="frmseattype" onsubmit="return validateform()"> 

<?php
if(isset($_SESSION[theatreid]))								
{
?>
<input type="hidden" name="theatreid" id="theatreid" value="<?php echo $_SESSION[theatreid]; ?>" />
<?php
}
else
{
?>
<p>Theatre name </p>
<select name="theatreid" class="form-control"  >
<option value=''>select</option>
<?php
$sqltheatre="SELECT * FROM theatre where status='active'";
$qsqltheatre=mysqli_query($con,$sqltheatre);
echo mysqli_error($con);
while($rstheatre=mysqli_fetch_array($qsqltheatre))
{
	if($rstheatre[theatreid] == $rsedit[theatreid])
	{
	echo "<option value='$rstheatre[theatreid]' selected>$rstheatre[theatrename]</option>";
	}
	else
	{
	echo "<option value='$rstheatre[theatreid]'>$rstheatre[theatrename]</option>";
	}
}
?>
</select>
<em id="idtheatreid" style="color:red;" class="ms-error"></em>
<?php
}
?>

									<p>Screen number</p>
									<input type="text" class="name" name="screenno" value='<?php echo $rsedit[screenno]; ?>' /> 
									<em id="idscreenno" style="color:red;" class="ms-error"></em>
									<p>Seat type</p>
									<input type="text" class="name" name="seattype" value='<?php echo $rsedit[seattype]; ?>' /> 
									<em id="idseattype" style="color:red;" class="ms-error"></em>
									<p>Cost</p>
									<input type="text" class="name" name="cost" value='<?php echo $rsedit[cost]; ?>' /> 
									<em id="idcost" style="color:red;" class="ms-error"></em>
									<p>Status </p>
<select name="status" class="form-control">
	<option value=''>Select</option>
	<?php
		$arr  = array("Active","Inactive");
		foreach($arr as $val)
		{
			if($val == $rsedit[status])
			{
			echo "<option value='$val' selected>$val</option>";
			}
			else
			{
			echo "<option value='$val'>$val</option>";
			}
		}
	?>
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
	 var alpha = /^[a-zA-Z\s]+$/;
	 var num = /^[0-9]*$/;
	 var regexdecimal = /^[0-9]+(\.[0-9]{1,2})?/;
	i =0;
	
	if(document.frmseattype.screenno.value == "" )
	{
		document.getElementById("idscreenno").innerHTML="Kindly enter the screen number..";		
		i=1;
	}
	if(document.frmseattype.seattype.value == "" )
	{
		document.getElementById("idseattype").innerHTML="Kindly enter the type of seat..";		
		i=1;
	}
	if(!document.frmseattype.seattype.value.match(alpha))
	{
		document.getElementById("idseattype").innerHTML="seat type should contain alphabets..";		
		i=1;
	}
	
	if(document.frmseattype.cost.value == "" )
	{
		document.getElementById("idcost").innerHTML="Kindly enter the cost..";		
		i=1;
	}
	if(!document.frmseattype.cost.value.match(regexdecimal))
	{
		document.getElementById("idcost").innerHTML="cost  should  contain numbers..";		
		i=1;
	}
	if(document.frmseattype.status.value == "" )
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