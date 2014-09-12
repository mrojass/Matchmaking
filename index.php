<?php

//check for session. If user is already logged in, redirect to appropriate menu
    if(array_key_exists('role', $_SESSION) && $_SESSION['role'] == 1)
    {
        header('Location:./StudentSide/');
        exit();
    }
    else if(array_key_exists('role', $_SESSION) && $_SESSION['role'] == 2)
    {
        header('Location: ./AdminSide/');
        exit();
    }

    //get message to display if there is one
    if( array_key_exists('message', $_SESSION) )
    {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }     
    else
    {
        $message = "<br>";  
    } 
?>
<!doctype HTML>
    <html lang="en">
    <head>
      <meta charset="utf-8">
      <title>MatchMaking</title>
      <link rel="stylesheet" href="css/normalize.css">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" type="text/css" href="css/nav.css">
      <script type="text/javascript" src="js/jquery-1.11.0.js"></script>
      <script type="text/javascript">
            $(document).ready(function() {
                
                $("button").click(function(){
                     $("#login").show();
                     $("button").hide();
                });
                
            });
            </script>
    </head>
<body>
       <header>
            <img id="logo" src="images/matchlogo.jpg" alt="Logo" height="50" width="200"/> <br>
            <div id="topheader"><center> <h1> WELCOME TO MATCHMAKING </h2> <br>
                        
            </center>
        </header>
    <center>
        <button type="button">Login</button></div>
    <div id="login">
        <table border="0" cellspacing="0" cellpadding="5">
            <h4>Please Enter Student Info Below: </h4>
            <form name="loginform" method=post action="index.php">
            <tr> 
                <td>FSUID</td>
                <td><input class="forminput" type="text" name="fsuid" size="13" value=""></td>
            </tr>
            <tr> 
                <td>Password</td>
                <td><input class="forminput" type="Password" name="password" size="13"></td>
            </tr>
            <tr> 
                <td><input class=loginbutton type="submit" name="Submit" value="Login"></td>
            </tr>

            </form>
            </table>
    </div> </center>
    <div id="content">
    <!-- end login -->
    <center>
        <h2> Your Perfect Group is Waiting for YOU! </h2>
        <img id="group" src="images/businessmen-white.png" width="500" height="300"/>
    </center>
    <!--<div id="container">
    	<h2> Your Perfect Group is Waiting for YOU! </h2>
    	<img src="images/businessmen-white.png" width="500" height="300"/>
    </div> <center>end container -->
    </div>
    <footer>
    	<p>&#169; Team MatchMaking</p>
    </footer>
</body>
</html>
