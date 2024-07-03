<?php
include("header.php");
error_reporting(0);
if(isset($_POST[submit]))
{
	$imgbanner = rand(). $_FILES["bannerimg"]["name"];
	move_uploaded_file($_FILES["bannerimg"]["tmp_name"],"imagebanner/".$imgbanner);
	
	$trailer = rand(). $_FILES["movietrailer"]["name"];
	move_uploaded_file($_FILES["movietrailer"]["tmp_name"],"trailermovie/".$trailer);
	$moviewname = mysqli_real_escape_string($con,$_POST[moviename]);
	if(isset($_GET[editid])) //if block to update the record
	{
		//Update statement starts here
		$sql ="UPDATE movie SET bannerimg='$imgbanner',moviename='$moviewname',language='$_POST[language]',movietype='$_POST[movietype]',movietrailer='$trailer',moviesummary='$_POST[moviesummary]',status='$_POST[status]' WHERE movieid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert('movie record updated successfully...');</SCRIPT>";
		}
		//Update statement ends here
	}//if block
	else
	{
	$sql = "INSERT INTO movie (bannerimg,moviename,language,movietype,movietrailer,moviesummary,status) VALUES ('$imgbanner','$moviewname','$_POST[language]','$_POST[movietype]','$trailer','$_POST[moviesummary]','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	  {
		echo "<SCRIPT>alert('Movie record inserted successfully...');</SCRIPT>";
	 }
	
	}
  
 }
if(isset($_GET[editid]))
{
	$sqledit="SELECT * FROM movie where movieid='$_GET[editid]'";
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
							<h5>Movie Form</h5> 
							<div class="login-agileits-top"> 	
								<form  action="" method="post"  enctype="multipart/form-data" name="frmmovie" onsubmit="return validateform()"> 
									
									<p>Banner</p>
									<input type="file" class="name" name="bannerimg" value='<?php echo $rsedit[bannerimg];?>' />
									<em id="idbannerimg" style="color:red;" class="ms-error"></em>
									<p>Movie Name </p>
									<input type="text" class="name" name="moviename" value='<?php echo $rsedit[moviename];?>' />
									<em id="idmoviename" style="color:red;" class="ms-error"></em>
									<p>Language</p>
									<input type="text" class="name" name="language" value='<?php echo $rsedit[language];?>' />
									<em id="idlanguage" style="color:red;" class="ms-error"></em>
									<p>Movie type</p>
									<input type="text" class="name" name="movietype" value='<?php echo $rsedit[movietype];?>' />
									<em id="idmovietype" style="color:red;" class="ms-error"></em>
									<p>Movie Trailer</p>
									<input type="file" class="name" name="movietrailer" value='<?php echo $rsedit[movietrailer];?>' /> 
									
									<p>Movie Summary</p>
									<input type="text" class="name" name="moviesummary" value='<?php echo $rsedit[moviesummary];?>' /> 
									
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
	 var alpha = /^[a-zA-Z\s]+$/;
	i =0;
	if(document.frmmovie.bannerimg.value == "" )
	{
		document.getElementById("idbannerimg").innerHTML="Kindly upload the banner..";		
		i=1;
	}
	if(document.frmmovie.moviename.value == "" )
	{
		document.getElementById("idmoviename").innerHTML="Kindly enter the movie name..";		
		i=1;
	}
	if(document.frmmovie.language.value == "" )
	{
		document.getElementById("idlanguage").innerHTML="Kindly enter language..";		
		i=1;
	}
	if(document.frmmovie.language.value != ""  && !document.frmmovie.language.value.match(alpha))
	{
		document.getElementById("idlanguage").innerHTML="language should contain only alphabets..";		
		i=1;
	}
	if(document.frmmovie.movietype.value == "" )
	{
		document.getElementById("idmovietype").innerHTML="Kindly enter movietype..";		
		i=1;
	}
	if(document.frmmovie.movietype.value != ""  && document.frmmovie.movietype.value.match(num))
	{
		document.getElementById("idmovietype").innerHTML="movietype should not contain numbers..";		
		i=1;
	}
	if(document.frmmovie.status.value == "" )
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