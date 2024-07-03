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
		
			<div class="col-md-3 agileits_about_grid_right">
				<img src="<?php echo $picimage; ?>" style="width:100%;">
			</div>
			<div class="col-md-6 agileits_about_grid_left">
				<h2 class="agileits-title"><?php echo $rsmovie[moviename]; ?> <span class="w3lshr-line"> </span></h2>
				<p> <?php echo $rsmovie[moviesummary]; ?></p>
			</div> 
			<div class="col-md-3 agileits_about_grid_right">
				<h4 class="agileits-title" style="color:red;">about <?php echo $rsmovie[moviename]; ?></h4>
				<h4 style="color:grey;"><?php echo $rsmovie[movietype]; ?></h4>
				<h5><span style="color:red;">Language:</span> <?php echo $rsmovie[language]; ?></h5>
			</div>
			<div class="clearfix"> </div>
		</div> 
	</div>
	<!-- //about -->
	
	<!-- theatre starts -->
	<hr>
<?php
if(isset($_GET[showtimingid]))
{
	$sqltheatre="SELECT * from theatre WHERE theatreid='$_GET[theatreid]'";
	$qsqltheatre=mysqli_query($con,$sqltheatre);
	echo mysqli_error($con);
	$rstheatre=mysqli_fetch_array($qsqltheatre);
		 if(file_exists("imgtheatrelogo/$rstheatre[theatreimg]"))
		 {
			$picimage="imgtheatrelogo/$rstheatre[theatreimg]";
		 }
		 else
		 {
			$picimage="images/No_Image_Available.jpg";
		 }
?> 
<?php
	$sqlshowtimings="Select * From showtimings LEFT JOIN showlist ON  showtimings.showlistid =showlist.showlistid WHERE  showlist.status='Active' AND showtimings.showtimingid='$_GET[showtimingid]'";
	$qsqlshowtimings=mysqli_query($con,$sqlshowtimings);
	$rsshowtimings = mysqli_fetch_array($qsqlshowtimings);
	$screenno = $rsshowtimings[screenid];
?>
	<div id="about" class="about">
		<div class="container">
		
			<div class="col-md-3 agileits_about_grid_right">
	<img src="<?php echo $picimage; ?>" style="width:100%;">		
			</div>
			<div class="col-md-6 agileits_about_grid_left">
				<h2 class="agileits-title"><?php echo $rstheatre[theatrename]; ?> <span class="w3lshr-line"> </span></h2>
	<h4>Screen No. <?php echo $screenno; ?></h4>
				<p><?php echo $rstheatre[theatredescription]; ?></p>
				
			</div> 
			<div class="col-md-3 agileits_about_grid_right">
				<p><span style="color:red;">Address:</span><br/> <?php echo $rstheatre[address]; ?><br>Ph. <?php echo $rstheatre[mobileno]; ?></p>		
			</div>
			<div class="clearfix"> </div>
		</div> 
	</div>
	<!-- //theatre ends--> 	
		<div class="w3ls_about_bottom">
		<div class="container" style="color:white;"> 
				<center>
				<table>
					<tr>
						<td style="font-size:20px;">Booking  date  &nbsp; </td>
						<td style="background-color:white; color:black;padding:10px;"><?php echo date("d-M-Y",strtotime($rsshowtimings[datetime])); ?></td>
						<td style="font-size:20px;"> &nbsp;&nbsp;&nbsp; </td>
						<td style="font-size:20px;">Booking  Time  &nbsp; </td>
						<td style="background-color:white; color:black;padding:10px;"><?php echo date("h:i A",strtotime($rsshowtimings[datetime])); ?></td>
						<td style="padding:10px;"> </td>
						<td style="background-color:blue; font-size:20px;color:white;padding:10px;cursor:pointer;" onclick="window.location='bookingpanel.php?movieid=<?php echo $_GET[movieid]; ?>'" > Change </td>
					</tr>
				</table>
				</center>
		</div>
	</div>
<?php
}
else
{
	$sqlshowlisttimings = "SELECT * FROM `showlist` LEFT JOIN showtimings ON showlist.showlistid= showtimings.showlistid WHERE showlist.movieid='$_GET[movieid]' and showtimings.datetime >= '$dt 00:00:00'";
	$qsqlshowlisttimings = mysqli_query($con,$sqlshowlisttimings);
	if(mysqli_num_rows($qsqlshowlisttimings) >= 1)
	{
		if(isset($_SESSION["customerid"]))
		{
?>
	<!-- booking date starts here -->
	<div class="w3ls_about_bottom">
		<div class="container" style="color:white;"> 
				<center>
				<table>
					<tr>
						<td style="font-size:20px;">Select  date  &nbsp; </td>
						<td><input type="date" name="date" class="form-control" style="width:200px;" min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d"); ?>" onchange="changebookingdate(this.value,'<?php echo $_GET[movieid]; ?>')" ></td>
					</tr>
				</table>
				</center>
		</div>
	</div>
		<!-- //booking date ends here -->
	<div class="col-md-12" id="divshowtimings"> 	
		<?php
			include("ajaxscrolltheatre.php");
		?>
	</div>
		
	<script>
		function changebookingdate(bdate,movieid)
		{
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("divshowtimings").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","ajaxscrolltheatre.php?bdate="+bdate+"&movieid="+movieid,true);
			xmlhttp.send();
		}
	</script>
		<!-- //booking date ends here -->
<?php
		}
		else
		{
?>
<center>
<table>
<tr>
<td>
<a href="#" style="width:350px;" data-toggle="modal" class="form-control" data-target="#myModal"> Click here to Login</a>
</td>
<td>
<a href="#" style="width:350px;" data-toggle="modal" class="form-control" data-target="#myModal2"> Click here to Register</a>
</td>
</tr>
</table></center>

<?php
		}
	}
	else
	{
		echo "<center><b>No shows available..</b></center>";
	}
}
?>


	<hr>
<?php
if(isset($_GET[showtimingid]))
{
?>
		<!-- Seat selection starts here -->
	<div id="idfeatures" class="features" >
		<div class="" > 
			<div class="w3layouts_skills_grids w3layouts-features-agileinfo">
				<div class="col-md-12 col-sm-12 w3features-right"> 
				<center><h2>Seat selection </h2></center>
					
					<div id="idseatselection"  style="padding: 0em;">
						<div class="agile-row">
                            <div class="login-agileits-top">
<?php
include("seat.php");
?>
							</div>  
						</div>  
					</div>
					
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- Seat selection ends here -->
	
<?php
}
?>
	
<?php
include("footer.php");
?>
<script>   
function validateform()
{
	var spans = $('.ms-error');
	spans.text(''); // clear the textvar
	i =0;
	if(document.billingfrm.paymenttype.value == "" )
	{
		document.getElementById("idpaymenttype").innerHTML="Kindly enter the paymenttype ..";		
		i=1;
	}
	if(document.billingfrm.cardno.value == "" )
	{
		document.getElementById("idcardno").innerHTML="pls enter the cardno ..";		
		i=1;
	}
	if(document.billingfrm.cvvno.value == "" )
	{
		document.getElementById("idcvvno").innerHTML="pls enter the cvv number ..";		
		i=1;
	}
	if(document.billingfrm.expdate.value == "" )
	{
		document.getElementById("idexpdate").innerHTML="pls enter the expire date  ..";		
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