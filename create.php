<?php  ?>
<html>
<head>
	<title>Picstory</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<!-- multistep form -->
<form enctype="multipart/form-data" id="msform" method="post" action="generator.php">
	<!-- progressbar -->
	<ul id="progressbar">
		<li class="active">Start</li>
		<li>Step 2</li>
		<li>Step 3</li>
		<li>Step 4</li>
		<li>Step 5</li>
		<li>Step 6</li>
		<li>Step 7</li>
		<li>Step 8</li>
		<li>Step 9</li>
		<li>Ready</li>
	</ul>
	<!-- fieldsets -->
	<fieldset>
		<h2 class="fs-title">Start</h2>
		<h3 class="fs-subtitle">Basic Information of Event</h3>
		<input type="text" name="event" placeholder="Event Name (e.g. Mom's Birthday / Trip to California)" />
		<input type="text" name="location" placeholder="Location (Optional)" />
		<input type="text" name="whom" placeholder="Picstory By ... (Enter only Name / Nickname)" />
		<select>
			<option selected disabled value="">Select Visual Effect</option>
			<option value="fade-in">Custom 1</option>
			<option value="fade-out">Fade-out</option>
			<option value="slide-left">Slide-left</option>
			<option value="slide-right">Slide-right</option>
			<option value="rotate-180">Rotate 180 degree</option>
			<option value="rotate-360">Rotate 360 degree</option>
			<option value="slide-right">Slide-right</option>
		</select>
		<input type="button" name="next1" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Step 2</h2>
		<h3 class="fs-subtitle">Event Details / Photo</h3>
		<input type="textarea" name="detail1" placeholder="Some brief sweet memories..." /><br/>OR<br/>
		<input type="file" name="pic1" accept="image/*">
		<input type="button" name="previous2" class="previous action-button" value="Previous" />
		<input type="button" name="next2" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Step 3</h2>
		<h3 class="fs-subtitle">Event Details / Photo</h3>
		<input type="textarea" name="detail2" placeholder="Some brief sweet memories..." /><br/>OR<br/>
		<input type="file" name="pic2" accept="image/*">
		<input type="button" name="previous3" class="previous action-button" value="Previous" />
		<input type="button" name="next3" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Step 4</h2>
		<h3 class="fs-subtitle">Event Details / Photo</h3>
		<input type="textarea" name="detail3" placeholder="Some brief sweet memories..." /><br/>OR<br/>
		<input type="file" name="pic3" accept="image/*">
		<input type="button" name="previous4" class="previous action-button" value="Previous" />
		<input type="button" name="next4" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Step 5</h2>
		<h3 class="fs-subtitle">Event Details / Photo</h3>
		<input type="textarea" name="detail4" placeholder="Some brief sweet memories..." /><br/>OR<br/>
		<input type="file" name="pic4" accept="image/*">
		<input type="button" name="previous5" class="previous action-button" value="Previous" />
		<input type="button" name="next5" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Step 6</h2>
		<h3 class="fs-subtitle">Event Details / Photo</h3>
		<input type="textarea" name="detail5" placeholder="Some brief sweet memories..." /><br/>OR<br/>
		<input type="file" name="pic5" accept="image/*">
		<input type="button" name="previous6" class="previous action-button" value="Previous" />
		<input type="button" name="next6" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Step 7</h2>
		<h3 class="fs-subtitle">Event Details / Photo</h3>
		<input type="textarea" name="detail6" placeholder="Some brief sweet memories..." /><br/>OR<br/>
		<input type="file" name="pic6" accept="image/*">
		<input type="button" name="previous7" class="previous action-button" value="Previous" />
		<input type="button" name="next7" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Step 8</h2>
		<h3 class="fs-subtitle">Event Details / Photo</h3>
		<input type="textarea" name="detail7" placeholder="Some brief sweet memories..." /><br/>OR<br/>
		<input type="file" name="pic7" accept="image/*">
		<input type="button" name="previous8" class="previous action-button" value="Previous" />
		<input type="button" name="next8" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Step 9</h2>
		<h3 class="fs-subtitle">Event Details / Photo</h3>
		<input type="textarea" name="detail8" placeholder="Some brief sweet memories..." /><br/>OR<br/>
		<input type="file" name="pic8" accept="image/*">
		<input type="button" name="previous9" class="previous action-button" value="Previous" />
		<input type="button" name="next9" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Ready!</h2>
		<h3 class="fs-subtitle">Event Details / Photo</h3>
		<input type="textarea" name="detail9" placeholder="Some brief sweet memories..." /><br/>OR<br/>
		<input type="file" name="pic9" accept="image/*">
		<input type="button" name="previous10" class="previous action-button" value="Previous" />
		<input type="submit" name="submit" class="submit action-button" value="Generate" />
	</fieldset>
</form>
<script src="js/jquery-2.1.0.min.js" type="text/javascript"></script>
<script src="js/jquery.easing.min.js" type="text/javascript"></script>
<script src="js/myscriptt.js"></script>
</body>
</html>
