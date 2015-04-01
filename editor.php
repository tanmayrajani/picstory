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
            <li class="pure-menu-item"><a href="#" class="pure-menu-link">Home</a></li>';
        
            if(file_exists('stories/'.$_GET['user_id'].'.html')){
                echo '<li class="pure-menu-item"><a href="stories/'.$_GET['user_id'].'.html" target="_blank" class="pure-menu-link">Your Story</a></li><li class="pure-menu-item"><a href="#" class="pure-menu-link">Edit</a></li>';
                echo '<li class="pure-menu-item"><a href="demo_create.php?user_id='.$_GET['user_id'].'&user_name='.$_GET['user_name'].'" class="pure-menu-link">Create New</a></li><li class="pure-menu-item"><a href="?reset=1" class="pure-menu-link">Sign Out ('.$_GET['user_name'].')</a></li>';
            }
?>
</ul></div></div><br/><br/>
<div id="msform">
  <fieldset>
    <h2 class="fs-title">Edit Story</h2>
    <h3 class="fs-subtitle">Reorder images here</h3>
    <center><ul id="sortable">
      <li class="ui-state-default">Item 1</li>
      <li class="ui-state-default">Item 2</li>
      <li class="ui-state-default">Item 3</li>
      <li class="ui-state-default">Item 4</li>
      <li class="ui-state-default">Item 5</li>
      <li class="ui-state-default">Item 6</li>
      <li class="ui-state-default">Item 7</li>
    </ul></center>
  </fieldset>
</div>
<script src="js/jquery-2.1.0.min.js" type="text/javascript"></script>
<script src="js/jquery.easing.min.js" type="text/javascript"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/myscriptt.js"></script>
<script>
  $(function() {
    $( "#sortable" ).sortable({
        placeholder: "ui-state-highlight",
        axis: "y",
        stop: function (event, ui) {
            var data = $(this).sortable('serialize');
            $('span').text(data);
            $.ajax({
                data: oData,
                type: 'POST',
                url: '/editgen.php'
            });
        }
    });
    $( "#sortable" ).disableSelection();
  });
  </script>
</body>