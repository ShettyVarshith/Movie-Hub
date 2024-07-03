<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql="DELETE FROM tax where taxid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con)==1)
	{
		echo "<script>alert('tax record deleted successfully...');</script>";
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
						<th>Taxtype</th>
						 <th>Tax amount</th>
						  <th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sql ="SELECT * FROM  tax";
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
					echo "<tr>
						<td>$rs[taxtype]</td>
						<td>$rs[taxamt]</td>
						<td>$rs[status]</td>
						<td>
						<a class='btn btn-primary' href='tax_setting.php?editd=$rs[taxid]'>Edit </a>|
						<a class='btn btn-primary' href='viewtax_setting.php?delid=$rs[taxid]' onclick='return confirmtodelete()'>Delete</a></td>
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