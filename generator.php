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

    foreach ($files as $file) { 
        echo $file['name'] . "<br/>";
    }

    $target_path = "uploads/";
    for($i=0; $i<count($_FILES['imageURL']['name']); $i++){
        $ext = explode('.', basename( $_FILES['imageURL']['name'][$i]));
        $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext)-1]; 

        if(move_uploaded_file($_FILES['imageURL']['tmp_name'][$i], $target_path)) {
            //echo "The file has been uploaded successfully <br />";
        } else{
            echo "There was an error uploading the file, please try again! <br />";
        }
    }
  }
  else header('Location: demo_create.php');


  //   $filename="user1.html";
  //   $fh = fopen($filename, 'w') or die("can't open file");

  // if ((($_FILES['pic1']['type'] == 'image/jpeg') || $_FILES['pic1']['type'] == 'image/jpg') && $_FILES['pic1']['size'] < 1000000 && $_FILES['pic1']['size'] > 0)
  //   {
  //     if(file_exists('photos/'.md5($_SESSION['username'],false) .'.jpg'))
  //         unlink('photos/'.md5($_SESSION['username'],false) .'.jpg');

  //     $_FILES['pic1']['name']=md5($_SESSION['username'],false) .'.jpg';
  //     $src = 'photos/'.$_FILES['pic1']['name'];

  //     if(move_uploaded_file($_FILES['pic1']['tmp_name'], $src)) {
  //       //echo '<p>The file has been successfully uploaded.</p>';
  //       $flag=true;
  //     }
  //   }
  //   else
  //   {
  //     echo "<div align='center'><font color='#FF0000'>Invalid image. Please select valid image.</font></div><br>";
  //     $flag=false;
  //   }


    // if(isset($_POST['pic1'])){
    //   $uploaddir = "/git/picstory/";
    //   $uploadfile = $uploaddir . basename($_FILES['pic1']['name']);
    //   echo '<pre>';
    //   if (move_uploaded_file($_FILES['pic1']['tmp_name'], $uploadfile)) {
    //       echo "File is valid, and was successfully uploaded.\n";
    //   } else {
    //       echo "Possible file upload attack!\n";
    //   }
    //   echo 'Here is some more debugging info:';
    //   print_r($_FILES);
    //   print "</pre>";
    // }

  //   $stringData = '<!doctype html><html lang="en"><head><meta charset="utf-8" /><meta name="viewport" content="width=1024" />
  //       <meta name="apple-mobile-web-app-capable" content="yes" />
  //       <title>'.$_POST['event'].'</title>

  //       <meta name="description" content="This is a Picstory. It is a photo presentation application created by Tanmay Rajani." />
  //       <meta name="author" content="Tanmay Rajani" /><link href="css/stylesofstory.css" rel="stylesheet" />
  //   </head>
  //   <body class="impress-not-supported"><div class="fallback-message"></div>
  //   <div id="impress">
  //       <div id="json1" class="step slide" data-x="-3000" data-y="-1500">
  //           <center><h1 class="first-title">'.$_POST['event'].'</h1><br/>
  //             <h5 class="picstoryby">A Picstroy by '.$_POST['whom'].'</h5>
  //           </center>
  //           <!-- TODO: Check if Location is not empty; Add Location -->
  //       </div>
  //       <div id="json2" class="step slide" data-x="-1000" data-y="-1500">
  //         <img src="photos/'.md5($_SESSION['username']).'.jpg" class="imgclass" />
  //       </div>
  //       <div class="step slide" data-x="-1000" data-y="-1500" data-z="-500" data-rotate-y="900" >
  //         <p class="briefmemory">'.$_POST['detail2'].'</p>
  //       </div>
  //       <div class="step slide" data-x="-1000" data-y="-1500" data-z="9000" data-rotate-y="900">
  //         <img src="1.jpg" class="imgclass" />
  //       </div>
  //       <div class="slide2 step" data-x="0" data-y="1000" data-scale="4">
  //         <img src="1.jpg" class="imgclass" />
  //       </div>
  //       <div id="title2" class="step" data-x="5000" data-y="3000" data-rotate-x="60" data-rotate-y="1080" data-rotate-z="45" data-scale="6">
  //         <img src="1.jpg" class="imgclass" />
  //       </div>
  //       <div class="slide2 step" data-x="1000" data-y="-11000" data-scale="2">
  //         <center><h4 class="endtitle">Thank you!</h4><Br/>
  //         <h6>This was &nbsp;<b>'.$_POST['event'].'</b>&nbsp;<br/> by '.$_POST['whom'].'.</h6>
  //         <br>
  //         <div id="createyours">
  //           Create your own picstory now at &nbsp;<a target="_blank" href="http://picstory.me">picstory.me</a>
  //         </div></center>
  //       </div>
  //   </div>
  //   <script src="js/jquery-2.1.0.min.js"></script>
  //   <script src="js/jmpress.min.js"></script>
  //   <script>$(function(){$("#impress").jmpress();});</script>
  //   </body>
  //   </html>
  //   ';
  //   fwrite($fh, $stringData);
  // }
  // else echo "something went wrong!";


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
    <input type="button" name="view" class="view action-button" onclick="window.open('<?php echo "user1.html"; ?>','_blank')" value="View" />
    <input type="button" name="fbshare" class="fbshare action-button" value="Facebook" />
    <input type="button" name="twshare" class="twshare action-button" value="Twitter" />
    <input type="button" name="gpshare" class="gpshare action-button" value="Google+" />
  </fieldset>
</div>
<script src="js/jquery-2.1.0.min.js" type="text/javascript"></script>
<script src="js/jquery.easing.min.js" type="text/javascript"></script>
<script src="js/myscriptt.js"></script>
<script>
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
