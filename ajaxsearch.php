<?php
error_reporting(E_ERROR | E_PARSE);
	include("dbconnection.php");
			$sqlsearchmovie = "SELECT * FROM movie WHERE moviename LIKE '%$_GET[searchtext]%'";
			$qsqlsearchmovie = mysqli_query($con,$sqlsearchmovie);
			while($rssearchmovie = mysqli_fetch_array($qsqlsearchmovie))
			{
											
    if(file_exists("imagebanner/$rssearchmovie[bannerimg]"))
     {
	    $picimage="imagebanner/$rssearchmovie[bannerimg]";
     }
      else
     {
	    $picimage="images/No_Image_Available.jpg";
     }
	 
			?>
	<div class="col-sm-12 col-xs-6" >
		<div class="">
			<a href="displaymoviedetail.php?movieid=<?php echo $rssearchmovie[movieid]; ?>"  title="<?php echo $rssearchmovie[moviename]; ?>"  onclick="window.location='displaymoviedetail.php?movieid=<?php echo $rssearchmovie[movieid]; ?>';">
				<img src="<?php echo $picimage; ?>" alt="" width="50px;" height="50px;" align="left" style="padding-right:5px;" /><h4><?php echo $rssearchmovie[moviename]; ?></h4>
			</a>
		</div>
					
	</div>
			<?php
			}
			?>	