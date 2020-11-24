<?php 
//start sessions
	session_start();
        //logout user
	if(isset($_GET['logout']))
	{
		//unset session 
		unset($_SESSION['user']);
		//redirect to index page
		header("Location: index.php");
		//exit
		exit(0);
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>Fumba</title>
<meta charset="utf-8">
<!--css-->
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/grid.css" type="text/css" media="screen">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<link href='http://fonts.googleapis.com/css?family=PT+Serif+Caption:400,400italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen">
<!--js-->
<script type="text/javascript" src="js/jquery-1.7.1.min.js" ></script>
<script type="text/javascript" src="js/superfish.js"></script>
<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>

<script>	
			jQuery(window).load(function() {								
			jQuery('.flexslider').flexslider({
				animation: "fade",			
				slideshow: true,			
				slideshowSpeed: 7000,
				animationDuration: 600,
				prevText: "",
				nextText: "",
				controlNav: false		
			})
			  
			
					
      });
	</script>


</head>
<body>

<!--==============================header=================================-->
<header>
  <div class="line-top"></div>
  <div class="main">
    <div class="row-top">
      <h1><a href="index.php"><img alt="" src="images/logo.png"></a></h1>
      <nav>
        <ul class="sf-menu">
          <li class="active"><a href="index.php">Home</a></li>          
          <li><a href="recipes.html">Recipes</a>           
           <li><a href="chefs.html">Chefs</a> </li>
          <li><a href="contact.html">Contacts</a> </li>
	 <li><a href="signup.php"><font color ="blue">SignUp/SignIn</font></a></li>
        </ul>
      </nav>
      <div class="clear"></div>
    </div>
  </div>
  <div class="box-slider">
    <div class="flexslider">
      <ul class="slides">
        <li> <img alt="" src="images/slide-1.jpg"></li>
        <li> <img alt="" src="images/slide-2.jpg"></li>
      </ul>
    </div>
  </div>
  <div class="box-slogan">
    <h3>Welcome Fumba Recipe Corner</h3>
    <p> we have the  best Recipe for your home dish. Make your family a surprise !!  </p>
  </div>
</header>
<!--==============================content=================================-->
<section id="content"><div class="ic"></div>
  <div class="border-horiz"></div>
  <div class="container_12 row-1">
    <article class="grid_4 thumbnail-1">
      <h3><span>Vegan</span> cookings </h3>
      <figure class="box-img"><img src="images/page1-img1.jpg" alt="" /></figure>
      <p>Meet Professional chefs to guide you prepare the best meal of your life</p>
      </article>
    <article class="grid_4 thumbnail-1">
      <h3><span>grill</span> cookings </h3>
      <figure class="box-img"><img src="images/page1-img2.jpg" alt="" /></figure>
      <p>Just signUp to view our best recipes at no costs . .</p>
       </article>
    <article class="grid_4 thumbnail-1">
      <h3><span>dessert</span> cookings </h3>
      <figure class="box-img"><img src="images/page1-img3.jpg" alt="" /></figure>
      <p>Own a free account and control your family always.....</p>
       </article>
    <div class="clear"></div>
  </div>
  <div class="border-horiz"></div>
  
</section>

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
