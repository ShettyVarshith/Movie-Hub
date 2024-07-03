<?php
include("header.php");
 
if(isset($_GET[theatrest]))
{
	$sql = "UPDATE theatre SET status='$_GET[theatrest]' WHERE theatreid='$_GET[theatreid]'";
	$qsql  = mysqli_query($con,$sql);
	echo "<script>alert('Theatre status updated successfully...');</script>";
	echo 
"<script>window.location='viewtheatre.php?theatretype=Pe
nding';</script>";
}
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM theatre where theatreid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Theatre record deleted successfully...');</script>";
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
			<th>Theatre logo</th>
			<th>Theatre image</th>
			<th>Theatre name</th>
			<th>location Name</th>
			<th>Address</th>
			<th>Contact</th>
			<th>status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT * FROM  theatre LEFT JOIN location ON theatre.locationid = location.locationid";
	if($_GET[theatretype] == "Pending")
	{
		$sql = $sql . " WHERE theatre.status='Pending' ";
	}
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		if(file_exists("imgtheatrelogo/$rs[theatrelogo]"))
		{
		$logoimg = "imgtheatrelogo/$rs[theatrelogo]";
		}
		else
		{
		$logoimg = "images/No_Image_Available.jpg";
		}
		if(file_exists("imgtheatrelogo/$rs[theatreimg]"))
		{
		$picimage="imgtheatrelogo/$rs[theatreimg]";
		}
		else
		{
		$picimage="images/No_Image_Available.jpg";
		}

		echo "<tr>
			<td><img src='$logoimg' width='150px' height='100px;' ></td>
			<td><img src='$picimage' width='150px' height='100px;'></td>
			<td>$rs[theatrename]</td>
			<td>$rs[location]</td>
			<td>$rs[address]</td>	
			<td>
			<b>Email ID:</b> $rs[emailid]<br>
			<b>Mobile No.</b> $rs[mobileno]</td>
			<td>$rs[11]<br>";
if($_GET[theatretype] == "Pending")
{
	echo "<a class='btn btn-primary' href='viewtheatre.php?theatreid=$rs[theatreid]&theatrest=Active' >Activate</a>";
}
			echo "</td>
			<td> 
			<a class='btn btn-primary' href='theatre.php?editid=$rs[theatreid]' >Edit</a> | 
			<a  class='btn btn-primary' href='viewtheatre.php?delid=$rs[theatreid]' onclick='return confirmtodelete()' >Delete</a></td>
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
});

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