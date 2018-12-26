<?php 
          
        $dbhost = "localhost";
        $dbname = 'generalLists';
        $dbuser = "root";
        $dbpass = "flyers62";

        $db = new mysqli($dbhost,$dbuser,$dbpass,$dbname) or die("unable to connect");

echo'connected to db';

?>