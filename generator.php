<?php  ?>
<html>
<head>
  <title>Picstory</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<div id="msform">
  <fieldset>
    <h2 class="fs-title">Awesome!</h2>
    <h3 class="fs-subtitle">You've just created a picstory!</h3>
    <img class="happy" src="media/happy64.png" alt="Awesome" />
    <input type="button" name="view" class="view action-button" value="View" />
    <input type="button" name="edit" class="edit action-button" value="Edit" />
    <input type="button" name="fbshare" class="fbshare action-button" value="Facebook" />
    <input type="button" name="twshare" class="twshare action-button" value="Twitter" />
    <input type="button" name="gpshare" class="gpshare action-button" value="Google+" />
  </fieldset>
</div>
<script src="js/jquery-2.1.0.min.js" type="text/javascript"></script>
<script src="js/jquery.easing.min.js" type="text/javascript"></script>
<script src="js/myscriptt.js"></script>
<script>
  $(".view").click(function(){
    window.open('my-picstory-1.html','_blank');
  });

  $(".edit").click(function(){
    window.open('create.php','_self');
  });

  $(".fbshare").click(function(){
    alert('Facebook share window appers!');
  });

  $(".twshare").click(function(){
    alert('Twitter share window appers!');
  });

  $(".gpshare").click(function(){
    alert('Google+ share window appers!');
  });
</script>
<script src="js/generator.js"></script>
</body>
</html>
