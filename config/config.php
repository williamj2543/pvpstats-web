<?php

////\\\\\\\\\\\\\\\\\\\\\\EDIT The Below Variables\\\\\\\\\\\\\\\\\
////\\\\\\\\\\\\\\\\\\\ONLY EDIT WITHIN THE QUOTATION MARKS ("")\\\
//
$servername = "localhost"; //Server name (usually "localhost")
$database = "pvpstats";    //Database name (often username_databasename)
$username = "usr";        //User name for MySQL Database
$password = "pass";          //Password for MySQL User name
//
//// \\\\\\\\\\\\\\\\\\\\\\\DO NOT EDIT BELOW\\\\\\\\\\\\\\\\\\\\\\\
//
$connect = mysql_connect($servername,$username,$password);
    mysql_select_db($database, $connect) or die(mysql_error());

?>