<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>theatre detail</title>
</head>

<body>
<center>
<br />
<br />
<br />
<br />
<br />
<br />


<?php

if(isset($_POST['click']))
{
	//if(isset($_POST['cities']))
	//{
			echo "multiplex &nbsp";
			$query="select DISTINCT multiplexes from multiplex where city='".$_POST['cities']."'";
			//echo $query;


		
			$connect=mysqli_connect('localhost','root','') or die("error in connection");
			mysqli_select_db($connect,'project') or die("error in database");	
			//session_start();

			$result=mysqli_query($connect,$query);
			$count=mysqli_num_rows($result);
			//echo $count;
			
			echo '<select name="multi" id="multi" style="height:50px;width:200px">';
			while($rows=mysqli_fetch_array($result)) {
				echo '<option value="'.$rows[0].'">'.$rows[0].'</option>';
				
			}
			echo '</select>';
		
			
		echo "<br>";
		echo "<br>";
			
		echo "movies &nbsp";
		echo '<select id="movie" style="height:50px;width:200px">';
		echo '</select>';
			
		
					$str2="SELECT DISTINCT multiplexes,movie FROM multiplex where city='".$_POST['cities']."'";
					
					$result2=mysqli_query($connect,$str2);
					
					//$count=mysqli_num_rows($result1);
					echo '<script src="jquery-2.1.3.min.js"></script>';
					echo '<script>';		
					while($cit = mysqli_fetch_array($result2)) 
					{
						
						$script='var '.$cit[0].'=new Array(' .$cit[1]. ');
						console.log('.$cit[0].');';
						echo $script;
							//print_r($cities[0]);
					}
					//city1 is my id of "City(HOME)" and pincode1 is id of "Pincode(HOME)",denoted by #city1 and #pincode1
					echo '
					populateSelect1();
					
				$(function() {
				$("#multi").change(function(){
					populateSelect1();
					});
								
				});

				function populateSelect1()
				{
					city=$("#multi").val();
					$("#movie").html("");
			
				   eval(city).forEach(function(t) { 
					$("#movie").append("<option>"+t+"</option>");
					});
				}
					
					
					</script>';
					
					
}		
?>

</center>
</body>
</html>