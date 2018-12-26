<?php 
          
        $dbhost = "localhost";
        $dbname = 'jstewa50';
        $dbuser = "jstewa50";
        $dbpass = "S5ZPq8cHSa";

        $db = new mysqli($dbhost,$dbuser,$dbpass,$dbname) or die("unable to connect");

//echo'connected to db <br>';

session_start();
//$_SESSION["user"] = '7';


?>