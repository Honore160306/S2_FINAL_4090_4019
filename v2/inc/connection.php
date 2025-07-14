<?php
function dbconnect()
{
    $connect = mysqli_connect('172.60.0.15', 'ETU004019', 'P3VFcEXD', 'db_s2_ETU004019');
    mysqli_set_charset($connect, 'utf8mb4');
    return $connect;
}
?>