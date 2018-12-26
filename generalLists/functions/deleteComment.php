

<?php
    require_once 'lists.php';
    
    if(isset($_SESSION['userId'])){ //This sets the currentUser var so that comments can only be deleted by the user who posted it while uncreated users you can still view the comments
            
            $currentUser = $_SESSION['userId'];
        }
    
    $q = $_REQUEST["q"]; // comment Number
    $x = $_REQUEST["x"]; // list Id
    
    //echo "$q and $x";


    $newList->deleteCommentOnList($db,$x,$q); //listId and comment number
    $newList->getListComments($db,$x,$currentUser);//Session userid has to be set to even get here.


?>
