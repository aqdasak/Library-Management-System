<?php
echo "welcome to connect to a database";

$server="localhost";
$username="root";
$password="";
$database="users1";

$conn=mysqli_connect($server,$username,$password,$database);

if(!$conn){
    die("sorry failed to connect".mysqli_connect_error());
}
else{
    echo "connection was successful";
}


?>