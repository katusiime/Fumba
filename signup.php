<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>SignUp</title>
<meta charset="utf-8">
<!--css-->
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">

<link rel="stylesheet" href="css/grid.css" type="text/css" media="screen">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link href='http://fonts.googleapis.com/css?family=PT+Serif+Caption:400,400italic' rel='stylesheet' type='text/css'>
<!--js-->
<script type="text/javascript" src="js/jquery-1.7.1.min.js" ></script>
<script type="text/javascript" src="js/superfish.js"></script>
<script type="text/javascript" src="js/forms.js"></script>
<link rel="stylesheet" type="text/css" href="css/style2.css" />
	<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<body>
    
<header>
  <div class="line-top"></div>
  <div class="main">
    <div class="row-top">
      <h1><a href="index.html"><img alt="" src="images/logo.png"></a></h1>
      <nav>
        <ul class="sf-menu">
          <li><a href="index.php">Home</a></li>
           <li><a href="recipes.html">Recipes</a> </li>
           <li><a href="chefs.html">Chefs</a> </li>
          <li class="active"><a href="contact.html">Contacts</a> </li>
          <li><a href="signup.php"><font color ="blue"><blink>SignUp/SignIn</blink></font></a></li>
        </ul>
      </nav>
      <div class="clear"></div>
    </div>
  </div>
</header>
  <div class = "container_demo"><!-- content-right starts here-->
 <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form  action="form_processor.php" autocomplete="on" method="POST"> 
                                <h1>Log in</h1> 
                               
                                    <label for="username" class="uname"  > Your email or username </label>
                                    <input id="username" name="username" required="required" type="text" placeholder="myusername or mymail@mail.com" autofocus="autofocus"/>
                               
                               
                                    <label for="password" class="youpasswd" > Your password </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                               
                                <p class="keeplogin"> 
									<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
									<label for="loginkeeping">Keep me logged in</label>
								</p>
                                                               
                                <p class="login button"> 
                                    <input type="submit" value="Login" name="submit" /> 
								</p>
                                <p class="change_link">
									Not a member yet ?
									<a href="#toregister" class="to_register">Join us</a>
								</p>
                            </form>
                        </div>

                        <div id="register" class="animate form">
                            <form  action="form_processor.php" autocomplete="on" method="POST"> 
                                <h1> Sign up </h1> 
                                
                                    <label for="usernamesignup" class="uname" >Enter FullName</label>
                                    <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder="mysuperusername690" autofocus="autofocus" />
                                
                                    <label for="emailsignup" class = "youmail"  > Your email</label>
                                    <input id="emailsignup" name="emailsignup" required="required" type="email" placeholder="mysupermail@mail.com"/> 
                               
                                    <label for="passwordsignup" class="youpasswd" >Your password </label>
                                    <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="eg. X8df!90EO"/>
                               
                                    <label for="passwordsignup_confirm" class="youpasswd" >Please confirm your password </label>
                                    <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                 
                                <p class="signin button"> 
									<input type="submit" value="Sign up"/> 
								</p>
                            
                             
                                <p class="change_link">  
									Already a member ?
									<a href="#tologin" class="to_register"> Go and log in </a>
								</p>
                            </form>
                        </div>
						
                    </div></div>
                    
<!--==============================footer=================================-->
<footer>
  <div class="main">
    <ul class="soc-list">
      <li><a href="https://www.facebook.com/groups/676307169126868/"><img alt="" src="images/icon-1.png"></a></li>
      <li><a href="https://twitter.com/hashtag/Fumba2014?src=hash"><img alt="" src="images/icon-3.png"></a></li>
      <li><a href="https://plus.google.com/u/0/?tab=XX"><img alt="" src="images/icon-4.png"></a></li>
    </ul>
    &copy Rights Resevered By Fumba 2014 <a href="http://mak.ac.ug/" rel="nofollow">Powered Makerere University  FCIT</a> </div>
    <div class="clear"></div>
  </footer>
</body>
</html>
