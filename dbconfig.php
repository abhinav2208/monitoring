<?php
$mysqli= new mysqli("localhost","root","","monitoring") or die(mysql_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>