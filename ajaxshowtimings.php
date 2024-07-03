<?php
session_start();
include("dbconnection.php");
			if(isset($_SESSION["customerid"]))
			{
			?>				
 	<div  class="gallery1">
	<?php
if($_GET[bdate] != "")	
{
	$bdate = $_GET[bdate];
}
else
{
	$bdate = date("Y-m-d");
}
	$sqltheatre="Select * From theatre LEFT JOIN location ON theatre.locationid= location.locationid LEFT JOIN showlist ON showlist.theatreid =theatre.theatreid WHERE theatre.status='Active' AND ('$bdate' BETWEEN showlist.startdate AND showlist.enddate) and showlist.movieid='$_GET[movieid]'";
	$qsqltheatre=mysqli_query($con,$sqltheatre);
	echo mysqli_error($con);
	while($rstheatre = mysqli_fetch_array($qsqltheatre))
	{
		 if(file_exists("imgtheatrelogo/$rstheatre[theatreimg]"))
		 {
			$picimage="imgtheatrelogo/$rstheatre[theatreimg]";
		 }
		 else
		 {
			$picimage="images/No_Image_Available.jpg";
		 }
	?>
                <div class="col-sm-4 col-xs-6"   onclick="window.location='bookingpanel.php?theatrieid=<?php echo $rstheatre[0]; ?>&movieid=<?php echo $_GET[movieid]; ?>&bookingdate='+bookdate.value;">
					<div class="view view-seventh" style="cursor:pointer;">
							<img src="<?php echo $picimage; ?>" style="height:300px;" alt="<?php echo $rstheatre[theatrename]; ?>" style="cursor:pointer;"/>
							<div class="mask" style="cursor:pointer;">
								<h4><?php echo $rstheatre[theatrename]; ?></h4>
								<p>
<?php
	$sqlshowtimings="Select * From showtimings LEFT JOIN showlist ON  showtimings.showlistid =showlist.showlistid WHERE  showlist.status='Active' AND showtimings.status='Active' AND showlist.movieid='$_GET[movieid]' AND showlist.theatreid='$rstheatre[theatreid]' ORDER by showtimings.datetime";
	$qsqlshowtimings=mysqli_query($con,$sqlshowtimings);
	echo mysqli_error($con);
	while($rsshowtimings = mysqli_fetch_array($qsqlshowtimings))
	{
echo "<span style='background-color:red;color:white;padding:1px;`> &nbsp;". date("h:i A",strtotime($rsshowtimings[datetime])) ." </span><br>";
	}
?>
								</p>
							</div>
					</div>
                </div> 
	<?php
	}
	?>
				
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