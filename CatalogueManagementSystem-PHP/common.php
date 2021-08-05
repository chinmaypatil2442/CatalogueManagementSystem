<?php
$dbserver="localhost";
$dbname="cataloguesystem";
$dbuser="root";
$dbpass="";
global $conn;

$conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);
//Check connection in mysqli
if(!$conn){
die("Error on the connection" .mysqli_error($conn));
}
else
{
// echo "Connected Sucessfully";
}

function mysql_query_db($query)
{
global $conn;
$result=mysqli_query($conn,$query) or die('Error: '.mysqli_error($conn));
// print_r($result[0]);
return $result;
}

function mysql_num_db($resultn) 
{
$numrow=$resultn->num_rows;
return $numrow;
}

function mysql_fetch_db($resultn)
{
$frow=$resultn->fetch_array();
return $frow;
}

// $asd = mysql_query_db('select * from department');
// $fasd = mysql_fetch_db($asd);
// print_r($fasd);
?>