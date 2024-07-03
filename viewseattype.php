<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql="DELETE FROM seattype where seattypeid=$_GET[delid]";
	$qsql=mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) ==1)
	{
		echo "<script>alert('seat type record deleted successfully..');</script>";
	}
}

?>
	<!-- about -->
	<div id="about" class="about">
		<div class="container">
			<div class="col-md-12 agileits_about_grid_right">

<?php
$sqlseattype ="SELECT * FROM seattype LEFT JOIN theatre on seattype.theatreid=theatre.theatreid WHERE seattype.seattypeid!='0' ";
if(isset($_SESSION[theatreid]))
{
	$sqlseattype = $sqlseattype . " AND seattype.theatreid='$_SESSION[theatreid]'";
}
$sqlseattype  = $sqlseattype . " GROUP by seattype.screenno";
$qsqlseattype = mysqli_query($con,$sqlseattype);
while($rsseattype = mysqli_fetch_array($qsqlseattype))
{
?>
<div class="panel panel-default">
		<table class="table table-striped table-bordered" cellspacing="0" width="100%" >
			<thead>
				<tr>
					<th>Screen No -  <?php echo $rsseattype[screenno]; ?></th>
				</tr>
			</thead>
		</table>
			<table class="table table-striped table-bordered"  style="border: 1px solid black;" width="100%" >
				<thead>
					<tr>
						<?php
						if(isset($_SESSION["adminid"]))
						{
						?>
						<th>Theatre Name</th>
						<?php
						}
						?>
						<th>Seat Type</th>
						<th>Screen No</th>
						<th>Cost</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sql ="SELECT * FROM seattype LEFT JOIN theatre on seattype.theatreid=theatre.theatreid WHERE seattype.screenno='$rsseattype[screenno]' ";
				if(isset($_SESSION[theatreid]))
				{
					$sql = $sql . " AND seattype.theatreid='$_SESSION[theatreid]'";
				}
				
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
					echo "<tr>";
					if(isset($_SESSION["adminid"]))
						{
					echo "<td>$rs[theatrename]</td>";
						}
					echo "<td>$rs[seattype]</td>
						<td>$rs[screenno]</td>
						<td>₹ $rs[cost]</td>
						<td>$rs[status]</td>
						<td><a class='btn btn-primary' href='seattype.php?editid=$rs[seattypeid]'>Edit</a> |
						<a class='btn btn-primary' href='viewseattype.php?delid=$rs[seattypeid]' onclick='return confirmtodelete()'>Delete</a></td>
						</tr>";
				}
				?>
				</tbody>
			</table>
</div>	
			<hr>		
<?php
}
?>			
			
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