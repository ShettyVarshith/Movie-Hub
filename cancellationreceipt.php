<?php
include("header.php");
error_reporting(0);
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
							<h5>Cancellation Receipt</h5> 
							<div class="login-agileits-top"> 	
								<form  action="" method="post" name="billingfrm" onsubmit="return validateform()"> 
								
<div class="panel panel-default" style="padding:15px;">		
<?php
echo "<b>Theatre:</b> " . $rsshowtimedetail[theatrename] . "<br>"; 
echo "<b>Movie name:</b> " . $rsshowtimedetail[moviename] . "<br>"; 
echo "<b>Show Date:</b> " . date("d-M-Y",strtotime($rsshowtimedetail[datetime])) . "<br>"; 
echo "<b>Show Time:</b> " . date("h:i A",strtotime($rsshowtimedetail[datetime])) . "<br>"; 
?>
<?php
$cost= 0;
$bookingrow="";
$sqlbookingrs ="SELECT * FROM ticket_booking where  billingid='$_GET[billingid]'  order by seatrow ";
$qsqlticketbookingrs = mysqli_query($con,$sqlbookingrs);
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
$_GET[cost] = $cost;
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
	<b>Total Amount : </b> ₹<?php echo $cost+$totfoodcost; ?><hr>
	
	<b>Discount Amount : </b> ₹<?php echo $rsedit[discamt]; ?><hr>
	
	<b>Paid Amount : </b> ₹<?php echo $paidamt= $cost+$totfoodcost-$rsedit[discamt]; ?><hr>
<?php
}
else
{
?>
	<b>Paid Amount : </b> ₹<?php echo $paidamt= $cost+$totfoodcost; ?><hr>
<?php
}
?>
	<b>Cancellation charge : </b> ₹<?php echo $paidamt/2; ?><hr>
	<b>Refundable amount :</b> ₹<?php echo $paidamt/2; ?><hr>
</div>
<input type="button" name="submit" class="form-control" value="Print Receipt" onclick="printbill('divreceipt')">
								</form> 	
							</div>  
						</div>  
					</div>  
					
<script>
function printbill(divName)
{
	  var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>	
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
	var i =0;
	
	if(document.frm3.customerid.value == "" )
	{
		document.getElementById("idcustomerid").innerHTML="Kindly enter your name..";		
		i=1;
	}
	
	if(document.frm3.totalcost.value.length != 10 )
	{
		document.getElementById("idtotalcost").innerHTML="kindly enter the total cost..";		
		i=1;		
	}
   if(!document.frm3.date.value == " " )
	{
		document.getElementById("iddate").innerHTML="kindly enter the date..";		
		i=1;		
	}
	if(document.frm3.paymenttype.value == "" )
	{
		document.getElementById("idpaymenttype").innerHTML="choose any payment type..";		
		i=1;
	}
	if(document.frm3.cardno.value == "" )
	{
		document.getElementById("idcardno").innerHTML="card no should not be blank..";		
		i=1;
	}
	if(document.frm3.cvvno.value < 6 )
	{
		document.getElementById("idcvvno").innerHTML="cvv no should not be blank....";		
		i=1;		
	}
	
	if(document.frm3.expdate.value == "" )
	{
		document.getElementById("idexpdate").innerHTML="Password should not be empty..";		
		i=1;
	}

	
	if(document.frm3.status.value == "" )
	{
		document.getElementById("idstatus").innerHTML="Kindly select the status..";		
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