<?php
include("header.php");
?>
	<!-- about -->
	<div id="about" class="about">
		<div class="container">
			<div class="col-md-12 agileits_about_grid_right">
<center><h2>Ticket Booking Report</h2></centeR>
			<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Bill No.</th>
						<th>Customer Name</th>
						<th>Booking Date</th>
						<th>Booking detail</th>
						<th>Total cost</th>
						<th>Commission Earned</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$totamt=0;
				$sql ="SELECT * FROM billing LEFT JOIN customer on billing.customerid=customer.customerid ";
				if(isset($_SESSION["customerid"]))
				{
					$sql = $sql . " and billing.customerid='$_SESSION[customerid]'";
				}
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
					
					
$sqlbookingcommission ="SELECT SUM(handlingcharge) FROM ticket_booking where billingid='$rs[0]' order by seatrow ";
$qsqlticketcommission = mysqli_query($con,$sqlbookingcommission);
$rsshowcommission = mysqli_fetch_array($qsqlticketcommission);

					
$sqlbookingrs1 ="SELECT * FROM ticket_booking where billingid='$rs[0]' order by seatrow ";
$qsqlticketbookingrs1 = mysqli_query($con,$sqlbookingrs1);
$rsshowtimedetail1 = mysqli_fetch_array($qsqlticketbookingrs1);

$sqlshowtime = "select * From showtimings LEFT JOIN showlist ON showtimings.showlistid =showlist.showlistid left join movie on movie.movieid=showlist.movieid LEFT JOIN theatre ON theatre.theatreid=showlist.theatreid WHERE showlist.status='Active' AND showtimings.showtimingid='$rsshowtimedetail1[showtimingid]'";
$qsqlshowtime = mysqli_query($con,$sqlshowtime);
$rsshowtimedetail = mysqli_fetch_array($qsqlshowtime);


$sqlcancel_booking ="SELECT * FROM cancel_booking where cancel_booking_id='$rs[0]' ";
$qsqlcancel_booking = mysqli_query($con,$sqlcancel_booking);
$rscancel_booking = mysqli_fetch_array($qsqlcancel_booking);

					echo "<tr>
						<td>$rs[billingid]</td>
						<td>$rs[customername]</td>
						<td>". date("d-M-Y",strtotime($rs[payment_date])) ."</td>
						<td>";
echo "<b>Theatre:</b> " . $rsshowtimedetail[theatrename] . "<br>"; 
echo "<b>Movie name:</b> " . $rsshowtimedetail[moviename] . "<br>"; 
echo "<b>Show Date:</b> " . date("d-M-Y",strtotime($rsshowtimedetail[datetime])) . "<br>"; 
echo "<b>Show Time:</b> " . date("h:i A",strtotime($rsshowtimedetail[datetime])) . "<br>";
						echo "</td>
						<td> <b style='color:green;'>₹";
						
						echo $rs[totalcost];
						
						echo "</b> <hr>
						<b>Payment type:</b> $rs[paymenttype]</td>";
						
						echo "<td>
						₹$rsshowcommission[0]
						</td>
						
						<td><a class='btn-btn-primary' href='billingreceipt.php?billingid=$rs[billingid]' target='_blank'>View Receipt</a><hr>";
						
$date1 = $dt;
$date2 = date("d-M-Y",strtotime($rsshowtimedetail[datetime]));

$diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

						
						
						
						echo "</td></tr>";
$totamt = $rsshowcommission[0]	+$totamt;
				}
				?>
				</tbody>
				
				<tfoot>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th>Total Commission Earned</th>
						<th>₹<?php echo $totamt; ?></th>
						<th></th>
					</tr>
				
				</tfoot>
			</table>
			
			</div>
			<div class="clearfix"> </div>
		</div> 
	</div>
	
<?php
include("footer.php");
?>
<script type="text/javascript" language="javascript" class="init">
$(document).ready(function() {
	$('#datatable').DataTable();
} );

function confirmtodelete()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{ 
       return true;
	}
	else
	{
	 return false;
	}
}
</script>