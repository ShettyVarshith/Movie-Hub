<?php
include("header.php");
?>
	<div class="w3ls_about_bottom">
		<div class="container"> 
			<div class="w3_about_bottom_grid"> 
				<h4>Movies</h4>
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
			if($_GET[displaytype] == "OngoingMovie")
			{
				$sql = "SELECT * FROM showlist LEFT JOIN movie ON showlist.movieid=movie.movieid WHERE '$dt' BETWEEN showlist.startdate AND showlist.enddate  group by movie.movieid   ORDER BY movie.movieid";
			}
			else if($_GET[displaytype] == "UpcomingMovie")
			{
				$sql = "SELECT * FROM `movie` LEFT JOIN showlist ON movie.movieid=showlist.movieid WHERE  showlist.movieid is NULL group by movie.movieid   ORDER BY movie.movieid desc";
			}
			else
			{
				$sql = "SELECT * FROM `movie` LEFT JOIN showlist ON movie.movieid=showlist.movieid WHERE ('$dt' BETWEEN showlist.startdate AND showlist.enddate) OR (showlist.startdate>'$dt') GROUP BY movie.movieid";
			}
			$qsql = mysqli_query($con,$sql);
			while($rs = mysqli_fetch_array($qsql))
			{						
    if(file_exists("imagebanner/$rs[bannerimg]"))
     {
	    $picimage="imagebanner/$rs[bannerimg]";
     }
      else
     {
	    $picimage="images/No_Image_Available.jpg";
     } 
	 if($rs[movieid]== "")
	 {
		 $rs[movieid] = $rs[0];
	 }
	 ?>
	<div class="col-sm-4 col-xs-6">
		<div class="view view-seventh">
			<a href="displaymoviedetail.php?movieid=<?php echo $rs[movieid]; ?>"  title="<?php echo $rs[moviename]; ?>"  onclick="window.location='displaymoviedetail.php?movieid=<?php echo $rs[movieid]; ?>';">
				<img src="<?php echo $picimage; ?>" alt="" width="150px;" height="250px;" />
				<div class="mask">
					<h4><?php echo $rs[moviename]; ?></h4>
					<p><?php echo $rs[moviesummary]; ?></p>
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
<?php
include("footer.php");
?>