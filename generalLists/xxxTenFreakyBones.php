                <?php
        require_once("functions/lists.php");

        $listId = '1411';  // add list id here in save file
        $listUrl = ''; // add list url here in save file
        $creatorId = 4;     // add creatorId here in save file
        $currentUser = '0';

        if(isset($_SESSION['userId'])){ //This sets the currentUser var so that comments can only be deleted by the user who posted it while uncreated users you can still view the comments
            
            $currentUser = $_SESSION['userId'];
        }

        if(isset($_POST['noteName']))//saves notes and details
        {
            $itemId = $newList->addItem($db,$_POST['noteName'],$listId,$listUrl,$creatorId); // add list url here in save file (should work since the escape string should activate in saved file)
            
            if(isset($_POST['noteNotes']))
            {
                
                $newList->setItemNoteDetails($db,$listId,$itemId,$_POST['noteNotes'],$_POST['videoLink']);
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

        <title>GL xxxTenFreakyBones </title> <!-- Change in the save file -->

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

                <h1 align="center"> <span id="costOfList">$</span></h1> <!-- change these in saved file-->
                <h3 align="center">Topic: Health/Meal</h3> <!-- change these in saved file -->
                <h4 align="center">Created by: xxxTenFreakyBones</h4>
                <h5 align="center"><span id="followerNumber"><?php $newList->getListFollowers($db,$listId); ?></span> Followers</h5>
                
                
                <?php 
                    $result = $newList->getFollowedLists($db,$listId,$currentUser,'1'); //toggle value decides whether you are looking for all the list you follow or just a 1 when you're checking againt one list
                
                    if($creatorId == $currentUser)
                    {
                        echo'<h6 align="center">Admin</h6>';
                    }
                    else if ($result == '1')
                    {
                        echo'<div id="unfollowButton"><h6 align="center"><em><button onclick="unFollowList('.$listId.','.$currentUser.')">UnFollow</button></em></h6></div>';
                    } 
                else {echo'<div id="followButton"><h6 align="center"><button onclick="followList('.$listId.','.$currentUser.')">Follow</button></h6></div>';}
                
                ?>


                <div class="col-lg-12">
                    
                  <?php  if($creatorId == $currentUser){ ?>
                        <form method="post" action="xxxTenFreakyBones.php"> <!--  change in save file -->

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
                                        $newList->getListItems($db,$listId,$creatorId);
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
                                <?php $newList->getListComments($db,$listId,$currentUser); ?>
                                
                            
                            </ul>
                    
                            <div class="form-group">
                                
                                <label for="comment"></label>
                                
                                <textarea class="form-control" rows="3" id="newCommentInput"></textarea>
                                <?php echo'<button onclick="leaveComment('.$currentUser.','.$listId.')" id="commentSubmit">Comment</button>'; ?>
                                
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

            

            