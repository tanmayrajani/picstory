<?php
  if(isset($_POST['submit'])){

    $db_username = "root"; //Database Username
    $db_password = "tanmay"; //Database Password
    $hostname = "localhost"; //Mysql Hostname
    $db_name = 'picstory'; //Database Name

    $mysqli = new mysqli($hostname, $db_username, $db_password, $db_name);
  
    if ($mysqli->connect_error) {
      $_SESSION['uuser']='wrong';
      echo "sonething wont wrong!!";
      die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }
    else{
          $xx= "SELECT * FROM google_users WHERE google_id=".$_POST['userid'];
          $detailss = $mysqli->query($xx); 
          if($detailss)
          {
              $yy = mysqli_fetch_array($detailss);

          }else{ 
              echo "sonething wont wrong!!!";
          }
    }

    $paths = array();
    
    if (!is_dir('uploads/'.md5($yy[0]))) {
      mkdir('uploads/'.md5($yy[0]), 0777, true);
    }
    else{
      $files = glob('uploads/'.md5($yy[0])."/*"); // get all file names
      foreach($files as $file){ // iterate files
        if(is_file($file))
          unlink($file); // delete file
      }
    }

    for($i=0; $i<count($_FILES['imageURL']['name']); $i++){

        
        $ext = explode('.', basename( $_FILES['imageURL']['name'][$i]));
        $target_path = "uploads/" . md5($yy[0]) . "/" . md5($yy[0]) . $i .".".$ext[count($ext)-1]; 
        if(move_uploaded_file($_FILES['imageURL']['tmp_name'][$i], $target_path)) {
            //echo "The file has been uploaded successfully <br />";
          $paths[$i] = $target_path;
          $_SESSION['okay']='okay';
        } else{
            echo "<br/><br/><br/><br/><br/>There was an error uploading the file, please try again later! <br />";
        }
    }
  }
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
        <a class="pure-menu-heading" href="index.php"></a>
        <ul class="pure-menu-list">
            <li class="pure-menu-item"><a href="http://localhost/git/picstory/" class="pure-menu-link">Home</a></li>
            <li class="pure-menu-item"><a target="_blank" href="http://localhost/git/picstory/story.html" class="pure-menu-link">Demo</a></li>
            <li class="pure-menu-item"><a href="http://localhost/git/picstory/index.php?reset=1" class="pure-menu-link">Sign Out (<?php echo $yy[1]; ?>)</a></li>
        </ul>
    </div>
</div>

<?php

    $filename='stories/'.$yy[0].'.html';
    $fh = fopen($filename, 'w') or die("can't open file");

  if (isset($_SESSION['okay']))
  {
      
    $stringData = '<!doctype html><html lang="en"><head><meta charset="utf-8" /><meta name="viewport" content="width=1024" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <title>'.$_POST['event'].'</title>

        <meta name="description" content="This is a Picstory. It is a photo presentation application created by Tanmay Rajani." />
        <meta name="author" content="Tanmay Rajani" /><link href="../css/stylesofstory.css" rel="stylesheet" />';
        if(isset($_POST['visual'])){
          if($_POST['visual']=='pink'){
            $stringData = $stringData . '<style>body{background: rgba(233,30,98,1); background: -moz-radial-gradient(center, ellipse cover, rgba(233,30,98,1) 0%, rgba(136,14,79,1) 56%, rgba(77,9,45,1) 100%); background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(233,30,98,1)), color-stop(56%, rgba(136,14,79,1)), color-stop(100%, rgba(77,9,45,1))); background: -webkit-radial-gradient(center, ellipse cover, rgba(233,30,98,1) 0%, rgba(136,14,79,1) 56%, rgba(77,9,45,1) 100%); background: -o-radial-gradient(center, ellipse cover, rgba(233,30,98,1) 0%, rgba(136,14,79,1) 56%, rgba(77,9,45,1) 100%); background: -ms-radial-gradient(center, ellipse cover, rgba(233,30,98,1) 0%, rgba(136,14,79,1) 56%, rgba(77,9,45,1) 100%); background: radial-gradient(ellipse at center, rgba(233,30,98,1) 0%, rgba(136,14,79,1) 56%, rgba(77,9,45,1) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#EB3472", endColorstr="#82536c", GradientType=1 );}</style>';
          }
          elseif ($_POST['visual']=='yellow') {
            $stringData = $stringData . '<style>body{background: rgba(255,235,59,1); background: -moz-radial-gradient(center, ellipse cover, rgba(255,235,59,1) 0%, rgba(245,127,23,1) 52%, rgba(163,99,42,1) 100%); background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(255,235,59,1)), color-stop(52%, rgba(245,127,23,1)), color-stop(100%, rgba(163,99,42,1))); background: -webkit-radial-gradient(center, ellipse cover, rgba(255,235,59,1) 0%, rgba(245,127,23,1) 52%, rgba(163,99,42,1) 100%); background: -o-radial-gradient(center, ellipse cover, rgba(255,235,59,1) 0%, rgba(245,127,23,1) 52%, rgba(163,99,42,1) 100%); background: -ms-radial-gradient(center, ellipse cover, rgba(255,235,59,1) 0%, rgba(245,127,23,1) 52%, rgba(163,99,42,1) 100%); background: radial-gradient(ellipse at center, rgba(255,235,59,1) 0%, rgba(245,127,23,1) 52%, rgba(163,99,42,1) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#ffeb3b", endColorstr="#a3632a", GradientType=1 );}</style>';
          }
          elseif ($_POST['visual']=='deep-orange') {
            $stringData = $stringData . '<style>body{background: rgba(255,86,34,1); background: -moz-radial-gradient(center, ellipse cover, rgba(255,86,34,1) 0%, rgba(191,54,12,1) 53%, rgba(92,26,6,1) 100%); background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(255,86,34,1)), color-stop(53%, rgba(191,54,12,1)), color-stop(100%, rgba(92,26,6,1))); background: -webkit-radial-gradient(center, ellipse cover, rgba(255,86,34,1) 0%, rgba(191,54,12,1) 53%, rgba(92,26,6,1) 100%); background: -o-radial-gradient(center, ellipse cover, rgba(255,86,34,1) 0%, rgba(191,54,12,1) 53%, rgba(92,26,6,1) 100%); background: -ms-radial-gradient(center, ellipse cover, rgba(255,86,34,1) 0%, rgba(191,54,12,1) 53%, rgba(92,26,6,1) 100%); background: radial-gradient(ellipse at center, rgba(255,86,34,1) 0%, rgba(191,54,12,1) 53%, rgba(92,26,6,1) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#ff5622", endColorstr="#5c1a06", GradientType=1 );}</style>';
          }
          elseif ($_POST['visual']=='red') {
            $stringData = $stringData . '<style>body{background: rgba(244,66,54,1); background: -moz-radial-gradient(center, ellipse cover, rgba(244,66,54,1) 0%, rgba(183,28,28,1) 49%, rgba(97,8,8,1) 100%); background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(244,66,54,1)), color-stop(49%, rgba(183,28,28,1)), color-stop(100%, rgba(97,8,8,1))); background: -webkit-radial-gradient(center, ellipse cover, rgba(244,66,54,1) 0%, rgba(183,28,28,1) 49%, rgba(97,8,8,1) 100%); background: -o-radial-gradient(center, ellipse cover, rgba(244,66,54,1) 0%, rgba(183,28,28,1) 49%, rgba(97,8,8,1) 100%); background: -ms-radial-gradient(center, ellipse cover, rgba(244,66,54,1) 0%, rgba(183,28,28,1) 49%, rgba(97,8,8,1) 100%); background: radial-gradient(ellipse at center, rgba(244,66,54,1) 0%, rgba(183,28,28,1) 49%, rgba(97,8,8,1) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#F77B72", endColorstr="#610808", GradientType=1 );}</style>';
          }
        }
          
    $stringData = $stringData . '</head>
    <body class="impress-not-supported"><div class="fallback-message"></div>
    <div id="impress">
        <div class="step slide" data-x="-3000" data-y="-1500">
            <center><h1 class="first-title">'.$_POST['event'].'</h1><br/>
              <h5 class="picstoryby">A Picstroy by '.$_POST['whom'].'</h5>';
        if(isset($_POST['location'])){
          $stringData = $stringData . '<span class="icon">'.$_POST['location'].'</span>';
        }
        $stringData = $stringData . '</center></div>';
        if(isset($paths[0])){
          $stringData = $stringData . '<div class="step slide" data-x="-1000" data-y="-1500" data-z="9000" data-rotate-y="900">
          <img id="im1" src="../'.$paths[0].'" class="imgclass" /></div>';
          if(isset($paths[1])){
            $stringData = $stringData . '<div class="slide2 step" data-x="0" data-y="1000" data-scale="4"><img src="../'.$paths[1].'" id="im2" class="imgclass" /></div>';
            if(isset($paths[2])){
              $stringData = $stringData . '<div class="step" data-x="5000" data-y="3000" data-rotate-x="60" data-rotate-y="1080" data-rotate-z="45" data-scale="6"><img id="im3" src="../'.$paths[2].'" class="imgclass" /></div>';
              if(isset($paths[3])){
                $stringData = $stringData . '<div class="step slide" data-x="5000" data-y="3000" data-rotate-x="60" data-rotate-y="180" data-rotate-z="45" data-scale="6"><img id="im4" src="../'.$paths[3].'" class="imgclass" /></div>';  
                if(isset($paths[4])){
                  $stringData = $stringData . '<div class="step slide" data-x="5000" data-y="13000" data-rotate-x="90"><img id="im5" src="../'.$paths[4].'" class="imgclass" /></div>';  
                  if(isset($paths[5])){
                    $stringData = $stringData . '<div class="step slide" data-x="5000" data-y="3000" data-rotate-x="60" data-rotate-y="180" data-rotate-z="45" data-scale="6"><img id="im6" src="../'.$paths[5].'" class="imgclass" /></div>';  
                    if(isset($paths[6])){
                      $stringData = $stringData . '<div class="step slide" data-x="-11000" data-y="13000" data-rotate-x="60" data-rotate-y="180" data-rotate-z="45" data-scale="6"><img id="im7" src="../'.$paths[6].'" class="imgclass" /></div>';  
                    }
                  }
                }
              }
            }
          }  
        } 
        
      $stringData = $stringData . '<div class="slide2 step" data-x="1000" data-y="-11000" data-scale="2">
          <center><h4 class="endtitle">Thank you!</h4><Br/>
          <h6>This was &nbsp;<b>'.$_POST['event'].'</b>&nbsp;<br/> by '.$_POST['whom'].'.</h6>
          <br>
          <div id="createyours">
            Create your own picstory now at &nbsp;<a class="picstory-link" target="_blank" href="http://picstory.me">picstory.me</a>
          </div></center>
        </div>
    </div>
    <div id="request2"></div>
    <script src="../js/jquery-2.1.0.min.js"></script>
    <script src="../js/impress.min.js"></script>
    <script src="http://sindresorhus.com/screenfull.js/src/screenfull.js"></script>
    <script>
    $(function(){
      impress().init();
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
    <input type="button" name="view" class="view action-button" onclick="window.open('<?php echo 'stories/'.$yy[0].".html"; ?>','_blank')" value="View" />
    <input type="button" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=http://localhost/git/picstory/stories/<?php echo $yy[0].".html"; ?>','_blank')" name="fbshare" class="fbshare action-button" value="Facebook" />
    <input type="button" onclick="window.open('https://<?php echo $yy[0].".html"; ?>','_blank')" name="twshare" class="twshare action-button" value="Twitter" />
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
