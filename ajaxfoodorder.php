<?php
session_start();
error_reporting(0);
$bookingfee=20;
$taxpercentage=18;
include("dbconnection.php");
if(isset($_GET[delfoodorderid]))
{
		$sql = "DELETE FROM foodorder WHERE orderid='$_GET[delfoodorderid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
}
if(isset($_GET[foodqtyorderid]))
{
	$sql ="UPDATE foodorder SET qty='$_GET[qty]' WHERE orderid='$_GET[foodqtyorderid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
}
if(isset($_GET[itemid]))
{
	$sqlitem ="SELECT * FROM foodorder where customerid='$_SESSION[customerid]' AND snacksid='$_GET[itemid]' AND status='Pending'";
	$qsqlitem = mysqli_query($con,$sqlitem);
	
	if(mysqli_num_rows($qsqlitem) >= 1 )
	{
		//update statement starts here
		$sql = "UPDATE foodorder SET qty = qty+1  where customerid='$_SESSION[customerid]' AND snacksid='$_GET[itemid]' AND status='Pending'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		//update statement ends here
	}
	else
	{
		//Insert statement starts here
		$sql = "INSERT INTO foodorder(customerid,snacksid,billingid,cost,status,qty) VALUES ('$_SESSION[customerid]','$_GET[itemid]','0','$_GET[itemcost]','Pending','1')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		//Insert statement ends here
	}
}
//This code is to select data while updating

$sql ="SELECT * FROM  foodorder LEFT JOIN customer on foodorder.customerid = customer.customerid LEFT JOIN snacks on foodorder.snacksid=snacks.snacksid where foodorder.customerid='$_SESSION[customerid]' AND foodorder.status='Pending'"; 
$qsql = mysqli_query($con,$sql);
$totfoodcost =0;
if(mysqli_num_rows($qsql) >= 1)
{
?>
<hr>
	<div class='panel panel-default' style="padding:5px;">
	<b>Food Order</b><hr>
	<?php
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<span style='float: right;padding-right:5px;cursor:pointer;color:red;'  onclick='delrec($rs[0])'><b>X</b></span><b style='color:grey;'>$rs[itemname]</b> | <b>Cost-</b> ₹$rs[cost] <br> <b>Qty:</b> <input style='width:75px;' type='number' value='$rs[qty]' onchange='changeorderqty($rs[0],this.value)' onkeyup='changeorderqty($rs[0],this.value)'><br>  
		<b>Total :</b> ₹" . $rs[cost]*$rs[qty] . "<hr>";
		$totfoodcost = $totfoodcost + ($rs[cost]*$rs[qty]);
	}
	?>
	</div>
<?php
}
?>
<hr>
<?php
$dt = date("Y-m-d");
if($_GET[offercode] != "")
{
	$sqloffercode = "SELECT * FROM offer WHERE offercode='$_GET[offercode]' and '$dt' between startdate AND enddate";
	$qsqloffercode = mysqli_query($con,$sqloffercode);
	$rsoffercode = mysqli_fetch_array($qsqloffercode);
	if(mysqli_num_rows($qsqloffercode) == 1)
	{
		$_SESSION[offercode] = $rsoffercode[offercode] ;
		$_SESSION[offeramt] = $rsoffercode[offeramt];
		$msg= "<b style='color:green;'>Offer applied..</b>";
	}
	else
	{
		unset($_SESSION[offercode]);
		unset($_SESSION[offeramt]);		
		$msg= "<b style='color:red;'>Offer code not available..</b>";
	}
}
?>
<div class='panel panel-default' style="padding:5px;">
	<b>Do you have offer code?<input type='text' class="form-control" name='offercode'id='offercode' value="<?php echo $_SESSION[offercode]; ?>" >
<?php
if(isset($_SESSION[offeramt]))
{
?>
Discount amount : <?php echo $_SESSION[offeramt]; ?>
	<input type="hidden" name='offeramt' value="<?php echo $_SESSION[offeramt]; ?>">
<?php
}
echo $msg;
?>
	<input type='button' class="form-control" name='btnoffercode' value='Verify' onclick='funoffercode(offercode.value)' ></b>
</div>
<hr>
<div class='panel panel-default' style="padding:5px;">
<b>Grand Total - ₹<?php echo $_GET[cost]+$totfoodcost-$_SESSION[offeramt]; ?></b>
</div>