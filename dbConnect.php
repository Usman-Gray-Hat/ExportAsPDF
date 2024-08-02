<?php
$conn = mysqli_connect("localhost","root","","demo");
if(!$conn)
{
    echo "<script> alert('Database not connected!'); </script>";
}
?>