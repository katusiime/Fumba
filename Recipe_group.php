<?php ob_start(); ?>
<?php
////refer to this page
$php_self = $_SERVER['PHP_SELF'];
//start sessions
session_start();
//check for session
if (!isset($_SESSION['user'])) {
//redirect to index page
    header("Location: index.php");
//exit
    exit(0);
}
// session data
$value_session = $_SESSION['user'];
$user_id = $value_session[0];
$user_name = $value_session[1];

$group = "";
if(isset($_GET['id'])){
    //setup session
$_SESSION['gr_ID'] = $_GET['id'];
    $group =$_GET['id'];
}
?>
<html lang="en">

<head>
<title>Recipe</title>
<meta charset="utf-8">
<!--css-->
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">

<link rel="stylesheet" href="css/grid.css" type="text/css" media="screen">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<link href='http://fonts.googleapis.com/css?family=PT+Serif+Caption:400,400italic' rel='stylesheet' type='text/css'>
<!--js-->
<script type="text/javascript" src="js/jquery-1.7.1.min.js" ></script>
<script type="text/javascript" src="js/superfish.js"></script>
<script type="text/javascript" src="js/forms.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<link href="css/dash.css" rel="stylesheet" type="text/css" />
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
          <li></li>
          <li></li>
          <li></li>
          <li></li>
         <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li><a href="index.php?logout=offline"><font color ="red" ><b>logOut<b/></font></a></li>
         
        </ul>
      </nav>
      <div class="clear"></div>
    </div>
  </div>
</header>
  
    
            <!--------------------- main content data ---------------------------------------->     
            <div class = "content_container"><!-- content_container starts here -->
                <div class="content_data"><!-- content_data starts here-->
                    <!-- bg................image ... preparationz...-->
                    <div class="group_img"><!-- group_img starts here-->
                        <div class="upsection"> <center> Hi User: <a href="dashboard.php"> <?php global $value_session; echo $value_session[1]; ?> </a></center> 
                        </div>

                        <div class="lowsection"><!-- low sec stratr here-->
                            <?php 
                           if(isset($_GET['id'])){
                               require_once 'includes/constants.php';
                            // establish a connection and insert it in db
                            $conx = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
                            if (!$conx) {
                                die("Database connection failed:" . mysql_error());
                            }

                            global $user_id;
                            //select DB to use
                            mysql_select_db(DB_NAME, $conx);
                            
                            //// fetch from database
                               $se  = mysql_query("SELECT  * FROM gr_p  WHERE gr_p_id ='{$group}' ", $conx);
                          
                            if (!$se) {
                                die("Database query failed:" . mysql_error());
                            }
                           // declare an array
                            $g_name ="";
                            $g_dish ="";
                            $g_photox ="";
                           while ($row = mysql_fetch_array($se)) {
                               $g_name =$row['gr_p_name'];
                               $g_dish = $row['Dish'];
                               $g_photox =$row['g_photo'];
                           }
                            //setup session
						$_SESSION['XX'] = $row['gr_p_name'];   
                           }
                            ?>
                            <div class="icon_sec" style="background-image: url(./<?php  if(isset($_GET['id'])){ echo $g_photox; }?>) "><!-- icon_sec  strat here-->
                                <div class="ic_up">
                                   <form action="image_processing.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="50000"> 
		<input type="file" value="Browse" class="img_browser" name="upfile" /> 
		<input type="submit" value="SAVE" name="save_image" class="img_browse"  />
	</form> 
                                </div>
                                <div class="ic_down">
                                 
                                </div>

                            </div><!-- icon_sec  ends here-->

                            <div class="upload_sector" ><!-- upload section  strats here-->
                              
                                <div class="upload_upper">
                                    <?php
                                     if(isset($_GET['id'])){
                                    ?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;  <font color="white">WELCOME TO GROUP :
                                    </font><font color="blue"> <?php echo $g_name; ?></font><br/>
                                    &nbsp;&nbsp;&nbsp;&nbsp; <h1> <font color="white">Our Best Dish is :
                                    </font><font color="black"> <?php echo $g_dish; ?></font></h1>
                              
                                     <?php } ?></div><a href="report.php?group=<?php echo $group;?>">
                                     <div class= "stat">
                                     Graph
                                     </div></a>

                            </div><!-- upload section ends here-->
                        </div><!-- low sec ends here-->
                    </div><!-- group_img ends here-->
                    <!-- bg................image ... preparationz...-->
                    <div class="main_data"><!-- main_data starts here-->
                        <!-- most logic is fount here's-->
                        <div class="news_feeds"><!-- news feeds starts here-->
                            
                            <?php 
                             if(isset($_GET['id'])){
                            require_once 'includes/constants.php';
                            // establish a connection and insert it in db
                            $con = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
                            if (!$con) {
                                die("Database connection failed:" . mysql_error());
                            }

                            global $user_id;
                            //select DB to use
                            mysql_select_db(DB_NAME, $con);
                            
                            //// fetch from database
                               $set  = mysql_query("SELECT  * FROM subscription_tb  WHERE user_id ='{$user_id}' AND gr_p_id = '{$group}' ", $con);
                          
                            if (!$set) {
                                die("Database query failed:" . mysql_error());
                            }
                           // declare an array
                            $userstatus ="";
                           while ($row = mysql_fetch_array($set)) {
                               $userstatus = array($row['sud_id'],$row['level']);
                           }
                           if(count($userstatus) >= 2){                            
                           if ($userstatus[1] == 'Cordinator' ) {
                            } elseif ($userstatus[1] == 'member') {
                                     echo " <center> <strong><font color = 'blue'><a href='image_processing.php?unsub={$userstatus[0]}&gr_p={$group}'>Unsubscribe</a></font></strong></center>";    
                         
                        }else {
                                echo " <center> <strong><font color = 'blue'><a href='image_processing.php?g={$group}'>Subscribe</a></font></strong></center>";    
                           }}  else {
   
             echo " <center> <strong><font color = 'blue'><a href='image_processing.php?g={$group}'>Subscribe</a></font></strong></center>";    
                          
                        }
                             }
                           ?>
                            <?php 
                                     if(isset($_GET['id'])){
                                         ?>
                                     
                                <div class="post_recipe"><!-- post recipe starts here-->
                                    
                                    <form action="Recipe_group.php?id=<?php echo $group;?>" method="post">
                                        <p> <textarea name="ser" cols="70" rows="2" wrap="virtual" placeholder="Post your recipe here"></textarea>
                                            <input type="submit" value="submit" name="postRecipe"/></p>
                                    </form>
                                     <?php if(isset($_POST['ser']) && isset($_POST['postRecipe'])){
                                         $rp_name =$_POST['ser'];
                                         $rpstate ="deactivated";
                                     // post a recipe
                                           require_once 'includes/constants.php';
                            // establish a connection and insert it in db
                            $connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
                            if (!$connection) {
                                die("Database connection failed:" . mysql_error());
                            }
                            // display available groups here
                            // function to query from the gr_p_id to pick group id  to subsribe
                            global $user_id;
                            //select DB to use
                            mysql_select_db(DB_NAME, $connection);
                            //// fetch from database
                           $query = "INSERT INTO recipe_tb(gr_p_id,user_id,recipe_name,re_act_status) VALUES("
. "'{$group}','{$user_id}','{$rp_name}','{$rpstate}')";
// check query results
$result = mysql_query($query, $connection);
                                    }
                                    ?>
                                </div>    <!-- post recipe ends here-->
                                     <?php } // show commenting console and marking bullshit
                                     ?>
                                <div class="recipe_fed"><!-- recipe fed ends here-->
                                    <?php 
                                    
                                          require_once 'includes/constants.php';
                            // establish a connection and insert it in db
                            $cons = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
                            if (!$cons) {
                                die("Database connection failed:" . mysql_error());
                            }

                            global $user_id;
                            //select DB to use
                            mysql_select_db(DB_NAME, $cons);
                            //// fetch from database
                               $setx  = mysql_query("SELECT rep.*,u.* FROM recipe_tb rep INNER JOIN user u"
                                       . " ON rep.gr_p_id = '{$group}' WHERE rep.re_act_status ='activated' AND rep.user_id =u.user_id ", $cons);
                          
                            if (!$setx) {
                                die("Database query failed:" . mysql_error());
                            }
                         
                           while ($row = mysql_fetch_array($setx)) {
                            
                                 
                            ?>
                                    
                                
                                    <div class="left_reci_icon" style="background-image: url(<?php echo  $row['user_photo'];?>)"><!-- left_recip_icon starts here-->
                                    </div><!-- left_recip_icon ends here-->
                                    <div class="right_reci_icon"><!--right_reci_icon starts here-->
                                        <?php 
                                    echo " <strong><font color='#d53827'>User :{$row['full_name']}</font></strong><br/>";
                                    echo"<strong><font color='#d53827'>Recipe :{$row['recipe_name']}</font></strong></br>";
                                    echo"<strong><font color='#d53827'>Recipe IDS :{$row['recipe_id']}</font></strong>";
                                                ?>
                                        <form action="image_processing.php" method = "POST">
                                            Rank Recipe :  0<input type="range" name="marks"  required ="required" min ="0" max="100" value="10"/>100
                                            <textarea name="ser" cols="50" rows="2"  wrap="virtual" required ="required"></textarea>
                                            <input type="hidden" name="rep_id" value="<?php echo $row['recipe_id'];?>"/>
                                             <input type="hidden" name="gp_id" value="<?php echo $row['gr_p_id'];?>"/>
                                            <input type="submit" value="Comment" name="submit"/>
                                        </form>
                                        <!-- comments shown here-->
                                       
                                        <center> <strong><font color = "blue">Comments shown here for each recipe</font></strong></center>
                                  <?php
                                  $conxs = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
                            if (!$conxs) {
                                die("Database connection failed:" . mysql_error());
                            }
                                   mysql_select_db(DB_NAME, $conxs);
                              // select from grade table to display comments
                                  $setxc  = mysql_query("SELECT * FROM grade_tb where recipe_id = '{$row['recipe_id']}' ORDER BY RAND() LIMIT 7", $conxs);
                          
                            if (!$setxc) {
                                die("Database query failed:" . mysql_error());
                            }
                         
                           while ($roxw = mysql_fetch_array($setxc)) {
                             echo"<strong><font color='#d53827'>Ranking :{$roxw['grade_mark']}</font></strong></br>";
                              echo"<strong><font color='#d53827'>comment :{$roxw['comment']}</font></strong></br><hr/>";
                           }
                                  
                                  
                                  ?>
                                    </div><!-- right_reci_icon ends here--><?php }?>
                                </div><!-- recipe fed ends here--> 
                                <?php
                            
                            if(isset($_GET['creategroup'])) {
                                // create a group
                                // you can subcribe boss
                                ?>

                                <div class="create_group"><!-- create_group starts here-->
                                    <form action="group_processor.php" method="post">
                                        <center> <table>
                                                <tr><td><strong> Group Name :</strong></td><td><input type="text" name="group_name" required placeholder="Enter Group name"/></td></tr>
                                                <tr><td><strong>Dish :</strong></td><td><input type="text" name="dish" required placeholder="Enter Dish name"/></td></tr>
                                                <tr><td></td><td><input type="submit" value="submit" name="submit"/></td></tr>
                                            </table>
                                    </form></center>
                                </div>    <!-- create_group ends here-->
                            <?php }
                            ?>
                        </div><!-- news feeds ends here-->
                        <div class="group_feeds"><!-- group feeds starts here-->
                            <div class="group_feeds_title">
                                <center><strong><font color="#d53827">Users With the Best Recipe</font></strong></center><br/></div>
                            <?php
                            // fetch the best recipe in a group
                            require_once 'includes/constants.php';
                            // establish a connection and insert it in db
                            $connec = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
                            if (!$connec) {
                                die("Database connection failed:" . mysql_error());
                            }
                            
                            //select DB to use
                            mysql_select_db(DB_NAME, $connec);
                            //// fetch from database
                            $qt = mysql_query("select recipe_id,grade_mark from grade_tb ORDER BY grade_mark DESC LIMIT 5", $connec);
                            if (!$qt) {
                                die("Database query failed:" . mysql_error());
                            }
                           
                            while ($rowa = mysql_fetch_array($qt)) {
                               
                            //$setRec = mysql_query("SELECT u.*,r.* FROM recipe_tb r INNER JOIN user u ON r.gr_p_id = '{$group}' //WHERE r.recipe_id ='{$rowa[0]}'",$connec);
							$setRec = mysql_query("SELECT u.*,r.* FROM recipe_tb r, user u  WHERE r.gr_p_id = '{$group}' AND u.user_id ='{$rowa[0]}'",$connec);
							
                               if (!$setRec) {
                                die("Database query failed:" . mysql_error());
                            }
                            //// use returned data 
                            while ($row = mysql_fetch_array($setRec)) {
                                ?>

                            
                                
                                <div class="info_container"><!-- info container starts here-->
                                    <div class="con_left">
                                    <img src="<?php echo $row['user_photo']; ?>"/>
                                    </div><!-- info con left ends here-->
                                    <div class="cont_right"><!-- info cont_right starts here-->
                                        <strong><font color="blue">User :<?php echo $row['full_name']; ?></font></strong><br/>
                                        <strong><font color="blue">Recipe Name :<?php echo $row['recipe_name']; ?></font></strong><br/>	                     					<strong><font color="#d53827">Ranking :<?php echo $rowa['grade_mark']; ?></font></strong><br/>
                                        <strong><font color="blue">Posted on :<?php echo $row['recp_date']; ?></font></strong><br/>

                                    </div><!-- info cont_right ends here-->
                                </div><!-- info container ends here-->
                                <br/>
                                <?php
                                }}
                            ?>
                        </div><!-- group feeds ends here-->

                    </div><!-- main_data ends here-->
                </div><!-- content_data ends here-->

                <div class="group_display"><!-- group_display starts here-->
                    <div class="group_title">
                        <center><strong><font color="#d53827">GROUPS YOU JOINED</font></strong></center><br/></div>
                    
                     <?php
// joined groups
                            require_once 'includes/constants.php';
                            // establish a connection and insert it in db
                            $connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
                            if (!$connection) {
                                die("Database connection failed:" . mysql_error());
                            }
                            // display available groups here
                            // function to query from the gr_p_id to pick group id  to subsribe
                            global $user_id;
                            //select DB to use
                            mysql_select_db(DB_NAME, $connection);
                            //// fetch from database
                            $query = mysql_query("SELECT gp.*,sub.* FROM gr_p gp INNER JOIN subscription_tb sub ON gp.gr_p_id = '{$group}' WHERE sub.user_id ='{$user_id}'AND  level ='member' ORDER BY RAND() LIMIT 4", $connection);
                            if (!$query) {
                                die("Database query failed:" . mysql_error());
                            }
                            //// use returned data 
                            while ($row = mysql_fetch_array($query)) {
                                ?>
                    <div class="group_con"><!-- info group_con starts here-->
                        <div class="co_left" style="background-image: url(./<?php echo $row['g_photo'];?>) "><!-- info co_left starts here-->
                        </div><!-- info co_left ends here-->
                        <div class="co_right"><!-- info co_right starts here-->
                            <?php
                                        echo "GROUP NAME :<a href = Recipe_group.php?id={$row['gr_p_id']}>{$row['gr_p_name']}</a><br/>";
                                        echo 'Dish  :' . $row['Dish'] . '<br/>';
                                        echo 'Opened On :' . $row['g_date'] . '<br/>';
                                        ?>

                        </div><!-- info co_right ends here-->
                    </div><!-- group_display ends here-->
                     <br/>
                                <?php
                            }
                            ?>
                </div><!-- group_display ends here-->


            </div><!-- content_container ends here -->
            <!--------------------- main content data ---------------------------------------->          
           
    
<!--==============================footer=================================-->
<div class="clear"></div>
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
