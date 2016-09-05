<?php 
$conn= new mysqli('localhost', 'root', '', 'db_svmanager');

if($conn->connect_error){
	die('Connect error!!'. $conn->connect_error);
}


$sql= "INSERT INTO billing (cid, payment) 
		SELECT cid, SUM(charge) as total FROM vps GROUP BY cid";
	
$sql_2= "UPDATE vps SET charge= 0";
		
$result= $conn->query($sql);

if($result==true){
	$result_2= $conn->query($sql_2);
	if($result_2== false){
		echo "Failed".$conn->error;
	}
}
else{
	echo "Failed".$conn->error;
}

$conn->close();

?>