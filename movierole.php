<?php
include("header.php");
error_reporting(0);
if(isset($_POST[submit]))
{

   if(isset($_GET[editid])) //if block to update the record
	{
		//Update statement starts here
		$sql ="UPDATE movierole SET castid='$_POST[castid]',movieid='$_POST[movieid]',status='$_POST[status]' WHERE movieroleid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert('movie role record updated successfully...');</SCRIPT>";
		}
		//Update statement ends here
	}//if block
	else
	{
	$sql = "INSERT INTO movierole (castid,movieid,role,status) VALUES ('$_POST[castid]','$_POST[movieid]','$_POST[role]','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	  {
		echo "<SCRIPT>alert('Movie role record inserted successfully...');</SCRIPT>";
	 }
	
	}
  
 }
if(isset($_GET[editid]))
{
	$sqledit="SELECT * FROM movierole where movieroleid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}

?>
	<!-- features -->
	<div id="features" class="features">
		<div class="container"> 
			<div class="w3layouts_skills_grids w3layouts-features-agileinfo">

				<div class="col-md-9 w3features-left">				

					<div id="register" class="login-form "> 
						<div class="agile-row">
							<h5>Movie Role Form</h5> 
							<div class="login-agileits-top"> 	
								<form  action="" method="post"  enctype="multipart/form-data" name="frmmovierole" onsubmit="return validateform()"> 

<p>Movie Name</p>
<select name="movieid" class="form-control"  value='<?php echo $rsedit[movieid]; ?> ' >
<option value=''>Select</option>
<?php
$sqlmovie="SELECT * FROM movie where status='active'";
$qsqlmovie=mysqli_query($con,$sqlmovie);
echo mysqli_error($con);
while($rsmovie=mysqli_fetch_array($qsqlmovie))
{
	echo "<option value='$rsmovie[movieid]'>$rsmovie[moviename]</option>";
}
?>
</select>
<em id="idmovieid" style="color:red;" class="ms-error"></em>

<p>Cast</p>
<select name="castid" class="form-control"  value='<?php echo $rsedit[castid]; ?> ' >
<option value=''>Select</option>
<?php
$sqlcast="SELECT * FROM cast where status='active'";
$qsqlcast=mysqli_query($con,$sqlcast);
echo mysqli_error($con);
while($rscast=mysqli_fetch_array($qsqlcast))
{
	echo "<option value='$rscast[castid]'>$rscast[name]</option>";
}
?>
</select>
<em id="idcastid" style="color:red;" class="ms-error"></em>
									
<p>Role</p>
<select name="role" class="form-control">
	<option value=''>Select</option>
	<?php
	$arr = array("Actor","Actress","Support role","Others");
	foreach($arr as $val)
	{
		echo "<OPTION value='$val'>$val</option>";
	}
	?>
</select>
<em id="idrole" style="color:red;" class="ms-error"></em>

<p>Status</p>
<select name="status" class="form-control">
	<option value=''>Select</option>
	<option value='Active'>Active</option>
	<option value='Inactive'>Inactive</option>
</select>  
  <em id="idstatus" style="color:red;" class="ms-error"></em>
<input type="submit" name="submit" value="submit">
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
	if(document.frmmovierole.movieid.value == "" )
	{
		document.getElementById("idmovieid").innerHTML="Kindly enter movie  name..";		
		i=1;
	}
	if(document.frmmovierole.castid.value == "" )
	{
		document.getElementById("idcastid").innerHTML="Kindly enter cast..";		
		i=1;
	}
		if(document.frmmovierole.role.value == "" )
	{
		document.getElementById("idrole").innerHTML="Kindly enter role..";		
		i=1;
	}
	
	if(document.frmmovierole.status.value == "" )
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