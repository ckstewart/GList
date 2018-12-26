

<?php
    require_once 'lists.php';

    //echo "we are in the unfollow list";

    $q = $_REQUEST["q"];
    $x = $_REQUEST["x"];

    //echo " ListId = $q UserId = $x \n\n"; 

    if(isset($_SESSION["userId"]) && isset($q)){//on show if user is logged in and request is sent
        
        $newList->unFollowList($db,$q,$x); //itemid and listid
    //$newList->getListItemsAdmin($db,$q); // In order to get to this version of this function you will aready be verified trough the first getListItems function

    echo "<div id='followButton'><h6 align='center'><button onclick='followList(".$q.",".$_SESSION["userId"].")'>Follow</button></em></h6></div>";
        
    }else {header('Location: ../index.php');}//if user is not loggedin send them to login screen

    

?>
