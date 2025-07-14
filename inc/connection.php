<?php
function dbconnect()
{
    $connect = mysqli_connect('localhost', 'root', '', 'finalProject');
    mysqli_set_charset($connect, 'utf8mb4');
    return $connect;
}
?>