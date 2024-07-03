<?php
session_start();
error_reporting(0);
$dt = date("Y-m-d");
$tim = date("H:i:s");

$dttim = date("Y-m-d H:i:s");

$bookingfee=30;
$taxpercentage=18;

$pagename=$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
include("dbconnection.php");

if(isset($_POST[btnlocation]))
{
	$sqllocation="SELECT * FROM location where location='$_POST[locations]' AND status='Active'";
	$qsqllocation=mysqli_query($con,$sqllocation);
	$loclocation=mysqli_fetch_array($qsqllocation);
	$_SESSION[loclocationid] = $loclocation[locationid];
}
if(isset($_POST[btnregister]))
{
	$sqlemail = "SELECT * FROM customer WHERE emailid='$_POST[emailid]'";
	$qsqlemail = mysqli_query($con,$sqlemail);
	if(mysqli_num_rows($qsqlemail) ==1)
	{
	echo "<SCRIPT>alert('Email ID already exists..' );</SCRIPT>";
	}	
	else
	{
		$sql = "INSERT INTO customer (customername,contactno,emailid,password,status) VALUES ('$_POST[customername]','$_POST[contactno]','$_POST[emailid]','$_POST[password]','Active')";
			$qsql = mysqli_query($con,$sql);
			$insid = mysqli_insert_id($con);
			echo mysqli_error($con);
			if(mysqli_affected_rows($con) == 1)
			{
				$_SESSION["customerid"]=$insid;
				echo "<SCRIPT>alert('customer Registration done	 successfully...');</SCRIPT>";
			}
	}
}
//Coding starts - Employee Login Panel
if(isset($_POST[empbtnlogin]))
{
	$pwd = ($_POST[emppassword]);
	$sql ="SELECT * FROM admin WHERE loginid='$_POST[emploginid]' AND password='$pwd' AND status='Active'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1)
	{
		$rslogin = mysqli_fetch_array($qsql);
		$_SESSION["adminid"] = $rslogin[adminid];
		echo "<script>window.location='dashboard.php';</script>";
	}
	else
	{
		echo "<script>alert('Login credentials are not valid..');</script>";	 
	}
}
//Coding ends here - Employee Login Panel
//Coding starts - customer Login Panel
if(isset($_POST[btnlogin]))
{
	$pwd = ($_POST[password]);
	$sql ="SELECT * FROM customer WHERE emailid='$_POST[email]' AND password='$pwd ' AND status='Active'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1)
	{
		$rslogin=mysqli_fetch_array($qsql);
		$_SESSION["customerid"]=$rslogin[customerid];
		echo "<script>window.location='index.php';</script>";
	}
	else
	{
		echo "<script>alert('Login credentials are not valid..');</script>";
	}
}
//Coding ends here - customer Login Panel

//Coding starts - Theatre Login Panel starts here
if(isset($_POST[theatrebtnlogin]))
{
	$pwd =($_POST[theatrepassword]);
	$sql ="SELECT * FROM theatre WHERE emailid='$_POST[theatreloginid]' AND password='$pwd' AND status='Active'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1)
	{
		$rslogin=mysqli_fetch_array($qsql);
		$_SESSION["theatreid"] = $rslogin[theatreid];
		echo "<script>window.location='theatredashboard.php';</script>";
	}
	else
	{
		echo "<script>alert('Login credentials are not valid..');</script>";
	}
}
//Coding ends here -  Theatre Login Panel ends here..

//Coding starts - customer Panel starts here..
if(isset($_SESSION["customerid"]))
{
	$sqlcustomerac ="SELECT * FROM customer WHERE customerid='$_SESSION[customerid]'";
	$qsqlcustomerac = mysqli_query($con,$sqlcustomerac);
	if(mysqli_num_rows($qsqlcustomerac) == 1)
	{
		$rscustomerac=mysqli_fetch_array($qsqlcustomerac);
	}
}
//Coding ends here - customer Panel ends here..

//Coding starts - Theatre profile starts here..
if(isset($_SESSION["theatreid"]))
{
	$sqltheatreac ="SELECT * FROM theatre WHERE theatreid='$_SESSION[theatreid]'";
	$qsqltheatreac = mysqli_query($con,$sqltheatreac);
	if(mysqli_num_rows($qsqltheatreac) == 1)
	{
		$rstheatreac=mysqli_fetch_array($qsqltheatreac);
	}
}
//Coding ends here - Theatre profile ends here..

//Coding starts - admin panel starts here..
if(isset($_SESSION["adminid"]))
{
	$sqlrsadminac ="SELECT * FROM admin WHERE adminid='$_SESSION[adminid]'";
	$qsqlrsadminac = mysqli_query($con,$sqlrsadminac);
	if(mysqli_num_rows($qsqlrsadminac) == 1)
	{
		$rsadminac=mysqli_fetch_array($qsqlrsadminac);
	}
}
//Coding ends here - admin panel ends here..

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>MOVIE HUB </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">   
<link href="css/font-awesome.css" rel="stylesheet">	<!-- font-awesome icons -->     
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />  <!-- flexslider-CSS -->  
<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen"> 
<!-- //Custom Theme files --> 
<!-- js -->
<script src="js/jquery-2.2.3.min.js"></script>  
<!-- //js -->
<!-- web-fonts -->    
<link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Aguafina+Script" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Petit+Formal+Script" rel="stylesheet"> 
<!-- //web-fonts -->


<!-- Login Modal starts here -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login Panel</h4>
		<center> <img src="images/culogin.gif" /></center>
      </div>
      <div class="modal-body">
	  <form action="" method="post" name="custlogin" onsubmit="return validateform()"> 
					
					
					<span class="input input--ichiro">
						<input class="input__field input__field--ichiro" type="email" id="input-25" name="email" placeholder=" " required="" />
						<label class="input__label input__label--ichiro" for="input-25">
							<span class="input__label-content input__label-content--ichiro">Enter Email ID</span>
							
						</label>
					</span>
					<em id="idemail" style="color:red;" class="ms-error"></em>
					<span class="input input--ichiro">
						<input class="input__field input__field--ichiro" type="password" id="input-26" name="password" placeholder=" " required="" />
					<label class="input__label input__label--ichiro" for="input-26">
							<span class="input__label-content input__label-content--ichiro">Enter Password</span>
						
						</label>
					</span>
						<em id="idpassword" style="color:red;" class="ms-error"></em>
					 
		
      </div>
	  
      <div class="modal-footer">
      <center> <input type="submit" name="btnlogin" value="login" style="background-color: #72A4D2" style="width:100px; height:100px" class="name"></center>
	    <div align="center"><strong>Did you forgot password?</strong><br /><input type="button" onclick="window.location='forgotpassword.php';" value="CLick here to Recover Password.." id="submit" name="submit" class="btn btn-primary btn-lg" /></div>
	   </form>
      </div>
    </div>
  </div>
</div>
<!-- Login Modal ends here -->

<!-- Register Modal starts here -->
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Registration Panel</h4>
      </div>
      <div class="modal-body">
	  
		<form action="" method="post" name="signup" onsubmit="return validateform1()">

					<span class="input input--ichiro">
						<input class="input__field input__field--ichiro" type="text" id="input-31" name="customername" placeholder=" " required="" />
						
						<label class="input__label input__label--ichiro" for="input-31">
							<span class="input__label-content input__label-content--ichiro">Enter Name</span>
						</label>
					</span>
				    <em id="idcustomername" style="color:red;" class="ms-error"></em>
					
					
					<span class="input input--ichiro">
						<input class="input__field input__field--ichiro" maxlength="10" type="text" id="input-311" name="contactno" placeholder=" " required="" />
							
						<label class="input__label input__label--ichiro" for="input-311">
							<span class="input__label-content input__label-content--ichiro">Enter Mobile No.</span>
						</label>
				    </span>
				   <em id="idnumber" style="color:red;" class="ms-error"></em>
				   
				    <span class="input input--ichiro">
						<input class="input__field input__field--ichiro" type="email" id="input-322" name="emailid" placeholder=" " required="" />
						<label class="input__label input__label--ichiro" for="input-322">
							<span class="input__label-content input__label-content--ichiro">Enter emailid</span>
						</label>
					</span>
					<em id="idemailid" style="color:red;" class="ms-error"></em>
					
					
                   <span class="input input--ichiro">
						<input class="input__field input__field--ichiro" type="password" id="input-33" name="password" placeholder=" " required="" />
						<label class="input__label input__label--ichiro" for="input-33">
							<span class="input__label-content input__label-content--ichiro">Enter Password</span>
						</label>
					</span>
				<em id="idpassword" style="color:red;" class="ms-error"></em>
      </div>
      <div class="modal-footer">
        <input type="submit" name="btnregister" value="Register"  class="form-control">
      </div>
		</form> 
    </div>

  </div>
</div>
<!-- Register Modal ends here -->

<!--  admin Login Modal starts here -->
<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!--  Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<center><img src="images/admin_login.gif" /></center>        
      </div>
      <div class="modal-body">
	  <form action="" method="post" name="adminlogin" onsubmit="return validateform2()"> 
					
 			
					<span class="input input--ichiro">
						<input class="input__field input__field--ichiro" type="text" id="input-125" name="emploginid" placeholder=" " required="" />
							
						<label class="input__label input__label--ichiro" for="input-125">
							<span class="input__label-content input__label-content--ichiro">Enter Login ID</span>
						</label>
					</span>
					<em id="idemploginid" style="color:red;" class="ms-error"></em>
					
					<span class="input input--ichiro">
						<input class="input__field input__field--ichiro" type="password" id="input-126" name="emppassword" placeholder=" " required="" />
							
						<label class="input__label input__label--ichiro" for="input-126">
							<span class="input__label-content input__label-content--ichiro">Enter Password</span>
						</label>
					</span>
			<em id="idemppassword" style="color:red;" class="ms-error"></em>
      </div>
      <div class="modal-footer">
       <input type="submit" name="empbtnlogin" value="Login" style="background-color: #72A4D2" style="width:100px;height:100px" class="form-control">
	   <div align="center"><strong>Did you forgot password?</strong><br /><input type="button" onclick="window.location='forgotpasswordadmin.php';" value="CLick here to Recover Password.." id="submit" name="submit" class="btn btn-primary btn-lg" /></div>
	   </form>
      </div>
    </div>
  </div>
</div>
<!--  admin Login Modal ends here -->


<!--  Theatre Login Modal starts here -->
<div id="myModal4" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!--  Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<center><img src="images/theatrelogin.png" /></center>       
		<center>Theatre login Panel</center>        
      </div>
      <div class="modal-body">
	  <form action="" method="post" name="theatrelogin" onsubmit="return validateform3()"> 
					
					<span class="input input--ichiro">
						<input class="input__field input__field--ichiro" type="text" id="input-125theatre" name="theatreloginid" placeholder=" " required="" />
							
						<label class="input__label input__label--ichiro" for="input-125theatre">
							<span class="input__label-content input__label-content--ichiro">Enter Login ID</span>
						</label>
					</span>
					<em id="idtheatreloginid" style="color:red;" class="ms-error"></em>
					
					<span class="input input--ichiro">
						<input class="input__field input__field--ichiro" type="password" id="input-126theatre" name="theatrepassword" placeholder=" " required="" />
							
						<label class="input__label input__label--ichiro" for="input-126theatre">
							<span class="input__label-content input__label-content--ichiro">Enter Password</span>
						</label>
					</span>
					<em id="idtheatrepassword" style="color:red;" class="ms-error"></em>
      </div>
      <div class="modal-footer">
       <input type="submit" name="theatrebtnlogin" value="Login"  class="form-control">
	   </form>
      </div>
	    <div align="center"><strong>Did you forgot password?</strong><br /><input type="button" onclick="window.location='theatreforgotpassword.php';" value="CLick here to Recover Password.." id="submit" name="submit" class="btn btn-primary btn-lg" /></div>
    </div>
  </div>
</div>
<!--  Theatre Login Modal ends here -->

<script defer src="js/fontawesomenew.js"></script>


  <!-- #### Select location Modal coding starts here  #### -->
  <!-- Modal -->
  <div class="modal fade" id="modallocation" role="dialog"  data-toggle="modal" data-backdrop="static" data-keyboard="false" Autosave="false">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
	  <form method="post" action="">
        <div class="modal-header">
          <h4 class="modal-title">Select Location here</h4>
        </div>
        <div class="modal-body">
          <p>
		  Select location here:
		  <input type="text" list="locations" name="locations" class="form-control"  autocomplete="off" >
				<datalist id="locations">
				<?php
				$sql="SELECT * FROM location where status='Active'";
				$qsql=mysqli_query($con,$sql);
				while($loc=mysqli_fetch_array($qsql))
				{
					echo "<option>$loc[location]</option>";
				}
				?>
				</datalist>
		  </p>
        </div>
        <div class="modal-footer">
          <button type="submit" name="btnlocation" class="btn btn-default" >Select Location</button>
        </div>
		</form>
      </div>
      
    </div>
  </div>
<?php
/*
	if(!isset($_SESSION[loclocationid]))
	{
	?>
	<script type="text/javascript">
		$(window).on('load',function(){
			$('#modallocation').modal('show');
		});
	</script>
	<?php
	}
*/
?>
<!-- #### Select location Modal coding ends here  #### height:30px;-->

</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<?php
include("topmenu.php");
if(basename($_SERVER['PHP_SELF']) == "index.php" || basename($_SERVER['PHP_SELF']) == "about.php" || basename($_SERVER['PHP_SELF']) == "contact.php")
{
?>	
	<!-- banner -->
	<div id="home" class="w3ls-banner "> 
		<!-- header -->
		<div class="header-w3layouts"> 
			<!-- Navigation -->
			<nav class="navbar navbar-default navbar-fixed-top" style="position: static;">
				<div class="container">
					<div class="navbar-header page-scroll" >
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">MOVIE HUB</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h1 class=""><a href="index.php"><img src="kannada movie/logo new.png" alt=""/><span></span></a></h1>
					</div> 
<?php
include("menu.php");
?>
				</div>
				<!-- /.container -->
			</nav>  
		</div>	
		<!-- //header -->
 	</div>	
	<!-- //banner -->
<?php
include("slider.php");
?>
<?php
/*
	<!-- banner -->
	<div id="home" class="w3ls-banner "> 
		<!-- header -->
		<div class="header-w3layouts"> 
			<!-- Navigation -->
			<nav class="navbar navbar-default navbar-fixed-top" style="position: relative;">
				<div class="container">
					<div class="navbar-header page-scroll">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only"> Movie Hub</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h1 class=""><a href="index.php"> Movie Hub <span>Online Movie Ticket Booking System</span></a></h1>
					</div> 
<?php
include("menu.php");
?>
				</div>
				<!-- /.container -->
			</nav>  
		</div>	
		<!-- //header -->
		<!-- banner-text -->
		<div class="banner-text">  
			<div class="container">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<div class="banner-w3lstext">  
								<h2>Movie Hub</h2>
								<p>Online movie ticket booking system.</p>
							</div>
						</li>
						<li>
							<div class="banner-w3lstext">  
								<h3>Book your show now! </h3>
								<p>Online movie ticket booking system </p>
							</div>
						</li>
					</ul> 
				</div>			
			<?php
			if(isset($_SESSION["customerid"]))
			{
			?>				
			<a href="account.php" class="wthree-btn btn-6" >Account</a>	
			<?php
			}
			else
			{
			?>
				<a href="#" class="wthree-btn btn-6 scroll" data-toggle="modal" data-target="#myModal">Login <span></span></a>	
				<a href="#" class="wthree-btn btn-6 scroll" data-toggle="modal" data-target="#myModal2">Register Now <span></span></a>
			<?php
			}
			?>
				
			</div> 
		</div> 
		<!-- //banner-text --> 	
	</div>	
	<!-- //banner -->
*/
?>
<?php
}
else
{
?>
	<!-- banner -->
	<div id="home" class="w3ls-banner "> 
		<!-- header -->
		<div class="header-w3layouts"> 
			<!-- Navigation -->
			<nav class="navbar navbar-default navbar-fixed-top" style="position: static;">
				<div class="container">
					<div class="navbar-header page-scroll" >
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">MOVIE HUB</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h1 class=""><a href="index.php"><img src="kannada movie/logo new.png" alt=""/><span></span></a></h1>
					</div> 
<?php
include("menu.php");
?>
				</div>
				<!-- /.container -->
			</nav>  
		</div>	
		<!-- //header -->
 	</div>	
	<!-- //banner -->
<?php
}
?>
<?php
if(basename($_SERVER['PHP_SELF']) == "index1.php")
{
?>	
	<div class="wthree-soon">
		<div class="container">
			<div class="wthree-soon-agileinfo">
			
<!-- timer -->
				<div class="agileits-timer"> 
				<h3>Your Movie, Your Theatre</h3><br/><br/>
					<div class="clock">
						<div class="column days">
							<div class="timer" id="days"></div>
							<div class="text">Days</div>
						</div>
						<div class="timer days"></div>
						<div class="column">
							<div class="timer" id="hours"></div>
							<div class="text">Hours</div>
						</div>
						<div class="timer"></div>
						<div class="column">
							<div class="timer" id="minutes"></div>
							<div class="text">Minutes</div>
						</div>
						<div class="timer"></div>
						<div class="column">
							<div class="timer" id="seconds"></div>
							<div class="text">Seconds</div>
						</div>
						<div class="clearfix"> </div>
					</div>	 
				</div>
				<!-- //timer --> 
			</div>
		</div>
	</div>
<?php
}
?>

<script> 	
function validateform()
{
	var spans = $('.ms-error');
	spans.text(''); // clear the text
	
	 var expemail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	 var i =0;
 if(!document.custlogin.email.value.match(expemail))
	{
		document.getElementById("idemail").innerHTML="Email ID is not valid..";		
		i=1;		
	}
	if(document.custlogin.email.value == "" )
	{
		document.getElementById("idemail").innerHTML="Email ID should not be empty..";
       i=1;		
	}
	if(document.custlogin.password.value  == "" )
	{
		document.getElementById("idpassword").innerHTML="Password should not be empty..";		
		i=1;
	}
	if(document.custlogin.password.value < 6 )
	{
		document.getElementById("idpassword").innerHTML="Password should contain atleast 6 characters..";		
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


<script>
function validateform1()
{
	var spans = $('.ms-error');
	spans.text(''); // clear the text
	var expemail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var phone = /^[789]\d{9}$/;
	var alpha = /^[a-zA-Z\s]+$/;
	var i =0;
	if(document.signup.customername.value == "" )
	{
		document.getElementById("idcustomername").innerHTML="Kindly senter name..";		
		i=1;
	}
	if(!document.signup.customername.value.match(alpha))
	{
		document.getElementById("idcustomername").innerHTML="name should  contain only alphabets.";		
		i=1;
	}
	if(document.signup.contactno.value == "" )
	{
		document.getElementById("idnumber").innerHTML="contact number should not be blank..";		
		i=1;
	}
	if(!document.signup.contactno.value.match(phone))
	{
		document.getElementById("idnumber").innerHTML="contact number is not valid.";		
		i=1;
	}
	
     if(!document.signup.emailid.value.match(expemail))
	{
		document.getElementById("idemailid").innerHTML="Email ID is not valid..";		
		i=1;		
	}
	if(document.signup.emailid.value == "" )
	{
		document.getElementById("idemailid").innerHTML="Email ID should not be empty..";
       i=1;		
	}
	if(document.signup.password.value  == "" )
	{
		document.getElementById("idpassword").innerHTML="Password should not be empty..";		
		i=1;
	}	
	if(document.signup.password.value < 6 )
	{
		document.getElementById("idpassword").innerHTML="Password should contain atleast 6 characters.";		
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

<script> 	
function validateform2()
{
	var spans = $('.ms-error');
	spans.text(''); // clear the text
	
	 var expemail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	 var i =0;
 if(!document.adminlogin.emploginid.value.match(expemail))
	{
		document.getElementById("idemploginid").innerHTML="Email ID is not valid..";		
		i=1;		
	}
	if(document.adminlogin.emploginid.value == "" )
	{
		document.getElementById("idemploginid").innerHTML="Email ID should not be empty..";
       i=1;		
	}
	if(document.adminlogin.emppassword.value  == "" )
	{
		document.getElementById("idemppassword").innerHTML="Password should not be empty..";		
		i=1;
	}
	if(document.adminlogin.emppassword.value < 6 )
	{
		document.getElementById("idemppassword").innerHTML="Password should contain atleast 6 characters..";		
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

<script> 	
function validateform3()
{
	var spans = $('.ms-error');
	spans.text(''); // clear the text
	
	 var expemail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	 var i =0;
 if(!document.theatrelogin.theatreloginid.value.match(expemail))
	{
		document.getElementById("idtheatreloginid").innerHTML="Email ID is not valid..";		
		i=1;		
	}
	if(document.theatrelogin.theatreloginid.value == "" )
	{
		document.getElementById("idtheatreloginid").innerHTML="Email ID should not be empty..";
       i=1;		
	}
	if(document.theatrelogin.theatrepassword.value  == "" )
	{
		document.getElementById("idtheatrepassword").innerHTML="Password should not be empty..";		
		i=1;
	}
	if(document.theatrelogin.theatrepassword.value < 6 )
	{
		document.getElementById("idtheatrepassword").innerHTML="Password should contain atleast 6 characters..";		
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

