<?php 
$databasename="users_manegement";
$databasepass="";
$databaseuser="root";
$databasehost="127.0.0.1";

$con=mysqli_connect("$databasehost","$databaseuser","$databasepass","$databasename");
if(!$con){
    echo "failed to connect to database";
}