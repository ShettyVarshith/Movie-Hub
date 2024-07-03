<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql="DELETE FROM snacks where snacksid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) ==1);
	{
		echo "<script>alert('snacks record deleted successfully...');</script>";
	}
}
?>
	<!-- about -->
	<div id="about" class="about">
		<div class="container">
			<div class="col-md-12 agileits_about_grid_right">

			<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Item Image</th>
						<th>Theatre Name</th>
						<th>Item Name</th>
						<th>Item Description</th>
						<th>Item Cost</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sql ="SELECT * FROM snacks LEFT JOIN theatre on snacks.theatreid=theatre.theatreid where snacks.snacksid!='0' ";
				if(isset($_SESSION["theatreid"]))
				{
					$sql = $sql . " AND snacks.theatreid='$_SESSION[theatreid]' ";
				}
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
					echo "<tr>
						<td><img src='imageitem/$rs[itemimg]'
						width='150' height='100'></td>
						<td>$rs[theatrename]</td>
						<td>$rs[itemname]</td>
						<td>$rs[itemdescription]</td>
						<td>$rs[itemcost]</td>
						<td>$rs[status]</td>
						<td><a class='btn btn-primary' href='snacks.php?editid=$rs[snacksid]'>Edit</a> |
						<a class='btn btn-primary' href='viewsnacks.php?delid=$rs[snacksid]' onclick='return confirmtodelete()'>Delete</a></td>
						</tr>";				
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