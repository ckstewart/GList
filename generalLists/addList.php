<?php 
   
    require_once 'functions/lists.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>General Lists</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/stylish-portfolio.css" rel="stylesheet">
    <link href="css/generalLists.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    
    
    
</head>

<body>

    <!-- Navigation -->
    <?php require_once 'navBar.php'; if(isset($_SESSION['userId'])){ ?>


    <div class="container">
        
        <div class="row">
            
            <h1 align="center">New List</h1>
            
        </div>
        
            <div class="row" id="newList">
               
                <div class="col-lg-12">
                    
                    <form method="post" action="addList.php"> <!-- This list will be updated on the list.php page via the if set -->

                          <div class="form-group">

                            <label for="title">Title</label>

                            <input type="text" class="form-control" id="listTitle" name="listTitle" placeholder="">


                          </div>
                            <div class="form-group">

                            <label for="type">Type</label>

                            <select class="form-control" id="type" name="type">
                                <option value="general">General</option>
                                <option value="toDo">To Do</option>
                                <option value="reminders">Reminders</option>
                              </select>



                          </div>
                            <div class="form-group">

                            <label for="privacy">Privacy</label>

                            <select class="form-control" id="privacy" name="privacy">
                                <option value="public">Public</option>
                                <option value="private">Private</option>
                                <option value="paid">Paid</option>
                              </select>


                          </div>
                            <div class="form-group">

                            <label for="price">Price</label>

                            <input type="text" class="form-control" id="price" name="price" aria-describedby="emailHelp" placeholder="$10.00">



                          </div>
                            <div class="form-group">

                            <label for="userName">Catergory</label>

                            <select class="form-control" id="catergory" name="category">
                                <option value="Health/Meal">Health/Meal Prep</option>
                                <option value="Health/Workout">Health/Workout Plan</option>
                                <option value="World Events/News">World Events/News</option>
                                <option value="World Events/Law Changes">World Events/Law Changes</option>
                                <option value="Food/Recipes">Food/Recipes</option>
                                <option value="Music/Lyrics">Music/Lyrics</option>
                                <option value="Music/Charts">Music/Charts</option>
                                <option value="Music/Other">Music/Other</option>
                                <option value="Travel/Trip Ideas">Travel/Trip Ideas</option>
                                <option value="Travel/Food">Travel/Food</option>
                                <option value="Travel/Road Trip">Travel/Road Trip</option>
                                <option value="Outdoors/Sites">Outdoors/Sites</option>
                                <option value="Outdoors/Outdoor Prep">Outdoors/Outdoor Prep</option>
                                <option value="Disaster Prep/Items">Disaster Prep/Items</option>
                                <option value="Disaster Prep/Shelters">Disaster Prep/Shelters</option>
                                <option value="Disaster Prep/Chores">Disaster Prep/Chores</option>
                                <option value="Other">Other</option>
                              </select>



                          </div>
                        
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                        </div>
                            
                        
                            <button type="submit" class="btn btn-primary">Save</button>
                        
                    </form>
                </div>
                
        
               
                
                  
                
            </div>
            
 
        </div>
    
    <?php }
    else header('Location:index.php')
    ?>
    
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
        
        
    </script>
      
      <script src="js/animals.js"></script>

</body>

</html>
