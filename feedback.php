<?php
include("header.php");
error_reporting(0);
if($_SESSION[randomid]==$_POST[randomid])
{
  if(isset($_POST[submit]))
   {
	if(isset($_GET[editid])) //if block to update the record
	{
		//Update statement starts here
		$sql ="UPDATE feedback SET customerid='$_POST[customerid]',movieid='$_POST[movieid]',theatreid='$_POST[theatreid]',ratings='$_POST[ratings]',feedback='$_POST[feedback]',feedbackdate='$_POST[feedbackdate]',status='$_POST[status]' WHERE feedbackid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert('feedback record updated successfully...');</SCRIPT>";
		}
		//Update statement ends here
	}//if block to update the record ends here
	else //else block to insert the record
	{
	//Insert statement starts here
	$sql = "INSERT INTO feedback(customerid,movieid,theatreid,ratings,feedback,feedbackdate,status) VALUES ('$_POST[customerid]','$_POST[movieid]','$_POST[theatreid]','$_POST[ratings]','$_POST[feedback]','$_POST[f]','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	  {
		echo "<SCRIPT>alert('feedback record inserted successfully...');</SCRIPT>";
	  }
	}
  }
}
//This code is to select data while updating
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM feedback WHERE feedbackid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
$_SESSION[randomid]=rand();
?>

	<!-- features -->
<section id="contact-page">
<div class="container">
<div class="center">        
<center><h2>Feedback</h2></center>
<center><p class="lead">Please give us Your Feedback...</p></center>
</div> 
<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post"  action="">
<div align="center">
<table  border="1"  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>"  />
            
<tr><td><strong>customer name:</strong>
<select name="customerid" class="form-control" value='<?php echo $rsedit[customerid]; ?>' >
<option value=''>select</option>
<?php
$sqlcustomer="SELECT * FROM customer where status='active'";
$qsqlcustomer=mysqli_query($con,$sqlcustomer);
echo mysqli_error($con);
while($rscustomer = mysqli_fetch_array($qsqlcustomer))
{
	echo "<option value='$rscustomer[customerid]'>$rscustomer[customername]</option>";
}
?>
</select></td><div class="cleaner_h10"></div></tr>


<tr><td><strong>movie name:</strong>
<select name="movieid" class="form-control" value='<?php echo $rsedit[movieid]; ?>' >
<option value=''>select</option>
<?php
$sqlmovie="SELECT * FROM movie where status='Active'";
$qsqlmovie=mysqli_query($con,$sqlmovie);
echo mysqli_error($con);
while($rsmovie=mysqli_fetch_array($qsqlmovie))
{
	echo "<option value='$rsmovie[movieid]'>$rsmovie[moviename]</option>";
}
?> </select></td><div class="cleaner_h10"></div></tr>

<tr><td><strong>theatre name:</strong>
<select name="theatreid" class="form-control" value='<?php echo $rsedit[theatreid]; ?>' >
<option value=''>select</option>
<?php
$sqltheatre="SELECT * FROM theatre where status='active'";
$qsqltheatre=mysqli_query($con,$sqltheatre);
echo mysqli_error($con);
while($rstheatre= mysqli_fetch_array($qsqltheatre))
{
	echo "<option value='$rstheatre[theatreid]'>$rstheatre[theatrename]</option>";
}
?>
</select></td><div class="cleaner_h10"></div></tr>

<tr><td><strong>ratings:</strong><input type="text" class="name" name="ratings" value='<?php echo $rsedit[ratings]; ?>'/></td><div class="cleaner_h10"></div></tr>

<tr><td> <strong>feedback:</strong>
<script src="richtexteditor/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<textarea name="feedback" id="descriptions" class="form-control"  rows="6" placeholder=" Description *"></textarea>
</td></tr>

<tr><td><strong>feedback date:</strong><input type="date"  class="form-control"  name="feedbackdate"value='<?php echo $rsedit[feedbackdate]; ?>' /> </td><div class="cleaner_h10"></div></tr>

<tr><td colspan="2"><div align="center"><button type="submit" name="submit" class="btn btn-primary btn-lg"  >Post Feedback</button></div></td></tr>				

</table>
</div>		
</form>
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#contact-page-->
	<!-- //features --> 
	<?php
include("footer.php");
?>