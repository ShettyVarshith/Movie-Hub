<?php
		$sql="DELETE FROM ticket_booking where status='Pending'";
		$qsql=mysqli_query($con,$sql);
		echo mysqli_error($con);
?>
<script src="seatcss/modernizr.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="seatcss/normalize.min.css">
<link rel="stylesheet" href="seatcss/style.css">
<?php
$arrrowno  = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
?>

<div class="col-md-12">
	
	<div class="col-md-12">
	
		<div class="plane">
		  <div class="cockpit">
			<h1>Screen</h1>	
		  </div>
		  <?php
		  /*
		  <div class="exit exit--front fuselage">
		  </div>
		  */
		  ?>
			<center>
		  <ol class="cabin fuselage">
		  
<?php
$rowno=0;
$sqlseat="SELECT * FROM seattype where status='active'  ";
$sqlseat = $sqlseat . " AND seattype.theatreid='$_GET[theatreid]' AND seattype.screenno='$screenno' ORDER BY seattype.seattypeid ASC";
//echo $sqlseat;
$qsqlseat=mysqli_query($con,$sqlseat);
echo mysqli_error($con);
while($rsseat=mysqli_fetch_array($qsqlseat))
{
	echo "<center style='padding:5px;'><h4><u>$rsseat[seattype]</u> - Cost : ₹$rsseat[cost]</h4></center>";
	
		$sqlseatno = "SELECT * FROM seat_setting WHERE status='Active' AND theatreid='$_GET[theatreid]' AND screenno='$screenno' AND seattypeid='$rsseat[seattypeid]' GROUP BY theatreid,screenno,seattypeid,seatrow ORDER BY seatrow asc ";
		//echo $sqlseatno;
		$qsqlseatno = mysqli_query($con,$sqlseatno);
		echo mysqli_error($con);
		while($rsseatno = mysqli_fetch_array($qsqlseatno))
		{
?>
<li class="row row--<?php echo $rsseatno[seatrow]; ?>" style="margin-right: 5px;margin-left: 5px;">
			  <ol class="seats" type="A">
			  <li class="seat" style="max-width:150px;">
				  <?php echo $arrrowno[$rowno]; 
				  ?>
				</li>
<?php
			$sqlseatnos = "SELECT * FROM seat_setting WHERE status='Active'  AND screenno='$rsseatno[screenno]' AND seattypeid='$rsseatno[seattypeid]' AND seatrow='$rsseatno[seatrow]' ORDER BY seatid asc ";
			//echo $sqlseatno;
			$qsqlseatnos = mysqli_query($con,$sqlseatnos);
			echo mysqli_error($con);
			while($rsseatnos = mysqli_fetch_array($qsqlseatnos))
			{
//Coding to check ticket booking is done or not..				
$sqlticket_booking = "SELECT * FROM ticket_booking LEFT JOIN showtimings ON ticket_booking.showtimingid=showtimings.showtimingid WHERE ticket_booking.showtimingid='$_GET[showtimingid]' AND ticket_booking.seatid='$rsseatnos[seatid]' AND ticket_booking.status='Active' ";
$qsqlticket_booking  = mysqli_query($con,$sqlticket_booking);
$rssqlticket_booking = mysqli_fetch_array($qsqlticket_booking);
?>
				<?php
			if($rsseatnos[seatno] == 0)
			{
				?>
				<li class="seat">
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</li>
				<?php
			}
			else if(mysqli_num_rows($qsqlticket_booking) >= 1)
			{
			?>
<li class="seat">
		  <input type="checkbox" disabled id="chk<?php echo $rsseatnos[seatid]; ?>" onchange="seatbooking('<?php echo $rsseatnos[seatid]; ?>','<?php echo $rsshowtimings[0]; ?>','<?php echo $arrrowno[$rowno]; ?>','<?php echo $rsseatnos[seatno]; ?>','<?php echo $rsseat[cost]; ?>')" />
		  <label for="chk<?php echo $rsseatnos[seatid]; ?>"><?php echo $rsseatnos[seatno]; ?></label>
</li>
			<?php
			}
			else
			{	
				?>
				<li class="seat">
				  <input type="checkbox" id="chk<?php echo $rsseatnos[seatid]; ?>" onchange="seatbooking('<?php echo $rsseatnos[seatid]; ?>','<?php echo $rsshowtimings[0]; ?>','<?php echo $arrrowno[$rowno]; ?>','<?php echo $rsseatnos[seatno]; ?>','<?php echo $rsseat[cost]; ?>')" />
				  <label for="chk<?php echo $rsseatnos[seatid]; ?>"><?php echo $rsseatnos[seatno]; ?></label>
				</li>
			<?php
			}
			?>			
				<?php
				/*
				<li class="seat">
				  <input type="checkbox" disabled id="1D" />
				  <label for="1D">Occupied</label>
				</li>
				*/
				?>
<?php

			}
?>
			  </ol>
</li>
<?php
				  $rowno = $rowno +1;
		}
	echo "<hr>";
}
?>
		  
		
		 </ol>
			</center>
		 <?php
		  /*
		  <div class="exit exit--back fuselage">
		  </div>
		  */
		  ?>
		</div>
	
	</div>
	
	<div class="col-md-6">
		<table>
		
						<tr>
							<td colspan="2" style="font-size:20px;"><centeR>Booking  detail</center></td>
						</tr>
						<tr>
							<td style="font-size:20px;">Booking  date  &nbsp; </td>
							<td style="background-color:white; color:black;padding:10px;"><?php echo date("d-M-Y",strtotime($rsshowtimings[datetime])); ?></td>
						</tr>
						
						<tr>
							<td style="font-size:20px;">Booking  Time  &nbsp; </td>
							<td style="background-color:white; color:black;padding:10px;"><?php echo date("h:i A",strtotime($rsshowtimings[datetime])); ?></td>
						</tr>
		</table>
	</div>
	<div class="col-md-6">
		<centeR style="font-size:20px;">Booking Report</center>
		<div id="divbooking">
		</div>
	</div>
	
</div>
<script>
function seatbooking(seatid,showtimingsid,rowno,seatno,cost)
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
			document.getElementById("divbooking").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET","ajaxticket_booking.php?seatid="+seatid+"&showtimingsid="+showtimingsid+"&rowno="+rowno+"&seatno="+seatno+"&cost="+cost,true);
	xmlhttp.send();

}
</script>