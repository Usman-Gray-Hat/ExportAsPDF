<?php
include("../../dbConnect.php");
if(isset($_POST['name']) && isset($_POST['age']))
{
    $name = $_POST['name'];
    $age = $_POST['age'];
    $query = "INSERT INTO users (name,age) VALUES ('$name','$age')";
    $exec = mysqli_query($conn,$query);
    if($exec==true)
    {
        echo "User has been added successfully";
    }
    else
    {
        echo "User has not added";
    }
}
?>