<?php
include("header.php");
error_reporting(0);
if(isset($_POST[submit]))
{
	$pwd = md5($_POST[password]);
	if(isset($_GET[editid])) //if block to update the record
	{
		//Update statement starts here
		$sql ="UPDATE admin SET admintype='$_POST[admintype]',adminname='$_POST[adminname]',loginid='$_POST[loginid]',password='$pwd',status='$_POST[status]' WHERE adminid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert('admin record updated successfully...');</SCRIPT>";
		}
		//Update statement ends here
	}//if block to update the record ends here
else //else block to insert the record
	{
		//Insert statement starts here
	$sql = "INSERT INTO admin (admintype,adminname,loginid,password,status) VALUES ('$_POST[admintype]','$_POST[adminname]','$_POST[loginid]','$pwd','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<SCRIPT>alert('Admin record inserted successfully...');</SCRIPT>";
	}
   }
}
//This code is to select data while updating
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM admin WHERE adminid='$_GET[editid]'";
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
							<h5>Admin Form</h5> 
							<div class="login-agileits-top"> 	
<form  action="" method="post" name="frmadmin" onsubmit="return validateform()"> 
	<p>Admin Type </p>
	<select name="admintype" class="form-control" value='<?php echo $rsedit[admintype]; ?>' >
		<option value=''>Select</option>
		<option value='Admin'>Admin</option>
		<option value='Employee'>Employee</option>
	</select>
	<em id="idadmintype" style="color:red;" class="ms-error"></em>
	<p>Admin Name</p>
	<input type="text" class="name" name="adminname" value='<?php echo $rsedit[adminname]; ?>' />
	<em id="idadminname" style="color:red;" class="ms-error"></em>
	
	<p>Login ID</p>
	<input type="text" class="name" name="loginid" value='<?php echo $rsedit[loginid]; ?>' />
	<em id="idloginid" style="color:red;" class="ms-error"></em>
	
	<p>Password</p>
	<input type="password" class="password" name="password" value='<?php echo $rsedit[password]; ?>'  />
	<em id="idpasswords" style="color:red;" class="ms-error"></em>
	
	<p>Status </p>
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
	spans.text(''); // clear the text
	 var expemail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var alpha = /^[a-zA-Z\s]+$/;
	var i =0;
	if(document.frmadmin.admintype.value == "" )
	{
		document.getElementById("idadmintype").innerHTML="Kindly select the type of admin..";		
		i=1;
	}
	if(document.frmadmin.adminname.value == "" )
	{
		document.getElementById("idadminname").innerHTML="Kindly enter your name..";		
		i=1;
	}
	if(document.frmadmin.adminname.value != "" && !document.frmadmin.adminname.value.match(alpha))
	{
		document.getElementById("idadminname").innerHTML="name should contain only alphabets..!";		
		i=1;
	}
	if(!document.frmadmin.loginid.value.match(expemail))
	{
		document.getElementById("idloginid").innerHTML="please enter the valid emailid.";		
		i=1;
	}	
	if(document.frmadmin.loginid.value=="")
	{
		document.getElementById("idloginid").innerHTML="email id should not be empty..";
		i=1;
	}
	if(document.frmadmin.password.value < 6 )
	{
		document.getElementById("idpassword").innerHTML="Password should contain more than 6 characters....";		
		i=1;
	}
	if(document.frmadmin.password.value=="")
	{
		document.getElementById("idpasswords").innerHTML="Please enter your password...";
		i=1;
	}
    if(document.frmadmin.status.value == "" )
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