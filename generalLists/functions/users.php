<?php 
          
    include_once 'connectdb.php';

    class User // will get and dislay all user along with relation to user
    {
       var $userName;
       var $password;


        private function signIn(){}// this will get all user info including lists etc
        private function signUp($db,$userName,$email,$password){



        }//submit new user info and go to home
    }

    //echo'in users<br>';//making sure users has been ac

    if ( isset($_POST['userEmail']) && isset($_POST['userPassword']) )// Sign In functionality
    { 

        $email      = $_POST['userEmail'];          //sets vars for users sql insert
        $password   = $_POST['userPassword'];

        $_SESSION['userId'] = getUserId($db,$email,$password);
        $_SESSION['userName'] = getUserName($db,$_SESSION['userId']);
        relocate();


    }

    if ( isset($_POST['userName']) && isset($_POST['email']) && isset($_POST['password']) )// Sign Up functionality
    {


        $userName   = $_POST['userName'];
        $email      = $_POST['email'];          //sets vars for users sql insert
        $password   = $_POST['password'];
        $dateCreated= date("Y-m-d");
        $birthDate  = '1993-3-05'; // uses default so sql will run




            $sql = "INSERT INTO listusers (userName,email,password,dateCreated,birthDate,gender,occupation,profilePicture) VALUES ('$userName','$email','$password','2017-12-23','1993-3-05','','','')";



           if(mysqli_query($db,$sql) or die('<br>could not add user '.$db->error)) // inserts into sql table , sets session var and relocates to home.php
           {

               $_SESSION['userId'] = getUserId($db,$email,$password);
               $_SESSION['userName'] = getUserName($db,$_SESSION['userId']);
               relocate();

           }


    }

    function relocate() // relocates to home after sign in
    {   
        header("Location: home.php");
    }

    function getUserId ($db,$email,$password){

        $sql = "SELECT uid from listusers WHERE email = '$email' and password = '$password'";

        $result = mysqli_query($db,$sql) or die("could not get uid ".$db->error);
        $result = mysqli_fetch_assoc($result);
        //echo $result["uid"]."we should be here";
        return $result["uid"];
    }

    function getUserName ($db,$uid){

        $sql = "SELECT userName from listusers WHERE uid = '$uid'";

        $result = mysqli_query($db,$sql) or die("could not get uid");
        $result = mysqli_fetch_assoc($result);
        //echo $result["userName"]."we should be here";
        return $result["userName"];
    }

?>