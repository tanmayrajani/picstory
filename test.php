<?php $myFile = "fileName.html";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = '<!doctype html><html lang="en"><head><meta charset="utf-8" /><meta name="viewport" content="width=1024" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title>JSON</title>

    <meta name="description" content="This is a Picstory. It is a photo presentation application created by Tanmay Rajani." />
    <meta name="author" content="Tanmay Rajani" /><link href="css/stylesofstory.css" rel="stylesheet" />
</head>
<body class="impress-not-supported"><div class="fallback-message"></div>
<div id="impress">
    <div id="json1" class="step slide" data-x="-3000" data-y="-1500">
        <center><h1 class="first-title">Trip to Calcutta</h1><br/>
          <h5 class="picstoryby">A Picstroy by Tanamy Rajani</h5>
        </center>
        <!-- TODO: Check if Location is not empty; Add Location -->
    </div>
    <div id="json2" class="step slide" data-x="-1000" data-y="-1500">
      <img src="1.jpg" class="imgclass" />
    </div>
    <div class="step slide" data-x="-1000" data-y="-1500" data-z="-500" data-rotate-y="900" >
      <img src="1.jpg" class="imgclass" />
    </div>
    <div class="step slide" data-x="-1000" data-y="-1500" data-z="9000" data-rotate-y="900">
        <p class="briefmemory">
          Or some sample text like this. This text is to write brief meomries about the event.
        </p>
    </div>
    <div class="slide2 step" data-x="0" data-y="1000" data-scale="4">
      <img src="1.jpg" class="imgclass" />
    </div>
    <div id="title2" class="step" data-x="5000" data-y="3000" data-rotate-x="60" data-rotate-y="1080" data-rotate-z="45" data-scale="6">
      <img src="1.jpg" class="imgclass" />
    </div>
    <div class="slide2 step" data-x="1000" data-y="-11000" data-scale="2">
      <center><h4 class="endtitle">Thank you!</h4><Br/>
      <h6>This was &nbsp;<b>Trip to Calcutta</b>&nbsp;<br/> by Tanmay Rajani.</h6>
      <br>
      <div id="createyours">
        Create your own picstory now at <a target="_blank" href="http://picstory.me">picstory.me</a>
      </div></center>
    </div>
</div>
<script src="js/jquery-2.1.0.min.js"></script>
<script src="js/jmpress.min.js"></script>
<script>$(function(){$("#impress").jmpress();});</script>
</body>
</html>
';
fwrite($fh, $stringData); ?>
