

<?php
    require_once 'lists.php';

    
    $q = $_REQUEST["q"];
    $x = $_REQUEST["x"];

    //echo " ListId = $q UserId = $x \n\n"; 

if(isset($_SESSION["userId"]) && isset($q)){//only do this if user is signed in and request is sent
    
    $newList->followList($db,$q,$x); //itemid and listid
    //$newList->getListItemsAdmin($db,$q); // In order to get to this version of this function you will aready be verified trough the first getListItems function
    echo "<div id='unfollowButton'><h6 align='center'><em><button onclick='unFollowList(".$q.",".$_SESSION["userId"].")'>UnFollow</button></em></h6></div>";
    
    
}else {header('Location: ../index.php');}//if user is not logged in send them to login screen

    

?>
