<?php 
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "toybox";
    $scan_id = "";
    $ip_address = "";
    $port = "";
    $product = "";
    $version = "";
    $name = "";
    $cpe = "";
    $extrainfo = "";

    $if = "";

    if(isset($_POST["scan_id"])) $scan_id = $_POST["scan_id"];
    if(isset($_POST["ip_address"])) $ip_address = $_POST["ip_address"];
    if(isset($_POST["port"])) $port = $_POST["port"];
    if(isset($_POST["product"])) $product = $_POST["product"];
    if(isset($_POST["version"])) $version = $_POST["version"];
    if(isset($_POST["name"])) $name = $_POST["name"];
    if(isset($_POST["cpe"])) $cpe = $_POST["cpe"];
    if(isset($_POST["extrainfo"])) $extrainfo = $_POST["extrainfo"];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
    echo "Connected successfully";
    mysqli_query($conn,"USE toybox");
    #$sql_if = "SELECT `scan_id` FROM `toy` WHERE `scan_id` = '".$scan_id."'";
    $sql_if = "SELECT `ip_address` FROM `toy` WHERE `ip_address` = '".$ip_n_web."'";
    $result = $conn->query($sql_if);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            #$if = $row["scan_id"];
            $if = $row["ip_address"];
        }
    }
    else {
        echo "error";
    }

    if ($if != NULL) {
        $sql = "UPDATE `toy` SET `ip_address` = '".$ip_address."', `port` = '".$port."', `product` = '".$product."', `version` = '".$version."', `name` = '".$name."', `cpe` = '".$cpe."', `extrainfo` = '".$extrainfo."', WHERE `scan_id` = '".$scan_id."'";
    } 
    else {
        $sql = "INSERT INTO `toy`( `scan_id`, `ip_address`, `port`, `product`, `version`, `name`, `cpe`, `extrainfo`) VALUES ('".$scan_id."','".$ip_address."','".$port."','".$product."','".$version."','".$name."','".$cpe."','".$extrainfo."')";
    }
    
    
    if (mysqli_query($conn, $sql)) {
        echo "\nNew Data Update!\n";
        echo "[".$scan_id."]-[".$ip_address."]-[".$port."]-[".$product."]-[".$version."]-[".$name."]-[".$cpe."]-[".$extrainfo."]\n";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();

?>