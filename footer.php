	<!-- copy rights start here -->
	<div class="copyw3-agile">
		<div class="container">  

			<p>© 2022 Movie Hub. All Rights Reserved | Designed by Hardik Varshith Deon | 
			
			<?php
			if(isset($_SESSION["adminid"]))
			{
			?>				
			<a href="dashboard.php"> Admin Account</a>  | 
			<a href="logout.php">Logout</a>  
			<?php
			}
			else if(isset($_SESSION["theatreid"]))
			{
			?>				
			<a href="theatredashboard.php"> theatre Account</a>  | 
			<a href="logout.php">Logout</a>  
			<?php
			}
			else
			{
			?>
<a href="#" data-toggle="modal" data-target="#myModal4">theatre Login</a>	 | 
<a href="theatreregistration.php">Theatre Registration</a>	 | 	
<a href="#" data-toggle="modal" data-target="#myModal3">Admin Login</a> 
			<?php
			}
			?>
			</p>
			
		</div>
	</div>
	<!-- //copy right end here --> 
	<!-- modal -->
	<div class="modal about-modal w3-agileits fade" id="myModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
				</div> 
				<div class="modal-body">
					<img src="images/g5.jpg" alt=""> 
					<h5>Cras rutrum iaculis enim</h5>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras rutrum iaculis enim, non convallis felis mattis at. Donec fringilla lacus eu pretium rutrum. Cras aliquet congue ullamcorper. Etiam mattis eros eu ullamcorper volutpat. Proin ut dui a urna efficitur varius. uisque molestie cursus mi et congue consectetur adipiscing elit cras rutrum iaculis enim, Lorem ipsum dolor sit amet, non convallis felis mattis at. Maecenas sodales tortor ac ligula ultrices dictum et quis urna. Etiam pulvinar metus neque, eget porttitor massa vulputate. </p>
				</div> 
			</div>
		</div>
	</div>
	<!-- //modal --> 
	<!-- timer scripts --> 
	<script type="text/javascript" src=" js/moment.js"></script>
	<script type="text/javascript" src=" js/moment-timezone-with-data.js"></script>
	<script type="text/javascript" src="js/timer.js"></script>
	<!-- //timer scripts -->
	<!-- start-smooth-scrolling --> 
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>	
	<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
			
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
	</script>
	<!-- //end-smooth-scrolling -->	 
	<!-- smooth-scrolling-of-move-up -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
	<!-- //smooth-scrolling-of-move-up -->   
	<!-- Scrolling Nav JavaScript --> 
    <script src="js/scrolling-nav.js"></script>  
	<!-- //fixed-scroll-nav-js -->  
	<!-- bth hover effect --> 
	<script>
	$(function() {
		$('.btn-6')
		.on('mouseenter', function(e) {
			var parentOffset = $(this).offset(),
			relX = e.pageX - parentOffset.left,
			relY = e.pageY - parentOffset.top;
		  $(this).find('span').css({
			top: relY,
			left: relX
		  })
		})
		.on('mouseout', function(e) {
		  var parentOffset = $(this).offset(),
			relX = e.pageX - parentOffset.left,
			relY = e.pageY - parentOffset.top;
		  $(this).find('.btn-6 span').css({
			top: relY,
			left: relX
		  })
		}); 
	});
	</script>	
	<!-- //bth hover effect --> 
	<!-- jarallax -->
	<script src="js/jarallax.js"></script>
	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript">
		/* init Jarallax */
		$('.jarallax').jarallax({
			speed: 0.5,
			imgWidth: 1366,
			imgHeight: 768
		})
	</script>
	<!-- //jarallax -->   
	<!-- FlexSlider --> 
	<script defer src="js/jquery.flexslider.js"></script>
	<script type="text/javascript">
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	</script>
	<!-- //End-FlexSlider -->  
	<!-- pop-up-script -->
	<script src="js/jquery.chocolat.js"></script>
	<script type="text/javascript">
	$(function() {
		$('.view-seventh a').Chocolat();
	});
	
	</script>
	<!-- //pop-up-script -->  
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.js"></script>
</body>
</html>
<?php
include("datatable.php");
?>
<?php
if(isset($_POST[empbtnlogin]))
{
?>
<script>
	$(window).load(function(){
		$('#myModal3').modal('show'); 
	})
</script>
<?php
}
?>
<?php
if(isset($_POST[theatrebtnlogin]))
{
?>
<script>
	$(window).load(function(){
		$('#myModal4').modal('show'); 
	})
</script>
<?php
}
?>
<?php
if(isset($_POST[btnlogin]))
{
?>
<script>
	$(window).load(function(){
		$('#myModal').modal('show'); 
	})
</script>
<?php
}
?>