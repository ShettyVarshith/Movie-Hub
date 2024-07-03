	
	<!-- blog -->
	<div id="blog" class="blog gallery">
		<div class="container">        
			<h3 class="agileits-title">Post feedback about this movie </h3>			
<form method="post"	 action="">

<script src="richtexteditor/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<textarea name="feedback" id="descriptions" class="form-control"  rows="6" placeholder=" Description *"></textarea>
Enter ratings : 
<select name="rating" class="form-control">
	<option value=''>Select</option>
	<option value='1'>1</option>
	<option value='2'>2</option>
	<option value='3'>3</option>
	<option value='4'>4</option>
	<option value='5'>5</option>
	<option value='6'>6</option>
	<option value='7'>7</option>
	<option value='8'>8</option>
	<option value='9'>9</option>
	<option value='10'>10</option>	
</select>
<br>
<button type="submit" name="submit" class="btn btn-primary btn-lg"  >Post Feedback</button>
</form>
			<?php
			$sqlfeedback = "SELECT * FROM feedback LEFT JOIN customer ON customer.customerid= feedback.customerid LEFT JOIN movie ON movie.movieid = feedback.movieid LEFT JOIN theatre on theatre.theatreid=feedback.theatreid where feedback.status='Active' AND feedback.movieid='$_GET[movieid]' order by feedback.feedbackid DESC";
			$qsqlfeedback = mysqli_query($con,$sqlfeedback);
			while($rsfeedback = mysqli_fetch_array($qsqlfeedback))
			{
			?>
			<div class="blog-agileinfo" style="margin-top: 0em;">
				<div class="col-md-1 blog-w3grid-img"></div>
				<div class="col-md-11 blog-w3grid-text"> 
					<h4><a href="#myModal" data-toggle="modal">Ratings</a></h4>
					<h6>By <a href="#"> <?php echo $rsfeedback[customername]; ?></a> - <?php echo date("M d, Y",strtotime($rsfeedback[feedbackdate])); ?></h6>
					<p><?php echo $rsfeedback[feedback]; ?></p>
				</div> 
				<div class="clearfix"> </div>
			</div> 
			<?php
			}
			?>
			
				<div class="clearfix"> </div>
			</div> 
		</div>
	

		