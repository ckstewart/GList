

<?php
    require_once 'lists.php';

    $q = $_REQUEST["q"];
    $x = $_REQUEST["x"];

    //echo " qitem = $q xlist = $x \n\n"; 

    $newList->deleteItem($db,$x,$q); //itemid and listid
    $newList->getListItemsAdmin($db,$q); // In order to get to this version of this function you will aready be verified trough the first getListItems function


?>
