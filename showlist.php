<?php
include("header.php");
error_reporting(0);
if(isset($_POST[submit]))
{
	if(isset($_GET[editid])) //if block to update the record
	{
		//Update statement starts here
		$sql ="UPDATE showlist SET movieid='$_POST[movieid]',theatreid='$_POST[theatreid]',screenid='$_POST[screenid]',startdate='$_POST[startdate]',enddate='$_POST[enddate]',status='$_POST[status]' WHERE showlistid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert('showlist record updated successfully...');</SCRIPT>";
		}
		//Update statement ends here
	}//if block to update the record ends here
	else //else block to insert the record
	{
		//Insert statement starts here
	$sql = "INSERT INTO  showlist (movieid,theatreid,screenid,startdate,enddate,status) VALUES('$_POST[movieid]','$_POST[theatreid]','$_POST[screenid]','$_POST[startdate]','$_POST[enddate]','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	  {
		echo "<SCRIPT>alert('Show list record inserted successfully...');</SCRIPT>";
	  }
	}
}
//This code is to select data while updating
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM showlist WHERE showlistid='$_GET[editid]'";
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
							<h5>showlist form</h5> 
							<div class="login-agileits-top"> 	
								<form  action="" method="post" name="frmshowlist" onsubmit="return validateform()"> 
<p>Movie name </p>
<select name="movieid" class="form-control"  value='<?php echo $rsedit[movieid]; ?> ' >
<option value=''>Select</option>
<?php
$sqlmovie="SELECT * FROM movie where status='active'";
$qsqlmovie=mysqli_query($con,$sqlmovie);
echo mysqli_error($con);
while($rsmovie=mysqli_fetch_array($qsqlmovie))
{
	if($rsmovie[movieid] == $rsedit[movieid])
	{
	echo "<option value='$rsmovie[movieid]' selected>$rsmovie[moviename] ($rsmovie[language])</option>";
	}
	else
	{
	echo "<option value='$rsmovie[movieid]'>$rsmovie[moviename] ($rsmovie[language])</option>";
	}	
}
?>
</select>
<em id="idmovieid" style="color:red;" class="ms-error"></em>
<?php
if(isset($_SESSION["theatreid"]))
{
?>
<input type='hidden' name='theatreid' value="<?php echo $_SESSION["theatreid"]; ?>">
<em id="idtheatreid" style="color:red;" class="ms-error"></em>
<?php
}
else
{
?>
<p>Theatre name <p>
<select name="theatreid" class="form-control" >
<option value=''>Select</option>
<?php
$sqltheatre="SELECT * FROM theatre where status='active'";
$qsqltheatre=mysqli_query($con,$sqltheatre);
echo mysqli_error($con);
while($rstheatre=mysqli_fetch_array($qsqltheatre))
{
	if($rstheatre[theatreid] = $rsedit[theatreid])
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
								
<p>Screen No</p>
<select name="screenid" class="form-control" >
<option value=''>Select</option>
<?php
$sqltheatre="SELECT * FROM seattype where status='active' AND theatreid='$_SESSION[theatreid]' GROUP BY screenno";
$qsqltheatre=mysqli_query($con,$sqltheatre);
echo mysqli_error($con);
while($rstheatre=mysqli_fetch_array($qsqltheatre))
{
	if($rstheatre[screenno] == $rsedit[screenid])
	{
	echo "<option value='$rstheatre[screenno]' selected>$rstheatre[screenno]</option>";
	}
	else
	{
	echo "<option value='$rstheatre[screenno]'>$rstheatre[screenno]</option>";
	}
}
?>
</select>
<em id="idscreenid" style="color:red;" class="ms-error"></em>	
									
<p>Start date</p>
<input type="date" class="form-control" name="startdate"  min="2022-05-01" max="2022-12-31" value='<?php echo $rsedit[startdate]; ?>'/> 
<em id="idstartdate" style="color:red;" class="ms-error"></em>	
									
<p>End date</p>
<input type="date" class="form-control" name="enddate"  min="2022-05-01" max="2022-12-31" value='<?php echo $rsedit[enddate]; ?>'/> 
<em id="idenddate" style="color:red;" class="ms-error"></em>	
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
	i =0;
	if(document.frmshowlist.movieid.value == "" )
	{
		document.getElementById("idmovieid").innerHTML="Kindly select the movie name..";		
		i=1;
	}
	if(document.frmshowlist.theatreid.value == "" )
	{
		document.getElementById("idtheatreid").innerHTML="Kindly select theatre name..";		
		i=1;
	}
	if(document.frmshowlist.screenid.value == "" )
	{
		document.getElementById("idscreenid").innerHTML="Kindly enter the screen number..";		
		i=1;
	}
	if(document.frmshowlist.startdate.value == "" )
	{
		document.getElementById("idstartdate").innerHTML="Kindly enter the starting date..";		
		i=1;
	}
	if(document.frmshowlist.enddate.value == "" )
	{
		document.getElementById("idenddate").innerHTML="Kindly enter the end date..";		
		i=1;
	}
	if(document.frmshowlist.status.value == "" )
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