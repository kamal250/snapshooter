<?php
require "config.php";

global $connection;
global $authorization;

// TODO :: Set limitation
$sql = "SELECT droplet_id,droplet_name FROM do_droplets ORDER BY ID";
if ($result = $connection->query($sql)) {
    foreach($result as $row) {
		$snapshotName = $row['droplet_name'].'-'.date('d-m-yy');
		$ch = curl_init("https://api.digitalocean.com/v2/droplets/".$row['droplet_id']."/actions");
		$post = [
			'type' => 'snapshot',
			'name' => $snapshotName
		];
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($post));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, 
			[
				'Content-Type: application/json',
				'Content-Length: ' . strlen(json_encode($post)),
				$authorization
			]
		);
		$snapshot = curl_exec($ch);
		curl_close($ch);
		$snapshot = json_decode($snapshot);
		// TODO :: Prevent SQL injection
		$sql = "INSERT INTO do_snapshots (snapshot_id, snapshot_name, droplet_id, snapshot_response)";
		$sql .= " VALUES ('".$snapshot->action->id."','".$snapshotName."','".$snapshot->action->resource_id."','".json_encode($snapshot)."')";
		if ($connection->query($sql) === TRUE) {
			echo "New snapshot with ID - ".$snapshot->action->id." and name - ".$snapshotName." created successfully <br>";
		} else {
			echo "Error: " . $sql . "<br>" . $connection->error;
		}
    }	
}   

$connection->close();
?>
