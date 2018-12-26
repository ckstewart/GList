<?php 
 require_once 'connectdb.php';
 require_once 'users.php';
//echo 'connected to lists';
          
    class allLists {
        
        var $name;
        
        public function __construct(){
            
        }
        
        public function createList($db,$uid,$listTitle,$type,$listPrivacy,$listPrice,$listCategory,$listDescription){
            
            $date = date("Y-m-d");
            $userName = $_SESSION['userName'];
            
            $sql = "INSERT INTO list(uid,listTitle,privacy,date,type,numberOfFollowers,creatorId,price,description,listUrl,listCategory) VALUES ('$uid','$listTitle','$listPrivacy','$date','$type','0','$uid','$listPrice','$listDescription','','$listCategory')";
            
            //$result = mysqli_query($db,$sql) or die('<br><br>cannot insert');
            
            if ($result = $db->query($sql) === TRUE) 
            {
                //echo "New record created successfully";
                
            } else {
                
                echo "Error: " . $sql . "<br>" . $db->error;
            }
            
            $listTitleNoSpace = str_replace(' ','',$listTitle);//need user name and title to not have space for the Url. Also me need to check for commas
            $userNameNoSpace = str_replace(' ','',$userName);
            
            $sql = "UPDATE list SET listUrl = '$userNameNoSpace$listTitleNoSpace' WHERE listTitle = '$listTitle'"; // Updated the listUrl later because we needed to use the title without spaces
            
            $result = mysqli_query($db,$sql) or die('<br><br>cannot Update');
            
            $theListUrl = $userNameNoSpace.$listTitleNoSpace;
            
            $listId = getListId($db,$theListUrl);
            
            $newList = fopen("$userNameNoSpace$listTitleNoSpace.php","w") or die("Unable to open file");
            
            $text = <<<EOT
                <?php
        require_once("functions/lists.php");

        \$listId = '$listId';  // add list id here in save file
        \$listUrl = '$listTitleNoSpace'; // add list url here in save file
        \$creatorId = $uid;     // add creatorId here in save file
        \$currentUser = '0';

        if(isset(\$_SESSION['userId'])){ //This sets the currentUser var so that comments can only be deleted by the user who posted it while uncreated users you can still view the comments
            
            \$currentUser = \$_SESSION['userId'];
        }

        if(isset(\$_POST['noteName']))//saves notes and details
        {
            \$itemId = \$newList->addItem(\$db,\$_POST['noteName'],\$listId,\$listUrl,\$creatorId); // add list url here in save file (should work since the escape string should activate in saved file)
            
            if(isset(\$_POST['noteNotes']))
            {
                
                \$newList->setItemNoteDetails(\$db,\$listId,\$itemId,\$_POST['noteNotes'],\$_POST['videoLink']);
            }
            
        }
    ?>

<html>
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>GL $userName $listTitle</title> <!-- Change in the save file -->

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/stylish-portfolio.css" rel="stylesheet">
        <link href="css/generalLists.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">


        
    <script>  /*Ajax to delete and add from tables*/
        function showUser(str,theId) {
            
            if (str == "") {
                document.getElementById("theOutput").innerHTML = "";
                return;
            } else { 
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("listOne").innerHTML = this.responseText;
                    }
                };
               //var list = document.getElementById("listOne");
               //list.style.display = 'none';
               //list.style.visibility = 'hidden';
                
                xmlhttp.open("GET","functions/deleteListItem.php?q="+str+"&x="+theId,true);
                
                xmlhttp.send();
                
                
                //prompt("it was sent");
            }
        }
        
        function unFollowList(str,userId) {//function to followList
            
            
            if (str == "") {
                document.getElementById("unfollowButton").innerHTML = "";
                return;
            } else { 
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        
                        document.getElementById("unfollowButton").innerHTML = this.responseText;
                        
                        var followers = document.getElementById("followerNumber");
                        
                        var followersInt = parseInt(followers.innerHTML);   //These were created to update the followers count without regrabing it from the database
                        
                        followersInt--;
                        
                        followers.innerHTML = followersInt;
                    }
                };
               //var list = document.getElementById("listOne");
               //list.style.display = 'none';
               //list.style.visibility = 'hidden';
                
                xmlhttp.open("GET","functions/unFollowList.php?q="+str+"&x="+userId,true);
                
                xmlhttp.send();
                
                
                //prompt("it was sent");
            }
        }
        
        function followList(str,userId) {//function to followList
            
            
            if (str == "") {
                document.getElementById("followButton").innerHTML = "";
                return;
            } else { 
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        
                        document.getElementById("followButton").innerHTML = this.responseText;
                        
                        var followers = document.getElementById("followerNumber");
                        
                        var followersInt = parseInt(followers.innerHTML);   //These were created to update the followers count without regrabing it from the database
                        
                        followersInt++;
                        
                        followers.innerHTML = followersInt;
                    }
                };
               //var list = document.getElementById("listOne");
               //list.style.display = 'none';
               //list.style.visibility = 'hidden';
                
                xmlhttp.open("GET","functions/followList.php?q="+str+"&x="+userId,true);
                
                xmlhttp.send();
                
                
                //prompt("it was sent");
            }
        }
        
        function leaveComment(str,listId){
            
            //alert('leaving comments');
            
            var comment = document.getElementById("newCommentInput");
            //alert(comment.value);
            
            if (str == "") {
                document.getElementById("newComment").innerHTML = "";
                return;
            } else { 
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("comments").innerHTML = "";
                        document.getElementById("comments").innerHTML = this.responseText;
                    }
                };
               //var list = document.getElementById("listOne");
               //list.style.display = 'none';
               //list.style.visibility = 'hidden';
                
                xmlhttp.open("GET","functions/leaveComments.php?q="+str+"&x="+comment.value+"&z="+listId,true);
                
                xmlhttp.send();
                
                window.location.href = "#comments";
                comment.value = "";
                //prompt("it was sent");
                //document.getElementById("newComment").style.backgroundColor = rgb(0, 226, 0);
            }
        }
        
        function deleteComment(str,listId){
            
            
            
            if (str == "") {
                document.getElementById("newComment").innerHTML = "";
                return;
            } else { 
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("comments").innerHTML = "";
                        document.getElementById("comments").innerHTML = this.responseText;
                    }
                };
    
                
                xmlhttp.open("GET","functions/deleteComment.php?q="+str+"&x="+listId,true);
                
                xmlhttp.send();
                
            }
        }
        
    </script>


    </head>

    <body>

        <!-- Navigation -->
        <?php require_once 'navBar.php'; ?>


        <div class="container" name="list">
            
            <div class="row">

                <h1 align="center">$listTitle <span id="costOfList">\$$listPrice</span></h1> <!-- change these in saved file-->
                <h3 align="center">Topic: $listCategory</h3> <!-- change these in saved file -->
                <h4 align="center">Created by: $userName</h4>
                <h5 align="center"><span id="followerNumber"><?php \$newList->getListFollowers(\$db,\$listId); ?></span> Followers</h5>
                
                
                <?php 
                    \$result = \$newList->getFollowedLists(\$db,\$listId,\$currentUser,'1'); //toggle value decides whether you are looking for all the list you follow or just a 1 when you're checking againt one list
                
                    if(\$creatorId == \$currentUser)
                    {
                        echo'<h6 align="center">Admin</h6>';
                    }
                    else if (\$result == '1')
                    {
                        echo'<div id="unfollowButton"><h6 align="center"><em><button onclick="unFollowList('.\$listId.','.\$currentUser.')">UnFollow</button></em></h6></div>';
                    } 
                else {echo'<div id="followButton"><h6 align="center"><button onclick="followList('.\$listId.','.\$currentUser.')">Follow</button></h6></div>';}
                
                ?>


                <div class="col-lg-12">
                    
                  <?php  if(\$creatorId == \$currentUser){ ?>
                        <form method="post" action="$userNameNoSpace$listTitleNoSpace.php"> <!--  change in save file -->

                          <div class="form-group">

                            <label for="noteName">Name</label>

                            <input type="text" class="form-control" name="noteName" aria-describedby="emailHelp" placeholder="Note Name">



                          </div>
                            <div class="form-group">

                            <label for="note">Note</label>

                            <textarea class="form-control" rows="5" id="noteNotes" name="noteNotes"></textarea>



                          </div>
                            <div class="form-group">

                            <label for="userName">Video Link</label>

                            <input type="text" class="form-control" id="videoLink" name="videoLink" aria-describedby="emailHelp" placeholder="User Name">



                          </div>

                            <hr>

                          <button type="submit" class="btn btn-primary">Add Item</button>

                        </form>
                    <?php } ?>

                       <br><br><!--temporary bottom spacer--> 

                    </div> 

                </div>

            <div class="row">

                <div class="col-10">
                    
                    <div id="countDiv">
                        Completed
                        <span id="listItemsCompletedCount" value="0">0</span>
                        /
                        <span id="listItemCount">0</span>
                    </div>
                    
  
                    <p>
                        <span>
                            <ul id="listOne">
                                <?php 
                                        \$newList->getListItems(\$db,\$listId,\$creatorId);
                                         //put the list id here  

                                    ?>
                            </ul>
                        </span>
                    </p>   
                        
                        <span>
                            <ul id="theOutput">
                            
                            
                            </ul>
                        
                        </span>
                        
                        <div id="commentDiv">
                            
                            <br><h1 align="center" id="commentsHeader">Comments</h1><br>
                            
                            <ul id="comments">
                                <span id="newComment"></span>
                                <?php \$newList->getListComments(\$db,\$listId,\$currentUser); ?>
                                
                            
                            </ul>
                    
                            <div class="form-group">
                                
                                <label for="comment"></label>
                                
                                <textarea class="form-control" rows="3" id="newCommentInput"></textarea>
                                <?php echo'<button onclick="leaveComment('.\$currentUser.','.\$listId.')" id="commentSubmit">Comment</button>'; ?>
                                
                            </div>
                        </div>

                    

                </div>

            </div>

            









            </div>

        <!-- About -->



        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script>
        // Closes the sidebar menu
        $("#menu-close").click(function(e) {
            e.preventDefault();
            $("#sidebar-wrapper").toggleClass("active");
        });
        // Opens the sidebar menu
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#sidebar-wrapper").toggleClass("active");
        });
        // Scrolls to the selected menu item on the page
        $(function() {
            $('a[href*=#]:not([href=#],[data-toggle],[data-target],[data-slide])').click(function() {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html,body').animate({
                            scrollTop: target.offset().top
                        }, 1000);
                        return false;
                    }
                }
            });
        });
        //#to-top button appears after scrolling
        var fixed = false;
        $(document).scroll(function() {
            if ($(this).scrollTop() > 250) {
                if (!fixed) {
                    fixed = true;
                    // $('#to-top').css({position:'fixed', display:'block'});
                    $('#to-top').show("slow", function() {
                        $('#to-top').css({
                            position: 'fixed',
                            display: 'block'
                        });
                    });
                }
            } else {
                if (fixed) {
                    fixed = false;
                    $('#to-top').hide("slow", function() {
                        $('#to-top').css({
                            display: 'none'
                        });
                    });
                }
            }
        });
        // Disable Google Maps scrolling
        // See http://stackoverflow.com/a/25904582/1607849
        // Disable scroll zooming and bind back the click event
        var onMapMouseleaveHandler = function(event) {
            var that = $(this);
            that.on('click', onMapClickHandler);
            that.off('mouseleave', onMapMouseleaveHandler);
            that.find('iframe').css("pointer-events", "none");
        }
        var onMapClickHandler = function(event) {
                var that = $(this);
                // Disable the click handler until the user leaves the map area
                that.off('click', onMapClickHandler);
                // Enable scrolling zoom
                that.find('iframe').css("pointer-events", "auto");
                // Handle the mouse leave event
                that.on('mouseleave', onMapMouseleaveHandler);
            }
            // Enable map zooming with mouse scroll when the user clicks the map
        $('.map').on('click', onMapClickHandler);

            function completedItem(name){ //name is the element you clicked . It is going to use nested if statments to only run if the class hasn't already been set to itemCompleted
                
              var listitem = document.getElementsByName(name);
                //listitem[0].removeClass();
                
                if(listitem[0].classList.contains("itemDue")){
                    
                    listitem[0].classList.remove("itemDue");
                
                    listitem[0].classList.add("itemCompleted");
                
                
                var currentDone = document.getElementById("listItemsCompletedCount").getAttribute("value");
                
                if(currentDone <= staticCountOfListItems)
                    {
                        //alert(countOfListItems.length);
                        currentDone = parseInt(currentDone);
                
                        currentDone += 1;
                        
                        document.getElementById("listItemsCompletedCount").setAttribute("value",currentDone);
                
                
                        document.getElementById("listItemsCompletedCount").innerHTML = currentDone;
                    }
                    
                }
                
               
            }
            
            var countOfListItems = document.getElementsByClassName("itemDue");
            
            var staticCountOfListItems = document.getElementById("listItemCount").innerHTML = countOfListItems.length;
            //var staticCountOfListItems = document.getElementById("listItemCount").innerHTML = countOfListItems.length;
            //alert(countOfListItems.length);

        </script>

          <script src="js/addListItem.js"></script>

    </body>

</html>

            

            
EOT;
            
            
            fwrite($newList, $text);
            fclose($newList);
            
            
            
            //echo '<br>'.$_SESSION['userName'];
        }
        
        public function addItem($db,$noteName,$listId,$listUrl,$creatorId){
            
            //echo('adding item');
            
            $sql = "INSERT INTO listitems (listId,itemName,creatorId,listUrl) VALUES ($listId,'$noteName',$creatorId,'$listUrl')";
            
            if ($db->query($sql) === TRUE) 
            {
                //echo "New record created successfully";
                
            } else {
                
                echo "Error: " . $sql . "<br>" . $db->error;
            }
            
            $sql2 = "SELECT itemId FROM listitems WHERE itemName = '$noteName'";
            
            $result = $db->query($sql2);
            $resultFinal = $result->fetch_assoc();
            return $resultFinal["itemId"];
        }
        public function deleteItem($db,$itemId,$listId){
            
            //echo('adding item');
            
            $sql = "DELETE FROM listitems WHERE listId = '$listId' AND itemId = '$itemId'" ;
            
            if ($db->query($sql) === TRUE) 
            {
                
                
            } else {
                
                echo "Error: " . $sql . "<br>" . $db->error;
            }
            
        }
        public function setItemNoteDetails($db,$listId,$itemId,$note,$videoLink){
            
           
            
            $sql = "INSERT INTO listitemdetails (listId,itemId,note,videoLink) VALUES ('$listId','$itemId','$note','$videoLink')";
            
            
            
            if ($db->query($sql) === TRUE) 
            {
                //echo "New record created successfully";
                
            } else {
                
                echo "Error: " . $sql . "<br>" . $db->error;
            }
        } 
        
        public function commentOnList($db,$listId,$comment,$commenterId,$commenterName){
            
           $date = date("Y-m-d");
            
            $sql = "INSERT INTO listcomments (listId,theComment,commenterId,date,commenterName) VALUES ('$listId','$comment','$commenterId','$date','$commenterName')";
            
            
            
            if ($db->query($sql) === TRUE) 
            {
                //echo "New record created successfully";
                
            } else {
                
                echo "Error: " . $sql . "<br>" . $db->error;
            }
        }
        
        public function deleteCommentOnList($db,$listId,$commentNumber){
            
           $date = date("Y-m-d");
            
            $sql = "Delete From listcomments WHERE listId ='$listId' and commentNumber = '$commentNumber'";
            
            
            
            if ($db->query($sql) === TRUE) 
            {
                //echo "New record created successfully";
                
            } else {
                
                echo "Error: " . $sql . "<br>" . $db->error;
            }
        }
        
        
        protected function setItemVideoLink(){}
        public function followList($db,$listId,$userId){
            
            $sql = "INSERT INTO listfollowers(listId,followerId) VALUES ('$listId','$userId')";
            
            
            if ($db->query($sql) === TRUE) 
            {
                //echo "New record created successfully";
                
            } else {
                
                echo "Error: " . $sql . "<br>" . $db->error;
            }
            
            $sql2 = "SELECT numberOfFollowers from list where listId ='$listId'";
            
            $result = $db->query($sql2) or die("can not find"); // finds the number of followers for  a list
        
            
            while($row = $result->fetch_assoc())  //get the current number of followers to add one to it
            {
                $finalResult = $row["numberOfFollowers"];
            }
            
            
            $finalResult++;
            
            $sql3 = "UPDATE list SET numberOfFollowers = '$finalResult' WHERE listId = '$listId' ";
            
            if($db->query($sql3)){}else{echo "Error: " . $sql3 . "<br>" . $db->error;}
            
        }
        public function unfollowList($db,$listId,$userId){
            $sql = "DELETE from listfollowers WHERE listId = '
$listId' and followerId = '$userId'";
            $db->query($sql);
            
            $sql2 = "SELECT numberOfFollowers from list where listId ='$listId'";
            
            $result = $db->query($sql2) or die("can not find"); // finds the number of followers for  a list
        
            
            while($row = $result->fetch_assoc())  //get the current number of followers to subtract one from it
            {
                $finalResult = $row["numberOfFollowers"];
            }
            
            
            $finalResult--;// -1
            
            $sql3 = "UPDATE list SET numberOfFollowers = '$finalResult' WHERE listId = '$listId' ";
            
            if($db->query($sql3)){}else{echo "Error: " . $sql3 . "<br>" . $db->error;}
            
        }
        protected function setPinnedList(){}
        
        protected function unPinList(){}
        
        public function getPublicLists($db){
            
            $sql = "SELECT * From list WHERE 1 ORDER BY listId DESC";
            
            $result = $db->query($sql);
            
            if ($result->num_rows > 0) {//only if there is somethingin the result
            
                while($row = $result->fetch_assoc()) {
                    echo '<li>
                            <a href="'.$row["listUrl"].'.php" id="titleOfTheList">'.$row["listTitle"].' </a>
                        </li>';
                    
                }
            
            //echo "$finalResult";
            
        } else {
            //echo "0 results";
        }
        }
        public function getFollowedLists($db,$listId,$followerId,$toggle){
            
            if ($toggle == '1'){
                //echo "toggle set to 1";
                $found = 0;
                $sql = "SELECT * FROM listfollowers WHERE followerId = '$followerId' AND listId = '$listId' ";
                
                $result = $db->query($sql);
                
                while($reply = $result->fetch_assoc()){
                 $found = 1;
                }
                
                
            }
            else
            {
                echo"toggle is not set to 1";
                
                
            }
            return $found;
            
        }
        public function getMyLists($db){
            
            $uid = $_SESSION['userId'];
            $sql = "Select * FROM list WHERE uid = $uid";
            $result = $db->query($sql);
            
            while ($list = $result->fetch_assoc())
            {
                echo "<a href='".$list["listUrl"].".php'>";
                echo $list['listTitle'];
                echo "</a><br>";
            }
        }
        
        public function getMyFollowedLists($db){
            
            $uid = $_SESSION['userId'];
            $sql = "Select * FROM listfollowers WHERE followerId = $uid";
            $result = $db->query($sql);
            
            
            
            while ($lists = $result->fetch_assoc())
            {
                $listId = $lists['listId'];
                $sql2 = "SELECT * FROM list where listid = $listId";
                $result2 = $db->query($sql2);
                
                    while($listReturned = $result2->fetch_assoc()){
                        
                        echo "<a href='".$listReturned["listUrl"].".php'>";
                        echo $listReturned['listTitle'];
                        echo "</a> Created by ";
                        
                        $listCreator = getUserName($db,$listReturned['creatorId']);
                        
                        echo $listCreator.'<br>';
                        
                    }
                
                
            }
        }
        protected function getPinnedLists(){}
        protected function getLists(){}
        public function getListItemsAdmin($db,$listId){
            $sql = "SELECT * FROM listitems where listId = '$listId' ";
            
            $result = $db->query($sql);

        if ($result->num_rows > 0) {
            
            
            // output data of each row
            
                while($row = $result->fetch_assoc()) {
                    echo "<li id='listItems' class='itemDue' name='".$row["itemId"]."'>
                            <p id='".$row["itemId"]."'>
                    
                                
                                
                                <button id='listItemButtons' value='".$row['itemId']."' onclick='showUser(".$row['listId'].",".$row['itemId'].")'> Delete</button>
                                <button id='listItemButtons' value='".$row["itemId"]."' onclick='completedItem()'> Complete</button><br>
                                ".$row['itemName']." 
        
                    
                            </p>
                        ";
                    
                    $this->getListItemDetails($db,$row["itemId"]);
                    echo "</li>";
                    
                    
                }
            
        } else {
            //echo "0 results";
        }
            
        }//Not sure this is being used
        
        
        public function getListFollowers($db,$listId){
            $sql = "SELECT numberOfFollowers FROM list where listId = '$listId' ";
            
            $result = $db->query($sql);

        if ($result->num_rows > 0) {//only if there is somethingin the result
            
                while($row = $result->fetch_assoc()) {
                    $finalResult = $row["numberOfFollowers"];
                    
                }
            
            echo "$finalResult";
            
        } else {
            //echo "0 results";
        }
            
        }
        public function getListItems($db,$listId,$creatorId){
            $sql = "SELECT * FROM listitems where listId = '$listId' ";
            
            $result = $db->query($sql);

        if ($result->num_rows > 0) {
            
            
            // output data of each row
            
                while($row = $result->fetch_assoc()) {
                    echo "<li id='listItems' class='itemDue' name='".$row["itemId"]."'><p id='".$row["itemId"]."'>";
                    
                    if(isset($_SESSION["userId"])){ // only check for the delete button if user signed in
                    
                                if($creatorId == $_SESSION["userId"])
                                {
                                    echo "<button id='listItemButtons' value='".$row['itemId']."' onclick='showUser(".$row['listId'].",".$row['itemId'].")'> Delete</button>";
                                }
                    }

                                 echo"<button id='listItemButtons' value='".$row["itemId"]."' onclick='completedItem(".$row['itemId'].")'> Complete</button><br>";
                    
                        echo $row['itemName']."</p>";
                            
                    $this->getListItemDetails($db,$row["itemId"]);
                    
                    echo "</li>";
                    
                    
                }
            
        } else {
            //echo "0 results";
        }
            
        }
        
        public function getListItemDetails($db,$itemId){
            
            //echo"now we did call it";
            $sql = "SELECT * FROM listitemdetails where itemId = '$itemId' ";
            
            $result = $db->query($sql);

        if ($result->num_rows > 0) {
            
            
                while($row = $result->fetch_assoc()) {
                    //echo "<p>'.$row["note"].'"<br>".$row["videoLink"].'<br></p>";
                    
                    echo "<p id='listItemsDetailsView'>".$row["note"]."<br>".$row["videoLink"]."<br></p>";
                }
            
        } else {
            //echo "0 results";
        }
            
        }
        
        public function getListComments($db,$listId,$currentUserId){
            
            //echo"now we did call it";
            $sql = "SELECT * FROM listcomments where listId = '$listId' ORDER BY commentNumber Desc ";
            
            $result = $db->query($sql);

        if ($result->num_rows > 0) {
            
            
                while($row = $result->fetch_assoc()) {
                    //echo "<p>'.$row["note"].'"<br>".$row["videoLink"].'<br></p>";
                    
                    echo '<li id="userComment"><span id="commenterName">';
                    
                    if($currentUserId == $row["commenterId"])
                    {
                        echo '<button id="deleteCommentB" onclick="deleteComment('.$row["commentNumber"].','.$listId.')">remove</button>';
                    }
                    
                   echo $row["commenterName"]; 
                    
                   echo '<br></span><span id="commenterComment">'.$row["theComment"].'</span></li>'; 
                }
            
        } else {
            //echo "0 results";
        }
            
        }
    }
        
          

    $newList = new allLists();

    if( isset($_POST['listTitle']) && isset($_POST['type']) && isset($_POST['privacy']) && isset($_POST['price']) && isset($_POST['category']) && isset($_POST['description']) ){

        //echo "<br><br>ALL FIELDS SET";
        
        
        $newList->createList($db,$_SESSION['userId'],$_POST['listTitle'],$_POST['type'],$_POST['privacy'],$_POST['price'],$_POST['category'],$_POST['description']);

    }
    else{}

function getListId($db,$listUrl){//Moved this out of the list class becuase it needs to be called before the newList is fully created
            
            $sql = "SELECT listId FROM list where listUrl = '$listUrl' ";
            
            $result = $db->query($sql);

        if ($result->num_rows > 0) {//only if there is something in the result
            
                while($row = $result->fetch_assoc()) {
                    $finalResult = $row["listId"];
                    
                }
            
            } else {echo"final was empty"; echo " the row is".$row["listId"];}
            
            return $finalResult;
            
        }

?>