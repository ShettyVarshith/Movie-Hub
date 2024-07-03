<?php
include("dbconnection.php");

$sqlticket_bookingpayment= "SELECT sum(ticket_booking.cost) FROM ticket_booking LEFT JOIN billing on ticket_booking.billingid=billing.billingid LEFT JOIN showtimings ON showtimings.showtimingid=ticket_booking.showtimingid LEFT JOIN showlist ON showlist.showlistid=showtimings.showlistid WHERE showlist.theatreid='$_GET[theatreid]' and billing.status='Active'";
$qsqlticket_bookingpayment = mysqli_query($con,$sqlticket_bookingpayment);
$rsticket_bookingpayment = mysqli_fetch_array($qsqlticket_bookingpayment);
$ticketbookingamt = $rsticket_bookingpayment[0];

$sqlfoodorder= "SELECT sum(foodorder.cost*foodorder.qty) FROM `foodorder` LEFT JOIN snacks ON foodorder.snacksid=snacks.snacksid WHERE snacks.theatreid='$_GET[theatreid]' and foodorder.status='Active' ";
$qsqlfoodorder = mysqli_query($con,$sqlfoodorder);
$rsqsqlfoodorder = mysqli_fetch_array($qsqlfoodorder);
$foodorderamt = $rsqsqlfoodorder[0];

$sqlcancel_booking= "SELECT SUM(cancel_booking.cancellationamt) FROM `cancel_booking` LEFT JOIN ticket_booking on cancel_booking.billingid=ticket_booking.billingid LEFT JOIN billing on ticket_booking.billingid=billing.billingid LEFT JOIN showtimings ON showtimings.showtimingid=ticket_booking.showtimingid LEFT JOIN showlist ON showlist.showlistid=showtimings.showlistid WHERE showlist.theatreid='$_GET[theatreid]' and billing.status='Cancelled'";
$qsqlcancel_booking = mysqli_query($con,$sqlcancel_booking);
$rscancel_booking = mysqli_fetch_array($qsqlcancel_booking);
$cancelamt = $rscancel_booking[0];

$sqlpayment= "SELECT SUM(paid_amt) FROM payment WHERE theatreid='$_GET[theatreid]'";
$qsqlpayment = mysqli_query($con,$sqlpayment);
echo mysqli_error($con);
$rspayment = mysqli_fetch_array($qsqlpayment);
$lastpaymentamt = $rspayment[0];
?>

<p><b>Bank Account</b></p>
<?php
	$sqltheatre = "SELECT * FROM theatre WHERE theatreid='$_GET[theatreid]'";
	$qsqltheatre = mysqli_query($con,$sqltheatre);
echo mysqli_error($con);
	$rstheatre = mysqli_fetch_array($qsqltheatre);
	$bankac="Account holder - $rstheatre[thacholder]<br>";
	$bankac=$bankac . "bank name - $rstheatre[thbankname]<br>";
	$bankac=$bankac . "Account Number - $rstheatre[thbankac]<br>";
	$bankac=$bankac . "IFSC Code - $rstheatre[thifsc]<br>";
	echo $bankac;
?>

 <p>Payment date</p>
<input type="date" class="form-control" name="paymentdate" id="paymentdate" value="<?php echo date("Y-m-d"); ?>" readonly /> 


<p>Ticket Booking Amount</p>
<input type="text" class="name" name="bookingamt" readonly style="background-color:grey;color:white;" value="<?php echo $ticketbookingamt; ?>" /> 

<p>Food order Amount</p>
<input type="text" class="name" name="foodorderamt" readonly style="background-color:grey;color:white;" value="<?php echo $foodorderamt; ?>" /> 

<p>Cancellation charge</p>
<input type="text" class="name" name="cancellationcharge" readonly style="background-color:grey;color:white;" value="<?php echo $cancelamt; ?>" /> 

<p>Last payment</p>
<input type="text" class="name" name="lastpayment" readonly style="background-color:grey;color:white;" value="<?php echo $lastpaymentamt; ?>" /> 

<p>Total amount</p>
<input type="text" class="name" name="totamt" id="totamt" readonly style="background-color:grey;color:white;" value="<?php echo $totamt=($ticketbookingamt + $foodorderamt + $cancelamt)-$lastpaymentamt; ?>" /> 

<p>Paid amount</p>
<input type="text" class="name" name="paidamt" id="paidamt" onkeyup="funbalpayment()"  /> 

<p>Balance amount</p>
<input type="text" class="name" name="balamt" id="balamt"  readonly  style="background-color:grey;color:white;" value="0"/> 
				
<input type="submit" name="submit" value="Make Payment">