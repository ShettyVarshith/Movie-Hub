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
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sql ="SELECT * FROM billing LEFT JOIN customer on billing.customerid=customer.customerid LEFT JOIN ticket_booking ON ticket_booking.billingid = billing.billingid LEFT JOIN showtimings on showtimings.showtimingid=ticket_booking.showtimingid left join showlist on showlist.showlistid=showtimings.showlistid where billing.status='Active'";
				if(isset($_SESSION["theatreid"]))
				{
					$sql = $sql ." AND showlist.theatreid='$_SESSION[theatreid]'";
				}
				if(isset($_SESSION["customerid"]))
				{
					$sql = $sql . " and billing.customerid='$_SESSION[customerid]'";
				} 
				
				$sql = $sql . " GROUP BY billing.billingid";
				//echo $sql;
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
					
$sqlbookingrs1 ="SELECT * FROM ticket_booking where billingid='$rs[0]' order by seatrow ";
$qsqlticketbookingrs1 = mysqli_query($con,$sqlbookingrs1);
$rsshowtimedetail1 = mysqli_fetch_array($qsqlticketbookingrs1);

$sqlshowtime = "select * From showtimings LEFT JOIN showlist ON showtimings.showlistid =showlist.showlistid left join movie on movie.movieid=showlist.movieid LEFT JOIN theatre ON theatre.theatreid=showlist.theatreid WHERE showlist.status='Active' AND showtimings.showtimingid='$rsshowtimedetail1[showtimingid]'";

$qsqlshowtime = mysqli_query($con,$sqlshowtime);
$rsshowtimedetail = mysqli_fetch_array($qsqlshowtime);

					echo "<tr>
						<td>$rs[billingid]</td>
						<td>$rs[customername]</td>
						<td>". date("d-M-Y",strtotime($rs[payment_date])) ."</td>
						<td>";
echo "<b>Theatre:</b> " . $rsshowtimedetail[theatrename] . "<br>"; 
echo "<b>Movie name:</b> " . $rsshowtimedetail[moviename] . "<br>"; 
echo "<b>Show Date:</b> " . date("d-M-Y",strtotime($rsshowtimedetail[datetime])) . "<br>"; 
echo "<b>Show Time:</b> " . date("h:i A",strtotime($rsshowtimedetail[datetime])) . "<br>";
			
	$amt =  $rs[totalcost] - $rs[discamt];			
	echo "</td><td> <b style='color:green;'>₹$amt</b> <hr><b>Payment type:</b> $rs[paymenttype]</td><td><a class='btn-btn-primary' href='billingreceipt.php?billingid=$rs[billingid]' target='_blank'>View Receipt</a><hr>";

	$now = strtotime($dt);
	$your_date = strtotime(date("Y-m-d",strtotime($rsshowtimedetail[datetime])));
	$datediff = $now - $your_date;
	$days =  round($datediff / (60 * 60 * 24));
	
if($days < 0)
{
	if(isset($_SESSION["customerid"]))
	{
	echo "<a href='cancel_booking.php?billingid=$rs[billingid]'>Cancel Booking</a>";
	}
}						
						echo "</td></tr>";
				}
				?>
				</tbody>
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