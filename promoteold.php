<?php
include("header.php");
error_reporting(0);
if($_GET[msgtype] =="msg")
{
?>
<iframe id="contact" src="http://smsc.co.in/api/mt/SendSMS?APIKey=04024e1f-2d50-4874-b1b5-b1b1d901e928&senderid=TESTIN&channel=2&DCS=0&flashsms=0&number=91<?php echo $_GET[contactno]; ?>&text=<?php echo  $_GET[movieid]; ?> - <?php echo $_GET[moviemsg]; ?>&route=1" allowtransparency="true" frameborder="0" scrolling="yes" style="visibility:Hidden;"></iframe>
<?php
}
if($_GET[msgtype] =="mail")
{
include("sendmail.php");
$toaddress = $_GET[emailid];
$subject = "Book a ticket";
$message = $_GET[moviemsg];
$name = "Movie Time";
sendmail($toaddress,$subject,$message,$name);
}
?>
	<!-- features -->
	<div id="features" class="features">
		<div class="container"> 
			<div class="w3layouts_skills_grids w3layouts-features-agileinfo">

				<div class="col-md-12 w3features-left">				

					<div id="register" class="login-form "> 
						<div class="agile-row">
							<h5>Promote Movie</h5> 
							<div class="login-agileits-top"> 	
<form  action="" method="post" name="frmpayment" > 
<p>Select Movie </p>
<select name="movieid" id="movieid" class="form-control"  >
<option value=''>Select</option>
<?php
$sqlmovie="SELECT * FROM movie LEFT JOIN showlist ON movie.movieid=showlist.movieid WHERE  showlist.movieid is NULL group by movie.movieid  ORDER BY movie.movieid DESC";
$qsqlmovie=mysqli_query($con,$sqlmovie);
echo mysqli_error($con);
while($rsmovie=mysqli_fetch_array($qsqlmovie))
{
	if($_GET[movieid] == "$rsmovie[moviename] ($rsmovie[language])")
	{
	echo "<option value='$rsmovie[moviename] ($rsmovie[language])' selected>$rsmovie[moviename] ($rsmovie[language])</option>";
	}
	else
	{
	echo "<option value='$rsmovie[moviename] ($rsmovie[language])'>$rsmovie[moviename] ($rsmovie[language])</option>";
	}
}
?>
</select>

<p>Message </p>
<textarea class="form-control" name="moviemsg" id="moviemsg"><?php echo $_GET[moviemsg]; ?></textarea>
<br>

<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Customer Name</th>
						<th>No. of bookings </th>
						<th>Email ID</th>
						<th>Contact Number</th>
						<th>Send SMS</th>
						<th>Send Mail</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sql ="SELECT *,(SELECT count(*) FROM billing where customerid-cst.customerid ) as cnt FROM customer as cst ORDER BY cnt ASC";
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
	echo "<tr>
		<td>$rs[customername]</td>
		<td>$rs[cnt]</td>
		<td>$rs[emailid]</td>
		<td>$rs[contactno]</td>
		<td>";
		?>
		<a class="btn btn-primary" onclick="window.location='promote.php?msgtype=msg&contactno=<?php echo $rs[contactno]; ?>&movieid='+movieid.value+'&moviemsg='+moviemsg.value">Send SMS</a>
	<?php
	echo "</td><td>";
	?>
		<a class="btn btn-primary" onclick="window.location='promote.php?msgtype=mail&emailid=<?php echo $rs[emailid]; ?>&movieid='+movieid.value+'&moviemsg='+moviemsg.value">Send Mail</a>
	<?php
	echo "</td></tr>";
				}
				?>
				</tbody>
			</table>




								</form> 	
							</div>  
						</div>  
					</div>  
					
					
				</div> 
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //features --> 
	<?php
include("footer.php");
?>
<script>
function funbalpayment()
{
	
	//totamt paidamt balamt
	document.getElementById("balamt").value= parseFloat(document.getElementById("totamt").value)-parseFloat(document.getElementById("paidamt").value);
}
function loadtheatre(theatreid)
{
	if (window.XMLHttpRequest) 
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("divtotamt").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET","ajaxpayment.php?theatreid="+theatreid,true);
	xmlhttp.send();
}
</script>