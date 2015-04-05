<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>UC Swiper</title>

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" type="text/css"  href="css/style.css">
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Karla:700,400|Inconsolata'>
	<!-- Web Fonts
  ================================================== -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	
	<!-- JS
  ================================================== -->
  	<script src="../js/jquery-2.0.3.min.js"></script>
  	<script src="http://code.jquery.com/jquery-1.5.2.min.js" language="javascript"></script>
</head>
<body>
	<!-- Primary Page Layout
	================================================== -->
	
	<!-- Header -->
	<div id="header">
	
		<!-- 960 Container -->
		<div class="container">
		
			<!-- Logo -->
			<div class="four columns">
					<div id="logo">UC Swpier</div>
			</div>
			
			<div class="twelve columns">
			
				<!-- Menu -->
				<div id="navigation">
				  <ul>
					<li><a  href="newbuy.php">Buy List</a></li>
					<li><a id="current" href="newsell.php">Sale List</a></li>
				  </ul>
				</div>			
	
			</div>
		</div>
	</div>
	<!-- End Header -->
	
	<!-- Page Subtitle -->
	<div id="main">
	
		<!-- 960 Container -->
		<div class="container">
			<div class="sixteen columns">
				<form action="sell.php" method="post" class="basic-grey">
				    <h1>I Want To Sell!</h1>
 					<input class="name" type="text" name="name" placeholder="Name" />
 				    <input class="email" type="text" name="email" placeholder="Email" />
 				    <!--input class="location" type="text" name="location" placeholder="Meal Location" /-->
 				    <select name="selection" class= "location">
         				<option value="UCLA Feast">UCLA Feast</option>
         				<option value="Ackerman Union">Ackerman Union</option>
         				<option value="Panda Express">Panda Express</option>
         				<option value="Vicky Sushi">Vicky Sushi</option>
         			</select>
 				    <input class="price" type="text" name="price" placeholder="Price " /> 
 				    <input class="amount" type="text" name="amount" placeholder="Num" />  
 				    <input class="start-time" type="text" name="start-time" placeholder=" Start Time" />
 				    <input class="end-time" type="text" name="end-time" placeholder="End Time" />
 				    <input type="submit" class="button" name="buy"value="GO !" /> 
				   
			</form>
			</div>
		</div>
		<!-- End 960 Container -->
	
	</div><!-- End Page Subtitle -->
	
<?php

$servername = "localhost";
$username = "root";
$password = "ucla";
$dbname = "swipe";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$loc_list = ["feast","Ackerman Union", "Panda Express", "Vicky Sushi"];
$id_list = [0,1,2,3];
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
#echo "Connected successfully";

if(isset($_GET['page']))
	$start = $_GET["page"]*6;
else
	$start = 0;
     	$end = 20;

#echo $start.' '.$end;

for($i=0;$i<4;$i++){
	$sql[$i] = "SELECT * FROM sell where pid % 4 = ".$id_list[$i]."";#." limit ".$start.",".$end;
#	echo $sql[$i];
	$result[$i] = $conn->query($sql[$i]);
	$len[$i] = $result[$i]->num_rows;
	$sql1[$i] = "SELECT * FROM sell where pid %4 = ".$id_list[$i]." limit ".$start.",6";
	$result[$i] = $conn->query($sql1[$i]);
}

/*
#$limit =  ;
#$result = $conn->query($sql);
*/
?>

	
	<!-- 960 Container -->
	<div id="list-background">
		<!-- Page Subtitle -->
	<div id="lists">
		<!-- 960 Container -->
		<div class="container">
			<div class="seven-left columns">
				<div class = "display">
					<h1>UCLA FEAST</h1>
					<table class="flat-table" cellspacing="0">
						<tbody>
<?php

$k=0;
if ($result[$k]->num_rows > 0) {
	if($end > $result[$k]->num_rows) 
	$end = $result[$k]->num_rows;
    for($i=$start;$i<$start+$end;$i++){
	 $row = $result[$k]->fetch_assoc();
	 $target = "<tr>"."<td>".$row["name"]."</td>"."<td> $".$row["price"].".00</td>"."<td>".$row["amount"]." swipes</td>"."<td>";
	 $target .= substr($row["starttime"], 11,5)."-".substr($row["endtime"],11,5)."</td>"."<td class='contact'>"."contact"."</td>"."</tr>";
         echo $target;
    }
	  
}

?>

</tbody>
</table>
<div class = "pagination">
						<div class = "sort">
							<a href="#">sort by time </a>
							<span> | </span>
							<a href="#">sort by price </a>
						</div>
						<div class = "nav">

<?php
$size = 6;
$index_limit = 5;
$index_start = $start/$size;
$last = floor($len[$k]/$size);
if($len[$k]%$size==0) 
	$last--;
	
if(($len[$k]-$start)/$size<5){
	$index_limit = floor(($len[$k]-$start)/$size)-1;
	if(($len[$k]-$start)%$size!=0) $index_limit +=1;
}
echo "<a href=./newbuy.php?page=0> FIRST </a>";
echo "<span> | </span>";
if($start!=0)
	echo "<a href=./newbuy.php?page=".($index_start-1)."> PREV </a>";
else
	echo "<a href=./newbuy.php?/#>PREV</a>";

echo "<span> | </span>";
	echo  "<a href=./newbuy.php?page=".$index_start."> ".$index_start."/".$last." </a>";
echo "<span> | </span>";
if($index_limit>1)
	echo  "<a href=./newbuy.php?page=".($index_start+1)."> NEXT </a>";
else
	echo "<a href=./newbuy.php?/#>NEXT</a>";
echo "<span> | </span>";
echo "<a href=./newbuy.php?page=".$last."> LAST </a>";
#echo "<p> In tatal ".$len." records found.</p>";

#$conn->close();
?>
						</div>
					</div>
				</div>
			</div>

			<div class="seven-right columns">
				<div class = "display">
					<h1>Ackerman Union</h1>
					<table class="flat-table" cellspacing="0">
						<tbody>
<?php

$k=1;
if ($result[$k]->num_rows > 0) {
	if($end > $result[$k]->num_rows) 
	$end = $result[$k]->num_rows;
    for($i=$start;$i<$start+$end;$i++){
	 $row = $result[$k]->fetch_assoc();
	 $target = "<tr>"."<td>".$row["name"]."</td>"."<td> $".$row["price"].".00</td>"."<td>".$row["amount"]." swipes</td>"."<td>";
	 $target .= substr($row["starttime"], 11,5)."-".substr($row["endtime"],11,5)."</td>"."<td class='contact'>"."contact"."</td>"."</tr>";
         echo $target;
    }
	  
}

?>				</tbody>
					</table>
					<div class = "pagination">
						<div class = "sort">
							<a href="#">sort by time </a>
							<span> | </span>
							<a href="#">sort by price </a>
						</div>
						<div class = "nav">
	<?php
$size = 6;
$index_limit = 5;
$index_start = $start/$size;
$last = floor($len[$k]/$size);
if($len[$k]%$size==0) 
	$last--;
	
if(($len[$k]-$start)/$size<5){
	$index_limit = floor(($len[$k]-$start)/$size)-1;
	if(($len[$k]-$start)%$size!=0) $index_limit +=1;
}
echo "<a href=./newbuy.php?page=0> FIRST </a>";
echo "<span> | </span>";
if($start!=0)
	echo "<a href=./newbuy.php?page=".($index_start-1)."> PREV </a>";
else
	echo "<a href=./newbuy.php?/#>PREV</a>";

echo "<span> | </span>";
	echo  "<a href=./newbuy.php?page=".$index_start."> ".$index_start."/".$last." </a>";
echo "<span> | </span>";
if($index_limit>1)
	echo  "<a href=./newbuy.php?page=".($index_start+1)."> NEXT </a>";
else
	echo "<a href=./newbuy.php?/#>NEXT</a>";
echo "<span> | </span>";
echo "<a href=./newbuy.php?page=".$last."> LAST </a>";
#echo "<p> In tatal ".$len." records found.</p>";

#$conn->close();
?>		
					</div>
					</div>
				</div>
			</div>
			<div class = "divider"></div>
			<div class = "seven-left columns">
			<div class = "display">
				<h1>Panda Express</h1>
				<table class="flat-table" cellspacing="0">
					
					<tbody>
					 <?php

$k=2;
if ($result[$k]->num_rows > 0) {
	if($end > $result[$k]->num_rows) 
	$end = $result[$k]->num_rows;
    for($i=$start;$i<$start+$end;$i++){
	 $row = $result[$k]->fetch_assoc();
	 $target = "<tr>"."<td>".$row["name"]."</td>"."<td> $".$row["price"].".00</td>"."<td>".$row["amount"]." swipes</td>"."<td>";
	 $target .= substr($row["starttime"], 11,5)."-".substr($row["endtime"],11,5)."</td>"."<td class='contact'>"."contact"."</td>"."</tr>";
         echo $target;
    }
	  
}

?>  
					  </tbody>
					</table>
					<div class = "pagination">
						<div class = "sort">
							<a href="#">sort by time </a>
							<span> | </span>
							<a href="#">sort by price </a>
						</div>
						<div class = "nav">
								<?php
$size = 6;
$index_limit = 5;
$index_start = $start/$size;
$last = floor($len[$k]/$size);
if($len[$k]%$size==0) 
	$last--;
	
if(($len[$k]-$start)/$size<5){
	$index_limit = floor(($len[$k]-$start)/$size)-1;
	if(($len[$k]-$start)%$size!=0) $index_limit +=1;
}
echo "<a href=./newbuy.php?page=0> FIRST </a>";
echo "<span> | </span>";
if($start!=0)
	echo "<a href=./newbuy.php?page=".($index_start-1)."> PREV </a>";
else
	echo "<a href=./newbuy.php?/#>PREV</a>";

echo "<span> | </span>";
	echo  "<a href=./newbuy.php?page=".$index_start."> ".$index_start."/".$last." </a>";
echo "<span> | </span>";
if($index_limit>1)
	echo  "<a href=./newbuy.php?page=".($index_start+1)."> NEXT </a>";
else
	echo "<a href=./newbuy.php?/#>NEXT</a>";
echo "<span> | </span>";
echo "<a href=./newbuy.php?page=".$last."> LAST </a>";
#echo "<p> In tatal ".$len." records found.</p>";

#$conn->close();
?>						

						</div>
					</div>
				</div>
			</div>

			<div class="seven-right columns">
				<div class = "display">
					<h1>Vicky Sushi</h1>
					<table class="flat-table" cellspacing="0">
						<tbody>
						    
<?php

$k=3;
if ($result[$k]->num_rows > 0) {
	if($end > $result[$k]->num_rows) 
	$end = $result[$k]->num_rows;
    for($i=$start;$i<$start+$end;$i++){
	 $row = $result[$k]->fetch_assoc();
	 $target = "<tr>"."<td>".$row["name"]."</td>"."<td> $".$row["price"].".00</td>"."<td>".$row["amount"]." swipes</td>"."<td>";
	 $target .= substr($row["starttime"], 11,5)."-".substr($row["endtime"],11,5)."</td>"."<td class='contact'>"."contact"."</td>"."</tr>";
         echo $target;
    }
	  
}

?>
						</tbody>
					</table>
					<div class = "pagination">
						<div class = "sort">
							<a href="#">sort by time </a>
							<span> | </span>
							<a href="#">sort by price </a>
						</div>
						<div class = "nav">
							<?php
$size = 6;
$index_limit = 5;
$index_start = $start/$size;
$last = floor($len[$k]/$size);
if($len[$k]%$size==0) 
	$last--;
	
if(($len[$k]-$start)/$size<5){
	$index_limit = floor(($len[$k]-$start)/$size)-1;
	if(($len[$k]-$start)%$size!=0) $index_limit +=1;
}
echo "<a href=./newbuy.php?page=0> FIRST </a>";
echo "<span> | </span>";
if($start!=0)
	echo "<a href=./newbuy.php?page=".($index_start-1)."> PREV </a>";
else
	echo "<a href=./newbuy.php?/#>PREV</a>";

echo "<span> | </span>";
	echo  "<a href=./newbuy.php?page=".$index_start."> ".$index_start."/".$last." </a>";
echo "<span> | </span>";
if($index_limit>1)
	echo  "<a href=./newbuy.php?page=".($index_start+1)."> NEXT </a>";
else
	echo "<a href=./newbuy.php?/#>NEXT</a>";
echo "<span> | </span>";
echo "<a href=./newbuy.php?page=".$last."> LAST </a>";
#echo "<p> In tatal ".$len." records found.</p>";

#$conn->close();
?>	
						</div>
					</div>
				</div>
			</div>


		</div>
		<!-- End 960 Container -->
	
	</div><!-- End Page Subtitle -->
		
	</div>
	<!-- End 960 Container -->
	<!--  Footer - Copyright-->
	<div id="footer_bottom">
		<!-- 960 Container -->
		<div class="container">
			<div class="eight columns">
				<div class="copyright">Copyright 2015. All Rights Reserved. 
				</div>
			</div>	
			<div class="eight columns">
				<div class="author-info">
					Designed by Team Swiper
				</div>
			</div>
		</div><!-- End 960 Container -->
	</div>
	
	<!-- JavaScript -->
	
</body>
</html>

