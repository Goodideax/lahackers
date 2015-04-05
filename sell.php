<?php
	
	if(isset($_POST['sell'])){
		$t=time();
		$hour = substr($_POST['start-time'], 0, 2);
		$minute = substr($_POST['start-time'], 3, 2);
		$start = date("Y-m-d",$t)." ".$hour.":".$minute.":00";
		$hour = substr($_POST['end-time'], 0, 2);
		$minute = substr($_POST['end-time'], 3, 2);
		$end = date("Y-m-d",$t)." ".$hour.":".$minute.":00";
		$posttime = date('Y-m-d H:i:s', $t);
	
		$conn = new mysqli(localhost, "root", "ucla", "swipe");
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		echo "Connected successfully";

		$sql = 'INSERT INTO buy(name, email, starttime, endtime, posttime, loc, amount, price) VALUES ('."'".$_POST['name']."'".' ,'."'".$_POST['email']."'".', '."'".$start."'".', '."'".$end."'".', '."'".$posttime."'".', '."'".$_POST['selection']."'".', '.$_POST['amount'].', '.$_POST['price'].')';
		echo $sql;
		$result = $conn->query($sql);

		
	}

?>
