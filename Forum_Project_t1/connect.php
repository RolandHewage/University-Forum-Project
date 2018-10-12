<?php
//connect.php
$server = 'localhost';
$username   = 'roland1';
$password   = 'alianza2';
$database   = 'forum1';
 
if(!mysql_connect($server, $username,  $password))
{
    exit('Error: could not establish database connection');
}
if(!mysql_select_db($database))
{
    exit('Error: could not select the database');
}
?>