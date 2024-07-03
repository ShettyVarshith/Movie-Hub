<?php
include("header.php");
include("tabs.php");
?>
<!-- features -->
	<div id="features" class="features">
		<div class="container"> 
			<div class="w3layouts_skills_grids w3layouts-features-agileinfo">
				<div class="col-md-6 col-sm-9 w3features-right">
					<div id="register" class="login-form agileits-right"> 
						<div class="agile-row">
							<h5>Register Form</h5> 
							<div class="login-agileits-top"> 	
								<form action="#" method="post"> 
									<p>User Name </p>
									<input type="text" class="name" name="user name" required=""/>
									<p>Email</p>
									<input type="email" class="email" name="email" required=""/>
									<p>Password</p>
									<input type="password" class="password" name="password" required=""/>   
									<input type="submit" value="Register">
								</form> 	
							</div>  
						</div>  
					</div>  
				</div>
				<div class="col-md-6 w3features-left">
					<h3 class="agileits-title">Features<span class="w3lshr-line"> </span></h3>
					<div class="w3features-grids">
						<div class="w3features-left-gridl">
							<div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
								<i class="hi-icon fa-cubes"> </i>
							</div>
						</div>
						<div class="w3features-left-gridr">
							<h4>Covered almost all the theatre in Udupi</h4>
							<p>Movie Hub has online movie ticket booking option in any of the multiplex or common theatre in mangalore</p>
						</div>
						<div class="clearfix"> </div>
					</div> 
					<div class="w3features-grids">
						<div class="w3features-left-gridl">
							<div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
								<i class="hi-icon fa-globe"> </i>
							</div>
						</div>
						<div class="w3features-left-gridr">
							<h4>snacks order facility</h4>
							<p>Customer can order their snacks directly from website</p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="w3features-grids">
						<div class="w3features-left-gridl">
							<div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
								<i class="hi-icon fa-gear"> </i>
							</div>
						</div>
						<div class="w3features-left-gridr">
							<h4>Sending Notification</h4>
							<p>Upcoming movie notification will be sent to the existing customer</p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="w3features-grids">
						<div class="w3features-left-gridl">
							<div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
								<i class="hi-icon fa-hotel"> </i>
							</div>
						</div>
						<div class="w3features-left-gridr">
							<h4>Feedback option</h4>
							<p>Customer reviews or feedback option is also available</p>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div> 
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //features -->
	
	<!-- Stats -->
	<div id="stats" class="stats services news-w3layouts jarallax"> 
		<div class="container">    
			<div class="stats-agileinfo agileits-w3layouts">
				<div class="col-sm-3 col-xs-6 stats-grid">
					<div class="stats-img">
						<i class="fa fa-users" aria-hidden="true"></i>
					</div>
					<h6>No. of ticket bookings</h6>
					<div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='<?php
$sql ="SELECT * FROM ticket_booking";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>' data-delay='.5' data-increment="100">
<?php
$sql ="SELECT * FROM ticket_booking";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>					
					</div>
				</div>
				<div class="col-sm-3 col-xs-6 stats-grid">
					<div class="stats-img w3-agileits">
						<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
					</div>
					<h6>No. of shows</h6>
					<div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='<?php
$sqlshowtimings="Select * From showtimings";
$qsqlshowtimings=mysqli_query($con,$sqlshowtimings);
echo mysqli_num_rows($qsqlshowtimings);
					?>' data-delay='8' data-increment="1"><?php
$sqlshowtimings="Select * From showtimings";
$qsqlshowtimings=mysqli_query($con,$sqlshowtimings);
echo mysqli_num_rows($qsqlshowtimings);
					?></div>
				</div>
				<div class="col-sm-3 col-xs-6 stats-grid">
					<div class="stats-img w3-agileits">
						<i class="fa fa-briefcase" aria-hidden="true"></i>
					</div>	
					<h6>No. of theatres running.. </h6> 
					<div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='<?php
$sqltheatre="Select * From theatre";
$qsqltheatre=mysqli_query($con,$sqltheatre);
echo mysqli_num_rows($qsqltheatre);
					?>' data-delay='.5' data-increment="10"><?php
$sqltheatre="Select * From theatre";
$qsqltheatre=mysqli_query($con,$sqltheatre);
echo mysqli_num_rows($qsqltheatre);
					?></div> 
				</div>
				<div class="col-sm-3 col-xs-6 stats-grid">
					<div class="stats-img w3-agileits">
						<i class="fa fa-trophy" aria-hidden="true"></i>
					</div>
					<h6>Overall Ratings</h6>
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