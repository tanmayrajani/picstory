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
    
    <hr/>
    <input type="button" name="previous2" class="previous action-button" value="Previous" />
    <input type="button" name="next2" class="next action-button" value="Next" /><br/><br/><br/>
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Ready!</h2>
    <h3 class="fs-subtitle">Almost there</h3>
    <h1 class="fs-ready">Hit Generate to create your Picstory</h1><br/>
    <input type="button" name="previous10" class="previous action-button" value="Previous" />
    <input type="submit" name="submit" class="submit action-button" value="Generate" />
  </fieldset>
</form>
<script src="js/jquery-2.1.0.min.js" type="text/javascript"></script>
<script src="js/jquery.easing.min.js" type="text/javascript"></script>
<script src="js/myscriptt.js"></script>
</body>
</html>
