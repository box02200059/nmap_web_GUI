<?php 
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "toybox";
    $ip_n_web = "";
    //$thread = "";
    $if = "";
    if(isset($_POST["ip_n_web"])) $ip_n_web = $_POST["ip_n_web"];
    //if(isset($_POST["thread"])) $thread = $_POST["thread"];
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    echo "Connected successfully";
    mysqli_query($conn,"USE toybox");
    $sql_if = "SELECT `ip_address` FROM `toy` WHERE `ip_address` = '".$ip_n_web."'";
    $result = $conn->query($sql_if);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $if = $row["ip_address"];
        }
    }
    else {
    }

    if ($if != NULL) {
        echo "yes";
        $sql = "UPDATE `toy` SET `ip_address` = '".$ip_n_web."', `port` = 'Scanning', `product` = '...', `version` = '...', `name` = '...', `cpe` = '...', `extrainfo` = '...' WHERE `ip_address` = '".$ip_n_web."'";
    } 
    else {
        echo "no";
        $sql = "INSERT INTO `toy`(`ip_address`, `port`, `product`, `version`, `name`, `cpe`, `extrainfo`) VALUES ('".$ip_n_web."','Scanning','...','...','...','...','...')";
    }
    mysqli_query($conn, $sql);

    $conn->close();
    echo "<script>alert('ok');location.href='../show.php'</script>";

?>
