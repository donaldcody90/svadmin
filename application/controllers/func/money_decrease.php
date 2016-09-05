<?php 
$conn= new mysqli('localhost', 'root', '', 'db_svmanager');

if($conn->connect_error){
	die('Connect error!!'. $conn->connect_error);
}

		
$sql= "UPDATE vps as v 
		INNER JOIN plans as p 
		ON p.id = v.pid 
		SET v.charge= v.charge + p.price/720";
		
$sql_2= "UPDATE balance as b
		INNER JOIN (SELECT cid, SUM(charge) as total FROM vps GROUP BY cid) as v
		ON b.cid = v.cid
		SET b.amount = b.amount - v.total
		";
		
$result= $conn->query($sql);

if($result===true){
	$result_2= $conn->query($sql_2);
	if($result_2==false){
		echo "Failed".$conn->error;
	}
}
else{
	echo "Failed".$conn->error;
}

$conn->close();

?>