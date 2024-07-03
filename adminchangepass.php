<?php
include("header.php");
error_reporting(0);
if(isset($_POST[submit]))
{
	$opassword = md5($_POST[opassword]);
	$npassword = md5($_POST[npassword]);
		//Update statement starts here
		$sql ="UPDATE admin SET password='$npassword' WHERE adminid='$_SESSION[adminid]' AND password='$opassword'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert('Admin password updated successfully...');</SCRIPT>";
		}
		else
		{
			echo "<script>alert('Failed to change admin password..');</script>";
		}
		//Update statement ends here
	}
?>

	<!-- features -->
	<div id="features" class="features">
		<div class="container"> 
			<div class="w3layouts_skills_grids w3layouts-features-agileinfo">

				<div class="col-md-9 w3features-left">				

					<div id="register" class="login-form "> 
						<div class="agile-row">
							<h5>Update Password</h5> 
							<div class="login-agileits-top"> 	
								<form  action="" method="post" name="frmchnage" onsubmit="return validateform()"> 
								<p>Enter your old Password</p>
						<input type="password" class="password" name="opassword"/> 
						<em id="idopassword" style="color:red;" class="ms-error"></em>
								<p>Enter your new Password</p>
						<input type="password" class="password" name="npassword"/> 	 
                        <em id="idnpassword" style="color:red;" class="ms-error"></em>						
						        <p>Confirm Password</p>
						<input type="password" class="password" name="cpassword"/> 
						<em id="idcpassword" style="color:red;" class="ms-error"></em>
									<input type="submit" name="submit" value="Update password">
									
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
    var i =0;
	if(document.frmchnage.opassword.value=="")
	{
		document.getElementById("idopassword").innerHTML="please enter your  old password...";
		i=1;
	}
	if(document.frmchnage.npassword.value=="")
	{
		document.getElementById("idnpassword").innerHTML="please enter your  new password...";
		i=1;
	}

	if(document.frmchnage.cpassword.value == "" )
	{
		document.getElementById("idcpassword").innerHTML="Confirm Password should not be empty..";		
		i=1;
	}
	if(document.frmchnage.cpassword.value!=document.frmchnage.npassword.value )
	{
		document.getElementById("idcpassword").innerHTML="password and confirm password must match.";		
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