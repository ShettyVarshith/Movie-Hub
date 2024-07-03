<?php
error_reporting(0);
include("dbconnection.php");
//ajaxseat.php?theatreid="+theatreid+"&screenno="+screenno+"&seattypeid="+seattypeid+"&seatrow="+seatrow+"&btnaddseat=btnrename"+"&blocktype="+blocktype+"&seatno="+seatno+"&seatrename="+seatrename
if(isset($_GET[btndelseat]))
{
	 $sqlseat_settingseatrow = "Delete from seat_setting WHERE seatid='$_GET[seatno]'";
	mysqli_query($con,$sqlseat_settingseatrow);
	echo mysqli_error($con);
}
if(isset($_GET[btnrename]))
{
	$sqlseat_settingseatrow = "UPDATE seat_setting SET seatno='$_GET[seatrename]' WHERE seatid='$_GET[seatno]'";
	mysqli_query($con,$sqlseat_settingseatrow);
	echo mysqli_error($con);
}

if(isset($_GET[btnaddseatrow]))
{
	$sqlseat_settingseatrow = "SELECT MAX(seatrow) FROM seat_setting WHERE theatreid='$_GET[theatreid]' AND screenno='$_GET[screenno]' AND seattypeid='$_GET[seattypeid]' AND status='Active'";
	$qsqlseat_settingseatrow = mysqli_query($con,$sqlseat_settingseatrow);
	$rsseat_settingseatrow=mysqli_fetch_array($qsqlseat_settingseatrow);
	$rowno = $rsseat_settingseatrow[0];
	$rowno = $rowno+1;
	
	$sql ="INSERT INTO seat_setting(theatreid,screenno,seattypeid,seatno,seatrow,status) VALUES('$_GET[theatreid]','$_GET[screenno]','$_GET[seattypeid]','1','$rowno','Active')";
	$qsql = mysqli_query($con,$sql);
}

if(isset($_GET[btnaddseat]))
{
	if($_GET[blocktype] == "seat")
	{
		$sql = "SELECT * FROM seat_setting WHERE theatreid='$_GET[theatreid]' AND screenno='$_GET[screenno]' AND seattypeid='$_GET[seattypeid]' AND seatrow='$_GET[seatrow]' and seatno!='0' AND status='Active'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		$seatno = mysqli_num_rows($qsql) + 1 ;
	}
	else
	{
		$seatno = 0;
	}
	$sql ="INSERT INTO seat_setting(theatreid,screenno,seattypeid,seatno,seatrow,status) VALUES('$_GET[theatreid]','$_GET[screenno]','$_GET[seattypeid]','$seatno','$_GET[seatrow]','Active')";
	$qsql = mysqli_query($con,$sql);
}
	if(isset($_GET[theatreid]))
	{
		$theatreid = $_GET[theatreid];
	}
	else
	{
		$theatreid = $rsseat[theatreid];
	}
	
	if(isset($_GET[screenno]))
	{
		$screenno = $_GET[screenno];
	}
	else
	{
		$screenno = $rsseat[screenno];
	}
	
	if(isset($_GET[seattypeid]))
	{
		$seattypeid = $_GET[seattypeid];
	}
	else
	{
		$seattypeid = $rsseat[seattypeid];
	}
	
	if(isset($_GET[seatrow]))
	{
		$seatrow = $_GET[seatrow];
	}
	else
	{
		$seatrow = $rsseat[theatreid];
	}
$sqlseatno = "SELECT * FROM seat_setting WHERE status='Active' AND theatreid='$_GET[theatreid]' AND screenno='$_GET[screenno]' AND seattypeid='$seattypeid' GROUP BY theatreid,screenno,seattypeid,seatrow ORDER BY seatrow asc ";
//echo $sqlseatno;
$qsqlseatno = mysqli_query($con,$sqlseatno);
echo mysqli_error($con);
while($rsseatno = mysqli_fetch_array($qsqlseatno))
{
?>
	<div class="col-md-12 panel panel-default" >
	<?php
	echo "<span style='background-color: violet;color:white; padding:5px;'>Seat Row: ".$rsseatno[seatrow] ."  </span> &nbsp;";
	?>
	<?php
		$sqlseatnos = "SELECT * FROM seat_setting WHERE status='Active'  AND screenno='$rsseatno[screenno]' AND seattypeid='$rsseatno[seattypeid]' AND seatrow='$rsseatno[seatrow]' ORDER BY seatid asc ";
		//echo $sqlseatno;
		$qsqlseatnos = mysqli_query($con,$sqlseatnos);
		echo mysqli_error($con);
		while($rsseatnos = mysqli_fetch_array($qsqlseatnos))
		{
	?>
			<button type="button" id="btnseatnos<?php echo $rsseatnos[0]; ?>" class="btn" data-toggle="modal" data-target="#myModal<?php echo $rsseatnos[0]; ?>"><?php 
				if($rsseatnos[seatno] == '0')
				{
					echo "-";
				}
				else
				{
				echo $rsseatnos[seatno]; 
				} 
				?>
			</button>
			
			<div class="modal fade" id="myModal<?php echo $rsseatnos[0]; ?>" role="dialog">
				<div class="modal-dialog">
				  <!-- Modal content-->
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Update seat number..</h4>
					</div>
					<div class="modal-body">
					  <?php
					  if($rsseatnos[seatno] == '0')
							{
								echo "Empty seats cannot be updated..";
							}
							else
							{
						?>
					  <p>
<input type="text" name="seatno<?php echo $rsseatnos[0]; ?>" id="seatno<?php echo $rsseatnos[0]; ?>" value="<?php echo $rsseatnos[seatno]; ?>" class="form-control" >
						</p>
						<p>
<button type="button" class="btn btn-default" data-dismiss="modal"  style="float: right;"  onclick="renameseat('<?php echo $rsseatno[theatreid]; ?>','<?php echo $rsseatno[screenno]; ?>','<?php echo $rsseatno[seattypeid]; ?>','<?php echo $rsseatno[seatrow]; ?>','rename','<?php echo $rsseatnos[0]; ?>',seatno<?php echo $rsseatnos[0]; ?>.value)">Update seat No.</button>
							<br>
					  </p>
					  <?php
							}
					?>
					</div>
					<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal"  style="float: left;"   onclick="deleteseat('<?php echo $rsseatno[theatreid]; ?>','<?php echo $rsseatno[screenno]; ?>','<?php echo $rsseatno[seattypeid]; ?>','<?php echo $rsseatno[seatrow]; ?>','delete','<?php echo $rsseatnos[0]; ?>','0')">Delete</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				  </div>
				</div>
			</div>
			
	<?php
		}
	?>		
				
			<button type="button" class="btn btn-primary" onclick="addseat('<?php echo $rsseatno[theatreid]; ?>','<?php echo $rsseatno[screenno]; ?>','<?php echo $rsseatno[seattypeid]; ?>','<?php echo $rsseatno[seatrow]; ?>','seat')" >Add Seat</button>
			<button type="button" class="btn btn-primary" onclick="addseat('<?php echo $rsseatno[theatreid]; ?>','<?php echo $rsseatno[screenno]; ?>','<?php echo $rsseatno[seattypeid]; ?>','<?php echo $rsseatno[seatrow]; ?>','emptyspace')" >Add Empty space</button>
	</div>
<?php
}
?>

<?php
/*
btnseatnos<?php echo $rsseatnos[0]; ?> 
addseatname('<?php echo $rsseatnos[seatno]; ?>',seatno<?php echo $rsseatnos[0]; ?>.value)
*/
?>