<?php
include("header.php");
if(isset($_POST[submit]))
{
	$npassword = md5($_POST[password]);
	$sql = "UPDATE admin SET password='$npassword' WHERE adminid='$_GET[id]'";
	$qsql  = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Password updated successfully');</script>";
		echo "<script>window.location='index.php';</script>";
	}
	else
	{
		echo "<script>alert('Failed to update password..');</script>";
	}
}
?>
<section id="contact-page">
<div class="container">
<div class="center">        
<h2></h2>
<p class="lead">Kindly enter the credentials</p>
</div> 

<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post" name="contact" action="">
<div align="center">
<table border="2">
                    
<tr><th><label for="Password">New Password:</label> </th><td><input type="password" class="form-control" required name="password" /></td>
<div class="cleaner_h10"></div></tr>

<tr><th><label for="Password">Confirm Password:</label> </th><td><input type="password" class="form-control" required name="npassword" /></td>
<div class="cleaner_h10"></div></tr>

<tr><td colspan="2"><div align="center"><input type="submit" value="Change password.." id="submit" name="submit" class="btn btn-primary btn-lg" /></div></td></tr>

</table>
</div>
</form>
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php");
?>