<?php
include("header.php");
?>
	<div class="w3ls_about_bottom">
		<div class="container"> 
			<div class="w3_about_bottom_grid"> 
				<h4>Cast</h4>
				<?php
				/*
				<a href="#myModal" class="wthree-btn btn-6"  data-toggle="modal">Read More<span></span></a> 
				*/
				?>
			</div>
		</div>
	</div>
	<!-- //about --> 
	<!-- gallery -->
	<div id="gallery" class="gallery">
		<div class="container">
			<div class="main">
			
			<?php
			$sql = "SELECT * FROM cast";
			$qsql = mysqli_query($con,$sql);
			while($rs = mysqli_fetch_array($qsql))
			{
		if(file_exists("castimg/$rs[image]"))
	{
		$logoimg = "castimg/$rs[image]";
	}
	else
	{
		$logoimg = "images/No_Image_Available.jpg";
	}
	 
			?>
	<div class="col-sm-4 col-xs-6 gallry-agile-grids">
		<div class="view view-seventh">
			<a href="" class="b-link-stripe b-animate-go thickbox" title="Movie">
				<img src="<?php echo $logoimg; ?>" alt="" width="150px;" height="250px;" />
				<div class="mask">
					<h4><?php echo $rs[name]; ?></h4>
					
				</div>
			</a>
		</div>
	</div>
			<?php
			}
			?>				
				<div class="clearfix"> </div>
            </div>
		</div>
	</div>
	<!-- //gallery -->
	<!-- Stats -->
	<div id="stats" class="stats services news-w3layouts jarallax"> 
		<div class="container">    
			<div class="stats-agileinfo agileits-w3layouts">
				<div class="col-sm-3 col-xs-6 stats-grid">
					<div class="stats-img">
						<i class="fa fa-users" aria-hidden="true"></i>
					</div>
					<h6>Happy Clients</h6>
					<div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='157000' data-delay='.5' data-increment="100">157000</div>
				</div>
				<div class="col-sm-3 col-xs-6 stats-grid">
					<div class="stats-img w3-agileits">
						<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
					</div>
					<h6>Branches</h6>
					<div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='850' data-delay='8' data-increment="1">850</div>
				</div>
				<div class="col-sm-3 col-xs-6 stats-grid">
					<div class="stats-img w3-agileits">
						<i class="fa fa-briefcase" aria-hidden="true"></i>
					</div>	
					<h6>Our Events </h6> 
					<div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='5000' data-delay='.5' data-increment="10">5000</div>
				</div>
				<div class="col-sm-3 col-xs-6 stats-grid">
					<div class="stats-img w3-agileits">
						<i class="fa fa-trophy" aria-hidden="true"></i>
					</div>
					<h6>Awards</h6>
					<div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='110' data-delay='8' data-increment="1">110</div>
				</div>
				<div class="clearfix"></div>
			</div> 
			<!-- Progressive-Effects-Animation-JavaScript -->  
			<script type="text/javascript" src="js/numscroller-1.0.js"></script>
			<!-- //Progressive-Effects-Animation-JavaScript -->
		</div>
	</div>
	<!-- //Stats -->
<?php
include("footer.php");
?>