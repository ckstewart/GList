    <!-- Navigation -->
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav" id="userNavBar">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="home.php" onclick=$("#menu-close").click();>Home</a>
            </li>
            
            <li>
                <a href="myLists.php" onclick=$("#menu-close").click();>My Lists</a>
            </li>
            
            <li>
                <a href="publicLists.php" onclick=$("#menu-close").click();>Public List</a>
            </li>
            
            <li>
                <a href="messages.php" onclick=$("#menu-close").click();>Messages</a>
            </li>
            
            <li>
                <a href="signOut.php" onclick=$("#menu-close").click();>Sign Out</a>
            </li>
            
            <li>
                <a href="notifcations.php" onclick=$("#menu-close").click();>Notifications</a>
                
                <div id="notificationsFeed">
                    <ul id="notificationsList">
                        <li>Task Comming up</li>
                        <li>New comment on Workout list</li>
                    </ul>
                
                </div>
            </li>
        </ul>
    </nav>
