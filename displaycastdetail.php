<?php
include("header.php");
$sqlcast="SELECT * from cast WHERE castid='$_GET[castid]'";
$qsqlcast=mysqli_query($con,$sqlcast);
echo mysqli_error($con);
$rscast=mysqli_fetch_array($qsqlcast);
											
   if(file_exists("castimg/$rscast[image]"))
	{
		$logoimg = "castimg/$rscast[image]";
	}
	else
	{
		$logoimg = "images/No_Image_Available.jpg";
	}
	 
?>
<script defer src="js/fontawesomenew.js"></script>


	<div class="w3ls_about_bottom" >
		<div class="container"> 
			<div class="w3_about_bottom_grid">
				<img src="<?php echo $logoimg; ?>" style="width:200px;height:250px;" align="left" ><br/><br/><br/><br/><br/><br/>
				<h4> &nbsp; &nbsp;<?php echo $rscast[name]; ?></h4>
				<p>
				 
				 <a href='<?php echo $rscast[facebookURL]; ?>' target='_blank' style="color:white;"><div class="wthree-btn btn-6"  data-toggle="modal" style="background-color:green;cursor:pointer;"><i class="fab fa-facebook"></i> Facebook</div></a>
				
				
				<a href='<?php echo $rscast[twitterURL]; ?>' target='_blank' style="color:white;"><div class="wthree-btn btn-6"  data-toggle="modal" style="background-color:green;cursor:pointer;"><i class="fab fa-twitter"></i>Twitter</div></a>
				
				</p>
			</div>
        </div>			
			 
	</div> 	
	
	
	<!-- about -->
	<div id="about" class="about">
		<div class="container">
		
			<div class="col-md-12 agileits_about_grid_left">
				<h2 class="agileits-title">About <?php echo $rscast[name]; ?> <span class="w3lshr-line"> </span></h2>
				<p> <?php echo $rscast[about]; ?></p>
			</div> 
			<div class="clearfix"> </div>
		</div> 
	</div>
	<!-- //about --> 

	<!-- services -->
	<div class="services jarallax">
		<div class="container"> 
			<div class="w3ls_banner_bottom_grids">
				<ul class="cbp-ig-grid">
<?php
$sql = "SELECT * FROM movierole ORDER BY RAND() LIMIT 4";
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
	$sqlcast = "SELECT * FROM  movierole LEFT JOIN movie on movierole.movieid=movie.movieid LEFT JOIN cast on movierole.castid=cast.castid  WHERE movierole.movieroleid='$rs[0]'";
	$qsqlcast = mysqli_query($con,$sqlcast);
	$rscast = mysqli_fetch_array($qsqlcast);
	?>	
	<a href='displaycastdetail.php?castid=<?php echo $rscast[castid]; ?>'>			
		<li>
			<div class="w3_grid_effect" >
				<img src='castimg/<?php echo $rscast[image]; ?>' style="width:100%;height:200px;">
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

<?php
include("footer.php");
?>