<div class="container-fluid">
     <div class="row">
        <div class="col-xs-6 col-md-6 big-box" id="first-child">
          <!-- Modal -->
          <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
            <div class="modal-dialog" style="width:100%;">
              <div class="modal-content modal-content-one">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                  <h4 class="modal-title" id="myModalLabel">
	
				  
<input type="text" autofocus="autofocus" class="form-control my-textbox" placeholder="Search for Movies" autocomplete="off" spellcheck="false" dir="auto" style="left: 300px; position: relative; vertical-align: top;width:500px;" onkeyup="searchrecord(this.value)" >

<div class="personsMenu" id="divsearchrecord" style="left: 300px; width:514px;height: 450px; overflow-y: scroll; position: absolute;z-index: 99;background-color:white;"></div>
				  </h4>
                </div>
		





		
				
<div class="modal-body">			
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
         <a class="nav-link active" data-toggle="tab" href="#panelOngoingAll1" role="tab" >All</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panelKannada1" role="tab" >Kannada</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panelHindi1" role="tab">Hindi</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panelEnglish1" role="tab">English</a>
    </li>    
	<li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#panelTamil1" role="tab" >Tamil</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panelTelugu1" role="tab">Telugu</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panelMalayalam1" role="tab">Malayalam</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panelTulu1" role="tab">Tulu</a>
    </li>
                        </ul>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="tab-content">

<div class="tab-pane active" id="panelOngoingAll1">
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
</div

					
<div class="tab-pane" id="panelKannada1">
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
<div class="tab-pane" id="panelHindi1"><!-- Ongoing movie -->
<br> 
	<?php
	$sqlshowlist = "SELECT * FROM showlist LEFT JOIN movie ON showlist.movieid=movie.movieid WHERE '$dt' BETWEEN showlist.startdate AND showlist.enddate AND LANGUAGE LIKE '%Hindi%' group by movie.movieid   ORDER BY movie.movieid desc  limit 4";
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
<div class="tab-pane" id="panelEnglish1"><!-- Ongoing movie -->
<br> 
	<?php
	$sqlshowlist = "SELECT * FROM showlist LEFT JOIN movie ON showlist.movieid=movie.movieid WHERE '$dt' BETWEEN showlist.startdate AND showlist.enddate AND LANGUAGE LIKE '%English%' group by movie.movieid  ORDER BY movie.movieid desc  limit 0,4";
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
<div class="tab-pane" id="panelTamil1"><!-- Ongoing movie -->
<br> 
	<?php
	$sqlshowlist = "SELECT * FROM showlist LEFT JOIN movie ON showlist.movieid=movie.movieid WHERE '$dt' BETWEEN showlist.startdate AND showlist.enddate AND LANGUAGE LIKE '%Tamil%' group by movie.movieid  ORDER BY movie.movieid desc  limit 0,4";
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
<div class="tab-pane" id="panelTelugu1"><!-- Ongoing movie -->
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
<div class="tab-pane" id="panelMalayalam1"><!-- Ongoing movie -->
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
<div class="tab-pane" id="panelTulu1"><!-- Ongoing movie -->
<br>
	<?php
	$sqlshowlist = "SELECT * FROM showlist LEFT JOIN movie ON showlist.movieid=movie.movieid WHERE '$dt' BETWEEN showlist.startdate AND showlist.enddate AND LANGUAGE LIKE '%Tulu%'   group by movie.movieid ORDER BY movie.movieid desc  limit 0,4";
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
</div> 












              </div>
            </div>
          </div>
        </div>
	</div> 
  </div>

<script>
function searchrecord(searchtext)
{
	if (searchtext == "") {			
				 $("#divsearchrecord").hide(); 
        document.getElementById("divsearchrecord").innerHTML = ""; 
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				 $("#divsearchrecord").show();
                document.getElementById("divsearchrecord").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxsearch.php?searchtext="+searchtext,true);
        xmlhttp.send();
    }
}
$("#divsearchrecord").hide();
</script>