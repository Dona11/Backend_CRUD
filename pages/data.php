<?php
    $host = "172.17.0.1:3306";
    $user = "root";
    $pass = "my-secret-pw";
    $db = "mydb";

    $connessione = mysqli_connect ($host, $user, $pass, $db)
        or die("Connessione non riuscita " . mysqli_connect_error() );
?>