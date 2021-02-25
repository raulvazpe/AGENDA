<?php
    $conn = new mysqli('localhost','root','','bd_agenda');

    if($conn->connect_error){
        echo $error -> $conn->connect_error;
    }
?>