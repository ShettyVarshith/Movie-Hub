<?php
include("header.php");
error_reporting(0);
if(isset($_POST[submit]))
{
	$imgcast= rand(). $_FILES["image"]["name"];
	move_uploaded_file($_FILES["image"]["tmp_name"],"castimg/".$imgcast);
	
	
	if(isset($_GET[editid])) //if block to update the record
	{
		//Update statement starts here
		$sql ="UPDATE cast SET image='$imgcast',name='$_POST[name]',about='$_POST[about]',facebookURL='$_POST[facebookURL]',twitterURL='$_POST[twitterURL]',status='$_POST[status]' WHERE castid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert('cast record updated successfully...');</SCRIPT>";
		}
		//Update statement ends here
	}//if block
	else
	{
	$sql = "INSERT INTO cast (image,name,about,facebookURL,twitterURL,status) VALUES('$imgcast','$_POST[name]','$_POST[about]','$_POST[facebookURL]','$_POST[twitterURL]','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	  {
		echo "<SCRIPT>alert('cast record inserted successfully...');</SCRIPT>";
	 }
	
	}
  
 }
if(isset($_GET[editid]))
{
	$sqledit="SELECT * FROM cast where castid='$_GET[editid]'";
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
							<h5>Cast</h5> 
							<div class="login-agileits-top"> 	
<form  action="" method="post"  enctype="multipart/form-data"  name="frmcast" onsubmit="return validateform()"> 
									
	<p>Name</p>
	<input type="text" class="name" name="name" value='<?php echo $rsedit[name];?>' />
	<em id="idname" style="color:red;" class="ms-error"></em>
	<p>Select Image</p>
	<input type="file" class="name" name="image" value='<?php echo $rsedit[image];?>' />
	<em id="idimage" style="color:red;" class="ms-error"></em>
	<p>About</p>
	<textarea class="name form-control" name="about"><?php echo $rsedit[about];?></textarea>
	<em id="idabout" style="color:red;" class="ms-error"></em>
	<p>Facebook URL</p>
	<input type="text" class="name" name="facebookURL" value='<?php echo $rsedit[facebookURL];?>' />
	<em id="idfacebookURL" style="color:red;" class="ms-error"></em>
	<p>Twitter URL</p>
	<input type="text" class="name" name="twitterURL" value='<?php echo $rsedit[movietrailer];?>' /> 
	<em id="idtwitterURL" style="color:red;" class="ms-error"></em>
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
	var num = /^[0-9]*$/;
	var furl=/^(?:https?:\/\/)?(?:www\.)?facebook\.com\/.(?:(?:\w)*#!\/)?(?:pages\/)?(?:[\w\-]*\/)*([\w\-\.]*)/;
	var twurl=/^(?:https?:\/\/)?(?:www\.)?twitter\.com\/.(?:(?:\w)*#!\/)?(?:pages\/)?(?:[\w\-]*\/)*([\w\-\.]*)/;
	i =0;
	if(document.frmcast.name.value == "" )
	{
		document.getElementById("idname").innerHTML="Kindly enter name..";		
		i=1;
	}
	if(document.frmcast.name.value !== "" && document.frmcast.name.value.match(num))
	{
		document.getElementById("idname").innerHTML="name should contain only alphabets ..";		
		i=1;
	}
	if(document.frmcast.image.value == "" )
	{
		document.getElementById("idimage").innerHTML="Kindly upload image..";		
		i=1;
	}
		if(document.frmcast.about.value == "" )
	{
		document.getElementById("idabout").innerHTML="Kindly enter information..";		
		i=1;
	}
		if(document.frmcast.about.value !="" && document.frmcast.about.value.match(num))
	{
		document.getElementById("idabout").innerHTML="information  should contain only alphabets..";		
		i=1;
	}
	if(document.frmcast.facebookURL.value == "" )
	{
		document.getElementById("idfacebookURL").innerHTML="Kindly enter facebookURL..";		
		i=1;
	}
	if(document.frmcast.facebookURL.value !="" && !document.frmcast.facebookURL.value.match(furl))
	{
		document.getElementById("idfacebookURL").innerHTML="invalid facebook url.";		
		i=1;
	}
		if(document.frmcast.twitterURL.value == "" )
	{
		document.getElementById("idtwitterURL").innerHTML="Kindly enter twitterURL..";		
		i=1;
	}
	if(document.frmcast.twitterURL.value !="" && !document.frmcast.twitterURL.value.match(twurl))
	{
		document.getElementById("idtwitterURL").innerHTML="invalid twitter url.";		
		i=1;
	}
	if(document.frmcast.status.value == "" )
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