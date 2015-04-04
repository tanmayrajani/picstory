<?php 

echo '<!doctype html>
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
  html>body #sortable li { height: 1.5em; line-height: 1.2em; }
  .ui-state-highlight { height: 1.5em; line-height: 1.2em; }
  .ui-state-default{cursor:n-resize;}
  </style>
</head>
<body>

<div class="header">
    <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href=""></a>

        <ul class="pure-menu-list">
            <li class="pure-menu-item"><a href="index.php" class="pure-menu-link">Home</a></li>';
        
            if(file_exists('stories/'.$_GET['user_id'].'.html')){
                echo '<li class="pure-menu-item"><a href="stories/'.$_GET['user_id'].'.html" target="_blank" class="pure-menu-link">Your Story</a></li><li class="pure-menu-item"><a href="" class="pure-menu-link">Edit</a></li>';
                echo '<li class="pure-menu-item"><a href="demo_create.php?user_id='.$_GET['user_id'].'&user_name='.$_GET['user_name'].'" class="pure-menu-link">Create New</a></li><li class="pure-menu-item"><a href="?reset=1" class="pure-menu-link">Sign Out ('.$_GET['user_name'].')</a></li>';
            }
?>
</ul></div></div><br/><br/>
<div id="msform">
  <fieldset>
    
    
      <?php 

      if (isset($_COOKIE['li_position'])) {

          //explode the cockie by ";"...
          $lis = explode(';', $_COOKIE['li_position']);
          $li='';
          // loop for each "id_#=#" ...
          $rightOrder = array();
          foreach ($lis as $key => $val) {
              //explode each value found by "="...
              $p = explode('=', $val);
              $id = str_replace('id_', '', $p[0]);
              $rightOrder[] = $id;
          }

          //display it
          //print_r($rightOrder) ;
          echo '<h3>New Order Saved!</h3>';
          $filename='stories/'.$_GET['user_id'].'.html';
          //echo $filename;

          $doc = new DOMDocument();
          $doc->loadHTMLFile($filename);
          
          for ($i=0; $i < sizeof($rightOrder); $i++) { 
            $im = $doc->getElementsByTagName('img')->item($i);
            $im->removeAttribute('src');
            if(file_exists('uploads/'.md5($_GET['user_id']).'/'.md5($_GET['user_id']).$rightOrder[$i]--.'.jpg'))
              $im->setAttribute('src','../uploads/'.md5($_GET['user_id']).'/'.md5($_GET['user_id']).$rightOrder[$i]--.'.jpg');
            else $im->setAttribute('src','../uploads/'.md5($_GET['user_id']).'/'.md5($_GET['user_id']).$rightOrder[$i]--.'.jpg');
          }

          $doc->saveHTMLFile($filename);

          setcookie("li_position", "", time()-3600);

      } else {
          echo '<h2 class="fs-title">Edit Story</h2> <h3 class="fs-subtitle">Reorder images here <span title="These images are in order of upload. Drag them up and down to reorder.">&nbsp;&nbsp;(<u>Help!</u>)</span></h3><center><ul id="sortable">';

          echo '<li id="id_1" class="ui-state-default">Item 1</li>';
          if(file_exists('uploads/'.md5($_GET['user_id']).'/'.md5($_GET['user_id']).'1.jpg') || file_exists("uploads/".md5($_GET['user_id']).'/'.md5($_GET['user_id'])."1.png")) {
            echo '<li id="id_2" class="ui-state-default">Item 2</li>';
              if(file_exists("uploads/".md5($_GET['user_id']).'/'.md5($_GET['user_id'])."2.jpg") || file_exists("uploads/".md5($_GET['user_id']).'/'.md5($_GET['user_id'])."2.png")) {
                echo '<li id="id_3" class="ui-state-default">Item 3</li>';
                  if(file_exists("uploads/".md5($_GET['user_id']).'/'.md5($_GET['user_id'])."3.jpg") || file_exists("uploads/".md5($_GET['user_id']).'/'.md5($_GET['user_id'])."3.png")) {
                    echo '<li id="id_4" class="ui-state-default">Item 4</li>';
                      if(file_exists("uploads/".md5($_GET['user_id']).'/'.md5($_GET['user_id'])."4.jpg") || file_exists("uploads/".md5($_GET['user_id']).'/'.md5($_GET['user_id'])."4.png")) {
                        echo '<li id="id_5" class="ui-state-default">Item 5</li>';
                          if(file_exists("uploads/".md5($_GET['user_id']).'/'.md5($_GET['user_id'])."5.jpg") || file_exists("uploads/".md5($_GET['user_id']).'/'.md5($_GET['user_id'])."5.png")) {
                            echo '<li id="id_6" class="ui-state-default">Item 6</li>';
                              if(file_exists("uploads/".md5($_GET['user_id']).'/'.md5($_GET['user_id'])."6.jpg") || file_exists("uploads/".md5($_GET['user_id']).'/'.md5($_GET['user_id'])."6.png")) {
                                echo '<li id="id_7" class="ui-state-default">Item 7</li>';
                              } 
                          } 
                      } 
                  } 
              } 
          } 
          $flag=1;
      }
       ?>      
    </ul>
     <?php if(isset($flag)) echo '<br/>
      <a href=""><button id="update-button" class="pure-button pure-button-primary" style=" color: white; font-family:inherit; font-size:20px" >Update</button></a>'; ?>
  </center>
  </fieldset>
</div>
<script src="js/jquery-2.1.0.min.js" type="text/javascript"></script>
<script src="js/jquery.easing.min.js" type="text/javascript"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.cookie.js" type="text/javascript"></script>
<script src="js/myscriptt.js"></script>
<script>
  $(function() {
    //cookie name
    var LI_POSITION = 'li_position';
    $( "#sortable" ).sortable({
        placeholder: "ui-state-highlight",
        axis: "y",
        update : function(event, ui) {
            //create the array that hold the positions...
            var order = [];
            //loop trought each li...
            $('#sortable li').each(function(e) {
                //add each li position to the array...
                // the +1 is for make it start from 1 instead of 0
                order.push($(this).attr('id') + '=' + ($(this).index() + 1));
            });
            // join the array as single variable...
            var positions = order.join(';');
            //use the variable as you need!
            $.cookie(LI_POSITION, positions, {
                expires : 10
            });
        }
    });
    $( "#sortable" ).disableSelection();
  });
  </script>
</body>