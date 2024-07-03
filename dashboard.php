<?php
include("header.php");
if(!isset($_SESSION[adminid]))
{
	echo "<SCRIPT>window.location='index.php';</SCRIPT>";
}
?>
	<!-- services -->
<script defer src="js/fontawesomenew.js"></script>	
<div class="services jarallax">
		<div class="container"> 
			<div class="w3ls_banner_bottom_grids">
				<ul class="cbp-ig-grid">

					<li onclick="window.location='viewadmin.php';" >
						<div class="w3_grid_effect">
							<span><i style="color:yellow" class="fas fa-lock fa-5x"></i></span>
							<h4 class="cbp-ig-title" style="height:70px;">Admin Records</h4>
							<span class="cbp-ig-category">
<?php							
$sql = "SELECT * FROM admin";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>
							</span>
						</div>
					</li>

		
						<li onclick="window.location='viewbilling.php';">
						<div class="w3_grid_effect">
							<span><i style="color:yellow" class="fab fa-bitcoin fa-spin fa-5x"></i></span>
							<h4 class="cbp-ig-title" style="height: 70px;">Billig Records</h4>
							<span class="cbp-ig-category">
<?php							
$sql = "SELECT * FROM billing";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>
							</span>
						</div>
					</li>


						<li onclick="window.location='viewcancel_booking.php';">
						<div class="w3_grid_effect">
							<span><i style="color:yellow" class="fas fa-ban fa-spin fa-5x"></i></span>
							<h4 class="cbp-ig-title" style="height: 70px;">Cancelled booking Records</h4>
							<span class="cbp-ig-category">
<?php							
$sql = "SELECT * FROM cancel_booking";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>
							</span>
						</div>
					</li>									
					
		

						<li onclick="window.location='viewcustomer.php';">
						<div class="w3_grid_effect">
							<span><i style="color:yellow" class="fas fa-users fa-5x"></i></span>
							<h4 class="cbp-ig-title" style="height: 70px;">Customer Records</h4>
							<span class="cbp-ig-category">
<?php							
$sql = "SELECT * FROM customer";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>
							</span>
						</div>
					</li>									
					
					
		

						<li onclick="window.location='viewfeedback.php';">
						<div class="w3_grid_effect">
							<span><i style="color:yellow" class="fas fa-comments fa-spin fa-5x"></i></span>
							<h4 class="cbp-ig-title" style="height: 70px;">Feedback Records</h4>
							<span class="cbp-ig-category">
<?php							
$sql = "SELECT * FROM feedback";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>
							</span>
						</div>
					</li>									

						<li onclick="window.location='viewfoodorder.php';">
						<div class="w3_grid_effect">
							<span><i style="color:yellow" class="fas fa-coffee fa-5x"></i></span>
							<h4 class="cbp-ig-title" style="height: 70px;">snacksorder Records</h4>
							<span class="cbp-ig-category">
<?php							
$sql = "SELECT * FROM foodorder";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>
							</span>
						</div>
					</li>									
					

						<li onclick="window.location='viewlocation.php';">
						<div class="w3_grid_effect">
							<span><i style="color:yellow" class="fas fa-map-marker-alt fa-5x"></i></span>
							<h4 class="cbp-ig-title" style="height: 70px;">Location Records</h4>
							<span class="cbp-ig-category">
<?php							
$sql = "SELECT * FROM location";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>
							</span>
						</div>
					</li>									

						<li onclick="window.location='viewmovie.php';">
						<div class="w3_grid_effect">
							<span><i style="color:yellow" class="fas fa-film fa-5x"></i></span>
							<h4 class="cbp-ig-title" style="height: 70px;">Movie Records</h4>
							<span class="cbp-ig-category">
<?php							
$sql = "SELECT * FROM Movie";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>
							</span>
						</div>
					</li>									
															
										

						<li onclick="window.location='viewoffer.php';">
						<div class="w3_grid_effect">
							<span><i style="color:yellow" class="fas fa-star fa-spin fa-5x"></i></span>
							<h4 class="cbp-ig-title" style="height: 70px;">Offer Records</h4>
							<span class="cbp-ig-category">
<?php							
$sql = "SELECT * FROM offer";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>
							</span>
						</div>
					</li>									

						<li onclick="window.location='viewseattype.php';">
						<div class="w3_grid_effect">
							<span><i style="color:yellow" class="fas fa-wheelchair fa-5x"></i></span>
							<h4 class="cbp-ig-title" style="height: 70px;">Seattype Records</h4>
							<span class="cbp-ig-category">
<?php							
$sql = "SELECT * FROM seattype";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>
							</span>
						</div>
					</li>									
																	
						<li onclick="window.location='viewseat_setting.php';">
						<div class="w3_grid_effect">
							<span><i style="color:yellow" class="fas fa-cog fa-spin fa-5x"></i></span>
							<h4 class="cbp-ig-title" style="height: 70px;">Seat_setting Records</h4>
							<span class="cbp-ig-category">
<?php							
$sql = "SELECT * FROM seat_setting";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>
							</span>
						</div>
					</li>	
						<li onclick="window.location='viewshowlist.php';">
						<div class="w3_grid_effect">
							<span><i style="color:yellow" class="fab fa-accusoft fa-5x"></i></span>
							<h4 class="cbp-ig-title" style="height: 70px;">Showlist Records</h4>
							<span class="cbp-ig-category">
<?php							
$sql = "SELECT * FROM showlist";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>
							</span>
						</div>
					</li>									
										
							
						<li onclick="window.location='viewshowtimings.php';">
						<div class="w3_grid_effect">
							<span><i style="color:yellow" class="fas fa-clock fa-spin fa-5x"></i></span>
							<h4 class="cbp-ig-title" style="height: 70px;">Showtimings Records</h4>
							<span class="cbp-ig-category">
<?php							
$sql = "SELECT * FROM showtimings";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>
							</span>
						</div>
					</li>	
						<li onclick="window.location='viewsnacks.php';">
						<div class="w3_grid_effect">
							<span><i style="color:yellow" class="fas fa-boxing-glove fa-5x"></i></span>
							<h4 class="cbp-ig-title" style="height: 70px;">Snacks Records</h4>
							<span class="cbp-ig-category">
<?php							
$sql = "SELECT * FROM snacks";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>
							</span>
						</div>
					</li>									
										
						<li onclick="window.location='viewtheatre.php';">
						<div class="w3_grid_effect">
							<span><i style="color:yellow" class="fab fa-houzz fa-5x"></i></span>
							<h4 class="cbp-ig-title" style="height: 70px;">Theatre Records</h4>
							<span class="cbp-ig-category">
<?php							
$sql = "SELECT * FROM theatre";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>
							</span>
						</div>
					</li>									
						<li onclick="window.location='viewticket_booking.php';">
						<div class="w3_grid_effect">
							<span><i style="color:yellow" class="fas fa-book fa-5x"></i></span>
							<h4 class="cbp-ig-title" style="height: 70px;">Ticket_booking Records</h4>
							<span class="cbp-ig-category">
<?php							
$sql = "SELECT * FROM ticket_booking";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>
							</span>
						</div>
					</li>									
																				
					
				</ul>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //services -->
<?php
include("footer.php");
?>