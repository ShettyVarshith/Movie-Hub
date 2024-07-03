<?php
include("header.php");
if(isset($_GET[id]))
{
	echo "<script>window.location='adminrecoverpassword.php?id=$_GET[id]';</script>";
}
if(isset($_POST[submit]))
{
	$sql = "SELECT * FROM admin WHERE loginid='$_POST[email]' ";
	$qsql=mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_num_rows($qsql)==1)
	{
		$rs = mysqli_fetch_array($qsql);
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?id=$rs[0]";
	 	$msg = "Kindly recover password by entering clicking following link: " . $actual_link;
		include("sendmail.php");
		sendmail($rs[loginid],"MovieTime - Password Recovery Mail",$msg,$rs[adminname]);
		echo "<script>alert('Password sent on mail');</script>";
	}
	else
	{
		echo "<script>alert('Inavalid login credentials');</script>";	
	}
}
?>

<section id="contact-page">
<div class="container">
<div class="center"><br/><br/>       
<center><h3><i>Recover password</i></h3></center><br/><br/> 
<center><p class="lead">Enter your Email ID to recover password...</p></center>
</div>
 
<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post" name="contact" action="">
<div align="center">
<table   border="1"  id="example" class="table table-striped table-bordered" cellspacing="0" style="width:50%">
<tr><th><label for="author">Email ID:</label></th><td> <input type="text" name="email" class="form-control" required /></td>
<div class="cleaner_h10"></div></tr>
<tr><td colspan="2"><div align="center"><input type="submit" value="Recover password.." id="submit" name="submit" class="btn btn-primary btn-lg" /></div></td></tr>


</table>
</div>
</form>
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php"); include("datatables.php");
?>