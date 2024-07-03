<?php
include("header.php");
error_reporting(0);
if(isset($_POST[submit]))
{
	include("sendmail.php");
	//Insert statement starts here
	$dt = date("Y-m-d");
	$sql = "INSERT INTO billing (customerid,totalcost,discamt,payment_date,paymenttype,cardno,cvvno,expdate,status) VALUES ('$_SESSION[customerid]','$_POST[totalamt]','$_POST[discamt]','$dt','$_POST[paymenttype]','$_POST[cardno]','$_POST[cvvno]','$_POST[expdate]-01','Active')";
	$qsql = mysqli_query($con,$sql);
	$insid = mysqli_insert_id($con);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		
		$sqlcustomer="SELECT * FROM customer WHERE customerid='$_SESSION[customerid]'";
		$qsqlcustomer = mysqli_query($con,$sqlcustomer);
		$rscustomer = mysqli_fetch_array($qsqlcustomer);

$msg = "Movie Hub...".$_POST[msg];
//echo $mailmsg = $_POST[mailmsg];
sendmail($rscustomer[emailid],"Ticket Booking Receipt..",$msg,"Movie Hub...")

?>
<iframe id="contact" src="http://smsc.co.in/api/mt/SendSMS?APIKey=04024e1f-2d50-4874-b1b5-b1b1d901e928&senderid=TESTIN&channel=2&DCS=0&flashsms=0&number=91<?php echo $rscustomer[contactno]; ?>&text=<?php echo $msg; ?>&route=1" allowtransparency="true" frameborder="0" scrolling="yes" style="visibility:Hidden;"></iframe>
<?php
		$sqlupd ="UPDATE ticket_booking set status='Active',billingid='$insid' where status='Pending'";
		mysqli_query($con,$sqlupd);
		$sqlupd ="UPDATE foodorder set status='Active',billingid='$insid' where status='Pending'";
		mysqli_query($con,$sqlupd);
		
		echo "<SCRIPT>alert('Payment done successfully...');</SCRIPT>";
		echo "<script>window.location='billingreceipt.php?billingid=$insid';</script>";
	}
}
//This code is to select data while updating
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM billing WHERE billingid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//This code is to select data while updating ends here	


$sqlbookingrs1 ="SELECT * FROM ticket_booking where  status='pending' and customerid='$_SESSION[customerid]' order by seatrow ";
$qsqlticketbookingrs1 = mysqli_query($con,$sqlbookingrs1);
$rsshowtimedetail1 = mysqli_fetch_array($qsqlticketbookingrs1);

$sqlshowtime = "select * From showtimings LEFT JOIN showlist ON showtimings.showlistid =showlist.showlistid left join movie on movie.movieid=showlist.movieid LEFT JOIN theatre ON theatre.theatreid=showlist.theatreid WHERE showlist.status='Active' AND showtimings.showtimingid='$rsshowtimedetail1[showtimingid]'";
$qsqlshowtime = mysqli_query($con,$sqlshowtime);
$rsshowtimedetail = mysqli_fetch_array($qsqlshowtime);
?>

<!-- features -->
<?php
if(isset($_GET[confirmbill]))
{
?>

                <div class="col-md-12 col-sm-12 w3features-right">			

					<div class="login-form agileits-right idregister"> 
						<div class="agile-row">
							<h5>Payment Receipt</h5> 
							<div class="login-agileits-top"> 	
								<form  action="" method="post" name="billingfrm" onsubmit="return validateform()"> 
								
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
		$seatnos="Row : $rsbookingrs[seatrow] \n Seat No. $rsbookingrs[seatno]";
	}
	else
	{
		echo ", $rsbookingrs[seatno]";
		$seatnos = $seatnos .", $rsbookingrs[seatno]";
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
							</div>  
						</div>  
					</div>  
		

					<div class="login-form agileits-right idregister"> 
						<div class="agile-row">
							<h5>Billing Form</h5> 
							<div class="login-agileits-top"> 	
								<form  action="" method="post" name="billingfrm" onsubmit="return validateform()"> 
<?php
if(isset($_SESSION[offeramt]))
{
?>
<b>Total Amount : </b> 
<input type="text" class="name" name="totalamt" value='<?php echo $_GET[cost]+$totfoodcost; ?>'  readonly style="background-color:grey;color:white;" />
	
	
<b>Discount Amount : </b>
<input type="text" class="name" name="discamt" value='<?php echo $_SESSION[offeramt]; ?>'  readonly style="background-color:grey;color:white;" />

<b>Grand Total : </b>
<input type="text" class="name" name="grandtotal" value='<?php echo $totamt = ($_GET[cost]+$totfoodcost) - $_SESSION[offeramt]; ?>'  readonly style="background-color:grey;color:white;" />

<?php
}
else
{
?>
<b>Total Amount : </b> 
<input type="text" class="name" name="totalamt" value='<?php echo $totamt = $_GET[cost]+$totfoodcost; ?>'  readonly style="background-color:grey;color:white;" />
	
<?php
}

$mailmsg  = "<center>Movie Time<center>
<b>Thanks for booking movie ticket in Movie Hub...</b><br>";
$mailmsg  = "<br>". $mailmsg. " Theatre:" . $rsshowtimedetail[theatrename].".. ";
$mailmsg  = "<br>". "<br>". $mailmsg . "Movie name: " . $rsshowtimedetail[moviename].".. ";
$mailmsg  = "<br>". $mailmsg ."Screen: " . $rsshowtimedetail[screenid].".. ";
$mailmsg  = "<br>". $mailmsg ."Show Date: " . date("d-M-Y",strtotime($rsshowtimedetail[datetime])).".. "; 
$mailmsg  = "<br>". $mailmsg ."Show Time: " . date("h:i A",strtotime($rsshowtimedetail[datetime])).".. "; 
$mailmsg = "<br>". $mailmsg . $seatnos."...";
$mailmsg = "<br>". $mailmsg. " Amount - ".$totamt;

$msg  = " Thanks for booking movie ticket  Movie Hub...";
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
 
<p>Payment Type</p>
<select name="paymenttype" class="form-control">
	<option value=''>Select payment type</option>
	<?php
	$arr = array("VISA","MASTER CARD");
	foreach($arr as $val)
	{
		echo "<option value='$val'>$val</option>"; 
	}
	?>
</select>
<em id="idpaymenttype" style="color:red;" class="ms-error"></em>
<p>Card holder</p>
<input type="text" class="name" name="cardholder" /> 
<em id="idcardholder" style="color:red;" class="ms-error"></em>
<p>Card No</p>
<input type="text" class="name" name="cardno" maxlength="16" value='<?php echo $rsedit[cardno];?>'/> 
<em id="idcardno" style="color:red;" class="ms-error"></em>
<p>Cvv No</p>
<input type="text" class="name" name="cvvno" maxlength="3" value='<?php echo $rsedit[cvvno]; ?>'/> 
<em id="idcvvno" style="color:red;" class="ms-error"></em>
<p>Expiry Date</p>
<input type="month" class="form-control" name="expdate" value='<?php echo $rsedit[expdate];?>'  min="<?php echo date("Y-m"); ?>"/> 
<em id="idexpdate" style="color:red;" class="ms-error"></em>
<input type="submit" name="submit" value="Make Payment">

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
}
else
{
?>
		<div class="container"> 
                <div class="col-md-8 col-sm-8 panel panel-default" style="overflow-y: scroll; height:600px;">			

						<div   >
						
							<h4>Food Order</h4> 
								
<?php
			$sql = "SELECT * FROM snacks WHERE theatreid='$rsshowtimedetail[theatreid]'";
			$qsql = mysqli_query($con,$sql);
			while($rs = mysqli_fetch_array($qsql))
			{						
    if(file_exists("imageitem/$rs[itemimg]"))
     {
	    $picimage="imageitem/$rs[itemimg]";
     }
      else
     {
	    $picimage="images/No_Image_Available.jpg";
     }
	 
			?>
	<div class="col-sm-4 col-xs-6 gallry-agile-grids" data-toggle="tooltip" data-placement="right" title="<?php echo $rs[itemdescription]; ?>">
		<div class="view" >
			<a href="" class="b-link-stripe b-animate-go thickbox" onclick="additems('<?php echo $rs[0]; ?>','<?php echo $rs[itemcost]; ?>');return false;">
				<img src="<?php echo $picimage; ?>" alt="" width="150px;" height="200px;" />
				<div class="mask">
					<h4><?php echo $rs[itemname]; ?></h4>
					<br>
					<span style="background-color:red; color:white;padding:10px;"><b>₹<?php echo $rs[itemcost]; ?></b></span>
					</p>
				</div>
			</a>
		</div>
	</div>
			<?php
			}
			?>


								
						</div>  
					
				</div> 
				 <div class="col-md-4 col-sm-4 panel panel-default" style="overflow-y: scroll; height:600px;">			

						<div class="agile-row">
							<h4>Billing</h4>
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
$seatnos = "";
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
		$seatnos="Row : $rsbookingrs[seatrow] \n Seat No. $rsbookingrs[seatno]";
	}
	else
	{
		echo ", $rsbookingrs[seatno]";
		$seatnos = $seatnos .", $rsbookingrs[seatno]";
	}
	if($rsbookingrs[seatrow] != $bookingrow )
	{
		$bookingrow = $rsbookingrs[seatrow];
	}
	$cost = $cost + $rsbookingrs[cost];
}



echo "<hr>"; 
echo "<b>Booking Fee : </b> ₹".  $bookingfee = $totticket * $bookingfee ."<br>";
echo  "<b>Tax Amount ($taxpercentage%):  </b> ₹".  $taxamt = (sprintf('%0.2f', $bookingfee*$taxpercentage / 100));
echo "<hr><b style='color:green;'>Total Cost - ₹" . $_GET[cost] = $cost + $bookingfee + $taxamt  . "</b>";
?>

							
							<div class="login-agileits-top" id="divfoodorder"> 
							
								 	<?php include("ajaxfoodorder.php"); ?>
							</div>  
						</div>  
					
				</div> 
				
				<center><a href="billing.php?confirmbill=confirmbill"><input type="button" name="button" value="Click here to Complete Order" class="form-control" style="width:250px" ></a></center>
				<br>
				<div class="clearfix"> </div>
		</div>
	<!-- //features --> 
<?php
}
?>
	<?php
include("footer.php");
?>
<script>
function validateform()   
{
	var spans = $('.ms-error');
	spans.text(''); // clear the text
	var alpha = /^[a-zA-Z\s]+$/;
	var num = /^[0-9]*$/;
	var i =0;
	
	if(document.billingfrm.paymenttype.value == "" )
	{
		document.getElementById("idpaymenttype").innerHTML="Choose any payment type..";		
		i=1;
	}
	if(!document.billingfrm.cardholder.value.match(alpha))
	{
		document.getElementById("idcardholder").innerHTML="Card holder name should contain only alphabets..";		
		i=1;
	}
	if(document.billingfrm.cardholder.value == "" )
	{
		document.getElementById("idcardholder").innerHTML="kindly enter the name of card holder..";		
		i=1;
	}
	if(!document.billingfrm.cardno.value.match(num))
	{
		document.getElementById("idcardno").innerHTML="Entered card number should contain only numeric values...";		
		i=1;		
	}
	if(document.billingfrm.cardno.value == "" )
	{
		document.getElementById("idcardno").innerHTML="Card Number should not be blank..";		
		i=1;
	}
	
	if(document.billingfrm.cvvno.value == "" )
	{
		document.getElementById("idcvvno").innerHTML="CVV number should not be blank....";		
		i=1;		
	}
	if(!document.billingfrm.cvvno.value.match(num))
	{
		document.getElementById("idcvvno").innerHTML="Entered CVV number should contain only numeric values....";		
		i=1;		
	}
	if(document.billingfrm.expdate.value == "" )
	{
		document.getElementById("idexpdate").innerHTML="kindly selectthe expire date of your card.";		
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
function additems(itemid,itemcost)
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
                document.getElementById("divfoodorder").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxfoodorder.php?itemid="+itemid+"&itemcost="+itemcost+"&cost=<?php echo $_GET[cost]; ?>",true);
        xmlhttp.send();
}
function delrec(delfoodorderid)
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
                document.getElementById("divfoodorder").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxfoodorder.php?delfoodorderid="+delfoodorderid+"&cost=<?php echo $_GET[cost]; ?>",true);
        xmlhttp.send();
}
function changeorderqty(foodqtyorderid,qty)
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
                document.getElementById("divfoodorder").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxfoodorder.php?foodqtyorderid="+foodqtyorderid+"&qty="+qty+"&cost=<?php echo $_GET[cost]; ?>",true);
        xmlhttp.send();
}
function funoffercode(offercode)
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
                document.getElementById("divfoodorder").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxfoodorder.php?offercode="+offercode+"&cost=<?php echo $_GET[cost]; ?>",true);
        xmlhttp.send();
}

</script>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>