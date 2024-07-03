<?php
include("header.php");
error_reporting(0);
if(isset($_POST[submit]))
{    
     include("sendmail.php");
	$sqltheatre = "SELECT * FROM theatre WHERE theatreid='$_POST[theatreid]'";
	$qsqltheatre = mysqli_query($con,$sqltheatre);
	$rstheatre = mysqli_fetch_array($qsqltheatre);
	$bankac="Account holder - $rstheatre[thacholder]<br>";
	$bankac=$bankac . "Bank name - $rstheatre[thbankname]<br>";
	$bankac=$bankac . "Account Number - $rstheatre[thbankac]<br>";
	$bankac=$bankac . "IFSC Code - $rstheatre[thifsc]<br>";
		//Insert statement starts here
	$sql = "INSERT INTO payment (theatreid,paid_amt,paid_date,transaction_detail) VALUES ('$_POST[theatreid]','$_POST[paidamt]','$_POST[paymentdate]','$bankac')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	   {
		   $sqltheatre1="SELECT * theatre WHERE theatreid='$_GET[theatreid]'";
		$qsqltheatre1 = mysqli_query($con,$sqltheatre1);
		$rstheatre1= mysqli_fetch_array($qsqltheatre1);

$msgpay = "Movie Hub..".$_POST[msgpay];
//echo $mailmsgpay = $_POST[mailmsgpay];
sendmail($rstheatre1[emailid],"Ticket Booking Receipt..",$msgpay,"Movie Hub...")
?>
<iframe id="contact" src="http://smsc.co.in/api/mt/SendSMS?APIKey=04024e1f-2d50-4874-b1b5-b1b1d901e928&senderid=TESTIN&channel=2&DCS=0&flashsms=0&number=91<?php echo $rstheatre1[mobileno]; ?>&text=<?php echo $msgpay; ?>&route=1" allowtransparency="true" frameborder="0" scrolling="yes" style="visibility:Hidden;"></iframe>

<?php
	 	 echo "<SCRIPT>alert('Payment done successfully.....');</SCRIPT>";
	   }
}
?>


	<!-- features -->
	<div id="features" class="features">
		<div class="container"> 
			<div class="w3layouts_skills_grids w3layouts-features-agileinfo">

				<div class="col-md-9 w3features-left">				

					<div id="register" class="login-form "> 
						<div class="agile-row">
							<h5>Payment</h5> 
							<div class="login-agileits-top"> 	
<form  action="" method="post" name="frmpayment" > 

<?php

$mailmsgpay  = "<center>Movie Time<center>
<b>payment is transfered to your account successfuly...</b><br>";
$mailmsgpay  = "<br>". $mailmsgpay. " Amount:" .$totamt;

$msgpay  = " payment is transfered to your account successfuly...";
$msgpay = $msgpay. " Amount - ".$totamt;
?>
							
		
		
<input type='hidden' name="msgpay" value="<?php echo $msgpay; ?>" />	
<input type='hidden' name="mailmsgpay" value="<?php echo $mailmsgpay; ?>" />	


<p>Theatre name </p>
<select name="theatreid" class="form-control" onchange="loadtheatre(this.value)" >
<option value=''>select</option>
<?php
$sqltheatre="SELECT * FROM theatre where status='active'";
$qsqltheatre=mysqli_query($con,$sqltheatre);
echo mysqli_error($con);
while($rstheatre=mysqli_fetch_array($qsqltheatre))
{
	if($rstheatre[theatreid] == $rsedit[theatreid])
	{
	echo "<option value='$rstheatre[theatreid]' selected>$rstheatre[theatrename]</option>";
	}
	else
	{
	echo "<option value='$rstheatre[theatreid]'>$rstheatre[theatrename]</option>";
	}
}
?>
</select>



<div id="divtotamt">


	
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