<?php

    require_once 'functions/users.php';

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


    <div class="container">
        
        <div class="row">
            
            <h1 align="center">General Lists</h1>
            
        </div>
        
            <div class="row" id="signIn">
                
                <h2 align="center">Sign In</h2>
               
                <div class="col-lg-8 col-lg-offset-2">
                
                    <form method="post" action="index.php">
                    
                      <div class="form-group">

                        <label for="email">Email address</label>

                        <input type="email" class="form-control" name="userEmail" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

                        

                      </div>

                      <div class="form-group">

                        <label for="password">Password</label>

                        <input type="password" class="form-control" name="userPassword" id="password" placeholder="Password">

                      </div>

                      <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                
                </div>
                
                
                
                
            </div>
        
        
        
            <div class="row" id="signUp">
                
                <h2 align="center">Sign Up</h2>
                
                <div class="col-lg-8 col-lg-offset-2">
                    
                    <form method="post" action="index.php">

                      <div class="form-group">

                        <label for="userName">User Name</label>

                        <input type="text" class="form-control" name='userName' id="userName" aria-describedby="emailHelp" placeholder="User Name" required>

                        

                      </div>
                        
                        <div class="form-group">

                        <label for="email">Email</label>

                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>

                        

                      </div>
                        

                      <div class="form-group">

                        <label for="password">Password</label>

                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>

                      </div>

                      <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                
                
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
        
        
    </script>
      
      <script src="js/animals.js"></script>

</body>

</html>
