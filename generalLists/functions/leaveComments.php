

<?php
    require_once 'lists.php';
    require_once 'users.php';
    
    
    $q = $_REQUEST["q"]; //commenter Id
    $x = $_REQUEST["x"]; // comment
    $z = $_REQUEST["z"]; // List Id

    $userName = getUserName($db,$q);

    //echo " ListId = $q UserId = $x \n\n"; 

    $newList->commentOnList($db,$z,$x,$q,$userName); //listId Comment  commenterId
    $newList->getListComments($db,$z,$q);//listId and commenterId because he he is the current user
    //$newList->getListItemsAdmin($db,$q); // In order to get to this version of this function you will aready be verified trough the first getListItems function
    //echo '<li id="userComment"><span id="commenterName">'.$userName.'<br> </span><span id="commenterComment">'.$x.'</span></li>';

?>
