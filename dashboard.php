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
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Dashboard</title>
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
  <div class = "content_container"><!-- content_container starts here -->
                <div class="content_data"><!-- content_data starts here-->
                    <!-- bg................image ... preparationz...-->
                    <div class="group_img" ><!-- group_img starts here-->
                        <!--<img src="images/page1-img1.jpg " alt="dashboard"-->
                        <div class="upsection">
                            <center> Hi  User: <a href="dashboard.php"> <?php global $value_session; echo $value_session[1]; ?> </a></center>         

                        </div>

                        <div class="lowsection"><!-- low sec stratr here-->
                           
                                     <?php
                                require_once 'includes/constants.php';
                                // establish a connection and insert it in db
                                $concc = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
                                if (!$concc) {
                                    die("Database connection failed:" . mysql_error());
                                }

                                global $user_id;
                                //select DB to use
                                mysql_select_db(DB_NAME, $concc);
                                //// fetch from database
//                               
                                $setPic= mysql_query("SELECT user_id,user_photo FROM user WHERE user_id ='{$user_id}'",$concc);
                                if (!$setPic) {
                                    die("Database query failed:" . mysql_error());
                                }
                                $pic;
                                while ($rowq = mysql_fetch_array($setPic)){
                                    $pic = $rowq['user_photo'];
                                    
                                }?>
                             <div class="icon_sec" style="background-image: url(<?php echo $pic; ?>) "><!-- icon_sec  strat here-->
                                <div class="ic_up">
                                    <form action="image_processing.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="50000"> 
                                        <input type="file" value="Browse" class="img_browser" name="upfile" /> 
                                        <input type="submit" value="SAVE" name="save_image_dashboard" class="img_browse"  />
                                    </form> 
                                </div>
                                <div class="ic_down">

                                </div>

                            </div><!-- icon_sec  ends here-->

                            <div class="upload_sector" ><!-- upload section  strats here-->
                                <div class="upload_upper">
                                   
                                </div>

                                <div class ="upload_lower">
                                    <div class="left_bt_align"></div>
                                    <div class="right_bt_align">
                                        <form action="dashboard.php" method="post">
                                            <input type="hidden" name="image" value="Upload Image"/>
                                        </form>    
                                    </div>

                                </div>
                            </div><!-- upload section ends here-->
                        </div><!-- low sec ends here-->
                    </div><!-- group_img ends here-->
                    <!-- bg................image ... preparationz...-->
                    <div class="main_data"><!-- main_data starts here-->
                        <!-- most logic is fount here's-->
                        <div class="news_feeds"><!-- news feeds starts here-->
                            <?php
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
                               $set  = mysql_query("SELECT gp.*,sub.level FROM gr_p gp INNER JOIN subscription_tb sub"
                                       . " ON gp.user_id = sub.user_id WHERE gp.user_id ='{$user_id}' LIMIT 1", $con);
                          
                            if (!$set) {
                                die("Database query failed:" . mysql_error());
                            }
                            //// use returned data 
//                           $ph = mysql_fetch_array($set);
                            $groupnamedisplay = "";
                           while ($row = mysql_fetch_array($set)) {
                              $groupnamedisplay = $row['gr_p_name']; 
                           }      
                            ?>
                            <center> <strong><font color = "white"><?php echo" Hi User : <font color ='blue'>".$user_name.
                                    "</font> You are a cordinator of  group:<font color='blue'>" .$groupnamedisplay.'</font>';?></font></strong></center>
                            <?php if($groupnamedisplay == ""){
                                ?>
                                <center> <strong><font color = "white"><a href="Recipe_group.php?creategroup=WI509jGM4eiBISQ">Create Group</a></font></strong></center>
                            <?php } ?>


                            <?php
                                require_once 'includes/constants.php';
                                // establish a connection and insert it in db
                                $conc = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
                                if (!$conc) {
                                    die("Database connection failed:" . mysql_error());
                                }

                                global $user_id;
                                //select DB to use
                                mysql_select_db(DB_NAME, $conc);
                                //// fetch from database
//                              
                                 $setR = mysql_query("SELECT *  FROM subscription_tb WHERE user_id ='{$user_id}' AND level = 'Cordinator'");
                                if (!$setR) {
                                    die("Database query failed:" . mysql_error());
                                }
                               $u_gr_ids ="";
                                while ($rowq = mysql_fetch_array($setR)){
                                    $u_gr_ids = array($rowq['gr_p_id']);
                                }
                                
                                if ($u_gr_ids != ""){
                                    foreach ($u_gr_ids as $value) {
                                        
                                    
                                
                                
                                $setRec = mysql_query("SELECT u.*,r.* FROM recipe_tb r INNER JOIN user u ON r.gr_p_id = '{$u_gr_ids[0]}' WHERE u.user_id ='{$user_id}' AND re_act_status = 'deactivated'ORDER BY RAND() LIMIT 4");
                                if (!$setRec) {
                                    die("Database query failed:" . mysql_error());
                                }
                                while ($rowq = mysql_fetch_array($setRec)){?>
                            <div class="recipe_fed"><!-- recipe fed ends here-->
                               <?php
                                    echo "<font color='white'>Recipe :  ". $rowq['recipe_name']."</font><br/>";
                                    echo "<font color='white'>Posted On :  ". $rowq['recp_date']."</font><br/>";
                                    echo "<a href =image_processing.php?a={$rowq['recipe_id']}>Activate</a><br/>";
                                ?>
                                
                                
                         
                            </div><!-- recipe fed ends here-->
                                <?php }} }?>
                        </div><!-- news feeds ends here-->


                        <div class="group_feeds"><!-- group feeds starts here-->
                            <div class="group_feeds_title">
                                <center><strong>GROUPS YOU JOINED</strong></center><br/></div>
                            <?php
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
                            // get the groups in an array first
                              //// fetch from database
                           $qu = mysql_query("SELECT * FROM subscription_tb WHERE user_id = '{$user_id}' AND level ='member' ORDER BY RAND() LIMIT 7", $connection);
                           if (!$qu) {
                                die("Database query failed:" . mysql_error());
                            }
                            // intialize an array to hold my group mebers
                            $group_holder ="";
                            //// use returned data 
                            while ($row = mysql_fetch_array($qu)) {
                                $group_holder = array($row['gr_p_id']);
                            }
                            if($group_holder != null){
                            foreach ($group_holder as $member) {
                            
                            //// fetch from database
                           $query = mysql_query("SELECT * FROM gr_p WHERE gr_p_id ='{$member}'", $connection);
                            if (!$query) {
                                die("Database query failed:" . mysql_error());
                            }
                            //// use returned data 
                            while ($row = mysql_fetch_array($query)) {
                                ?>

                                <div class="info_container"><!-- info container starts here-->
                                    <div class="con_left"><!-- info con_left starts here-->
                                        <img src="<?php echo $row['g_photo'];?>" alt="<?php echo $row['gr_p_name'];?>"/>
                                    </div><!-- info con left ends here-->
                                    <div class="cont_right"><!-- info cont_right starts here-->
                                        <?php
                                        echo "GROUP NAME :<a href = Recipe_group.php?id={$row['gr_p_id']}>{$row['gr_p_name']}</a><br/>";
                                        echo 'Dish  :' . $row['Dish'] . '<br/>';
                                        echo 'Opened On :' . $row['g_date'] . '<br/>';
                                        ?>
                                    </div><!-- info cont_right ends here-->
                                </div><!-- info container ends here-->
                                <br/>
                                <?php
                            } }  }  // end of for each
                            ?>
                        </div><!-- group feeds ends here-->

                    </div><!-- main_data ends here-->
                </div><!-- content_data ends here-->

                <div class="group_display"><!-- group_display starts here-->
                    <div class="group_title">
                        <center><strong>Available Groups</strong></center><br/></div>

                    <?php
                    require_once 'includes/constants.php';
                    // establish a connection and insert it in db

                    if (!$connection) {
                        die("Database connection failed:" . mysql_error());
                    }
                    // display available groups here
                    // function to query from the gr_p_id to pick group id  to subsribe
                    global $user_id;
                    //select DB to use
                    mysql_select_db(DB_NAME, $connection);
                    //// fetch from database
                    $que = mysql_query("SELECT * FROM gr_p ORDER BY RAND() LIMIT 6", $connection);
                    if (!$que) {
                        die("Database query failed:" . mysql_error());
                    }
                    //// use returned data 
                    while ($row = mysql_fetch_array($que)) {
                        ?>
                        <div class="group_con"><!-- info group_con starts here-->
                            <div class="co_left"><!-- info co_left starts here-->
                            <img src="<?php echo $row['g_photo'];?>" alt="<?php echo $row['gr_p_name'];?>"/>
                            </div><!-- info co_left ends here-->
                            <div class="co_right"><!-- info co_right starts here-->
                                <?php
                                echo "GROUP NAME :<a href = Recipe_group.php?id={$row['gr_p_id']}><font color='blue'>{$row['gr_p_name']}</font></a><br/>";
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
