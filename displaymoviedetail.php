<?php
include("header.php");
if(isset($_POST[submit]))
{ 
	$dt = date("Y-m-d");
	//Insert statement starts here
	$sql = "INSERT INTO feedback(customerid,movieid,ratings,feedback,feedbackdate,status) VALUES ('$_SESSION[customerid]','$_GET[movieid]','$_POST[rating]','$_POST[feedback]','$dt','Active')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	  {
		echo "<SCRIPT>alert('Feedback published successfully...');</SCRIPT>";
	  }
}

$sqlmovie="SELECT * FROM movie where movieid=$_GET[movieid]";
$qsqlmovie=mysqli_query($con,$sqlmovie);
echo mysqli_error($con);
$rsmovie=mysqli_fetch_array($qsqlmovie);

	if(file_exists("imagebanner/$rsmovie[bannerimg]"))
     {
	    $picimage="imagebanner/$rsmovie[bannerimg]";
     }
      else
     {
	    $picimage="images/No_Image_Available.jpg";
     }
?>

	<!-- services -->
    <div class="services jarallax" style="padding:10px;">	
        <div class="container"> 
			<div class="w3ls_banner_bottom_grids">
			<center><h3 style='color:white;'><?php echo $rsmovie[moviename]; ?></h3><br>
			
			<div class="wthree-btn btn-6"  data-toggle="modal" style="background-color:violet;"> <?php echo $rsmovie[language]; ?></div> 
			
				<div class="wthree-btn btn-6"  data-toggle="modal" style="background-color:green;"><?php echo $rsmovie[movietype]; ?></div> 
				&nbsp;&nbsp;&nbsp;
				<a href="#movietrailer" class="wthree-btn btn-6"  data-toggle="modal" style="background-color:blue;"><i class="fa fa-video" aria-hidden="true"></i> View Trailer<span></span></a>
				
			</center>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //services -->
	
   
	<div class="w3ls_about_bottom" style="background-color:white;">
		<div class="container"> 
			<div class="w3_about_bottom_grid"> 
				<h4 style="background-color:yellow;color:red;"></h4>
			       <img src="<?php echo $picimage; ?>" style="width:300px;height:400px;" align="center">
				<p>
				</p>
			</div>
        </div>			
			 
	</div> 	
	
	
	<!-- about -->
	<div id="about" class="about">
		<div class="container">
		
			<div class="col-md-8 agileits_about_grid_left">
				<h2 class="agileits-title"><?php echo $rsmovie[moviename]; ?> <span class="w3lshr-line"> </span></h2>
				<p> <?php echo $rsmovie[moviesummary]; ?></p>
			</div> 
			<div class="col-md-4 agileits_about_grid_right">
				<h4 class="agileits-title" style="color:red;">About<?php echo $rsmovie[moviename]; ?></h4>
				<h4 style="color:grey;"><?php echo $rsmovie[movietype]; ?></h4>
				<h5><span style="color:red;">Language:</span> <?php echo $rsmovie[language]; ?></h5>
				
			</div>
			<div class="clearfix"> </div>
		</div> 
	</div>
	<!-- //about --> 

	<!-- services -->
	<div class="services jarallax">
		<div class="container"> 
			<div class="w3ls_banner_bottom_grids">
			<center><h3 style='color:white;'>Cast</h3><hr></center>
				<ul class="cbp-ig-grid">
<?php
$sqlcast = "SELECT * FROM  movierole LEFT JOIN movie on movierole.movieid=movie.movieid LEFT JOIN cast on movierole.castid=cast.castid WHERE movierole.movieid='$_GET[movieid]'";
$qsqlcast = mysqli_query($con,$sqlcast);
while($rscast = mysqli_fetch_array($qsqlcast))
{
?>	
	<a href='displaycastdetail.php?castid=<?php echo $rscast[castid]; ?>'>			
	<li>
		<div class="w3_grid_effect" >
			<img src='castimg/<?php echo $rscast[image]; ?>' style="width:50%;height:100px;">
			<h4 style="margin: 1px 0 1px 0;padding: 20px 0 0 0;font-size: 1.2em;position: relative; -webkit-transition: -webkit-transform 0.2s;
		-moz-transition: -moz-transform 0.2s;transition: transform 0.2s;
		text-transform: uppercase;letter-spacing: 2px;color: #fff;
		font-family: 'Lato', sans-serif;"><?php echo $rscast[name]; ?></h4>
			<span style="margin: 25px 0 10px 0;padding: 20px 0 0 0;font-size: 1.2em;position: relative; -webkit-transition: -webkit-transform 0.2s;
		-moz-transition: -moz-transform 0.2s;transition: transform 0.2s;
		text-transform: uppercase;letter-spacing: 2px;color: #ffd;
		font-family: 'Lato', sans-serif;"><?php echo $rscast[role]; ?></span>
		</div>
	</li>
</a>
<?php
}
?>
				</ul>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //services -->
	
	<!-- about -->
	<div class="w3ls_about_bottom">
		<div class="container"> 
				<center>
				<a href="bookingpanel.php?movieid=<?php echo $_GET[movieid]; ?>" class="wthree-btn btn-6"  >Click here to book ticket<span></span></a>
				</center>
		</div>
	</div>
	<!-- //about --> 	
	
	
<?php	
/*
	<!-- features -->
	<div id="features" class="features">
		<div class="container"> 
			<div class="w3layouts_skills_grids w3layouts-features-agileinfo">
				<div class="col-md-12 col-sm-9 w3features-right">
					<div id="register" class="login-form agileits-right"> 
						<div class="agile-row">
							<h5>Book tickets</h5>							
<div class="col-md-12">
	Date : <input type="date" name="bookdate" id="bookdate" class="form-control" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" onchange="changebookingdate(this.value,'<?php echo $_GET[movieid]; ?>')" >
</div>
<div class="login-agileits-top" id="divshowtimings">
	<?php include("ajaxshowtimings.php"); ?>
</div>

						</div>  
					</div>  
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //features -->
*/
?>
	

<?php
//Movie Feed back starts here
include("moviefeedback.php");
//Movie Feed back ends here
?>

	</div>
	
	<!-- //blog -->
<?php
include("footer.php");
?>

<!-- Trailer modal starts here -->
<div id="movietrailer" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Movie Trailer of <?php echo $rsmovie[moviename]; ?></h4>
      </div>
      <div class="modal-body">
<video style="width:100%;" controls>
 <source src="trailermovie/<?php echo $rsmovie[movietrailer]; ?>" type="video/mp4">
</video>
      </div>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>
<!-- Login Modal ends here -->
