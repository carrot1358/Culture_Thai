
<?php
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "culture_thai";

    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("<script> alert('Connect DATABASE failed ...'); </script> " . $conn->connect_error);
    }
    //end connect database

?>

