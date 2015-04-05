<!DOCTYPE html>
<html>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "ucla";

$dbname = "swipe";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

if(isset($_GET['page']))
	$start = $_GET["page"]*20;
else
	$start = 0;
     	$end = $start  + 20;

#echo $start.' '.$end;
$sql = "SELECT * FROM sell";#." limit ".$start.",".$end;
$result = $conn->query($sql);
$len = $result->num_rows;
echo $len;
#$limit =  ;
#$result = $conn->query($sql);

echo "<table>";

echo "<tr>"."<td>name</td>"."<td>start</td>"."<td>end</td>"."<td>location</td>"."<td>amount</td>"."<td>price</td>"."</tr>";

if ($result->num_rows > 0) {
	if($end > $result->num_rows) 
	$end = $result->num_rows;

    for($i=$start;$i<$end;$i++){
	 $row = $result->fetch_assoc();
	 echo "<tr>"."<td>".$row["name"]."</td>"."<td>".$row["start"]."</td>"."<td>".$row["end"]."</td>"."<td>".$row["location"]."</td>"."<td>".$row["amount"]."</td>"."<td>".$row["price"]."</td>"."</tr>";
    }
}	
echo "<table>";
$conn->close();

?>

</body>
</html>



