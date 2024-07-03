<?php
include("dbconnection.php");
$dt = date("Y-m-d");
?>
<style>
.index-content a:hover{
    color:black;
    text-decoration:none;
}
.index-content{
    margin-bottom:20px;
    padding:50px 0px;
    
}
.index-content .row{
    margin-top:20px;
}
.index-content a{
    color: black;
}
.index-content .card{
    background-color: #FFFFFF;
    padding:0;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius:4px;
    box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);

}
.index-content .card:hover{
    box-shadow: 0 16px 24px 2px rgba(0,0,0,0.14), 0 6px 30px 5px rgba(0,0,0,0.12), 0 8px 10px -5px rgba(0,0,0,0.3);
    color:black;
}
.index-content .card img{
    width:100%;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
}
.index-content .card h4{
    margin:20px;
}
.index-content .card p{
    margin:20px;
    opacity: 0.65;
}
.index-content .blue-button{
    width: 100px;
    -webkit-transition: background-color 1s , color 1s; /* For Safari 3.1 to 6.0 */
    transition: background-color 1s , color 1s;
    min-height: 20px;
    background-color: #002E5B;
    color: #ffffff;
    border-radius: 4px;
    text-align: center;
    font-weight: lighter;
    margin: 0px 20px 15px 20px;
    padding: 5px 0px;
    display: inline-block;
}
.index-content .blue-button:hover{
    background-color: #dadada;
    color: #002E5B;
}
@media (max-width: 768px) {

    .index-content .col-lg-4 {
        margin-top: 20px;
    }
}
</style>

<?php
error_reporting(E_ERROR | E_PARSE);
if($_GET[bdate] != "")	
{
	$now = strtotime(date("Y-m-d"));
	$your_date = strtotime($_GET[bdate]);
	if($your_date >= $now)
	{
		$bdate = $_GET[bdate];
	}
	else
	{
		$bdate = 0;
	}
}
else
{
	$bdate = date("Y-m-d");	
}
//echo $bdate;
	$sqltheatre="Select * From theatre LEFT JOIN location ON theatre.locationid= location.locationid LEFT JOIN showlist ON showlist.theatreid =theatre.theatreid WHERE theatre.status='Active' AND ('$bdate' BETWEEN showlist.startdate AND showlist.enddate) and showlist.movieid='$_GET[movieid]'  GROUP BY theatre.theatreid";
	//echo $sqltheatre;
	$qsqltheatre=mysqli_query($con,$sqltheatre);
	echo mysqli_error($con);
?>
<?php
if($bdate==0)
{
?>
<?php
}
else
{
?>
	<br><center><h2 style="color:white;">Select theatre and Time</h2></center>
	<div class="index-content">
		<div class="container">
	<?php
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
		
		
				<a href="" onclick="return false;">
					<div class="col-lg-4">
						<div class="card">
							<img src="<?php echo $picimage; ?>">
							<h4><?php echo $rstheatre[theatrename]; ?></h4>
	<?php
	error_reporting(E_ERROR | E_PARSE);
		$sqlshowtimings="Select * From showtimings LEFT JOIN showlist ON  showtimings.showlistid =showlist.showlistid WHERE  showlist.status='Active' AND showtimings.status='Active' AND showlist.movieid='$_GET[movieid]' AND showlist.theatreid='$rstheatre[theatreid]'  AND (datetime BETWEEN '$bdate 00:00:00' and '$bdate 23:59:59') ORDER by showtimings.datetime";
		$qsqlshowtimings=mysqli_query($con,$sqlshowtimings);
		echo mysqli_error($con);
		while($rsshowtimings = mysqli_fetch_array($qsqlshowtimings))
		{
			if(strtotime($dttim) >= strtotime($rsshowtimings[datetime])) 
			{
				echo "<a href=''  onclick='alert(`Booking closed`);return false;' class='blue-button' style='color:white;background-color:grey;'>". date("h:i A",strtotime($rsshowtimings[datetime])) . "</a>";
			} 
			else 
			{
				echo "<a href='bookingpanel.php?movieid=$_GET[movieid]&theatreid=$rstheatre[0]&showtimingid=$rsshowtimings[0]' class='blue-button' style='color:white;'>". date("h:i A",strtotime($rsshowtimings[datetime])) . "</a>";
			}
		}
	?> 

						</div>
					</div>
				</a>
	<?php
		}
	?>
		</div>
	</div>
<?php
}
?>
