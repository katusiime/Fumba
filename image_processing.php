<?php
//start sessions
session_start();

require_once 'includes/connection.php';
require_once 'includes/funtions.php';

// session data
$value_session = $_SESSION['user'];
$user_id = $value_session[0];
$g_id = $_SESSION['gr_ID'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<?php
if (isset($_POST['save_image'])) {
    $uploaddir = "uploads/";
    $uploadfile = $uploaddir . $_FILES['upfile']['name'];
    $userphoto = mysql_preparation($uploadfile);
    if (move_uploaded_file($_FILES['upfile']['tmp_name'], $uploadfile)) {
        //select DB to use
        select_DB_TO_USE();
// insert into db
        $query = "UPDATE gr_p SET  g_photo  = '{$userphoto}' WHERE gr_p_id = '{$g_id[0]}'";
// check query results
        $user_icon = mysql_query($query, $connection);

//$_SESSION['user'] = $user_icon;
        header("location:Recipe_group.php?id=".$g_id[0]);
        exit(0);
    } 
        header('location:Recipe_group.php'.$g_id[0]);
    } else {

        echo("<center><h1><font color='red'>File upload failed" . '</font></h1></center><br/>');
        echo "<strong><font color='blue'>FILE NAME:" . $_FILES['upfile']['name'] . "</font><strong><br/>";
        echo("<font color='red'>Please check the file extension you are trying to upload on a server<br/>"
        . "It shouuld be a .jpg,.png/.jpeg and the file size shouldn't exceed 50KB<br/>"
        . "Click <font color='blue'><a href='Recipe_group.php'>HERE</a></font> to reupload again.</font>");
    }


if (isset($_POST['save_image_dashboard'])) {
    $uploaddir = "userimg/";
    $filename = mt_rand();
    $uploadfile = $uploaddir . $_FILES['upfile']['name'];
    $userphoto = mysql_preparation($uploadfile);
    if (move_uploaded_file($_FILES['upfile']['tmp_name'], $uploadfile)) {
        // update photo column in user table
//select DB to use
        select_DB_TO_USE();
// insert into db
        $query = "UPDATE user SET  user_photo  = '{$userphoto}' WHERE user_id = '{$user_id}'";
// check query results
        $user_icon = mysql_query($query, $connection);

//$_SESSION['user'] = $user_icon;
        header('location:dashboard.php');
        exit(0);
    } else {

        echo("<center><h1><font color='red'>File upload failed" . '</font></h1></center><br/>');
        echo "<strong><font color='blue'>FILE NAME:" . $_FILES['upfile']['name'] . "</font><strong><br/>";
        echo("<font color='red'>Please check the file extension you are trying to upload on a server<br/>"
        . "It shouuld be a .jpg,.png/.jpeg and the file size shouldn't exceed 50KB<br/>"
        . "Click <font color='blue'><a href='dashboard.php'>HERE</a></font> to reupload again.</font>");
    }
}
?>
<?php
if (isset($_GET['a'])) {
    require_once 'includes/constants.php';
    // establish a connection and insert it in db
    $conc = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
    mysql_select_db(DB_NAME, $conc);
//// insert into db
    $act = "activated";
    $query = "UPDATE recipe_tb SET re_act_status  = '{$act}' WHERE recipe_id = '{$_GET['a']}'";
//// check query results
    mysql_query($query, $conc);
    header('location:dashboard.php');
    exit(0);
}
?>
<?php
if (isset($_GET['unsub']) && $_GET['gr_p']) {
    $u = $_GET['unsub'];
    $g = $_GET['gr_p'];
    require_once 'includes/constants.php';
//                               // establish a connection and insert it in db
    $conc = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
    mysql_select_db(DB_NAME, $conc);
    $act = null;
    $query = "DELETE  FROM subscription_tb WHERE sud_id = '{$u}' AND gr_p_id ='{$g}'";
    mysql_query($query, $conc);
    header('location:Recipe_group.php?id=' . $g);
}
?>

<?php
if (isset($_GET['g'])) {
    $g = $_GET['g'];
    require_once 'includes/constants.php';
    // establish a connection and insert it in db
    $conc = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
    mysql_select_db(DB_NAME, $conc);
//// insert into db
    $act = "member";
    $query = "INSERT INTO subscription_tb(gr_p_id,user_id,level) VALUES("
            . "'{$g}','{$user_id}','{$act}')";
// check query results
    $result = mysql_query($query, $conc);
    header('location:Recipe_group.php?id=' . $g);
    exit(0);
}
?>

<?php
if (isset($_POST['rep_id']) && isset($_POST['submit']) && isset($_POST['ser']) && isset($_POST['gp_id']) && isset($_POST['marks'])) {
    require_once 'includes/constants.php';
    echo 'Value have come this side bro !!!!';
    $g_id = $_POST['gp_id'];
    $r_id = $_POST['rep_id'];
    $comt = $_POST['ser'];
    $gradMArk = $_POST['marks'];

//// establish a connection and insert it in db
    $conc = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
    mysql_select_db(DB_NAME, $conc);
//////// insert into db

    $query = "INSERT INTO grade_tb(recipe_id,grade_mark,comment) VALUES("
            . "'{$r_id}','{$gradMArk}','{$comt}')";
////// check query results
    $result = mysql_query($query, $conc);
    header('location:Recipe_group.php?id=' . $g_id);
    exit(0);
}
?>