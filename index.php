<?php

########## Google Settings.. Client ID, Client Secret from https://cloud.google.com/console #############
$google_client_id 		= '427574390979-531nlhipt5dje69o0d6qspggl9kafkih.apps.googleusercontent.com';
$google_client_secret 	= 'OH6iDdTHDAZmigcGwoek2SNd';
$google_redirect_url 	= 'http://localhost/git/picstory'; //path to your script
$google_developer_key 	= 'AIzaSyATAkvYkWuRvis2T1yk9Aqv3A7ZgZuP0rU';

########## MySql details (Replace with yours) #############
$db_username = "root"; //Database Username
$db_password = "tanmay"; //Database Password
$hostname = "localhost"; //Mysql Hostname
$db_name = 'picstory'; //Database Name
###################################################################

//include google api files
require_once 'src/Google_Client.php';
require_once 'src/contrib/Google_Oauth2Service.php';

//start session
session_start();

$gClient = new Google_Client();
$gClient->setApplicationName('Picstory');
$gClient->setClientId($google_client_id);
$gClient->setClientSecret($google_client_secret);
$gClient->setRedirectUri($google_redirect_url);
$gClient->setDeveloperKey($google_developer_key);

$google_oauthV2 = new Google_Oauth2Service($gClient);

//If user wish to log out, we just unset Session variable
if (isset($_REQUEST['reset'])) 
{
  unset($_SESSION['token']);
  $gClient->revokeToken();
  header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
}

//If code is empty, redirect user to google authentication page for code.
//Code is required to aquire Access Token from google
//Once we have access token, assign token to session variable
//and we can redirect user back to page and login.
if (isset($_GET['code'])) 
{ 
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
	return;
}


if (isset($_SESSION['token'])) 
{ 
	$gClient->setAccessToken($_SESSION['token']);
}


if ($gClient->getAccessToken()) 
{
	  //For logged in user, get details from google using access token
	  $user 				= $google_oauthV2->userinfo->get();
	  $user_id 				= $user['id'];
	  $user_name 			= filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
	  $email 				= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
	  $profile_url 			= filter_var($user['link'], FILTER_VALIDATE_URL);
	  $profile_image_url 	= filter_var($user['picture'], FILTER_VALIDATE_URL);
	  $personMarkup 		= "$email<div><img src='$profile_image_url?sz=50'></div>";
	  $_SESSION['token'] 	= $gClient->getAccessToken();
}
else 
{
	//For Guest user, get google login url
	$authUrl = $gClient->createAuthUrl();
}

if(isset($authUrl)) //user is not logged in, show login button
{
	$_SESSION['uuser']='nothing';
} 
else // user logged in 
{
   /* connect to database using mysqli */
	$mysqli = new mysqli($hostname, $db_username, $db_password, $db_name);
	
	if ($mysqli->connect_error) {
		$_SESSION['uuser']='wrong';
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
	else{
        $_SESSION['user_name'] = $user_name;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['profile_image_url'] = $profile_image_url;    

        //compare user id in our database
        $user_exist = $mysqli->query("SELECT COUNT(google_id) as usercount FROM google_users WHERE google_id=$user_id")->fetch_object()->usercount; 
        if($user_exist)
        {
            $_SESSION['uuser']='again';
        }else{ 
            $_SESSION['uuser']='new';
            $mysqli->query("INSERT INTO google_users (google_id, google_name, google_email, google_link, google_picture_link) 
            VALUES ($user_id, '$user_name','$email','$profile_url','$profile_image_url')");
        }
    }
	
}

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
  
</head>
<body>

<div class="header">
    <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href=""></a>

        <ul class="pure-menu-list">
            <li class="pure-menu-item"><a href="#" class="pure-menu-link">Home</a></li>';
        if($_SESSION['uuser']=='nothing')
            echo '<li class="pure-menu-item"><a target="_blank" href="story.html" class="pure-menu-link">Demo</a></li>
        <li class="pure-menu-item"><a href="#logging-in" class="pure-menu-link">Sign In</a></li>';
        else if($_SESSION['uuser']=='again' || $_SESSION['uuser']=='new'){
            if(file_exists('stories/'.$user_id.'.html')) echo '<li class="pure-menu-item"><a href="stories/'.$user_id.'.html" target="_blank" class="pure-menu-link">Your Story</a></li>';
            else echo '<li class="pure-menu-item"><a target="_blank" href="story.html" class="pure-menu-link">Demo</a></li>';
            echo '<li class="pure-menu-item"><a href="demo_create.php?user_id='.$user_id.'&profile_image_url='.$profile_image_url.'&user_name='.$user_name.'" class="pure-menu-link">Create</a></li>
        <li class="pure-menu-item"><a href="?reset=1" class="pure-menu-link">Sign Out ('.$user_name.')</a></li>';
        }
            

echo '</ul></div></div>
<div class="splash-container">
    <div class="splash">
        <h1 class="splash-head">Picstory</h1>
        <p class="splash-subhead">
            A Photo Story Presentation tool. Add fun to your memories.
        </p>
        <p>
            <a href="#logging-in" class="pure-button pure-button-primary">Get Started</a>
        </p>
    </div>
</div>

<div class="content-wrapper">
    <div class="content">
        <h2 class="content-head is-center">Photo Presentation and Sharing. In a unique way.</h2>

        <div class="pure-g">
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">

                <h3 class="content-subhead">
                    <i class="fa fa-rocket"></i>
                    Get Started Quickly
                </h3>
                <p>
                    Just hit <a class="endlink" href="#logging-in"><strong>Sign in with Google</strong></a> to start adding images for the Presentation. No more passwords to remember.
                </p>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
                <h3 class="content-subhead">
                    <i class="fa fa-mobile"></i>
                    Modern Photo Sharing
                </h3>
                <p>
                    Because Uploading images over Facebook albums is boring. Remember Moriarty saying "BORINGGG"
                </p>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
                <h3 class="content-subhead">
                    <i class="fa fa-th-large"></i>
                    Completely Free
                </h3>
                <p>
                    Exactly! Currently, Picstory costs nothing more than Alia Bhatt\'s IQ score. 
                </p>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
                <h3 class="content-subhead">
                    <i class="fa fa-check-square-o"></i>
                    3D Transitions
                </h3>
                <p>
                    Amazing Animatoins and Transitions between images. After all, we are in 2015, not 1990s.
                </p>
            </div>
        </div>
    </div>

    <div class="ribbon l-box-lrg pure-g">
        <div class="l-box-lrg is-center pure-u-1 pure-u-md-1-2 pure-u-lg-2-5">
            <img class="pure-img-responsive" alt="File Icons" width="300" src="media/file-icons.png">
        </div>
        <div class="pure-u-1 pure-u-md-1-2 pure-u-lg-3-5">

            <h2 class="content-head content-head-ribbon">The Easiest way to Share memories.</h2>

            <p>
                This is the modern world photo sharing. Hardcopy albums and nowadays CDs are also found in museums. All you need to do is.. Hit <a class="endlink" href="#logging-in"><strong>Sign in with Google</strong></a> button and add your unforgettable memory in form of pictures. Hit generate and voila.. An amazing Picstory is ready for you. Share with friends on social media and have fun.
            </p>
        </div>
    </div>

    <div id="logging-in" class="content">
        <h2 class="content-head is-center">Because Signing in with Email is too mainstream!</h2>
        <div class="pure-g">
            <div class="l-box-lrg pure-u-1 pure-u-md-2-5">';
            if($_SESSION['uuser']=='nothing')
                echo '<center><a class="login" href="'.$authUrl.'">';
            else echo '<center><a class="login" onClick="alert(\'You are already logged in. Go to Your Account\');" href="#">';

            echo '<img class="pure-img-responsive loginimg" alt="Sign in" width="400" height="100" src="media/sign-in-with-google.png"></img></a><br/><span class="text-below-img">You must be having a Google account, I guess! <a target="_blank" class="endlink" href="https://accounts.google.com/SignUp">No?</a></span></center>
            </div>

            <div class="l-box-lrg pure-u-1 info pure-u-md-3-5">
                <h4>Contact me</h4>
                <p>
                    Hey there! I\'m Tanmay. I\'m pre-final year student at <a class="endlink" href="http://ddu.ac.in">DDU, Nadiad</a>. I\'m pursuing B.Tech. in Computer Science. You can contact me at <strong>rajani.tanmay@gmail.com</strong>. Or on <a target="_blank" class="endlink" href="http://facebook.com/tanmay.rajani">Facebook</a>, or <a target="_blank" class="endlink" href="http://quora.com/Tanmay-Rajani">Quora</a>, or <a target="_blank" class="endlink" href="http://twitter.com/rajani_tanmay">twitter</a>.
                </p>

                <h4>More Information</h4>
                <p>
                    Picstory is my pre-final year\'s project. I\'ve created this using open source JavaScript library called <strong><a target="_blank" class="endlink" href="https://github.com/jmpressjs/jmpress.js">jmpress.js</a></strong> . Have fun! Cheers! :)
                </p>
            </div>
        </div>

    </div>

    <div class="footer l-box is-center">
        &copy; 2015. No Rights Reserved by <b><a class="endlink" href="http://tanmayrajani.github.io">Tanmay Rajani</a></b>
    </div>

</div>

</body>
</html>
';








	//echo '<a class="login" href="'.$authUrl.'"><img height="70px" src="media/sign-in-with-google.png" /></a>';
?>

