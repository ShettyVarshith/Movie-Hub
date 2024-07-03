<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql="DELETE FROM showtimings where showtimingid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) ==1);
	{
		echo "<script>alert('showtimings record deleted successfully...');</script>";
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
						<th>Theatre</th>
						<th>Movie</th>
						<th>Screen No.</th>
						<th>Date time</th>
						<th>status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody> 
				<?php
				$sql ="SELECT * FROM showtimings LEFT JOIN showlist on showtimings.showlistid =showlist.showlistid LEFT JOIN theatre ON theatre.theatreid=showlist.theatreid LEFT JOIN movie ON  movie.movieid=showlist.movieid WHERE showtimings.showtimingid!='0' ";
				if(isset($_SESSION[theatreid]))
				{
					$sql= $sql . " AND showlist.theatreid='$_SESSION[theatreid]'";
				}
				//echo $sql;
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
					echo "<tr>
						<td>$rs[theatrename]</td>
						<td>$rs[moviename]</td>
						<td>$rs[screenid]</td>
						<td>" . date("d-M-Y h:i A",strtotime($rs[datetime])) . "</td>
						<td>$rs[status]</td>
						<td><a class='btn btn-primary' href='showtimings.php?editid=$rs[showtimingid]'>Edit</a> |
						<a class='btn btn-primary' href='viewshowtimings.php?delid=$rs[showtimingid]' onclick='return confirmtodelete()'>Delete</a></td>
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