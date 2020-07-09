<?php
require "config.php";

global $connection;
global $authorization;

$ch = curl_init("https://api.digitalocean.com/v2/droplets?per_page=200");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$droplets = curl_exec($ch);
curl_close($ch);

$droplets = json_decode($droplets);
foreach ($droplets->droplets as $droplet) {
	// TODO :: Prevent SQL injection
    $sql = "INSERT INTO do_droplets (droplet_id, droplet_name, droplet_response)";
    $sql .= " VALUES ('".$droplet->id."','".$droplet->name."','".json_encode($droplet)."')";
    if ($connection->query($sql) === TRUE) {
        echo "New droplet with ID - ".$droplet->id." and name - ".$droplet->name." created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }    
}
$connection->close();
?>
