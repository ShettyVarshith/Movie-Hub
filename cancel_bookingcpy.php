<?php
include("header.php");
error_reporting(0);
if(isset($_POST[submit]))
{	//Insert statement starts here

	$sql = "INSERT INTO cancel_booking (billingid,date,cancellationamt,status,acholder,bankname,acnumber,ifsccode) VALUES ('$_GET[billingid]','$dt','$_POST[cancellationamt]','Active','$_POST[acholder]','$_POST[bankname]','$_POST[acnumber]','$_POST[ifsccode]')";
	$qsql = mysqli_query($con,$sql);
    echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	  {
		$sqlcustomer="SELECT * FROM customer WHERE customerid='$_SESSION[customerid]'";
		$qsqlcustomer = mysqli_query($con,$sqlcustomer);
		$rscustomer = mysqli_fetch_array($qsqlcustomer);

$msg = "Movie Hub..".$_POST[msg];
//echo $mailmsg = $_POST[mailmsg];
sendmail($rscustomer[emailid],"Ticket Booking Receipt..",$msg,"Movie Hub..")

?>
<iframe id="contact" src="http://smsc.co.in/api/mt/SendSMS?APIKey=04024e1f-2d50-4874-b1b5-b1b1d901e928&senderid=TESTIN&channel=2&DCS=0&flashsms=0&number=91<?php echo $rscustomer[contactno]; ?>&text=<?php echo $msg; ?>&route=1" allowtransparency="true" frameborder="0" scrolling="yes" style="visibility:Hidden;"></iframe>
<?php	
			
			$sql="UPdATE billing set status='Cancelled' where billingid='$_GET[billingid]'";
			mysqli_query($con,$sql);
			$sql="UPdATE ticket_booking set status='Cancelled' where billingid='$_GET[billingid]'";
			mysqli_query($con,$sql);
			$sql="UPdATE foodorder set status='Cancelled' where billingid='$_GET[billingid]'";
			mysqli_query($con,$sql);
			
		echo "<SCRIPT>alert('Cancellation request sent successfully.. Amount will be refunded in 2-3 working days....');</SCRIPT>";
		echo "<script>window.location='viewcancel_booking.php';</script>";
	  }
}



//This code is to select data while updating

	$sqledit = "SELECT * FROM billing WHERE billingid='$_GET[billingid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);

//This code is to select data while updating ends here	


$sqlbookingrs1 ="SELECT * FROM ticket_booking where  billingid='$_GET[billingid]' order by seatrow ";
$qsqlticketbookingrs1 = mysqli_query($con,$sqlbookingrs1);
$rsshowtimedetail1 = mysqli_fetch_array($qsqlticketbookingrs1);

$sqlshowtime = "select * From showtimings LEFT JOIN showlist ON showtimings.showlistid =showlist.showlistid left join movie on movie.movieid=showlist.movieid LEFT JOIN theatre ON theatre.theatreid=showlist.theatreid WHERE showlist.status='Active' AND showtimings.showtimingid='$rsshowtimedetail1[showtimingid]'";
$qsqlshowtime = mysqli_query($con,$sqlshowtime);
$rsshowtimedetail = mysqli_fetch_array($qsqlshowtime);
?>

<!-- features -->
	<div id="features" class="features">
		<div class="container"> 
			<div class="w3layouts_skills_grids w3layouts-features-agileinfo">
                <div class="col-md-12 col-sm-12 w3features-right">			

					<div class="login-form agileits-right idregister"> 
						<div class="agile-row">
							<h5>Confirm before Cancellation</h5> 
							<div class="login-agileits-top" id="divreceipt"> 	
								<form  action="" method="post"> 
								
<div class="panel panel-default" style="padding:15px;">		
<?php
echo "<b>Theatre:</b> " . $rsshowtimedetail[theatrename] . "<br>"; 
echo "<b>Movie name:</b> " . $rsshowtimedetail[moviename] . "<br>";
echo "<b>Screen:</b> " . $rsshowtimedetail[screenid] . "<br>"; 
echo "<b>Show Date:</b> " . date("d-M-Y",strtotime($rsshowtimedetail[datetime])) . "<br>"; 
echo "<b>Show Time:</b> " . date("h:i A",strtotime($rsshowtimedetail[datetime])) . "<br>"; 
?>
<?php
$cost= 0;
$bookingrow="";
$sqlbookingrs ="SELECT * FROM ticket_booking where  billingid='$_GET[billingid]'  order by seatrow ";
$qsqlticketbookingrs = mysqli_query($con,$sqlbookingrs);
$totticket = mysqli_num_rows($qsqlticketbookingrs);
while($rsbookingrs = mysqli_fetch_array($qsqlticketbookingrs))
{
	if($rsbookingrs[seatrow] != $bookingrow )
	{
		echo "<hr>";
		echo "<b>Cost : </b> ₹$rsbookingrs[cost]";
		echo "<br><b>Row : </b> $rsbookingrs[seatrow] <br>";
		echo "<b>Seat No. </b> $rsbookingrs[seatno]";
	}
	else
	{
		echo ", $rsbookingrs[seatno]";
	}
	if($rsbookingrs[seatrow] != $bookingrow )
	{
		$bookingrow = $rsbookingrs[seatrow];
	}
	$cost = $cost + $rsbookingrs[cost];
}
?>
</div>

<hr>
<div class='panel panel-default' style="padding:5px;">
	<?php
	echo "<b>Booking Fee : </b> ₹".  $bookingfee = $totticket * $bookingfee ."<br>";
	echo "<b>Tax Amount ($taxpercentage%):  </b> ₹".  $taxamt = (sprintf('%0.2f', $bookingfee*$taxpercentage / 100, 0));
	echo "<hr><b style='color:green;'>Total Cost - ₹" . $_GET[cost] = $cost + $bookingfee + $taxamt  . "</b>";
	?>
</div>

<hr>
<div class='panel panel-default' style="padding:5px;">
<b>Food Order</b><hr>
<?php
$sql ="SELECT * FROM  foodorder LEFT JOIN customer on foodorder.customerid = customer.customerid LEFT JOIN snacks on foodorder.snacksid=snacks.snacksid where  foodorder.billingid='$_GET[billingid]'"; 
$qsql = mysqli_query($con,$sql);
$totfoodcost =0;
while($rs = mysqli_fetch_array($qsql))
{
	echo "<b style='color:grey;'>$rs[itemname]</b> | <b>Cost-</b> ₹$rs[cost] <br> <b>Qty:</b> $rs[qty]<br>  
			<b>Total :</b> ₹" . $rs[cost]*$rs[qty] . "<hr>";
			$totfoodcost = $totfoodcost + ($rs[cost]*$rs[qty]);
}
?></div>
<hr>
<div class='panel panel-default' style="padding: 10px;">

<?php
if($rsedit[discamt] > 0)
{
?>
	<b>Total Amount : </b> ₹<?php echo $_GET[cost]+$totfoodcost; ?><hr>
	
	<b>Discount Amount : </b> ₹<?php echo $rsedit[discamt]; ?><hr>
	
	<b>Paid Amount : </b> ₹<?php echo $paidamt=$_GET[cost]+$totfoodcost-$rsedit[discamt]; ?><hr>
<?php
}
else
{
?>
	<b>Paid Amount : </b> ₹<?php echo $paidamt= $_GET[cost]+$totfoodcost; ?><hr>
<?php
}
?>
	<b>Payment date : </b> <?php echo date("d-M-Y",strtotime($rsedit[payment_date])); ?><hr>
	<b>Payment type :</b> <?php echo $rsedit[paymenttype]; ?><hr>
</div>
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


<!-- features -->
<div id="features" class="features">
	<div class="container"> 
		<div class="w3layouts_skills_grids w3layouts-features-agileinfo">

			<div class="col-md-12 w3features-left">				

				<div id="register" class="login-form "> 
					<div class="agile-row">
						<h5>Cancellation Form</h5> 
						<div class="login-agileits-top"> 	
							<form  action="" method="post" name="cancelfrm" onsubmit="return validateform()">
<?php							
$mailmsg  = "<center>Movie Time<center>
<b> booking has been cancelled..</b><br>";
$mailmsg  = "<br>". $mailmsg. " Theatre:" . $rsshowtimedetail[theatrename].".. ";
$mailmsg  = "<br>". "<br>". $mailmsg . "Movie name: " . $rsshowtimedetail[moviename].".. ";
$mailmsg  = "<br>". $mailmsg ."Screen: " . $rsshowtimedetail[screenid].".. ";
$mailmsg  = "<br>". $mailmsg ."Show Date: " . date("d-M-Y",strtotime($rsshowtimedetail[datetime])).".. "; 
$mailmsg  = "<br>". $mailmsg ."Show Time: " . date("h:i A",strtotime($rsshowtimedetail[datetime])).".. "; 
$mailmsg = "<br>". $mailmsg . $seatnos."...";
$mailmsg = "<br>". $mailmsg. " Amount - ".$totamt;

$msg  = "booking has been cancelled...";
$msg  = $msg. " Theatre:" . $rsshowtimedetail[theatrename].".. ";
$msg  = $msg . "Movie name: " . $rsshowtimedetail[moviename].".. ";
$msg  = $msg ."Screen: " . $rsshowtimedetail[screenid].".. ";
$msg  = $msg ."Show Date: " . date("d-M-Y",strtotime($rsshowtimedetail[datetime])).".. "; 
$msg  = $msg ."Show Time: " . date("h:i A",strtotime($rsshowtimedetail[datetime])).".. "; 
$msg = $msg . $seatnos."...";
$msg = $msg. " Amount - ".$totamt;
?>
							
		
		
<input type='hidden' name="msg" value="<?php echo $msg; ?>" />	
<input type='hidden' name="mailmsg" value="<?php echo $mailmsg; ?>" />	

<div class="col-md-6" >
	<b>Account holder name</b>
	<input type="text" class="name" name="acholder"  />
	<em id="idacholder" style="color:red;" class="ms-error"></em>
</div>
<div class="col-md-6" >
	<b>Bank name</b>
	<input type="text" class="name" name="bankname"  /> 
	<em id="idbankname" style="color:red;" class="ms-error"></em>
</div>
<div class="col-md-6" >
	<b>Account Number</b>
	<input type="text" class="name" maxlength="14" name="acnumber" />
	<em id="idacnumber" style="color:red;" class="ms-error"></em>
</div>
<div class="col-md-6" >
	<b>IFSC Code</b>
	<input type="text" class="name"  maxlength="14" name="ifsccode"  /> 
	<em id="idifsccode" style="color:red;" class="ms-error"></em>
</div>					
<div class="col-md-6" >
	<b>Total Paid Amount(Excluding bookingfee and taxamt)</b>
	<input type="text" class="name" name="paidamt" value='<?php echo $cantotamt = $paidamt-($bookingfee + $taxamt); ?>' readonly style="background-color:grey;color:white;" />
</div>
<div class="col-md-6" >
	<b>Cancellation Charge (50%)</b>
	<input type="text" class="name" name="cancellationamt" value='<?php echo $cantotamt/2; ?>' readonly  style="background-color:grey;color:white;"/> 
</div>
<div class="col-md-6" >
	<b>Refundable amount</b>
	<input type="text" class="name" name="refundableamt" value='<?php echo $cantotamt/2; ?>' readonly  style="background-color:grey;color:white;"/> 
</div>
		<input type="submit" name="submit" value="Click here to Confirm cancellation">
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
function validateform()
{
	var spans = $('.ms-error');
	spans.text(''); // clear the text
	 var expemail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var alpha = /^[a-zA-Z\s]+$/;
	var num = /^[0-9]*$/;
	var code=/^[A-Z|a-z]{4}[0][\d]{6}$/;
	var i =0;
	if(document.cancelfrm.acholder.value == "" )
	{
		document.getElementById("idacholder").innerHTML="Kindly enter the name of account holder..";		
		i=1;
	}
	if(!document.cancelfrm.acholder.value.match(alpha))
	{
		document.getElementById("idacholder").innerHTML="account holder name should contain only alphabets..";		
		i=1;
	}
	if(document.cancelfrm.bankname.value == "" )
	{
		document.getElementById("idbankname").innerHTML="Kindly enter the name of bank..";		
		i=1;
	}
	if(document.cancelfrm.acnumber.value == "" )
	{
		document.getElementById("idacnumber").innerHTML="Kindly enter the account number..";		
		i=1;
	}
	if(!document.cancelfrm.acnumber.value.match(num))
	{
		document.getElementById("idacnumber").innerHTML=" account number should contain only numeric values..";		
		i=1;
	}
	if(document.cancelfrm.ifsccode.value == "" )
	{
		document.getElementById("idifsccode").innerHTML="Kindly enter the ifsc code..";		
		i=1;
	}
	if(!document.cancelfrm.ifsccode.value.match(code))
	{
		document.getElementById("idifsccode").innerHTML="please enter the valid IFSC code..!..";		
		i=1;
	}
	if(i == 0)
	{
		return true;
	}
	if(i = 1)
	{
		return false;
	}
}
</script>