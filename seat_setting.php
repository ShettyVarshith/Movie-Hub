<?php
include("header.php");
//This code is to select data while updating
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM seat_setting WHERE seatid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//This code is to select data while updating ends here
?>
	<!-- features -->
	<div id="features" class="features">
		<div class="container"> 
			<div class="w3layouts_skills_grids w3layouts-features-agileinfo">

				<div class="col-md-12 w3features-left">				

					<div id="register" class="login-form "> 
						<div class="agile-row">
							<h5>Seat Map</h5> 
							<div class="login-agileits-top"> 	
<form  action="" method="get"> 
	
	<?php
	if(isset($_SESSION[theatreid]))								
	{
	?>
		<input type="hidden" name="theatreid" id="theatreid" value="<?php echo $_SESSION[theatreid]; ?>" />
	<em id="idtheatreid" style="color:red;" class="ms-error"></em>
	<?php
	}
	else
	{
	?>
	<p>Theatre name </p>
	<select name="theatreid" class="form-control"  >
		<option value=''>select</option>
		<?php
		$sqltheatre="SELECT * FROM theatre where status='active'";
		$qsqltheatre=mysqli_query($con,$sqltheatre);
		echo mysqli_error($con);
		while($rstheatre=mysqli_fetch_array($qsqltheatre))
		{
			if($rstheatre[theatreid] == $rsedit[theatreid])
			{
			echo "<option value='$rstheatre[theatreid]' selected>$rstheatre[theatrename]</option>";
			}
			else
			{
			echo "<option value='$rstheatre[theatreid]'>$rstheatre[theatrename]</option>";
			}
		}
		?>
	</select>
	<em id="idtheatreid" style="color:red;" class="ms-error"></em>
	<?php
	}
	?>							

	<p>Screen number</p>
	<select name="screenno" class="form-control" onchange="loadseattype(this.value)" >
		<option value=''>Select screen Number</option>
		<?php
			$sqlseat="SELECT * FROM seattype where status='active'  ";
			if(isset($_SESSION[theatreid]))
			{
				$sqlseat = $sqlseat . " AND seattype.theatreid='$_SESSION[theatreid]'";
			}
			$sqlseat = $sqlseat . " GROUP BY screenno";
			$qsqlseat=mysqli_query($con,$sqlseat);
			echo mysqli_error($con);
			while($rsseat=mysqli_fetch_array($qsqlseat))
			{
				if($rsseat[screenno] == $_GET[screenno])
				{
					echo "<option value='$rsseat[screenno]' selected>$rsseat[screenno]</option>";
				}
				else
				{
					echo "<option value='$rsseat[screenno]'>$rsseat[screenno]</option>";
				}
			}
		?>
	</select>

	<input type="submit" name="submit" value="Load record" >
</form> 	
							</div>  
						</div>  
					</div>  
					
				
					
				</div> 
				<div class="clearfix"> </div>
			</div>
		</div>
		
		<hr>
<?php
if(isset($_GET[submit]))
{
?>
		<center style="color:red;"><h2>Seat Settings</h2></center><br>		
		<div class="container">	
<?php
$sqlseat="SELECT * FROM seattype where status='active'  ";
$sqlseat = $sqlseat . " AND seattype.theatreid='$_SESSION[theatreid]' AND seattype.screenno='$_GET[screenno]' ORDER BY seattype.seattypeid DESC";
//echo $sqlseat;
$qsqlseat=mysqli_query($con,$sqlseat);
echo mysqli_error($con);
while($rsseat=mysqli_fetch_array($qsqlseat))
{
	echo "<center style='padding:5px;'><h4><u>$rsseat[seattype]</u></h4></center>";
?>
	<div class="seattype" id='divseat<?php echo $rsseat[seattypeid]; ?>'>
		<?php 
		include("ajaxseat.php");
		?>
	</div>
<?php
	echo "<button type='button' class='btn  btn-info' onclick='addrow(`$_GET[theatreid]`,`$_GET[screenno]`,`$rsseat[0]`)'>Add Row</button><hr>";
}
?>
		</div>  
					
<div class='col-md-12' style='background-color:blue;height:50px;color:white;'><br><center><b>Screen</b></center></div>					
<?php
}
?>
	</div> 
				<div class="clearfix"> </div>
	<!-- //features --> 
<script>
function addrow(theatreid,screenno,seattypeid)
{
        if (window.XMLHttpRequest) 
		{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } 
		else 
		{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("divseat"+seattypeid).innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxseat.php?theatreid="+theatreid+"&screenno="+screenno+"&seattypeid="+seattypeid+"&btnaddseatrow=set",true);
        xmlhttp.send();
}
function addseat(theatreid,screenno,seattypeid,seatrow,blocktype)
{

        if (window.XMLHttpRequest) 
		{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } 
		else 
		{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("divseat"+seattypeid).innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxseat.php?theatreid="+theatreid+"&screenno="+screenno+"&seattypeid="+seattypeid+"&seatrow="+seatrow+"&btnaddseat=btnaddseat"+"&blocktype="+blocktype,true);
        xmlhttp.send();

}
function deleteseat(theatreid,screenno,seattypeid,seatrow,blocktype,seatno,seatrename)
{
	//alert(theatreid + "-" + screenno + "-" + seattypeid + "-" + seatrow + "-" + blocktype + "-" + seatno + "-" + seatrename);
	    if (window.XMLHttpRequest) 
		{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } 
		else 
		{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				//alert(this.responseText);
                document.getElementById("divseat"+seattypeid).innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxseat.php?theatreid="+theatreid+"&screenno="+screenno+"&seattypeid="+seattypeid+"&seatrow="+seatrow+"&btndelseat=btndelseat"+"&blocktype="+blocktype+"&seatno="+seatno+"&seatrename="+seatrename,true);
        xmlhttp.send();
}


function renameseat(theatreid,screenno,seattypeid,seatrow,blocktype,seatno,seatrename)
{
	//alert(theatreid + "-" + screenno + "-" + seattypeid + "-" + seatrow + "-" + blocktype + "-" + seatno + "-" + seatrename);

	    if (window.XMLHttpRequest) 
		{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } 
		else 
		{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				//alert(this.responseText);
                document.getElementById("divseat"+seattypeid).innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxseat.php?theatreid="+theatreid+"&screenno="+screenno+"&seattypeid="+seattypeid+"&seatrow="+seatrow+"&btnrename=btnrename"+"&blocktype="+blocktype+"&seatno="+seatno+"&seatrename="+seatrename,true);
        xmlhttp.send();
}
</script>
	
<style>
.seattype {
    border: 1px solid #73AD21;  
}
	
.floating-box {
    display: inline-block;
    height: 25px;
    margin: 1px;
    border: 3px solid #73AD21;  
	text-align: center;
}
.after-box {
    border: 3px solid red; 
}
</style>
<?php
include("footer.php");
?>