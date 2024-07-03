<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql="DELETE FROM showlist where showlistid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) ==1);
	{
		echo "<script>alert('showlist record deleted successfully...');</script>";
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
					   <th>Movie Name</th>
						<th>Theatre Name</th>
						<th>Screen No</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sql ="SELECT * FROM  showlist LEFT JOIN movie on showlist.movieid=movie.movieid LEFT JOIN theatre on showlist.theatreid=theatre.theatreid WHERE showlist.showlistid!=0 ";
				if(isset($_SESSION[theatreid]))
				{
					$sql= $sql . " AND showlist.theatreid='$_SESSION[theatreid]'";
				}
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
					echo "<tr>
						<td>$rs[moviename]($rs[language])</td>
						<td>$rs[theatrename]</td>
						<td>$rs[screenid]</td>
						<td>$rs[startdate]</td>
						<td>$rs[enddate]</td>
						<td>$rs[status]</td>
						<td><a class='btn btn-primary' href='showlist.php?editid=$rs[showlistid]'>Edit<a/> |<a class='btn btn-primary' href='viewshowlist.php?delid=$rs[showlistid]' onclick='return confirmtodelete()'>Delete</td>
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