<?php
include("header.php");
$sqlmovie="SELECT * from movie WHERE movieid='$_GET[movieid]'";
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
	
	
	<!-- about -->
	<div id="about" class="about">
		<div class="container">
		
			<div class="col-md-8 agileits_about_grid_left">
				<h2 class="agileits-title"><?php echo $rsmovie[moviename]; ?> <span class="w3lshr-line"> </span></h2>
				<p> <?php echo $rsmovie[moviesummary]; ?></p>
			</div> 
			<div class="col-md-4 agileits_about_grid_right">
				<h4 class="agileits-title" style="color:red;">about <?php echo $rsmovie[moviename]; ?></h4>
				<h4 style="color:grey;"><?php echo $rsmovie[movietype]; ?></h4>
				<h5><span style="color:red;">Language:</span> <?php echo $rsmovie[language]; ?></h5>
				
			</div>
			<div class="clearfix"> </div>
		</div> 
	</div>
	<!-- //about --> 
	<!-- about -->
  <hr>
	<?php
$sqltheatre="SELECT * from theatre WHERE theatreid='$_GET[theatrieid]'";
$qsqltheatre=mysqli_query($con,$sqltheatre);
echo mysqli_error($con);
$rstheatre=mysqli_fetch_array($qsqltheatre);
?> 
	<div id="about" class="about">
		<div class="container">
		
			<div class="col-md-8 agileits_about_grid_left">
				<h2 class="agileits-title"><?php echo $rstheatre[theatrename]; ?> <span class="w3lshr-line"> </span></h2>
				<p> <?php echo $rstheatre[theatredescription]; ?></p>
			</div> 
			<div class="col-md-4 agileits_about_grid_right">
				<p><span style="color:red;">Address:</span><br/> <?php echo $rstheatre[address]; ?><br>Ph. <?php echo $rstheatre[mobileno]; ?></p>		
			</div>
			<div class="clearfix"> </div>
		</div> 
	</div>
    <!-- //about --> 
	<!-- features -->
	<div id="features" class="features">
		<div class="container"> 
			<div class="w3layouts_skills_grids w3layouts-features-agileinfo">
				<div class="col-md-12 col-sm-9 w3features-right">
					<div id="register" class="login-form agileits-right"> 
						<div class="a-gile-row">
							<h5>Book tickets</h5> 
							<div class="login-agileits-top">
Date : <input type="date" name="bookdate" class="form-control" value="<?php echo $_GET[bookingdate]; ?>">
											<?php
			if(isset($_SESSION["customerid"]))
			{
			?>				
 	<div id="gallery" class="gallery">
	<?php
		 if(file_exists("imgtheatrelogo/$rstheatre[theatreimg]"))
		 {
			$picimage="imgtheatrelogo/$rstheatre[theatreimg]";
		 }
		 else
		 {
			$picimage="images/No_Image_Available.jpg";
		 }
	?>
                <div class="col-sm-12 ">
						<a  class="b-link-stripe b-animate-go thickbox" title="<?php echo $rstheatre[theatrename]; ?>">
								
<?php
 $sqlshowtimings="Select * From showtimings LEFT JOIN showlist ON showtimings.showlistid=showlist.showlistid  WHERE showlist.theatreid='$_GET[theatrieid]' AND showlist.movieid='$_GET[movieid]' AND  showtimings.datetime BETWEEN '$_GET[bookingdate] 00:00:01' AND '$_GET[bookingdate] 23:59:59'";
$qsqlshowtimings=mysqli_query($con,$sqlshowtimings);
echo mysqli_error($con);
	while($rsshowtimings = mysqli_fetch_array($qsqlshowtimings))
	{
		
$showtime =date("H:i:s",strtotime($rsshowtimings[datetime]));
echo "<input type='radio' name='bookingtime' value='$rsshowtimings[showtimingid]' onclick='window.location=`bookingpanel.php?theatrieid=$_GET[theatrieid]&movieid=$_GET[movieid]&bookingdate=$_GET[bookingdate]&bookingtime=$showtime#idfeatures`'  ";
if($_GET[bookingtime] == $showtime)
{
	echo " checked ";
}
echo "> &nbsp; <span style='background-color:red;color:white;padding:1px;' onclick=window.location=`bookingpanel.php?theatrieid=$_GET[theatrieid]&movieid=$_GET[movieid]&bookingdate=$_GET[bookingdate]&bookingtime=$showtime#idfeatures'> &nbsp;". date("h:i A",strtotime($rsshowtimings[datetime])) ." </span><br>";
	}
?>
						</a>
                </div> 
				
				<div class="clearfix"> </div>
	</div> 	
			<?php
			}
			else
			{
			?>
				<centeR><a href="#" class="wthree-btn btn-6 scroll" data-toggle="modal" data-target="#myModal" style="background-color:red;">Login <span></span></a>	
				<a href="#" class="wthree-btn btn-6 scroll" data-toggle="modal" data-target="#myModal2" style="background-color:red;">Register Now <span></span></a></center>
			<?php
			}
			?>
							</div>  
						</div>  
					</div>  
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //features -->
	<hr>
		<!-- features -->
	<div id="idfeatures" class="features" >
		<div class="container" > 
			<div class="w3layouts_skills_grids w3layouts-features-agileinfo">
				<div class="col-md-12 col-sm-12 w3features-right">
					<div id="idseatselection" class="login-form agileits-right"> 
						<div class="agile-row">
							<h5>Seat selection</h5> 	
					
                            <div class="login-agileits-top">
<?php
include("seat.php");
/*
$sqlseat="SELECT * FROM seat_setting ";
$qsqlseat=mysqli_query($con,$sqlseat);
echo mysqli_error($con);
while($rsseat=mysqli_fetch_array($qsqlseat))
{
	echo "<input type='radio' name='text' value='$rsseat[seatno]'";
	echo ">";

}
*/	
?>
							</div>  
						</div>  
					</div>  
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //features -->
	
<!-- features -->
	<div id="features" class="features">
		<div class="container"> 
			<div class="w3layouts_skills_grids w3layouts-features-agileinfo">
                <div class="col-md-12 col-sm-12 w3features-right">			

					<div class="login-form agileits-right idregister"> 
						<div class="agile-row">
							<h5>Billing Form</h5> 
							<div class="login-agileits-top"> 	
								<form  action="" method="post"> 
								    <p>Payment Type</p>
									<input type="text" class="name" name="paymenttype" value='<?php echo $rsedit[paymenttype];?>' /> 
									<p>Card No</p>
									<input type="text" class="name" name="cardno" value='<?php echo $rsedit[cardno];?>'/> 
									<p>Cvv No</p>
									<input type="text" class="name" name="cvvno" value='<?php echo $rsedit[cvvno]; ?>'/> 
									<p>Expire Date</p>
									<input type="date" class="form-control" name="expdate" value='<?php echo $rsedit[expdate];?>' /> 
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