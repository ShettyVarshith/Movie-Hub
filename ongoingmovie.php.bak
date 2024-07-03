<style>
/*Panel tabs*/
.panel-tabs {
    position: relative;
    bottom: 30px;
    clear:both;
    border-bottom: 1px solid transparent;
}

.panel-tabs > li {
    float: left;
    margin-bottom: -1px;
}

.panel-tabs > li > a {
    margin-right: 2px;
    margin-top: 4px;
    line-height: .85;
    border: 1px solid transparent;
    border-radius: 4px 4px 0 0;
    color: #ffffff;
}

.panel-tabs > li > a:hover {
    border-color: transparent;
    color: #ffffff;
    background-color: transparent;
}

.panel-tabs > li.active > a,
.panel-tabs > li.active > a:hover,
.panel-tabs > li.active > a:focus {
    color: #fff;
    cursor: default;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    background-color: rgba(255,255,255, .23);
    border-bottom-color: transparent;
}
</style>
<div>
	<div >
		<div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Ongoing movies</h3>
                    <span class="pull-right">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
    <li class="nav-item active">
        <a class="nav-link active" data-toggle="tab" href="#panelOngoingAll" role="tab" >All</a>
    </li>
	<li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panelKannada" role="tab" >Kannada</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panelHindi" role="tab">Hindi</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panelEnglish" role="tab">English</a>
    </li>    
	<li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#panelTamil" role="tab" >Tamil</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panelTelugu" role="tab">Telugu</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panelMalayalam" role="tab">Malayalam</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panelTulu" role="tab">Tulu</a>
    </li>
                        </ul>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
							
<div class="tab-pane active" id="panelOngoingAll">
<!-- Ongoing movie -->
<br>
	<?php
	$sqlshowlist = "SELECT * FROM showlist LEFT JOIN movie ON showlist.movieid=movie.movieid WHERE '$dt' BETWEEN showlist.startdate AND showlist.enddate group by movie.movieid   ORDER BY movie.movieid desc  limit 4";
	$qsqlshowlist = mysqli_query($con,$sqlshowlist);
	echo mysqli_error($con);
	while($rsshowlist = mysqli_fetch_array($qsqlshowlist))
	{							
		if(file_exists("imagebanner/$rsshowlist[bannerimg]"))
		{
		$picimage="imagebanner/$rsshowlist[bannerimg]";
		}
		else
		{
		$picimage="images/No_Image_Available.jpg";
		}
	?>
		<div class="col-sm-3 col-xs-3 gallry-agile-grids" style="border-width:1px;border-style:dotted;">

			<div class="view view-seventh">
				<a href="" class="b-link-stripe b-animate-go thickbox" title="<?php echo $rsshowlist[moviename]; ?>">
					<img src="<?php echo $picimage; ?>" alt="" width="150px;" height="250px;" style="" />
					<div class="mask">
						<h4><?php echo $rsshowlist[moviename]; ?></h4>
						<p><?php echo $rsshowlist[moviesummary]; ?></p>
					</div>
				</a>
			</div>

			<div>
				<b style='font-size:20px;padding-left: 10px;'><a href="displaymoviedetail.php?movieid=<?php echo $rsshowlist[movieid]; ?>" ><?php echo $rsshowlist[moviename]; ?></a></b><br>
				<b style='padding-left: 10px;'><?php echo $rsshowlist[language]; ?></b><br>
				<center><a href="displaymoviedetail.php?movieid=<?php echo $rsshowlist[movieid]; ?>" style="background-color:red;width:100%;" class="wthree-btn btn-6">Book Now</a></center>
			</div>
		</div>
	<?php
	}
	?>				
		<div class="clearfix"> </div>
<!-- //Ongoing movie -->
</div>			
<div class="tab-pane" id="panelKannada">
<!-- Ongoing movie -->
<br>
	<?php
	$sqlshowlist = "SELECT * FROM showlist LEFT JOIN movie ON showlist.movieid=movie.movieid WHERE '$dt' BETWEEN showlist.startdate AND showlist.enddate AND LANGUAGE LIKE '%kannada%' group by movie.movieid   ORDER BY movie.movieid desc  limit 0,4";
	$qsqlshowlist = mysqli_query($con,$sqlshowlist);
	echo mysqli_error($con);
	while($rsshowlist = mysqli_fetch_array($qsqlshowlist))
	{							
		if(file_exists("imagebanner/$rsshowlist[bannerimg]"))
		{
		$picimage="imagebanner/$rsshowlist[bannerimg]";
		}
		else
		{
		$picimage="images/No_Image_Available.jpg";
		}
	?>
		<div class="col-sm-3 col-xs-3 gallry-agile-grids" style="border-width:1px;border-style:dotted;">

			<div class="view view-seventh">
				<a href="" class="b-link-stripe b-animate-go thickbox" title="<?php echo $rsshowlist[moviename]; ?>">
					<img src="<?php echo $picimage; ?>" alt="" width="150px;" height="250px;" style="" />
					<div class="mask">
						<h4><?php echo $rsshowlist[moviename]; ?></h4>
						<p><?php echo $rsshowlist[moviesummary]; ?></p>
					</div>
				</a>
			</div>

			<div>
				<b style='font-size:20px;padding-left: 10px;'><a href="displaymoviedetail.php?movieid=<?php echo $rsshowlist[movieid]; ?>" ><?php echo $rsshowlist[moviename]; ?></a></b><br>
				<b style='padding-left: 10px;'><?php echo $rsshowlist[language]; ?></b><br>
				<center><a href="displaymoviedetail.php?movieid=<?php echo $rsshowlist[movieid]; ?>" style="background-color:red;width:100%;" class="wthree-btn btn-6">Book Now</a></center>
			</div>
		</div>
	<?php
	}
	?>				
		<div class="clearfix"> </div>
<!-- //Ongoing movie -->
</div>			
<div class="tab-pane" id="panelHindi"><!-- Ongoing movie -->
<br> 
	<?php
	$sqlshowlist = "SELECT * FROM showlist LEFT JOIN movie ON showlist.movieid=movie.movieid WHERE '$dt' BETWEEN showlist.startdate AND showlist.enddate AND LANGUAGE LIKE '%Hindi%' group by movie.movieid   ORDER BY movie.movieid desc  limit 0,4";
	$qsqlshowlist = mysqli_query($con,$sqlshowlist);
	echo mysqli_error($con);
	while($rsshowlist = mysqli_fetch_array($qsqlshowlist))
	{							
		if(file_exists("imagebanner/$rsshowlist[bannerimg]"))
		{
		$picimage="imagebanner/$rsshowlist[bannerimg]";
		}
		else
		{
		$picimage="images/No_Image_Available.jpg";
		}
	?>
		<div class="col-sm-3 col-xs-3 gallry-agile-grids" style="border-width:1px;border-style:dotted;">

			<div class="view view-seventh">
				<a href="" class="b-link-stripe b-animate-go thickbox" title="<?php echo $rsshowlist[moviename]; ?>">
					<img src="<?php echo $picimage; ?>" alt="" width="150px;" height="250px;" style="" />
					<div class="mask">
						<h4><?php echo $rsshowlist[moviename]; ?></h4>
						<p><?php echo $rsshowlist[moviesummary]; ?></p>
					</div>
				</a>
			</div>

			<div>
				<b style='font-size:20px;padding-left: 10px;'><a href="displaymoviedetail.php?movieid=<?php echo $rsshowlist[movieid]; ?>" ><?php echo $rsshowlist[moviename]; ?></a></b><br>
				<b style='padding-left: 10px;'><?php echo $rsshowlist[language]; ?></b><br>
				<center><a href="displaymoviedetail.php?movieid=<?php echo $rsshowlist[movieid]; ?>" style="background-color:red;width:100%;" class="wthree-btn btn-6">Book Now</a></center>
			</div>
		</div>
	<?php
	}
	?>				
		<div class="clearfix"> </div>
<!-- //Ongoing movie --></div>					
<div class="tab-pane" id="panelEnglish"><!-- Ongoing movie -->
<br> 
	<?php
	$sqlshowlist = "SELECT * FROM showlist LEFT JOIN movie ON showlist.movieid=movie.movieid WHERE '$dt' BETWEEN showlist.startdate AND showlist.enddate AND LANGUAGE LIKE '%English%' group by movie.movieid   ORDER BY movie.movieid desc  limit 0,4";
	$qsqlshowlist = mysqli_query($con,$sqlshowlist);
	echo mysqli_error($con);
	while($rsshowlist = mysqli_fetch_array($qsqlshowlist))
	{							
		if(file_exists("imagebanner/$rsshowlist[bannerimg]"))
		{
		$picimage="imagebanner/$rsshowlist[bannerimg]";
		}
		else
		{
		$picimage="images/No_Image_Available.jpg";
		}
	?>
		<div class="col-sm-3 col-xs-3 gallry-agile-grids" style="border-width:1px;border-style:dotted;">

			<div class="view view-seventh">
				<a href="" class="b-link-stripe b-animate-go thickbox" title="<?php echo $rsshowlist[moviename]; ?>">
					<img src="<?php echo $picimage; ?>" alt="" width="150px;" height="250px;" style="" />
					<div class="mask">
						<h4><?php echo $rsshowlist[moviename]; ?></h4>
						<p><?php echo $rsshowlist[moviesummary]; ?></p>
					</div>
				</a>
			</div>

			<div>
				<b style='font-size:20px;padding-left: 10px;'><a href="displaymoviedetail.php?movieid=<?php echo $rsshowlist[movieid]; ?>" ><?php echo $rsshowlist[moviename]; ?></a></b><br>
				<b style='padding-left: 10px;'><?php echo $rsshowlist[language]; ?></b><br>
				<center><a href="displaymoviedetail.php?movieid=<?php echo $rsshowlist[movieid]; ?>" style="background-color:red;width:100%;" class="wthree-btn btn-6">Book Now</a></center>
			</div>
		</div>
	<?php
	}
	?>				
		<div class="clearfix"> </div>
<!-- //Ongoing movie --></div>					
<div class="tab-pane" id="panelTamil"><!-- Ongoing movie -->
<br> 
	<?php
	$sqlshowlist = "SELECT * FROM showlist LEFT JOIN movie ON showlist.movieid=movie.movieid WHERE '$dt' BETWEEN showlist.startdate AND showlist.enddate AND LANGUAGE LIKE '%Tamil%' group by movie.movieid   ORDER BY movie.movieid desc  limit 0,4";
	$qsqlshowlist = mysqli_query($con,$sqlshowlist);
	echo mysqli_error($con);
	while($rsshowlist = mysqli_fetch_array($qsqlshowlist))
	{							
		if(file_exists("imagebanner/$rsshowlist[bannerimg]"))
		{
		$picimage="imagebanner/$rsshowlist[bannerimg]";
		}
		else
		{
		$picimage="images/No_Image_Available.jpg";
		}
	?>
		<div class="col-sm-3 col-xs-3 gallry-agile-grids" style="border-width:1px;border-style:dotted;">

			<div class="view view-seventh">
				<a href="" class="b-link-stripe b-animate-go thickbox" title="<?php echo $rsshowlist[moviename]; ?>">
					<img src="<?php echo $picimage; ?>" alt="" width="150px;" height="250px;" style="" />
					<div class="mask">
						<h4><?php echo $rsshowlist[moviename]; ?></h4>
						<p><?php echo $rsshowlist[moviesummary]; ?></p>
					</div>
				</a>
			</div>

			<div>
				<b style='font-size:20px;padding-left: 10px;'><a href="displaymoviedetail.php?movieid=<?php echo $rsshowlist[movieid]; ?>" ><?php echo $rsshowlist[moviename]; ?></a></b><br>
				<b style='padding-left: 10px;'><?php echo $rsshowlist[language]; ?></b><br>
				<center><a href="displaymoviedetail.php?movieid=<?php echo $rsshowlist[movieid]; ?>" style="background-color:red;width:100%;" class="wthree-btn btn-6">Book Now</a></center>
			</div>
		</div>
	<?php
	}
	?>				
		<div class="clearfix"> </div>
<!-- //Ongoing movie --></div>					
<div class="tab-pane" id="panelTelugu"><!-- Ongoing movie -->
<br> 
	<?php
	$sqlshowlist = "SELECT * FROM showlist LEFT JOIN movie ON showlist.movieid=movie.movieid WHERE '$dt' BETWEEN showlist.startdate AND showlist.enddate AND LANGUAGE LIKE '%Telugu%' group by movie.movieid   ORDER BY movie.movieid desc  limit 0,4";
	$qsqlshowlist = mysqli_query($con,$sqlshowlist);
	echo mysqli_error($con);
	while($rsshowlist = mysqli_fetch_array($qsqlshowlist))
	{							
		if(file_exists("imagebanner/$rsshowlist[bannerimg]"))
		{
		$picimage="imagebanner/$rsshowlist[bannerimg]";
		}
		else
		{
		$picimage="images/No_Image_Available.jpg";
		}
	?>
		<div class="col-sm-3 col-xs-3 gallry-agile-grids" style="border-width:1px;border-style:dotted;">

			<div class="view view-seventh">
				<a href="" class="b-link-stripe b-animate-go thickbox" title="<?php echo $rsshowlist[moviename]; ?>">
					<img src="<?php echo $picimage; ?>" alt="" width="150px;" height="250px;" style="" />
					<div class="mask">
						<h4><?php echo $rsshowlist[moviename]; ?></h4>
						<p><?php echo $rsshowlist[moviesummary]; ?></p>
					</div>
				</a>
			</div>

			<div>
				<b style='font-size:20px;padding-left: 10px;'><a href="displaymoviedetail.php?movieid=<?php echo $rsshowlist[movieid]; ?>" ><?php echo $rsshowlist[moviename]; ?></a></b><br>
				<b style='padding-left: 10px;'><?php echo $rsshowlist[language]; ?></b><br>
				<center><a href="displaymoviedetail.php?movieid=<?php echo $rsshowlist[movieid]; ?>" style="background-color:red;width:100%;" class="wthree-btn btn-6">Book Now</a></center>
			</div>
		</div>
	<?php
	}
	?>				
		<div class="clearfix"> </div>
<!-- //Ongoing movie --></div>					
<div class="tab-pane" id="panelMalayalam"><!-- Ongoing movie -->
<br> 
	<?php
	$sqlshowlist = "SELECT * FROM showlist LEFT JOIN movie ON showlist.movieid=movie.movieid WHERE '$dt' BETWEEN showlist.startdate AND showlist.enddate AND LANGUAGE LIKE '%Malayalam%' group by movie.movieid   ORDER BY movie.movieid desc  limit 0,4";
	$qsqlshowlist = mysqli_query($con,$sqlshowlist);
	echo mysqli_error($con);
	while($rsshowlist = mysqli_fetch_array($qsqlshowlist))
	{							
		if(file_exists("imagebanner/$rsshowlist[bannerimg]"))
		{
		$picimage="imagebanner/$rsshowlist[bannerimg]";
		}
		else
		{
		$picimage="images/No_Image_Available.jpg";
		}
	?>
		<div class="col-sm-3 col-xs-3 gallry-agile-grids" style="border-width:1px;border-style:dotted;">

			<div class="view view-seventh">
				<a href="" class="b-link-stripe b-animate-go thickbox" title="<?php echo $rsshowlist[moviename]; ?>">
					<img src="<?php echo $picimage; ?>" alt="" width="150px;" height="250px;" style="" />
					<div class="mask">
						<h4><?php echo $rsshowlist[moviename]; ?></h4>
						<p><?php echo $rsshowlist[moviesummary]; ?></p>
					</div>
				</a>
			</div>

			<div>
				<b style='font-size:20px;padding-left: 10px;'><a href="displaymoviedetail.php?movieid=<?php echo $rsshowlist[movieid]; ?>" ><?php echo $rsshowlist[moviename]; ?></a></b><br>
				<b style='padding-left: 10px;'><?php echo $rsshowlist[language]; ?></b><br>
				<center><a href="displaymoviedetail.php?movieid=<?php echo $rsshowlist[movieid]; ?>" style="background-color:red;width:100%;" class="wthree-btn btn-6">Book Now</a></center>
			</div>
		</div>
	<?php
	}
	?>				
		<div class="clearfix"> </div>
<!-- //Ongoing movie --></div>				
<div class="tab-pane" id="panelTulu"><!-- Ongoing movie -->
<br>
	<?php
	$sqlshowlist = "SELECT * FROM showlist LEFT JOIN movie ON showlist.movieid=movie.movieid WHERE '$dt' BETWEEN showlist.startdate AND showlist.enddate AND LANGUAGE LIKE '%Tulu%' group by movie.movieid   ORDER BY movie.movieid desc  limit 0,4";
	$qsqlshowlist = mysqli_query($con,$sqlshowlist);
	echo mysqli_error($con);
	while($rsshowlist = mysqli_fetch_array($qsqlshowlist))
	{							
		if(file_exists("imagebanner/$rsshowlist[bannerimg]"))
		{
		$picimage="imagebanner/$rsshowlist[bannerimg]";
		}
		else
		{
		$picimage="images/No_Image_Available.jpg";
		}
	?>
		<div class="col-sm-3 col-xs-3 gallry-agile-grids" style="border-width:1px;border-style:dotted;">

			<div class="view view-seventh">
				<a href="" class="b-link-stripe b-animate-go thickbox" title="<?php echo $rsshowlist[moviename]; ?>">
					<img src="<?php echo $picimage; ?>" alt="" width="150px;" height="250px;" style="" />
					<div class="mask">
						<h4><?php echo $rsshowlist[moviename]; ?></h4>
						<p><?php echo $rsshowlist[moviesummary]; ?></p>
					</div>
				</a>
			</div>

			<div>
				<b style='font-size:20px;padding-left: 10px;'><a href="displaymoviedetail.php?movieid=<?php echo $rsshowlist[movieid]; ?>" ><?php echo $rsshowlist[moviename]; ?></a></b><br>
				<b style='padding-left: 10px;'><?php echo $rsshowlist[language]; ?></b><br>
				<center><a href="displaymoviedetail.php?movieid=<?php echo $rsshowlist[movieid]; ?>" style="background-color:red;width:100%;" class="wthree-btn btn-6">Book Now</a></center>
			</div>
		</div>
	<?php
	}
	?>				
		<div class="clearfix"> </div>
<!-- //Ongoing movie --></div>

                    </div>
                </div>
				<div class="panel-footer" ><a href="displaymovie.php?displaytype=OngoingMovie">View More >></a></div>
            </div>
        </div>
	</div>
</div>