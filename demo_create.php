<?php  ?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Picstory is photo story generator application with amazing animations and transitions.">

    <title>Picstory | Modern World Photo Sharing</title>

<link rel="stylesheet" href="css/pure-min.css">

<!--[if lte IE 8]>
  
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-old-ie-min.css">
  
<![endif]-->
<!--[if gt IE 8]><!-->
  
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
  
<!--<![endif]-->

    <!--[if lte IE 8]>
        <link rel="stylesheet" href="css/marketing-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="css/marketing.css">
    <!--<![endif]-->
  <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>

<div class="header">
    <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href=""></a>

        <ul class="pure-menu-list">
            <li class="pure-menu-item"><a href="http://localhost/git/picstory/" class="pure-menu-link">Home</a></li>
            <li class="pure-menu-item"><a target="_blank" href="http://localhost/git/picstory/story.html" class="pure-menu-link">Demo</a></li>
            <li class="pure-menu-item"><a href="http://localhost/git/picstory/index.php?reset=1" class="pure-menu-link">Sign Out(<?php echo $_GET['user_name']; ?>)</a></li>
        </ul>
    </div>
</div>

<!-- multistep form -->
<form enctype="multipart/form-data" id="msform" method="post" action="generator.php?user_id=<?php echo $_GET['user_id']; ?>&user_name=<?php echo $_GET['user_name'] ?>">
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
    <input type="text" id="event" name="event" placeholder="Event Name (e.g. Mom's Birthday / Trip to California)" />
    <input type="text" id="location" name="location" placeholder="Location (Optional)" />
    <input type="text" id="whom" name="whom" readonly value="<?php echo $_GET['user_name']; ?>" placeholder="Picstory By ... (Enter only Name / Nickname)" />
    <select id="visual" name="visual">
      <option disabled value="">Select Visual Effect</option>
      <option selected value="fade-in">Template 1</option>
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
    <h3 class="fs-subtitle">Upload All photos (Max. 8 Currently)</h3>
    <!-- <input type="textarea" name="detail1" placeholder="Some brief sweet memories..." /><br/>OR<br/>
    <input type="file" name="pic1" accept="image/*"> -->
    <div id="dvPreview"></div>
    <input id="fileupload" type="file" name="imageURL[]" class="img" multiple="multiple" />
    <input type="button" name="previous2" class="previous action-button" value="Previous" />
    <input type="button" name="next3" class="next action-button" value="Next" /><br/><br/><br/>
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Ready!</h2>
    <h3 class="fs-subtitle">Almost there</h3>
    <!-- <h1 class="fs-ready">Hit Generate to create your Picstory</h1><br/> -->
    <input type="text" name="msg" placeholder="Enter your personalized message.. (If any)"/>
    <input type="button" name="previous3" class="previous action-button" value="Previous" />
    <input  type="submit" name="submit" class="submit action-button gen" value="Generate" />
  </fieldset>
</form>
<script src="js/jquery-2.1.0.min.js"></script>
<script src="js/jquery.easing.min.js" type="text/javascript"></script>
<script src="js/myscriptt.js"></script>
<script type="text/javascript">
$(function() {

    $("#fileupload").change(function () {
        if (typeof (FileReader) != "undefined") {
            //$("#msform").submit();
            var dvPreview = $("#dvPreview");
            dvPreview.html("");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            $($(this)[0].files).each(function () {
                var file = $(this);
                if (regex.test(file[0].name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = $("<img />");
                        img.attr("style", "height:80px;width: 80px");
                        img.attr("src", e.target.result);
                        dvPreview.append(img);
                    }
                    reader.readAsDataURL(file[0]);
                } else {
                    alert(file[0].name + " is not a valid image file.");
                    dvPreview.html("");
                    return false;
                }
            });
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    });
});
//$("#uploadFile").after('<input id="uploadFile" type="file" name="image" class="img" />');
</script>
</body>
</html>
