<?php 
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "toybox";
    $ip_n_web = "";
    $if = "";
    if(isset($_POST["ip_address"])) $ip_n_web = $_POST["ip_address"];
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    echo "Connected successfully";
    mysqli_query($conn,"USE toybox");
    $sql = "DELETE FROM toy WHERE `ip_address` = '".$ip_n_web."'"; 
    mysqli_query($conn, $sql);
    $conn->close();

?>