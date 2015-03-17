<?php
  if(isset($_POST['submit'])){
    $files=array();
    $fdata=$_FILES['imageURL'];
    if(is_array($fdata['name'])){
      for($i=0;$i<count($fdata['name']);++$i){
        $files[]=array(
          'name'  =>$fdata['name'][$i],
          'type'  => $fdata['type'][$i],
          'tmp_name'=>$fdata['tmp_name'][$i],
          'error' => $fdata['error'][$i], 
          'size'  => $fdata['size'][$i]  
        );
      }
    }
    else $files[]=$fdata;

    // foreach ($files as $file) { 
    //     echo $file['name'] . "<br/>";
    // }
    $paths = [];
    $target_path = "uploads/";
    for($i=0; $i<count($_FILES['imageURL']['name']); $i++){
        $ext = explode('.', basename( $_FILES['imageURL']['name'][$i]));
        $target_path = $target_path . md5($_GET['user_id']) . $i .".".$ext[count($ext)-1]; 
        if(move_uploaded_file($_FILES['imageURL']['tmp_name'][$i], $target_path)) {
            //echo "The file has been uploaded successfully <br />";
          $paths[$i] = $target_path;
          $_SESSION['okay']='okay';
        } else{
            echo "There was an error uploading the file, please try again! <br />";
        }
    }
  }
  else header('Location: index.php');
?>
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
            <li class="pure-menu-item"><a href="http://localhost/git/picstory/index.php?reset=1" class="pure-menu-link">Sign Out (<?php echo $_GET['user_name']; ?>)</a></li>
        </ul>
    </div>
</div>

<?php

    $filename='stories/'.$_GET['user_id'].'.html';
    $fh = fopen($filename, 'w') or die("can't open file");

  if (isset($_SESSION['okay']))
  {
      
    $stringData = '<!doctype html><html lang="en"><head><meta charset="utf-8" /><meta name="viewport" content="width=1024" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <title>'.$_POST['event'].'</title>

        <meta name="description" content="This is a Picstory. It is a photo presentation application created by Tanmay Rajani." />
        <meta name="author" content="Tanmay Rajani" /><link href="../css/stylesofstory.css" rel="stylesheet" />
    </head>
    <body class="impress-not-supported"><div class="fallback-message"></div>
    <div id="impress">
        <div id="json1" class="step slide" data-x="-3000" data-y="-1500">
            <center><h1 class="first-title">'.$_POST['event'].'</h1><br/>
              <h5 class="picstoryby">A Picstroy by '.$_POST['whom'].'</h5>
            </center>
            <!-- TODO: Check if Location is not empty; Add Location -->
        </div>
        <div id="json2" class="step slide" data-x="-1000" data-y="-1500">
          <img src="../'.$paths[0].'" class="imgclass" />
        </div>
        <div class="step slide" data-x="-1000" data-y="-1500" data-z="-500" data-rotate-y="900" >
          <p class="briefmemory">'.$_POST['msg'].'</p>
        </div>
        <div class="step slide" data-x="-1000" data-y="-1500" data-z="9000" data-rotate-y="900">
          <img src="../'.$paths[1].'" class="imgclass" />
        </div>
        <div class="slide2 step" data-x="0" data-y="1000" data-scale="4">
          <img src="../'.$paths[2].'" class="imgclass" />
        </div>
        <div id="title2" class="step" data-x="5000" data-y="3000" data-rotate-x="60" data-rotate-y="1080" data-rotate-z="45" data-scale="6">
          <img src="../'.$paths[3].'" class="imgclass" />
        </div>
        <div class="slide2 step" data-x="1000" data-y="-11000" data-scale="2">
          <center><h4 class="endtitle">Thank you!</h4><Br/>
          <h6>This was &nbsp;<b>'.$_POST['event'].'</b>&nbsp;<br/> by '.$_POST['whom'].'.</h6>
          <br>
          <div id="createyours">
            Create your own picstory now at &nbsp;<a target="_blank" href="http://picstory.me">picstory.me</a>
          </div></center>
        </div>
    </div>
    <div id="request2"></div>
    <script src="../js/jquery-2.1.0.min.js"></script>
    <script src="../js/jmpress.min.js"></script>
    <script src="http://sindresorhus.com/screenfull.js/src/screenfull.js"></script>
    <script>
    $(function(){
      $("#impress").jmpress();
      if (!screenfull.enabled) {
        $("#request2").click(function () {
          alert("full screen is not supported! :/");
        });          
      }
      else{
        $("#request2").click(function () {
          screenfull.toggle();
        });  
      }
    });</script>
    </body>
    </html>
    ';
    fwrite($fh, $stringData);
  }
  else echo "something went wrong!";


?>
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
    <input type="button" name="view" class="view action-button" onclick="window.open('<?php echo 'stories/'.$_GET['user_id'].".html"; ?>','_blank')" value="View" />
    <input type="button" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=http://localhost/git/picstory/stories/<?php echo $_GET['user_id'].".html"; ?>','_blank')" name="fbshare" class="fbshare action-button" value="Facebook" />
    <input type="button" onclick="window.open('https://<?php echo $_GET['user_id'].".html"; ?>','_blank')" name="twshare" class="twshare action-button" value="Twitter" />
    <input type="button" onclick="window.open('<?php echo $_SERVER[ 'DOCUMENT_ROOT' ] ?>','_blank')" name="gpshare" class="gpshare action-button" value="Google+" />
  </fieldset>
</div>
<script src="js/jquery-2.1.0.min.js" type="text/javascript"></script>
<script src="js/jquery.easing.min.js" type="text/javascript"></script>
<script src="js/myscriptt.js"></script>
<script>

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
